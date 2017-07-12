<?php
/*
Function creating a post with WP post information
*/
function jtg_create_property($item) {
    $user = get_option('api_wp_user');
    $options = get_option('pm_importer_options');
    $compatibility = $options['jtg_theme_compatibility'];
    if ($compatibility == 'wp-residence') {
        try {
            $property = array(
                'post_author' => $item['user'],
                'post_content' => $item['description'],
                'post_title' => $item['title'],
                'post_status' => $item['post_status'],
                'post_type' => 'estate_property',
                'ping_status' => 'closed',
                'comment_status' => 'closed'
            );
            $post_id = wp_insert_post($property);
            return $post_id;
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    } elseif ($compatibility == 'lava-real-estate') {
        try {
            $property = array(
                'post_author' => $item['user'],
                'post_content' => $item['description'],
                'post_title' => $item['title'],
                'post_status' => 'publish',
                'post_type' => 'property',
                'ping_status' => 'closed',
                'comment_status' => 'closed'
            );
            $post_id = wp_insert_post($property);
            return $post_id;
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    } elseif (!isset($compatibility) || $compatibility == 'none') {
        try {
            $property = array(
                'post_author' => $item['user'],
                'post_content' => $item['description'],
                'post_title' => $item['title'],
                'post_status' => $item['post_status'],
                'post_type' => 'property',
                'ping_status' => 'closed',
                'comment_status' => 'closed'
            );
            $post_id = wp_insert_post($property);
            return $post_id;
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

/*
Function creating and associating an attachment post to a property post
*/
add_filter( 'intermediate_image_sizes', '__return_empty_array', 99 );
function jtg_create_property_images($post_id, $image, $count) {
    $allowed = array(1, 2, 3);
    $wp_upload_dir = wp_upload_dir();
    $type = exif_imagetype($image);

    if (in_array($type, $allowed)) {
        switch ($type){
            case 1;
                $ext = '.gif';
                break;
            case 2;
                $ext = '.jpg';
                break;
            case 3;
                $ext = '.png';
                break;
        }


        $img = array('post_id' => $post_id, 'image' => $image, 'type' => $ext, 'name' => 'jtg_'.$post_id . "_" . $count . $ext);
        $filename = $wp_upload_dir['path'] . DIRECTORY_SEPARATOR . $img['name'];

        try{
            if (file_put_contents($filename, file_get_contents($image))){
                $parent_post_id = $post_id;
                $filetype = wp_check_filetype(basename($filename), null);
                $attachment = array(
                    'guid' => $wp_upload_dir['url'] . '/' . basename($filename),
                    'post_mime_type' => $filetype['type'],
                    'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

                $attach_id = wp_insert_attachment($attachment, $filename, $parent_post_id);
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
                wp_update_attachment_metadata($attach_id, $attach_data);
            }
        }
		catch (Exception $e){
            echo $e->getMessage();
        }
        return $attach_id;
    }
    return false;
}

/*
Function registering additionnal property information via metadata associated with property's post ID
*/
function jtg_add_property_meta($post_id, $meta) {
    $options = get_option('pm_importer_options');
    $compatibility = $options['jtg_theme_compatibility'];

    if ($compatibility == 'wp-residence') {
        // This saves the meta data so that WP Residence can read it
        // Checked to v1.20.2

        update_post_meta($post_id, 'full_address', $meta['full_address']);

        update_post_meta($post_id, 'latitude', $meta['latitude']);
        update_post_meta($post_id, 'longitude', $meta['longitude']);

        update_post_meta($post_id, 'county', $meta['county']);
        update_post_meta($post_id, 'area', $meta['area']);
        update_post_meta($post_id, 'city', $meta['city']);

        if ($meta['price'] && $property->Price !== []) {
            update_post_meta($post_id, 'price', $meta['price']);
        }
        if ($meta['price_term'] && $property->PriceTerm !== []) {
            update_post_meta($post_id, 'price_term', $meta['price_term']);
        }

        if ($meta['property_size'] && $property->Size !== []) {
            update_post_meta($post_id, 'property_size', $meta['property_size']);
        }
        if ($meta['property_floors'] && $property->Floors !== []) {
            update_post_meta($post_id, 'property_floors', $meta['property_floors']);
        }

        if ($meta['bedrooms'] && $property->Beds !== []) {
            update_post_meta($post_id, 'bedrooms', $meta['bedrooms']);
        }
        if ($meta['bathrooms'] && $property->BathRooms !== []) {
            update_post_meta($post_id, 'bathrooms', $meta['bathrooms']);
        }

        if ($meta['ber_rating'] && $property->BER !== []) {
            update_post_meta($post_id, 'ber_rating', $meta['ber_rating']);
        }
        if ($meta['energy_details'] && $property->EPI !== []) {
            update_post_meta($post_id, 'energy_details', $meta['energy_details']);
        }

        if ($meta['agent_id'] && $property->AgentId !== []) {
            update_post_meta($post_id, 'agent_id', $meta['agent_id']);
        }
        if ($meta['agent_name'] &&  $property->Agent !== []) {
            update_post_meta($post_id, 'agent_name', $meta['agent_name']);
        }
        if ($meta['agent_email'] && $property->Email !== []) {
            update_post_meta($post_id, 'agent_email', $meta['agent_email']);
        }
        if ($meta['agent_number'] && $property->Phone !== []) {
            update_post_meta($post_id, 'agent_number', $meta['agent_number']);
        }
        if ($meta['agent_mobile'] && $property->Mobile !== []) {
            update_post_meta($post_id, 'agent_mobile', $meta['agent_mobile']);
        }

        if ($meta['brochure_1'] && $property->Pdfs[0] !== []) {
            update_post_meta($post_id, 'brochure_1', $meta['brochure_1']);
        }
        if ($meta['brochure_2'] && $property->Pdfs[1] !== []) {
            update_post_meta($post_id, 'brochure_2', $meta['brochure_2']);
        }
        if ($meta['brochure_3'] && $property->Pdfs[2] !== []) {
            update_post_meta($post_id, 'brochure_3', $meta['brochure_3']);
        }

        update_post_meta($post_id, 'is_featured', $meta['is_featured']);

        update_post_meta($post_id, 'property_longitude', $meta['long']);
        update_post_meta($post_id, 'property_latitude', $meta['lat']);
        update_post_meta($post_id, 'property_county', $meta['location_county']);
        update_post_meta($post_id, 'property_price', $meta['sell_price']);
        update_post_meta($post_id, 'property_label', $meta['price_term']);
        update_post_meta($post_id, 'property_bathrooms', $meta['bath']);
        update_post_meta($post_id, 'property_bedrooms', $meta['bed']);
        update_post_meta($post_id, 'property_country', $meta['property_country']);
        update_post_meta($post_id, 'property_title', $meta['property_title']);
        update_post_meta($post_id, 'wpestate_title', $meta['wpestate_title']);
        update_post_meta($post_id, 'wpestate_description', $meta['wpestate_description']);
        update_post_meta($post_id, 'property_address', $meta['property_address']);
        update_post_meta($post_id, 'property_area', $meta['property_area']);
        update_post_meta($post_id, 'property_status', $meta['property_status']);
        update_post_meta($post_id, 'prop_featured', $meta['prop_featured']);
        update_post_meta($post_id, 'property_theme_slider', $meta['property_theme_slider']);
        update_post_meta($post_id, 'post_show_title', $meta['post_show_title']);
        update_post_meta($post_id, 'header_type', $meta['header_type']);
        update_post_meta($post_id, 'sidebar_agent_option', $meta['sidebar_agent_option']);
        update_post_meta($post_id, 'local_pgpr_slider_type', $meta['local_pgpr_slider_type']);
        update_post_meta($post_id, 'local_pgpr_content_type', $meta['local_pgpr_content_type']);
        update_post_meta($post_id, 'sidebar_option', $meta['sidebar_option']);
        update_post_meta($post_id, 'slide_template', $meta['slide_template']);


    } elseif ($compatibility == 'lava-real-estate') {
        
        // No Compatibility Needed
        update_post_meta($post_id, 'full_address', $meta['full_address']);

        update_post_meta($post_id, 'lv_item_lat', $meta['latitude']);
        update_post_meta($post_id, 'lv_item_lng', $meta['longitude']);

        update_post_meta($post_id, 'county', $meta['county']);
        update_post_meta($post_id, 'area', $meta['area']);
        update_post_meta($post_id, 'city', $meta['city']);

        if ($meta['price'] && $property->Price !== []) {
            update_post_meta($post_id, '_price', $meta['price']);
        }

        update_post_meta($post_id, '_price_prefix', '€');


        if ($meta['property_size'] && $property->Size !== []) {
            update_post_meta($post_id, '_area_prefix', $meta['property_size']);
        }
        if ($meta['property_floors'] && $property->Floors !== []) {
            update_post_meta($post_id, 'property_floors', $meta['property_floors']);
        }

        if ($meta['bedrooms'] && $property->Beds !== []) {
            update_post_meta($post_id, '_bedrooms', $meta['bedrooms']);
        }
        if ($meta['bathrooms'] && $property->BathRooms !== []) {
            update_post_meta($post_id, '_bathrooms', $meta['bathrooms']);
        }

        if ($meta['ber_rating'] && $property->BER !== []) {
            update_post_meta($post_id, 'ber_rating', $meta['ber_rating']);
        }
        if ($meta['energy_details'] && $property->EPI !== []) {
            update_post_meta($post_id, 'energy_details', $meta['energy_details']);
        }

        if ($meta['agent_id'] && $property->AgentId !== []) {
            update_post_meta($post_id, 'agent_id', $meta['agent_id']);
        }
        if ($meta['agent_name'] &&  $property->Agent !== []) {
            update_post_meta($post_id, 'agent_name', $meta['agent_name']);
        }
        if ($meta['agent_email'] && $property->Email !== []) {
            update_post_meta($post_id, 'agent_email', $meta['agent_email']);
        }
        if ($meta['agent_number'] && $property->Phone !== []) {
            update_post_meta($post_id, 'agent_number', $meta['agent_number']);
        }

        if ($meta['agent_number'] && $property->Phone !== []) {
            update_post_meta($post_id, '_phone1', $meta['agent_number']);
        }


        if ($meta['agent_mobile'] && $property->Mobile !== []) {
            update_post_meta($post_id, 'agent_mobile', $meta['agent_mobile']);
        }

        if ($meta['brochure_1'] && $property->Pdfs[0] !== []) {
            update_post_meta($post_id, 'brochure_1', $meta['brochure_1']);
        }
        if ($meta['brochure_2'] && $property->Pdfs[1] !== []) {
            update_post_meta($post_id, 'brochure_2', $meta['brochure_2']);
        }
        if ($meta['brochure_3'] && $property->Pdfs[2] !== []) {
            update_post_meta($post_id, 'brochure_3', $meta['brochure_3']);
        }









    } elseif (!isset($compatibility) || $compatibility == 'none') {
        // No Compatibility Needed
        update_post_meta($post_id, 'full_address', $meta['full_address']);
        update_post_meta($post_id, 'property_status', $meta['property_status']);

        update_post_meta($post_id, 'latitude', $meta['latitude']);
        update_post_meta($post_id, 'longitude', $meta['longitude']);

        update_post_meta($post_id, 'county', $meta['county']);
        update_post_meta($post_id, 'area', $meta['area']);
        update_post_meta($post_id, 'city', $meta['city']);
        update_post_meta($post_id, 'property_accommodation', $meta['property_accommodation']);

        if ($meta['property_features']) {
            update_post_meta($post_id, 'property_features', $meta['property_features']);
        }

        

        if ($meta['price'] && $property->Price !== []) {
            update_post_meta($post_id, 'price', $meta['price']);
        }

        if ($meta['ber_number'] && $property->BERNo !== []) {
            update_post_meta($post_id, 'ber_number', $meta['ber_number']);
        }

        if ($meta['price_term'] && $property->PriceTerm !== []) {
            update_post_meta($post_id, 'price_term', $meta['price_term']);
        }

        if ($meta['property_size'] && $property->Size !== []) {
            update_post_meta($post_id, 'property_size', $meta['property_size']);
        }
        if ($meta['property_floors'] && $property->Floors !== []) {
            update_post_meta($post_id, 'property_floors', $meta['property_floors']);
        }

        if ($meta['bedrooms'] && $property->Beds !== []) {
            update_post_meta($post_id, 'bedrooms', $meta['bedrooms']);
        }
        if ($meta['bathrooms'] && $property->BathRooms !== []) {
            update_post_meta($post_id, 'bathrooms', $meta['bathrooms']);
        }

        if ($meta['ber_rating'] && $property->BER !== []) {
            update_post_meta($post_id, 'ber_rating', $meta['ber_rating']);
        }
        if ($meta['energy_details'] && $property->EPI !== []) {
            update_post_meta($post_id, 'energy_details', $meta['energy_details']);
        }

        if ($meta['agent_id'] && $property->AgentId !== []) {
            update_post_meta($post_id, 'agent_id', $meta['agent_id']);
        }
        if ($meta['agent_name'] &&  $property->Agent !== []) {
            update_post_meta($post_id, 'agent_name', $meta['agent_name']);
        }
        if ($meta['agent_email'] && $property->Email !== []) {
            update_post_meta($post_id, 'agent_email', $meta['agent_email']);
        }
        if ($meta['agent_number'] && $property->Phone !== []) {
            update_post_meta($post_id, 'agent_number', $meta['agent_number']);
        }
        if ($meta['agent_mobile'] && $property->Mobile !== []) {
            update_post_meta($post_id, 'agent_mobile', $meta['agent_mobile']);
        }

        if ($meta['brochure_1'] && $property->Pdfs[0] !== []) {
            update_post_meta($post_id, 'brochure_1', $meta['brochure_1']);
        }
        if ($meta['brochure_2'] && $property->Pdfs[1] !== []) {
            update_post_meta($post_id, 'brochure_2', $meta['brochure_2']);
        }
        if ($meta['brochure_3'] && $property->Pdfs[2] !== []) {
            update_post_meta($post_id, 'brochure_3', $meta['brochure_3']);
        }

        if ($meta['is_featured'] == false) {
            update_post_meta($post_id, 'is_featured', 'false');
        } elseif ($meta['is_featured'] == true) {
            update_post_meta($post_id, 'is_featured', 'true');
        }

    }
	
    return $meta;
}

/*
Function checking if given taxonomy exists
*/
function jtg_check_taxonomies($taxonomies, $search) {
    $terms_list = array();
    $result = array();
    $terms = get_terms($taxonomies, 'orderby=count&hide_empty=0');
    foreach ($terms as $term) {
        $terms_list[$term->term_id] = $term->name;
    }

    $terms_list = array_map('strtolower', $terms_list);
    if (in_array(strtolower($search), $terms_list)) {

        foreach ($terms_list as $key => $value){
            if (strtolower($value) == strtolower($search)){
                $result[$taxonomies][$key] = $value;
            }
        }
    }
    return $result;
}

/*
Post deletion function
*/
function jtg_delete_property($ID) {
	jtg_delete_post_images($ID);
	wp_delete_post($ID, true);
	return true;
}

/*
Image attachments deletion function
*/
function jtg_delete_post_images($post_id) {
    $attachments = get_posts(array(
        'post_type' => 'attachment',
        'posts_per_page' => -1,
        'post_status' => 'any',
        'post_parent' => $post_id
    ));
    $upload_dir = wp_upload_dir();
	if($post_id != NULL && $post_id != '') {
		foreach ($attachments as $attachment) {
			$file = wp_get_attachment_metadata($attachment->ID);
			$main = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . $file['file'];
			chmod($main, 0777);
			unlink($main);	
			wp_delete_attachment($attachment->ID, true);
		}
	}
}