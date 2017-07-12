<?php

function jtg_setup_meta_data($property){
	// Create property meta details through an array
	$meta = array();
	

	$meta['full_address'] = $property->Address;

	$meta['latitude'] = $property->GPS->Latitude;
	$meta['longitude'] = $property->GPS->Longitude;

	$meta['county'] = $property->CountyCityName;
	$meta['area'] = $property->DistrictName;
	$meta['city'] = $property->CountyCityName;

	$meta['price'] = $property->PriceInDecimal;
	$meta['price_term'] = $property->PriceTerm;

	$meta['property_size'] = $property->Size;
	$meta['property_floors'] = $property->Floors;

	$meta['bedrooms'] = $property->Beds;
	$meta['bathrooms'] = $property->BathRooms;

	$meta['ber_rating'] = $property->BER;
	$meta['energy_details'] = $property->EPI;

	$meta['agent_id'] = $property->AgentId;
	$meta['agent_name'] = $property->Agent;
	$meta['agent_email'] = $property->Email;
	$meta['agent_number'] = $property->Phone;
	$meta['agent_mobile'] = $property->Mobile;

	$meta['brochure_1'] = $property->Pdfs[0];
	$meta['brochure_2'] = $property->Pdfs[1];
	$meta['brochure_3'] = $property->Pdfs[2];

	$meta['is_featued'] = $property->isFeaturedProperty;

	$meta['property_accommodation'] = wpautop($property->Accommodation, false);

	$meta['property_features'] = $property->Tags;

	$meta['ber_number'] = $property->BERNo;

	$meta['property_status'] = $property->Status;


	// Compatibility Check and add meta
	$comp_options = get_option('pm_importer_options');
    $compatibility = $comp_options['jtg_theme_compatibility'];

    if ($compatibility == 'wp-residence') {
    	$meta['property_country'] = 'Ireland';
    	$meta['property_title'] = $property->Address;
    	$meta['wpestate_title'] = $property->Address;
    	$meta['wpestate_description'] = $property->Desc;
    	$meta['property_address'] = $property->Address;
    	$meta['property_area'] = $property->DistrictName;
    	$meta['prop_featured'] = '0';
    	$meta['property_theme_slider'] = '0';
    	$meta['post_show_title'] = 'yes';
    	$meta['header_type'] = '0';
    	$meta['sidebar_agent_option'] = 'global';
    	$meta['local_pgpr_slider_type'] = 'global';
    	$meta['local_pgpr_content_type'] = 'global';
    	$meta['sidebar_option'] = 'global';
    	$meta['slide_template'] = 'default';

    } elseif ($compatibility == 'lava-real-estate') {
    	
    }

    return $meta;
}