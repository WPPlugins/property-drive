<?php

function jtg_ajax_request(){

	if (current_user_can('manage_options') && check_ajax_referer('jtg-ajax-nonce', 'jtg_security')) {
		 // Inbound Data
	    $agency_name = esc_attr($_POST["agency_name"]);
	    $agency_email = esc_attr($_POST["agency_email"]);
	    $agency_phone = esc_attr($_POST["agency_phone"]);
	    $agency_logo = $_POST["agency_logo"];

	    // Grab the options we want to update
	    $agency_details = get_option('pm_agency_options');

	    // Set the individual options in an array here
	    $agency_details = array(
	    		'agency_name' => $agency_name,
	    		'agency_email' => $agency_email,
	    		'agency_phone' => $agency_phone,
	    		'agency_logo' => $agency_logo
	    	);

	    // Update the option in the DB
	    $update_name = update_option('pm_agency_options', $agency_details);


	    /*****************************************************/


	    // Search inbound
	    $search_type = esc_attr($_POST["search_type"]);
	    $padding_above = esc_attr($_POST["padding_above"]);
	    $padding_below = esc_attr($_POST["padding_below"]);
	    $search_background_color = esc_attr($_POST["search_background_color"]);
	    $search_btn_color = esc_attr($_POST["search_btn_color"]);
	    $search_btn_text_color = esc_attr($_POST["search_btn_text_color"]);
	    $search_btn_hover_text_color = esc_attr($_POST["search_btn_hover_text_color"]);
	    $search_btn_hover_color = esc_attr($_POST["search_btn_hover_color"]);
	    $price_slider_bar = esc_attr($_POST["price_slider_bar"]);
	    $search_grouping = esc_attr($_POST["search_grouping"]);
	    

		

	    // Grab the options we want to update
	    $search_options = get_option('pm_search_options');

	    // Set the individual options in an array here
	    $search_options = array(
	    		'search_type' => $search_type,
	    		'search_space_above' => $padding_above,
	    		'search_space_below' => $padding_below,
	    		'search_background_color' => $search_background_color,
	    		'search_btn_color' => $search_btn_color,
	    		'search_btn_text_color' => $search_btn_text_color,
	    		'search_btn_hover_text_color' => $search_btn_hover_text_color,
	    		'search_btn_hover_color' => $search_btn_hover_color,
	    		'price_slider_bar' => $price_slider_bar,
	    		'search_grouping' => $search_grouping
	    	);

	    // Update the option in the DB
	    $update_search = update_option('pm_search_options', $search_options);


	    /*****************************************************/


	    // Design inbound
	    $base_colour = esc_attr($_POST["base_colour"]);
	    $secondary_colour = esc_attr($_POST["secondary_colour"]);

	    $header_show_type = esc_attr($_POST["header_show_type"]);
	    $header_show_status = esc_attr($_POST["header_show_status"]);
	    $header_show_price = esc_attr($_POST["header_show_price"]);
	    $header_show_ber = esc_attr($_POST["header_show_ber"]);
	    $header_show_area = esc_attr($_POST["header_show_area"]);
	    $header_show_beds = esc_attr($_POST["header_show_beds"]);
	    
	    $featured_title = esc_attr($_POST["featured_title"]);
	    $featured_title_background = esc_attr($_POST["featured_title_background"]);
	    $featured_title_color = esc_attr($_POST["featured_title_color"]);
	    $property_grid_title = esc_attr($_POST["property_grid_title"]);
	    $show_view_more = esc_attr($_POST["show_view_more"]);

	    $slider_auto_play = esc_attr($_POST["slider_auto_play"]);
	    $single_container_padding = esc_attr($_POST["single_container_padding"]);
	    $show_sidebar = esc_attr($_POST["show_sidebar"]);
	    $single_page_margin_top = esc_attr($_POST["single_page_margin_top"]);

	    $jtg_single_page_template = esc_attr($_POST["jtg_single_page_template"]);
	    $pd_page_margin_top = esc_attr($_POST["pd_page_margin_top"]);


	    // Grab the options we want to update
	    $design_options = get_option('pm_design_options');

	    // Set the individual options in an array here
	    $design_options = array(
	    		'base_colour' => $base_colour,
	    		'secondary_colour' => $secondary_colour,
	    		'header_show_type' => $header_show_type,
	    		'header_show_status' => $header_show_status,
	    		'header_show_price' => $header_show_price,
	    		'header_show_ber' => $header_show_ber,
	    		'header_show_area' => $header_show_area,
	    		'header_show_beds' => $header_show_beds,
	    		'featured_title' => $featured_title,
	    		'featured_title_background' => $featured_title_background,
	    		'featured_title_color' => $featured_title_color,
	    		'property_grid_title' => $property_grid_title,
	    		'show_view_more' => $show_view_more,
	    		'slider_auto_play' => $slider_auto_play,
	    		'single_container_padding' => $single_container_padding,
	    		'show_sidebar' => $show_sidebar,
	    		'single_page_margin_top' => $single_page_margin_top,
	    		'jtg_single_page_template' => $jtg_single_page_template,
	    		'pd_page_margin_top' => $pd_page_margin_top

	    	);

	    // Update the option in the DB
	    $update_design = update_option('pm_design_options', $design_options);


	    /*****************************************************/


	    // Property Box inbound
	    $design_option = esc_attr($_POST["design_option"]);
	    $results_grid_columns = esc_attr($_POST["results_grid_columns"]);
	    $property_box_style = esc_attr($_POST["property_box_style"]);



	    // Grab the options we want to update
	    $property_box_options = get_option('pm_property_results_options');

	    // Set the individual options in an array here
	    $property_box_options = array(
	    		'design_option' => $design_option,
	    		'results_grid_columns' => $results_grid_columns,
	    		'property_box_style' => $property_box_style


	    	);

	    // Update the option in the DB
	    $update_design = update_option('pm_property_results_options', $property_box_options);


		/*****************************************************/


	    // Custom CSS inbound
	    $custom_css = esc_attr($_POST["custom_css"]);

	    // Grab the options we want to update
	    $custom_css_options = get_option('pm_css_options');

	    // Set the individual options in an array here
	    $custom_css_options = array(
	    		'custom_css' => $custom_css


	    	);

	    // Update the option in the DB
	    $update_css = update_option('pm_css_options', $custom_css_options);



	    /*****************************************************/





	    	/*****************************************************/


	    // Short code Options - Search Type 3
	    $str = $_POST["search_type_3_images"];

$arr = explode(',', $str);
$arr = array_filter($arr);
$ready_for_storage =  implode(',', $arr);// apples,oranges,pears,kiwis 



	    $slider_images = esc_attr($ready_for_storage);
	    $search_3_background_color = esc_attr($_POST["search_3_background_color"]);
	    $slider_pause_time = esc_attr($_POST["slider_pause_time"]);

	    // Grab the options we want to update
	    $search_type_3_options = get_option('search_type_3_options');

	    // Set the individual options in an array here
	    $search_type_3_options = array(
	    		'search_type_3_images' => $slider_images,
	    		'search_3_background_color' => $search_3_background_color,
	    		'slider_pause_time' => $slider_pause_time


	    	);

	    // Update the option in the DB
	    $update_css = update_option('search_type_3_options', $search_type_3_options);



	    /*****************************************************/



	    // Importer options inbound
	    $auto_sync = esc_attr($_POST["auto_sync"]);

	    $jtg_pd_api = $_POST["jtg_pd_api"];
	    $author = esc_attr($_POST["author"]);

	    $allow_tax = esc_attr($_POST["allow_tax"]);
	    $allow_styling = esc_attr($_POST["allow_styling"]);

	    $jtg_importer_schedule = esc_attr($_POST["jtg_importer_schedule"]);

	    $jtg_currency = esc_attr($_POST["jtg_currency"]);

	    $jtg_theme_compatibility = esc_attr($_POST["jtg_theme_compatibility"]);
	    $jtg_email_alert_frequency = esc_attr($_POST["jtg_email_alert_frequency"]);

	    $property_drive_purchase_email = esc_attr($_POST["property_drive_purchase_email"]);
	    $property_drive_license_key = esc_attr($_POST["property_drive_license_key"]);

	    $jtg_auto_select_county = esc_attr($_POST["jtg_auto_select_county"]);

	    $pd_auto_draft_properties = esc_attr($_POST["pd_auto_draft_properties"]);

	    // Grab the options we want to update
	    $importer_options = get_option('pm_importer_options');

	    // Set the individual options in an array here
	    $importer_options = array(
	    		'auto_sync' => $auto_sync,
	    		'pd_api_key' => $jtg_pd_api,
	    		'property_author' => $author,
	    		'allow_tax' => $allow_tax,
	    		'allow_styling' => $allow_styling,
	    		'jtg_importer_schedule' => $jtg_importer_schedule,
	    		'jtg_currency' => $jtg_currency,
	    		'jtg_theme_compatibility' => $jtg_theme_compatibility,
	    		'jtg_email_alert_frequency' => $jtg_email_alert_frequency,
	    		'property_drive_license_key' => $property_drive_license_key,
	    		'property_drive_purchase_email' => $property_drive_purchase_email,
	    		'jtg_auto_select_county' => $jtg_auto_select_county,
	    		'pd_auto_draft_properties' => $pd_auto_draft_properties


	    	);

	    // Update the option in the DB
	    $update_importer = update_option('pm_importer_options', $importer_options);





	    // if ($update_name == true) {
	    // 	wp_send_json_success('Saved');
	    // } else {
	    // 	wp_send_json_error('Save failed');
	    // }

	    //Create the array we send back to javascript here
	    // $array_we_send_back = array( 'response' => $jtg_response );

	    //Make sure to json encode the output because that's what it is expecting
	    // echo json_encode( $array_we_send_back );
	    wp_send_json_success('All settings have been updated!');
	} else {
		return wp_send_json_error('You do not have permission to do this, or there is a nonce issue!');
	}

   

    //Make sure you die when finished doing ajax output.
    die(); 

}
add_action( 'wp_ajax_' . 'wpa_49691', 'jtg_ajax_request' );

function jtg_run_manual_import_request(){
	if (current_user_can('manage_options')) {
		$properties = jtg_process_import();		
			if($properties > 0){		
				wp_send_json_success('Properties have been successfully synced.');	
			}	
			else{		
				wp_send_json_error('Ooops, looks like something went wrong, please contact support.');
			}
	} else {
		return wp_send_json_error('Ooops, looks like something went wrong, please contact support.');
	}
    //Make sure you die when finished doing ajax output.
    die(); 
}
add_action( 'wp_ajax_' . 'jtg_run_manual_import', 'jtg_run_manual_import_request' );

function jtg_delete_all_properties(){
	if (current_user_can('manage_options')) {

		$options = get_option('pm_importer_options');
    $compatibility = $options['jtg_theme_compatibility'];

    if ($compatibility == 'wp-residence') {
    	$properties = get_posts(array(
	        'post_type' => 'estate_property',
	        'posts_per_page' => -1,
	        'post_status' => 'any'
    	));
    } elseif ($compatibility == 'lava-real-estate') {
    	$properties = get_posts(array(
	        'post_type' => 'property',
	        'posts_per_page' => -1,
	        'post_status' => 'any'
    	));
    } elseif (!isset($compatibility) || $compatibility == 'none') {
    	$properties = get_posts(array(
	        'post_type' => 'property',
	        'posts_per_page' => -1,
	        'post_status' => 'any'
    	));
    }

    	$url = plugin_dir_path(dirname(__DIR__)).'includes/importer/';
		$today_ddmmyyyy = date("d-m-y");
		$today_yyyymmddhhiiss = date("d-m-y");
		
    	$log = fopen( $url . "logs/log-".$today_ddmmyyyy . ".txt", "a");
        fwrite($log, "=== LOG ENTRY : " . date('Y-m-d H:i:s') . " Property Drive ===\n");

			$i = 0;
		    	foreach ($properties as $property) {
		    		$property_id = $property->ID;
		    		jtg_delete_property($property_id);

		    		fwrite($log, '*** PROPERTY '.$property_id." DELETED FROM DATABASE - user requested action\n");
		    		$i++;
		    	}
		fwrite($log, "*******************\n");
		fwrite($log, '=== '.$i." PROPERTIES DELETED IN TOTAL\n");
		fwrite($log, "=== END OF LOG ===\n\n");
				if($i > 0){		
					wp_send_json_success('Removed '.$i.' Properties & attached media!');	
				}	
				else{		
					wp_send_json_error('Ooops, looks like there are no properties to delete.');
				}
	} else {
		return wp_send_json_error('Ooops, looks like you don\'t have permission to do that!');
	}
    //Make sure you die when finished doing ajax output.
    die(); 
}
add_action( 'wp_ajax_' . 'jtg_run_delete_all_properties', 'jtg_delete_all_properties' );


////////////////////////////////////////////////////////////////////////////////////////////////
// Update Property Details
////////////////////////////////////////////////////////////////////////////////////////////////
function jtg_update_property_details(){
	if (current_user_can('manage_options') && check_ajax_referer('jtg-ajax-nonce', 'jtg_security')) {

			$post_id = $_POST['post_id'];
			$latitude = esc_attr(strip_tags($_POST['latitude']));
			$longitude = esc_attr(strip_tags($_POST['longitude']));

			$price = esc_attr(strip_tags($_POST['price']));
			$price_term = esc_attr(strip_tags($_POST['price_term']));

			$property_size = esc_attr(strip_tags($_POST['property_size']));
			$property_floors = esc_attr(strip_tags($_POST['property_floors']));
			$bedrooms = esc_attr(strip_tags($_POST['bedrooms']));
			$bathrooms = esc_attr(strip_tags($_POST['bathrooms']));
			$ber_rating = esc_attr(strip_tags($_POST['ber_rating']));
			$energy_details = esc_attr(strip_tags($_POST['energy_details']));

			$agent_id = esc_attr(strip_tags($_POST['agent_id']));
			$agent_name = esc_attr(strip_tags($_POST['agent_name']));

			$agent_email = esc_attr(strip_tags($_POST['agent_email']));
			$agent_number = esc_attr(strip_tags($_POST['agent_number']));
			$agent_mobile = esc_attr(strip_tags($_POST['agent_mobile']));

			$brochure_1 = esc_attr(strip_tags($_POST['brochure_1']));
			$brochure_2 = esc_attr(strip_tags($_POST['brochure_2']));

			$brochure_3 = esc_attr(strip_tags($_POST['brochure_3']));

			$residential_otw = esc_attr(strip_tags($_POST['residential_otw']));
			$commercial_otw = esc_attr(strip_tags($_POST['commercial_otw']));

			$is_featured = esc_attr(strip_tags($_POST['is_featured']));

			update_post_meta($post_id, 'latitude', $latitude);
			update_post_meta($post_id, 'longitude', $longitude);

			update_post_meta($post_id, 'price', $price);
			update_post_meta($post_id, 'price_term', $price_term);

			update_post_meta($post_id, 'property_size', $property_size);
			update_post_meta($post_id, 'property_floors', $property_floors);
			update_post_meta($post_id, 'bedrooms', $bedrooms);
			update_post_meta($post_id, 'bathrooms', $bathrooms);

			update_post_meta($post_id, 'ber_rating', $ber_rating);
			update_post_meta($post_id, 'energy_details', $energy_details);

			update_post_meta($post_id, 'agent_id', $agent_id);
			update_post_meta($post_id, 'agent_name', $agent_name);
			update_post_meta($post_id, 'agent_email', $agent_email);
			update_post_meta($post_id, 'agent_number', $agent_number);
			update_post_meta($post_id, 'agent_mobile', $agent_mobile);

			update_post_meta($post_id, 'brochure_1', $brochure_1);
			update_post_meta($post_id, 'brochure_2', $brochure_2);
			update_post_meta($post_id, 'brochure_3', $brochure_3);

			update_post_meta($post_id, 'residential_otw', $residential_otw);
			update_post_meta($post_id, 'commercial_otw', $commercial_otw);

			update_post_meta($post_id, 'is_featured', $is_featured);

			wp_send_json_success('Property details updated!');

	} else {
		return wp_send_json_error('Ooops, looks like you don\'t have permission to do that!');
	}
    //Make sure you die when finished doing ajax output.
    die(); 
}
add_action( 'wp_ajax_' . 'jtg_save_property_details', 'jtg_update_property_details' );