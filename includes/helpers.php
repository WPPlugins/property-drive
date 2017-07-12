<?php
function jtg_ber_image($ber_rating){
	$plugin_dir = plugin_dir_url( __dir__ ).'assets/images/ber';
    if ($ber_rating === 'A1') {
        return $ber_img = $plugin_dir.'/A1_BER_RGB_Web.png';
    } elseif ($ber_rating === 'A2') {
        return $ber_img = $plugin_dir.'/A2_BER_RGB_Web.png';
    } elseif ($ber_rating === 'A3') {
        return $ber_img = $plugin_dir.'/A3_BER_RGB_Web.png';
    } elseif ($ber_rating === 'B1') {
        return $ber_img = $plugin_dir.'/B1_BER_RGB_Web.png';
    } elseif ($ber_rating === 'B2') {
        return $ber_img = $plugin_dir.'/B2_BER_RGB_Web.png';
    } elseif ($ber_rating === 'B3') {
        return $ber_img = $plugin_dir.'/B3_BER_RGB_Web.png';
    } elseif ($ber_rating === 'C1') {
        return $ber_img = $plugin_dir.'/C1_BER_RGB_Web.png';
    } elseif ($ber_rating === 'C2') {
        return $ber_img = $plugin_dir.'/C2_BER_RGB_Web.png';
    } elseif ($ber_rating === 'C3') {
        return $ber_img = $plugin_dir.'/C3_BER_RGB_Web.png';
    } elseif ($ber_rating === 'D1') {
        return $ber_img = $plugin_dir.'/D1_BER_RGB_Web.png';
    } elseif ($ber_rating === 'D2') {
        return $ber_img = $plugin_dir.'/D2_BER_RGB_Web.png';
    } elseif ($ber_rating === 'E1') {
        return $ber_img = $plugin_dir.'/E1_RGB_BER_Web.png';
    } elseif ($ber_rating === 'E2') {
        return $ber_img = $plugin_dir.'/E2_RGB_BER_Web.png';
    } elseif ($ber_rating === 'F') {
        return $ber_img = $plugin_dir.'/F_BER_RGB_Web.png';
    } elseif ($ber_rating === 'G') {
        return $ber_img = $plugin_dir.'/G_BER_RGB_Web.png';
    } else {
        return $ber_img = $plugin_dir.'/on_request.png';
    }
}


function jtg_single_property_ber($ber_rating){
    $plugin_dir = plugin_dir_url( __dir__ ).'assets/images/ber';
    if ($ber_rating === 'A1') {
        return $ber_img = '<img width="60px" src="'.$plugin_dir.'/A1_BER_RGB_Web.png">';
    } elseif ($ber_rating === 'A2') {
        return $ber_img = '<img width="60px" src="'.$plugin_dir.'/A2_BER_RGB_Web.png">';
    } elseif ($ber_rating === 'A3') {
        return $ber_img = '<img width="60px" src="'.$plugin_dir.'/A3_BER_RGB_Web.png">';
    } elseif ($ber_rating === 'B1') {
        return $ber_img = '<img width="60px" src="'.$plugin_dir.'/B1_BER_RGB_Web.png">';
    } elseif ($ber_rating === 'B2') {
        return $ber_img = '<img width="60px" src="'.$plugin_dir.'/B2_BER_RGB_Web.png">';
    } elseif ($ber_rating === 'B3') {
        return $ber_img = '<img width="60px" src="'.$plugin_dir.'/B3_BER_RGB_Web.png">';
    } elseif ($ber_rating === 'C1') {
        return $ber_img = '<img width="60px" src="'.$plugin_dir.'/C1_BER_RGB_Web.png">';
    } elseif ($ber_rating === 'C2') {
        return $ber_img = '<img width="60px" src="'.$plugin_dir.'/C2_BER_RGB_Web.png">';
    } elseif ($ber_rating === 'C3') {
        return $ber_img = '<img width="60px" src="'.$plugin_dir.'/C3_BER_RGB_Web.png">';
    } elseif ($ber_rating === 'D1') {
        return $ber_img = '<img width="60px" src="'.$plugin_dir.'/D1_BER_RGB_Web.png">';
    } elseif ($ber_rating === 'D2') {
        return $ber_img = '<img width="60px" src="'.$plugin_dir.'/D2_BER_RGB_Web.png">';
    } elseif ($ber_rating === 'E1') {
        return $ber_img = '<img width="60px" src="'.$plugin_dir.'/E1_RGB_BER_Web.png">';
    } elseif ($ber_rating === 'E2') {
        return $ber_img = '<img width="60px" src="'.$plugin_dir.'/E2_RGB_BER_Web.png">';
    } elseif ($ber_rating === 'F') {
        return $ber_img = '<img width="60px" src="'.$plugin_dir.'/F_BER_RGB_Web.png">';
    } elseif ($ber_rating === 'G') {
        return $ber_img = '<img width="60px" src="'.$plugin_dir.'/G_BER_RGB_Web.png">';
    } else {
        return $ber_img = '<img width="100px" src="'.$plugin_dir.'/on_request.png">';
    }
}

function jtg_currency_symbol($currency) {
    if ($currency == 'euro') {
        $currency_symbol = array(
                'symbol' => '€',
                'icon_class' => 'fa fa-eur'
            );
        return $currency_symbol;
    } elseif ($currency == 'gbp') {
        $currency_symbol = array(
                'symbol' => '£',
                'icon_class' => 'fa fa-gbp'
            );
        return $currency_symbol;
    } elseif ($currency == 'usd') {
        $currency_symbol = array(
                'symbol' => '$',
                'icon_class' => 'fa fa-usd'
            );
        return $currency_symbol;
    }
}

function jtg_property_view_count($post_id){
    global $post;
    $views_count = get_post_meta($post_id, 'property_view_count', true);
    $views_count++;
    update_post_meta($post_id, 'property_view_count', $views_count);
    return $views_count;
}


function jtg_county_id($county_name){

    if ($county_name == 'Dublin') {
        $county_details = array(
            'county_id' => '1',
            'county_name' => 'Co. Dublin'
            );
        return $county_details;
    } elseif ($county_name == 'Meath') {
        $county_details = array(
            'county_id' => '2',
            'county_name' => 'Co. Meath'
            );
        return $county_details;
    } elseif ($county_name == 'Kildare') {
        $county_details = array(
            'county_id' => '3',
            'county_name' => 'Co. Kildare'
            );
        return $county_details;
    } elseif ($county_name == 'Wicklow') {
        $county_details = array(
            'county_id' => '4',
            'county_name' => 'Co. Wicklow'
            );
        return $county_details;
    } elseif ($county_name == 'Longford') {
        $county_details = array(
            'county_id' => '5',
            'county_name' => 'Co. Longford'
            );
        return $county_details;
    } elseif ($county_name == 'Offaly') {
        $county_details = array(
            'county_id' => '6',
            'county_name' => 'Co. Offaly'
            );
        return $county_details;
    } elseif ($county_name == 'Westmeath') {
        $county_details = array(
            'county_id' => '7',
            'county_name' => 'Co. Westmeath'
            );
        return $county_details;
    } elseif ($county_name == 'Laois') {
        $county_details = array(
            'county_id' => '8',
            'county_name' => 'Co. Laois'
            );
        return $county_details;
    } elseif ($county_name == 'Louth') {
        $county_details = array(
            'county_id' => '9',
            'county_name' => 'Co. Louth'
            );
        return $county_details;
    } elseif ($county_name == 'Carlow') {
        $county_details = array(
            'county_id' => '10',
            'county_name' => 'Co. Carlow'
            );
        return $county_details;
    } elseif ($county_name == 'Kilkenny') {
        $county_details = array(
            'county_id' => '11',
            'county_name' => 'Co. Kilkenny'
            );
        return $county_details;
    } elseif ($county_name == 'Waterford') {
        $county_details = array(
            'county_id' => '12',
            'county_name' => 'Co. Waterford'
            );
        return $county_details;
    } elseif ($county_name == 'Wexford') {
        $county_details = array(
            'county_id' => '13',
            'county_name' => 'Co. Wexford'
            );
        return $county_details;
    } elseif ($county_name == 'Kerry') {
        $county_details = array(
            'county_id' => '14',
            'county_name' => 'Co. Kerry'
            );
        return $county_details;
    } elseif ($county_name == 'Cork') {
        $county_details = array(
            'county_id' => '15',
            'county_name' => 'Co. Cork'
            );
        return $county_details;
    } elseif ($county_name == 'Clare') {
        $county_details = array(
            'county_id' => '16',
            'county_name' => 'Co. Clare'
            );
        return $county_details;
    } elseif ($county_name == 'Limerick') {
        $county_details = array(
            'county_id' => '17',
            'county_name' => 'Co. Limerick'
            );
        return $county_details;
    } elseif ($county_name == 'Tipperary') {
        $county_details = array(
            'county_id' => '18',
            'county_name' => 'Co. Tipperary'
            );
        return $county_details;
    } elseif ($county_name == 'Galway') {
        $county_details = array(
            'county_id' => '19',
            'county_name' => 'Co. Galway'
            );
        return $county_details;
    } elseif ($county_name == 'Mayo') {
        $county_details = array(
            'county_id' => '20',
            'county_name' => 'Co. Mayo'
            );
        return $county_details;
    } elseif ($county_name == 'Roscommon') {
        $county_details = array(
            'county_id' => '21',
            'county_name' => 'Co. Roscommon'
            );
        return $county_details;
    } elseif ($county_name == 'Sligo') {
        $county_details = array(
            'county_id' => '22',
            'county_name' => 'Co. Sligo'
            );
        return $county_details;
    } elseif ($county_name == 'Leitrim') {
        $county_details = array(
            'county_id' => '23',
            'county_name' => 'Co. Leitrim'
            );
        return $county_details;
    } elseif ($county_name == 'Donegal') {
        $county_details = array(
            'county_id' => '24',
            'county_name' => 'Co. Donegal'
            );
        return $county_details;
    } elseif ($county_name == 'Cavan') {
        $county_details = array(
            'county_id' => '25',
            'county_name' => 'Co. Cavan'
            );
        return $county_details;
    } elseif ($county_name == 'Monaghan') {
        $county_details = array(
            'county_id' => '26',
            'county_name' => 'Co. Monaghan'
            );
        return $county_details;
    }
}


function jtg_find_areas($county_id){
    global $wpdb;
    $jtg_table_name = $wpdb->prefix.'postmeta';
    $filled_areas = $wpdb->get_results("SELECT DISTINCT meta_value from $jtg_table_name where meta_key='area' ORDER BY meta_value ASC");


    $table_name = $wpdb->prefix . 'jtg_counties_areas';
    $areas = $wpdb->get_results("SELECT * FROM $table_name WHERE county_id = $county_id");

    foreach ($filled_areas as $filled_area) {
        
        foreach ($areas as $area) {
            if ($area->area == $filled_area->meta_value) {
                echo '<option value="'.$area->area.'">'.$area->area.'</option>';
            }
        }
    }
}



////////////////////////////////////////////////////////////////////////////////////////////////
// Sort Counties Areas Ajax
////////////////////////////////////////////////////////////////////////////////////////////////
function jtg_find_areas_from_counties(){

    jtg_find_areas($_POST['county_id']);

    //Make sure you die when finished doing ajax output.
    die(); 
}
add_action( 'wp_ajax_' . 'jtg_counties_areas_ajax', 'jtg_find_areas_from_counties' );
add_action( 'wp_ajax_nopriv_' . 'jtg_counties_areas_ajax', 'jtg_find_areas_from_counties' );














