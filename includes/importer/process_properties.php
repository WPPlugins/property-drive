<?php
function jtg_import_property_drive($properties, $log)
{
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Property Importer Processing 
///////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Start the timer for the log
	$time_start = microtime(true);
		// Loop through each property in the feed
		foreach($properties as $property) {
			// Call the WP global var
			global $wpdb;
			// Setup the inbound unique ID, this is how we compare the properties in the feed / db
			$jtg_inbound_id = $property->Id;
			// Find out if the property already exists
			$in_wp_db = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key = 'importer_id' AND meta_value = $jtg_inbound_id LIMIT 1", ARRAY_A);
			// Check to make sure is an admin user running this
			if ( ! is_admin() ) {
			    require_once( ABSPATH . 'wp-admin/includes/post.php' );
			}
			// print_r($in_wp_db);
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Check the control rule on the inbound feed
///////////////////////////////////////////////////////////////////////////////////////////////////////////
			$system_status = $property->ControlRule;

			if ($system_status == 'Published_Online') {
				$system_status_check = true;
			} elseif ($system_status == 'Archived_Offline') {
				$system_status_check = false;
			} elseif ($system_status == 'Deleted') {
				$system_status_check = false;
			} elseif ($system_status == 'Expired') {
				$system_status_check = false;
			} elseif ($system_status == 'Active_Offline') {
				$system_status_check = true;
			} elseif ($system_status == 'Awaiting_Payment') {
				$system_status_check = false;
			} elseif ($system_status == 'Pending_Review') {
				$system_status_check = false;
			}

			// If it is not in the Database - IMPORT!
				if (!$in_wp_db && $system_status_check == true) {
					// Settings saved by user
					$importer_options = get_option('pm_importer_options');
					// Check if theme compatibility has been turned on
					$compatibility = $importer_options['jtg_theme_compatibility'];
					// Item variable will handle post information
					$item = array();
					// Set user and post title
					$item['user'] = $importer_options['property_author'];
					$item['title'] = ucwords($property->Address);
					// Create property description through specialized function
					if ($compatibility == 'none') {
						$item['description'] = $property->Desc;
					} elseif($compatibility == 'lava-real-estate') {
						$item['description'] = $property->Desc.'<br><br>'.$property->BER.'<br>'.$property->EPI;
					}

					if ($system_status == 'Active_Offline') {
						$item['post_status'] = 'draft';
					} else {
						if ($importer_options['pd_auto_draft_properties'] == 'true') {
							$item['post_status'] = 'draft';
						} else {
							$item['post_status'] = 'publish';
						}
						
					}

					


	



					// Create property's post
					$post_id = jtg_create_property($item);
					// Save the Unique ID to the new post for comparison
					update_post_meta($post_id, 'importer_id', $jtg_inbound_id);
					// Add the control rule to the DB
					update_post_meta($post_id, 'system_status', $system_status);

					









						if($post_id){
							// Create property images
							$count = 1;
							$result = array();
								foreach($property->Pics as $image){
									if($image){
										if($result[] = jtg_create_property_images($post_id, $image, $count)){
											$count++;
										}
									}
								}
								// Set property thumbnail
								if($result[0]){
									set_post_thumbnail($post_id, $result[0], 0);
									unset($result[0]);
								}
							update_post_meta($post_id, 'detail_images', $result);

							// We setup the meta variables for saving in the DB
							// setup_taxonomies_meta.php
							$meta = jtg_setup_meta_data($property);

							// Then we send the variables we just setup to the DB
							// database.php
							$meta_result = jtg_add_property_meta($post_id, $meta, $log);

//////////////////////////////////////////////////////////////
///  Set the Property Status
/////////////////////////////////////////////////////////////
							if ($compatibility == 'wp-residence') {
								$status = term_exists($property->Status, 'property_action_category');
							
								if(!($status === NULL)) {
									wp_set_object_terms($post_id, intval($status['term_id']), 'property_action_category');
								}
								else {
									$status_created = wp_insert_term($property->Status, 'property_action_category');
									wp_set_object_terms($post_id, $status_created, 'property_action_category');
								}
							} else {

								$status = term_exists($property->Status, 'property_status');
							
								if(!($status === NULL)) {
									wp_set_object_terms($post_id, intval($status['term_id']), 'property_status');
								}
								else {
									$status_created = wp_insert_term($property->Status, 'property_status');
									wp_set_object_terms($post_id, $status_created, 'property_status');
								}

							}



//////////////////////////////////////////////////////////////
///  Set the Property Type
/////////////////////////////////////////////////////////////

							if ($compatibility == 'wp-residence') {

								$type = term_exists($property->Type, 'property_category');
							
								if(!($type === NULL)) {
									wp_set_object_terms($post_id, intval($type['term_id']), 'property_category');
								}
								else {
									$type_created = wp_insert_term($property->Type, 'property_category');
									wp_set_object_terms($post_id, $type_created, 'property_category');
								}
							} else {


								$type = term_exists($property->Type, 'property_type');
							
								if(!($type === NULL)) {
									wp_set_object_terms($post_id, intval($type['term_id']), 'property_type');
								}
								else {
									$type_created = wp_insert_term($property->Type, 'property_type');
									wp_set_object_terms($post_id, $type_created, 'property_type');
								}

							}

//////////////////////////////////////////////////////////////
///  Set the Property County
/////////////////////////////////////////////////////////////

							if ($compatibility == 'wp-residence') {
								$county = term_exists($property->CountyCityName, 'property_county_state');
							
								if(!($county === NULL)) {
									wp_set_object_terms($post_id, intval($county['term_id']), 'property_county_state');
								}
								else {
									$county_created = wp_insert_term($property->CountyCityName, 'property_county_state');
									wp_set_object_terms($post_id, $county_created, 'property_county_state');
								}
							} elseif ($compatibility == 'lava-real-estate') {

								$county = term_exists($property->CountyCityName, 'property_city');
							
								if(!($county === NULL)) {
									wp_set_object_terms($post_id, intval($county['term_id']), 'property_city');
								}
								else {
									$county_created = wp_insert_term($property->CountyCityName, 'property_city');
									wp_set_object_terms($post_id, $county_created, 'property_city');
								}

    						} else {

    							$county = term_exists($property->CountyCityName, 'property_county');
							
								if(!($county === NULL)) {
									wp_set_object_terms($post_id, intval($county['term_id']), 'property_county');
								}
								else {
									$county_created = wp_insert_term($property->CountyCityName, 'property_county');
									wp_set_object_terms($post_id, $county_created, 'property_county');
								}

							}


//////////////////////////////////////////////////////////////
///  Set the Property Area
/////////////////////////////////////////////////////////////

							if ($compatibility == 'wp-residence') {
								$area = term_exists($property->DistrictName, 'property_area');
							
								if(!($area === NULL)) {
									wp_set_object_terms($post_id, intval($area['term_id']), 'property_area');
								}
								else {
									$area_created = wp_insert_term($property->DistrictName, 'property_area');
									wp_set_object_terms($post_id, $area_created, 'property_area');
								}
							} else {

								$area = term_exists($property->DistrictName, 'property_area');
							
								if(!($area === NULL)) {
									wp_set_object_terms($post_id, intval($area['term_id']), 'property_area');
								}
								else {
									$area_created = wp_insert_term($property->DistrictName, 'property_area');
									wp_set_object_terms($post_id, $area_created, 'property_area');
								}


							}

							// Auto Draft check and send mail with details
					if ($importer_options['pd_auto_draft_properties'] == 'true' && $post_id) {
							pd_auto_draft($post_id);
						}


						} // close if
fwrite($log, "**** NEW PROPERTY ADDED - ".$property->Address . ", " . $property->Id . "\n");
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  If the property is already in the DB
///////////////////////////////////////////////////////////////////////////////////////////////////////////
				} elseif($in_wp_db[0]['post_id'] && $system_status == 'Published_Online') {									
						// Update the property if it is found
					fwrite($log, "---- PROPERTY ALREADY EXISTS - ".$property->Address . " - " . $jtg_inbound_id . "\n");



						$post_id_prop = $in_wp_db[0]['post_id'];
						$details = get_post_meta($post_id_prop);
						$property_in_wp = get_post($post_id_prop);
						
						if ($details['system_status'] !== $system_status) {
					    	update_post_meta($post_id_prop, 'system_status', $system_status);
					    }

						

						if ($compatibility == 'none') {
							if ($property_in_wp->post_title !== $property->Address) {
								$update_with = array(
										'ID' => $post_id_prop,
										'post_title' => $property->Address,
										'post_content' => $property->Desc,
									);
								wp_update_post($update_with);
								fwrite($log, "----** TITLE / DESC UPDATE - ".$jtg_inbound_id . "\n");
							}
						} elseif($compatibility == 'lava-real-estate') {
							if ($property_in_wp->post_title !== $property->Address) {
								$update_with = array(
										'ID' => $post_id_prop,
										'post_title' => $property->Address,
										'post_content' => $property->Desc.'<br><br>'.$property->BER.'<br>'.$property->EPI,
									);
								wp_update_post($update_with);
								fwrite($log, "----** TITLE / DESC UPDATE - ".$jtg_inbound_id . "\n");
							}
						}



						if ($compatibility == 'wp-residence') {
							$in_db_status = get_the_terms($post_id_prop, 'property_action_category');
								if ($in_db_status !== $property->Status) {
									wp_set_object_terms($post_id_prop, $property->Status, 'property_action_category' );
									fwrite($log, "-- Status update - ".$jtg_inbound_id . "\n");
								}
						} else {
							$in_db_status = get_the_terms($post_id_prop, 'property_status');
								if ($in_db_status !== $property->Status) {
									wp_set_object_terms($post_id_prop, $property->Status, 'property_status' );
									fwrite($log, "-- Status update - ".$jtg_inbound_id . "\n");
								}
						}

						// 

						if ($compatibility == 'wp-residence') {
							$in_db_type = get_the_terms($post_id_prop, 'property_category');
							if ($in_db_type !== $property->Type) {
								wp_set_object_terms($post_id_prop, $property->Type, 'property_category' );
								fwrite($log, "-- Category update - ".$jtg_inbound_id . "\n");
							}
						} else {
							$in_db_type = get_the_terms($post_id_prop, 'property_type');
							if ($in_db_type !== $property->Type) {
								wp_set_object_terms($post_id_prop, $property->Type, 'property_type' );
								fwrite($log, "-- Type update - ".$jtg_inbound_id . "\n");
							}
						}

						// 

						if ($compatibility == 'wp-residence') {
							$in_db_city = get_the_terms($post_id_prop, 'property_county_state');
							if ($in_db_city !== $property->CountyCityName) {
								wp_set_object_terms($post_id_prop, $property->CountyCityName, 'property_county_state' );
								fwrite($log, "-- County update - ".$jtg_inbound_id . "\n");
							}
						} else {
							$in_db_city = get_the_terms($post_id_prop, 'property_county');
							if ($in_db_city !== $property->CountyCityName) {
								wp_set_object_terms($post_id_prop, $property->CountyCityName, 'property_county' );
								fwrite($log, "-- County update - ".$jtg_inbound_id . "\n");
							}
						}

						// 

						if ($compatibility == 'wp-residence') {
							$in_db_city = get_the_terms($post_id_prop, 'property_city');
							if ($in_db_city !== $property->CountyCityName) {
								wp_set_object_terms($post_id_prop, $property->CountyCityName, 'property_city' );
								fwrite($log, "-- City update - ".$jtg_inbound_id . "\n");
							}
						} else {
							$in_db_city = get_the_terms($post_id_prop, 'property_city');
							if ($in_db_city !== $property->CountyCityName) {
								wp_set_object_terms($post_id_prop, $property->CountyCityName, 'property_city' );
								fwrite($log, "-- City update - ".$jtg_inbound_id . "\n");
							}
						}

						// 

						if ($compatibility == 'wp-residence') {
							$in_db_city = get_the_terms($post_id_prop, 'property_area');
							if ($in_db_city !== $property->DistrictName) {
								wp_set_object_terms($post_id_prop, $property->DistrictName, 'property_area' );
								fwrite($log, "-- Area update - ".$jtg_inbound_id . "\n");
							}
						} else {
							$in_db_city = get_the_terms($post_id_prop, 'property_area');
							if ($in_db_city !== $property->DistrictName) {
								wp_set_object_terms($post_id_prop, $property->DistrictName, 'property_area' );
								fwrite($log, "-- Area update - ".$jtg_inbound_id . "\n");

								// $terms= get_term_by('name', $property->CountyCityName, 'property_county');
						  //               if($terms!=''){
						  //                   $term_id=$terms->term_id;
						  //                   $term_meta=array('county_parent' => $property->CountyCityName);
						  //                   add_option( "area_parent_$term_id", $term_meta ); 
						  //               }
							}
						}
						
						
						// $attachments = get_posts(array(
					 //        'post_type' => 'attachment',
					 //        'posts_per_page' => -1,
					 //        'post_status' => 'any',
					 //        'post_parent' => $post_id_prop
					 //    ));
					 //    $in_db_pic_count = count($attachments);
					 //    $in_feed_pic_count = count($property->Pics);
						//     if ($in_db_pic_count !== $in_feed_pic_count) {
						//     	jtg_delete_post_images($post_id_prop);
						// 	    	$count = 1;
						// 			$result = array();
						// 				foreach($property->Pics as $image) {
						// 					if($image) {
						// 						if($result[] = jtg_create_property_images($post_id_prop, $image, $count)) {
						// 							$count++;
						// 						}
						// 					}
						// 				}
						// 				// Set property thumbnail
						// 				if($result[0]) {
						// 					set_post_thumbnail($post_id_prop, $result[0], 0);
						// 					unset($result[0]);
						// 				}
						// 				update_post_meta($post_id_prop, 'detail_images', $result);
						//     }
					    if ($details['price'] !== $property->Price && $property->Price !== []) {
					    	if ($compatibility == 'wp-residence') {
					    		update_post_meta($post_id_prop, 'property_price', $property->Price);
					    		fwrite($log, "-- Price update - ".$jtg_inbound_id . "\n");
					    	} else {
					    		update_post_meta($post_id_prop, 'price', $property->Price);
					    		fwrite($log, "-- Price update - ".$jtg_inbound_id . "\n");
					    	}
					    }
					    if ($details['price_term'] !== $property->PriceTerm && $property->PriceTerm !== []) {
					    	if ($compatibility == 'wp-residence') {
					    		update_post_meta($post_id_prop, 'property_label', $property->PriceTerm);
					    		fwrite($log, "-- Price Term update - ".$jtg_inbound_id . "\n");
					    	} else {
					    		update_post_meta($post_id_prop, 'price_term', $property->PriceTerm);

					    		fwrite($log, "-- Price Term update - ".$jtg_inbound_id . "\n");
					    	}
					    }
					    if ($details['bedrooms'] !== $property->Beds && $property->Beds !== []) {
					    	if ($compatibility == 'wp-residence') {
					    		update_post_meta($post_id_prop, 'property_bedrooms', $property->Beds);
					    		fwrite($log, "-- Bedrooms update - ".$jtg_inbound_id . "\n");

					    	} else {
					    		update_post_meta($post_id_prop, 'bedrooms', $property->Beds);
					    		fwrite($log, "-- Bedrooms update - ".$jtg_inbound_id . "\n");
					    	}
					    }
					    if ($details['bathrooms'] !== $property->BathRooms && $property->BathRooms !== []) {
					    	if ($compatibility == 'wp-residence') {
					    		update_post_meta($post_id_prop, 'property_bathrooms', $property->BathRooms);
					    		fwrite($log, "-- Bathrooms update - ".$jtg_inbound_id . "\n");
					    	} else {
					    		update_post_meta($post_id_prop, 'bathrooms', $property->BathRooms);
					    		fwrite($log, "-- Bathrooms update - ".$jtg_inbound_id . "\n");
					    	}
					    }
					    if ($details['ber_rating'] !== $property->BER && $property->BER !== []) {
					    	update_post_meta($post_id_prop, 'ber_rating', $property->BER);
					    	fwrite($log, "-- BER update - ".$jtg_inbound_id . "\n");
					    }
					    if ($details['county'] !== $property->CountyCityName && $property->CountyCityName !== []) {
					    	update_post_meta($post_id_prop, 'county', $property->CountyCityName);
					    	fwrite($log, "-- County update - ".$jtg_inbound_id . "\n");
					    }
					    if ($details['area'] !== $property->DistrictName && $property->DistrictName !== []) {
					    	update_post_meta($post_id_prop, 'area', $property->DistrictName);
					    	fwrite($log, "-- Area update - ".$jtg_inbound_id . "\n");
					    }
					    if ($details['city'] !== $property->CountyCityName && $property->CountyCityName !== []) {
					    	update_post_meta($post_id_prop, 'city', $property->CountyCityName);
					    	fwrite($log, "-- City update - ".$jtg_inbound_id . "\n");
					    }

					    if ($details['latitude'] !== $property->GPS->Latitude && $property->GPS->Latitude !== []) {
					    	update_post_meta($post_id_prop, 'latitude', $property->GPS->Latitude);
					    	fwrite($log, "-- Latitude update - ".$jtg_inbound_id . "\n");
					    }
					    if ($details['longitude'] !== $property->GPS->Longitude && $property->GPS->Longitude !== []) {
					    	update_post_meta($post_id_prop, 'longitude', $property->GPS->Longitude);
					    	fwrite($log, "-- Longitude update - ".$jtg_inbound_id . "\n");
					    }

					    if ($details['property_status'] !== $property->Status && $property->Status !== []) {
					    	update_post_meta($post_id_prop, 'property_status', $property->Status);
					    	fwrite($log, "-- Status update - ".$jtg_inbound_id . "\n");
					    }

					    if ($details['property_size'] !== $property->Size && $property->Size !== []) {
					    	update_post_meta($post_id_prop, 'property_size', $property->Size);
					    	fwrite($log, "-- Property Size update - ".$jtg_inbound_id . "\n");
					    }

					    if ($details['property_floors'] !== $property->Floors && $property->Floors !== []) {
					    	update_post_meta($post_id_prop, 'property_floors', $property->Floors);
					    	fwrite($log, "-- Property Floors update - ".$jtg_inbound_id . "\n");
					    }

					    if ($details['energy_details'] !== $property->EPI && $property->EPI !== []) {
					    	update_post_meta($post_id_prop, 'energy_details', $property->EPI);
					    	fwrite($log, "-- Energy details update - ".$jtg_inbound_id . "\n");
					    }

					    if ($details['agent_id'] !== $property->AgentId && $property->AgentId !== []) {
					    	update_post_meta($post_id_prop, 'agent_id', $property->AgentId);
					    	fwrite($log, "-- Agent ID update - ".$jtg_inbound_id . "\n");
					    }
					    if ($details['agent_name'] !== $property->Agent &&  $property->Agent !== []) {
					    	update_post_meta($post_id_prop, 'agent_name', $property->Agent);
					    	fwrite($log, "-- Agent Name update - ".$jtg_inbound_id . "\n");
					    }
					    if ($details['agent_email'] !== $property->Email && $property->Email !== []) {
					    	update_post_meta($post_id_prop, 'agent_email', $property->Email);
					    	fwrite($log, "-- Agent Email update - ".$jtg_inbound_id . "\n");
					    }
					    if ($details['agent_number'] !== $property->Phone && $property->Phone !== []) {
					    	update_post_meta($post_id_prop, 'agent_number', $property->Phone);
					    	fwrite($log, "-- Agent Number update - ".$jtg_inbound_id . "\n");
					    }
					    if ($details['agent_mobile'] !== $property->Mobile && $property->Mobile !== []) {
					    	update_post_meta($post_id_prop, 'agent_mobile', $property->Mobile);
					    	fwrite($log, "-- Agent Mobile update - ".$jtg_inbound_id . "\n");
					    }

					    if ($details['brochure_1'] !== $property->Pdfs[0] && $property->Pdfs[0] !== []) {
					    	update_post_meta($post_id_prop, 'brochure_1', $property->Pdfs[0]);
					    	fwrite($log, "-- Brochure 1 update - ".$jtg_inbound_id . "\n");
					    }
					    if ($details['brochure_2'] !== $property->Pdfs[1] && $property->Pdfs[1] !== []) {
					    	update_post_meta($post_id_prop, 'brochure_2', $property->Pdfs[1]);
					    	fwrite($log, "-- Brochure 2 update - ".$jtg_inbound_id . "\n");
					    }
					    if ($details['brochure_3'] !== $property->Pdfs[2] && $property->Pdfs[2] !== []) {
					    	update_post_meta($post_id_prop, 'brochure_3', $property->Pdfs[2]);
					    	fwrite($log, "-- Brochure 3 update - ".$jtg_inbound_id . "\n");
					    }

					    if ($details['is_featured'] !== $property->isFeaturedProperty && $property->isFeaturedProperty !== []) {

					    	if ($property->isFeaturedProperty == false) {
						    	update_post_meta($post_id_prop, 'is_featured', 'false');
					    	} elseif ($property->isFeaturedProperty == true) {
						    	update_post_meta($post_id_prop, 'is_featured', 'true');
					    	}
					    	fwrite($log, "-- Property Featured Tag Change - ".$jtg_inbound_id . "\n");
					    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  If the property is already in the DB and has been deleted or expired, change to draft!
///////////////////////////////////////////////////////////////////////////////////////////////////////////

				} elseif($in_wp_db[0]['post_id'] && ($system_status == 'Deleted' || $system_status == 'Expired' || $system_status == 'Active_Offline' || $system_status == 'Pending_Review')) {

					$post_id_prop = $in_wp_db[0]['post_id'];
						update_post_meta($post_id_prop, 'system_status', $system_status);
						$update_post_status = array(
							'ID' => $post_id_prop,
							'post_status' => 'draft',
						);
					wp_update_post($update_post_status);
					fwrite($log, "-- Updated property status to draft - Property Expired / Deleted - ".$post_id_prop . "\n");


				} //End of Else
		} // End of Foreach

///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  If the property is already in the DB and NOT in the feed - do some status updates
///////////////////////////////////////////////////////////////////////////////////////////////////////////
							// $in_wp_db_check = get_posts(array(
							// 		        'post_type' => 'property',
							// 		        'posts_per_page' => -1,
							// 		        'post_status' => 'publish',
							// 		    ));
							// foreach ($in_wp_db_check as $prop) {
							// 	$details = get_post_meta($prop->ID);
							// 	if (!jtg_check_in_feed($details[0]['importer_id'], $properties)) {
							// 		$in_db_status = get_the_terms($post_id_prop, 'property_status');
									
							// 		if ($in_db_status == 'To Let' || $in_db_status == 'For Rent') {
							// 			wp_set_object_terms($post_id_prop, 'Let Agreed', 'property_status' );
							// 		} elseif ($in_db_status == 'For Sale') {
							// 			wp_set_object_terms($post_id_prop, 'Sold', 'property_status' );
							// 		}
							// 	}
							// }

							$time = bcdiv((microtime(true) - $time_start), 1, 3);
							// $minutes = $time / 60;
							fwrite($log, '***********************'."\n".'It took '.$time .' secs to complete '."\n");
						
} // End of function
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  This whips through the array and finds out if there are any properties in there
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function jtg_check_in_feed($needle, $haystack) {
        $top = sizeof($haystack) - 1;
        $bottom = 0;
        while($bottom <= $top)
        {
            if($haystack[$bottom] == $needle)
                return true;
            else 
                if(is_array($haystack[$bottom]))
                    if(jtg_check_in_feed($needle, ($haystack[$bottom])))
                        return true;
                    
            $bottom++;
        }        
        return false;
}