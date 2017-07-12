<?php
function jtg_add_query_vars($public_query_vars) {
    $public_query_vars[] = 'property_status';
    $public_query_vars[] = 'property_type';
    $public_query_vars[] = 'type_group';
    $public_query_vars[] = 'location_county';
    $public_query_vars[] = 'location_area';
    $public_query_vars[] = 'bedrooms';
    $public_query_vars[] = 'min_price';
    $public_query_vars[] = 'max_price';
    $public_query_vars[] = 'orderby';
    $public_query_vars[] = 'property_keyword';

    return $public_query_vars;
}
add_filter('query_vars', 'jtg_add_query_vars');

// function jtg_search_properties( $query ) {
//     global $wp_query;
//     if (! is_admin() && $query->is_main_query() && is_post_type_archive( 'property' )) {
//         $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
//         $location_area = get_query_var('location_area') ? get_query_var('location_area') : '';
//         $location_county = get_query_var('location_county') ? get_query_var('location_county') : '';
//         $bedrooms = get_query_var('bedrooms') ? get_query_var('bedrooms') : '';
//         $min_price = get_query_var('min_price') ? get_query_var('min_price') : 0;
//         $max_price = get_query_var('max_price') ? get_query_var('max_price') : 5000000;

//         $property_keyword = get_query_var('property_keyword') ? get_query_var('property_keyword') : '';
//         // $orderby = get_query_var('orderby') ? get_query_var('orderby') : 'date_new';

//         $query->set('paged', $paged);
//         $query->set('posts_per_page', 12);
//         $query->set('post_status', 'publish');

//         $query->set('post_type', 'property');

//         $property_type = $_GET['property_type'];
//         if ($property_type == 'pm_commercial') {
//             $commercial = array(
//                     'industrial',
//                     'industrial-distribution',
//                     'office',
//                     'retail',
//                     'warehouse',
//                     'site',
//                     'development-site'
//                 );

//              $taxquery = array(
//                 array(
//                     'taxonomy' => 'property_type',
//                     'field' => 'slug',
//                     'terms' => $commercial,
//                 )
//             );
//              // This removes the pm_commercial from the get request to allow tha above rewrite
//             $query->set('property_type', '' );
//             $query->set( 'tax_query', $taxquery );
//         } elseif ($property_type == 'pm_residential') {
//             $residential = array(
//                     'house',
//                     'apartment',
//                     'flat',
//                     'studio',
//                     'duplex'
//                 );

//              $taxquery = array(
//                 array(
//                     'taxonomy' => 'property_type',
//                     'field' => 'slug',
//                     'terms' => $residential,
//                 )
//             );
//              // This removes the pm_commercial from the get request to allow tha above rewrite
//             $query->set('property_type', '' );
//             $query->set( 'tax_query', $taxquery );
//         }

//         $meta_query= array();
//         if (isset($_GET['property_keyword'])) {
//             $meta_query[] = array(
//                 'relation' => 'AND',
//                     array(
//                         'key' => 'full_address',
//                         'value' => $property_keyword,
//                         'compare' => 'LIKE',
//                         'type' => 'TEXT'
//                     )

//                 );
//         }

        
//         $meta_query= array();
//         if (isset($_GET['location_area'])) {
//             $meta_query[] = array(
//                         'key' => 'area',
//                         'value' => $location_area,
//                         'compare' => '='
//             );
//         }

//         if ($location_county == '1') {
//             $location_county = 'Dublin';
//         } elseif ($location_county == '2') {
//             $location_county = 'Meath';
//         } elseif ($location_county == '3') {
//             $location_county = 'Kildare';
//         } elseif ($location_county == '4') {
//             $location_county = 'Wicklow';
//         } elseif ($location_county == '5') {
//             $location_county = 'Longford';
//         } elseif ($location_county == '6') {
//             $location_county = 'Offaly';
//         } elseif ($location_county == '7') {
//             $location_county = 'Westmeath';
//         } elseif ($location_county == '8') {
//             $location_county = 'Laois';
//         } elseif ($location_county == '9') {
//             $location_county = 'Louth';
//         } elseif ($location_county == '10') {
//             $location_county = 'Carlow';
//         } elseif ($location_county == '11') {
//             $location_county = 'Kilkenny';
//         } elseif ($location_county == '12') {
//             $location_county = 'Waterford';
//         } elseif ($location_county == '13') {
//             $location_county = 'Wexford';
//         } elseif ($location_county == '14') {
//             $location_county = 'Kerry';
//         } elseif ($location_county == '15') {
//             $location_county = 'Cork';
//         } elseif ($location_county == '16') {
//             $location_county = 'Clare';
//         } elseif ($location_county == '17') {
//             $location_county = 'Limerick';
//         } elseif ($location_county == '18') {
//             $location_county = 'Tipperary';
//         } elseif ($location_county == '19') {
//             $location_county = 'Galway';
//         } elseif ($location_county == '20') {
//             $location_county = 'Mayo';
//         } elseif ($location_county == '21') {
//             $location_county = 'Roscommon';
//         } elseif ($location_county == '22') {
//             $location_county = 'Sligo';
//         } elseif ($location_county == '23') {
//             $location_county = 'Leitrim';
//         } elseif ($location_county == '24') {
//             $location_county = 'Donegal';
//         } elseif ($location_county == '25') {
//             $location_county = 'Cavan';
//         } elseif ($location_county == '26') {
//             $location_county = 'Monaghan';
//         }

//         if (isset($location_county)) {
//             $meta_query[] = array(
//                         'key' => 'county',
//                         'value' => $location_county,
//                         'compare' => '='
//             );
//         }

//         if (isset($_GET['bedrooms'])) {
//                 $meta_query[] = array(
//                         'key' => 'bedrooms',
//                         'type' => 'NUMERIC',
//                         'value' => $bedrooms,
//                         'compare' => '>='
//                     );
//         }

//         if (isset($min_price) && isset($max_price)) {
//             $meta_query[] = array(
//                         'key' => 'price',
//                         'value' => array($min_price, $max_price ),
//                         'type' => 'NUMERIC',
//                         'compare' => 'BETWEEN'
//             );
//         }
//         $query->set('meta_query', $meta_query);
//     }
// }
// add_filter( 'pre_get_posts', 'jtg_search_properties');