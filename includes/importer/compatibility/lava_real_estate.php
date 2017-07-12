<?php
/*
Function generating a JSON cache filled with data from every property.
This cache is stored on the server and used by Lava for the search listing page.
*/
function jtg_lava_real_estate_json_cache()
{
	$propertiesArray = array();
	
	// WP function to retrieve list of all properties' posts
	$args = array
	(
        'numberposts'       => -1,
        'post_type'         => 'property',
        'post_status'       => 'publish',
        'suppress_filters'  => true
    );
	
    $posts_array = get_posts($args);
	
	$i = 0;
	foreach($posts_array as $item)
	{
		$terms_list = array();
		
		$taxonomies = array
		(
			'property_type',
			'property_city',
			'property_status'
		);
		
		// Fill terms_list with taxonomies ID associated with properties
		foreach($taxonomies as $taxo)
		{
			$id_list = array();
			
			$terms = wp_get_post_terms($item->ID, $taxo, array("fields" => "ids"));
			
			if(terms != NULL)
			{
				foreach($terms as $key)
				{
					$id_list[] = (string)$key;
				}
				
			}
			$terms_list[] = $id_list;
		}
		
		$jsonLine = array
		(
			// Post-related fields
			'post_id'				=> $item->ID,
			'post_title'			=> $item->post_title,
			
			// Google Map LatLng Values
			'lat' 					=> get_post_meta($item->ID, 'lv_item_lat', true),
			'lng' 					=> get_post_meta($item->ID, 'lv_item_lng', true),
			
			// Some fields left empty to show what legacy code was
			// Said fields are not filled by the V2 version of Daft API
			
			// Icon and tag - Legacy
			'icon'					=> "", //$lava_set_icon,
			'tags'					=> "", //$lava_categories_label->get( self::SLUG . '_keyword' )
			
			// Post tags and Amenities - Legacy
			'post_tag'				=> "",
			'property_amenities'	=> "",
			
			// Taxonomies IDs, powers Lava search
			'property_type'			=> $terms_list[0],
			'property_city'			=> $terms_list[1],
			'property_status'		=> $terms_list[2],
			
			// Bedrooms and Bathrooms quantitites
			'_bedrooms'				=> get_post_meta($item->ID, '_bedrooms', true),
			'_bathrooms'			=> get_post_meta($item->ID, '_bathrooms', true),
			
			// Parking lots and garages - Legacy
			'_garages'				=> "",
			
			// Price, be it Rent or Sale
			'_price'				=> get_post_meta($item->ID, '_price', true),
			
			// Area - Legacy
			'_area'					=> ""
		);
		
		$propertiesArray[] = $jsonLine;
		$i++;
	}
	
	// Get upload directory, WordPress blog id and JSON cache path
	$wp_upload_dir = wp_upload_dir();
	$blog_id = get_current_blog_id();
	$json_file_path = substr($wp_upload_dir['path'], 0, 52)."s/lava_all_property_{$blog_id}_.json";
}