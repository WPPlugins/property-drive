<?php
add_action( 'wp_ajax_' . 'ajax_property_search', 'jtg_ajax_search' );
add_action( 'wp_ajax_nopriv_' . 'ajax_property_search', 'jtg_ajax_search' );
function jtg_ajax_search(){
////////////////////////////////////////////////////////////////////////////////////////////////
// Property Search v2
////////////////////////////////////////////////////////////////////////////////////////////////
$meta_query = array();
$tax_query = array();
if ($_POST['group_type'] == 'pm_commercial') {
    $commercial = array(
        'industrial',
        'industrial-distribution',
        'office',
        'retail',
        'warehouse',
        'site',
        'development-site',
        'site-individual'
        );
    $tax_query[] = array(
        array(
            'taxonomy' => 'property_type',
            'field' => 'slug',
            'terms' => $commercial,
            )
        );
} elseif ($_POST['group_type'] == 'pm_residential') {
    $residential = array(
        'house',
        'apartment',
        'flat',
        'studio',
        'duplex'
        );
    $tax_query[] = array(
        array(
            'taxonomy' => 'property_type',
            'field' => 'slug',
            'terms' => $residential,
            )
        );
}
if (isset($_POST['property_type'])) {
    $tax_query[] = array(
        array(
            'taxonomy' => 'property_type',
            'field' => 'slug',
            'terms' => $_POST['property_type'],
            )
        );
}
if (isset($_POST['property_status'])) {
    $tax_query[] = array(
        array(
            'taxonomy' => 'property_status',
            'field' => 'slug',
            'terms' => $_POST['property_status'],
            )
        );
}
$location_county = $_POST['location_county'];
if (isset($location_county)) {
    if ($location_county == '1') {
    $location_county = 'Dublin';
} elseif ($location_county == '2') {
    $location_county = 'Meath';
} elseif ($location_county == '3') {
    $location_county = 'Kildare';
} elseif ($location_county == '4') {
    $location_county = 'Wicklow';
} elseif ($location_county == '5') {
    $location_county = 'Longford';
} elseif ($location_county == '6') {
    $location_county = 'Offaly';
} elseif ($location_county == '7') {
    $location_county = 'Westmeath';
} elseif ($location_county == '8') {
    $location_county = 'Laois';
} elseif ($location_county == '9') {
    $location_county = 'Louth';
} elseif ($location_county == '10') {
    $location_county = 'Carlow';
} elseif ($location_county == '11') {
    $location_county = 'Kilkenny';
} elseif ($location_county == '12') {
    $location_county = 'Waterford';
} elseif ($location_county == '13') {
    $location_county = 'Wexford';
} elseif ($location_county == '14') {
    $location_county = 'Kerry';
} elseif ($location_county == '15') {
    $location_county = 'Cork';
} elseif ($location_county == '16') {
    $location_county = 'Clare';
} elseif ($location_county == '17') {
    $location_county = 'Limerick';
} elseif ($location_county == '18') {
    $location_county = 'Tipperary';
} elseif ($location_county == '19') {
    $location_county = 'Galway';
} elseif ($location_county == '20') {
    $location_county = 'Mayo';
} elseif ($location_county == '21') {
    $location_county = 'Roscommon';
} elseif ($location_county == '22') {
    $location_county = 'Sligo';
} elseif ($location_county == '23') {
    $location_county = 'Leitrim';
} elseif ($location_county == '24') {
    $location_county = 'Donegal';
} elseif ($location_county == '25') {
    $location_county = 'Cavan';
} elseif ($location_county == '26') {
    $location_county = 'Monaghan';
}
}


if (isset($location_county)) {
    $meta_query[] = array(
        'key' => 'county',
        'value' => $location_county,
        'compare' => '='
        );
}

if (isset($_POST['location_area'])) {
    $meta_query[] = array(
        'key' => 'area',
        'value' => $_POST['location_area'],
        'compare' => '='
        );
}


if (isset($_POST['bedrooms'])) {
    $meta_query[] = array(
        'key' => 'bedrooms',
        'type' => 'NUMERIC',
        'value' => $bedrooms,
        'compare' => '>='
        );
}
if (isset($min_price) && isset($max_price)) {
    $meta_query[] = array(
        'key' => 'price',
        'value' => array($min_price, $max_price ),
        'type' => 'NUMERIC',
        'compare' => 'BETWEEN'
        );
}


$args = array(
    'paged' => -1,
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'post_type' => 'property',
    'orderby' => 'meta_value',
    'meta_key' => 'property_status',
    'order' => 'ASC',
    'tax_query' => $tax_query,
    'meta_query' => $meta_query
    );
if (isset($_POST['property_keyword'])) {
    $args['s']= $_POST['property_keyword'];
}
$properties = new WP_Query( $args );
////////////////////////////////////////////////////////////////////////////////////////////////
// End of Custom Query
////////////////////////////////////////////////////////////////////////////////////////////////
while ( $properties->have_posts() ) : $properties->the_post();
$post_thumbnail_id = get_post_thumbnail_id();
if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
    $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
} else {
    $post_thumbnail_url = plugins_url( 'assets/images/no-image.jpg', dirname(__FILE__) );
}
$property = get_post_meta(get_the_id());
$title = get_the_title();
$link = get_the_permalink();
$lng = $property['longitude'][0];
$img_url = $post_thumbnail_url;
$lat = $property['latitude'][0];
$price = $property['price'];
$description = 'Something';

$property_types = get_the_terms(get_the_id(), 'property_type');
if ($property_types) {
        foreach ($property_types as $type) {
            $type = $type->name;
        }
    }
    $property_statuses = get_the_terms(get_the_id(), 'property_status');
    if ($property_statuses) {
        foreach ($property_statuses as $status) {
            $status = $status->name;
        }
    }

$locations[]=array('title' => $title,'lat'=>$lat, 'type' => $type, 'status' => $status, 'lng'=> $lng, 'link' => $link, 'img_url' => $img_url, 'price' => $price, 'description' => $description );
endwhile;
$markers = json_encode( $locations );

	echo $markers;
    //Make sure you die when finished doing ajax output.
    die(); 
}
