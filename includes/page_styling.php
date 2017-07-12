<?php
$dir = plugin_dir_url( __DIR__ );
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Register Scripts
///////////////////////////////////////////////////////////////////////////////////////////////////////////
wp_register_script('jtg-noui-script', $dir.'assets/js/nouislider.min.js', __FILE__);
wp_register_script('jtg-select2-script', $dir.'assets/js/select2.min.js', __FILE__);
wp_register_script('jtg-light-slider-scripts', $dir.'assets/js/lightslider.min.js', __FILE__);
wp_register_script('jtg-light-gallery-scripts', $dir.'assets/js/lightgallery.js', __FILE__);
wp_register_script('jtg-request-viewing', $dir.'assets/js/request_viewing.js', __FILE__);
wp_register_script('jtg-add-favourite-js', $dir.'assets/js/add_favourite.js', __FILE__);
wp_register_script('jtg-remove-favourite-js', $dir.'assets/js/remove_favourite.js', __FILE__);
wp_register_script('jtg-counties-areas', $dir.'assets/js/counties_areas.js', __FILE__);
wp_register_script('jtg-swiper', $dir.'assets/js/jtg-swiper.js', __FILE__);
wp_register_script('jtg-single-map', $dir.'assets/js/single_property_map.js', __FILE__);
wp_register_script('jtg-ajax-search', $dir.'assets/js/ajax_property_search.js', __FILE__);

wp_register_script('jtg-gears', $dir.'assets/js/gears_init.js', __FILE__);
wp_register_script('jtg-raphael', $dir.'assets/js/raphael-min.js', __FILE__);
wp_register_script('jtg-suncalc', $dir.'assets/js/suncalc.js', __FILE__);
wp_register_script('jtg-suncalc-overlay', $dir.'assets/js/suncalc-overlay.js', __FILE__);
wp_register_script('jtg-suncalc-main', $dir.'assets/js/suncalc-main.js', __FILE__);

///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Register Styles
///////////////////////////////////////////////////////////////////////////////////////////////////////////
wp_register_style('jtg-grid', $dir.'assets/css/jtg_grid.css', __FILE__);

wp_register_style('pd-flex-grid', $dir.'assets/css/pd_bootstrap.css', __FILE__, time());


wp_register_style('jtg-fa-icons', $dir.'assets/css/font-awesome.min.css', __FILE__);
wp_register_style('jtg-noui-styles', $dir.'assets/css/nouislider.min.css', __FILE__);
wp_register_style('jtg-select2-style', $dir.'assets/css/select2.css', __FILE__);
wp_register_style('jtg-single-property-styles', $dir.'assets/css/single_property_styles.css', __FILE__);
wp_register_style('jtg-light-slider-styles', $dir.'assets/css/lightslider.min.css', __FILE__);
wp_register_style('jtg-light-gallery-styles', $dir.'assets/css/lightgallery.min.css', __FILE__);
wp_register_style('jtg-single-property', $dir.'assets/css/single_property.css', __FILE__);
wp_register_style('jtg-single-property-2', $dir.'assets/css/single_property_2.css', __FILE__);
wp_register_style('jtg-single-property-3', $dir.'assets/css/single_property_3.css', __FILE__);
wp_register_style('jtg-search-type-3', $dir.'assets/css/search_type_3.css', __FILE__);
wp_register_style('jtg-search-type-4', $dir.'assets/css/search_type_4.css', __FILE__);
wp_register_style('jtg-property-box-1', $dir.'assets/css/property_box_1.css', __FILE__);
wp_register_style('jtg-property-box-2', $dir.'assets/css/property_box_2.css', __FILE__);
wp_register_style('jtg-property-box-3', $dir.'assets/css/property_box_3.css', __FILE__);
wp_register_style('jtg-property-box-4', $dir.'assets/css/property_box_4.css', __FILE__);
wp_register_style('jtg-main-styles', $dir.'assets/css/styles.css', __FILE__);


///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Enqueue Scripts
///////////////////////////////////////////////////////////////////////////////////////////////////////////
wp_enqueue_script( 'jtg-noui-script' );

///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Enqueue Style
///////////////////////////////////////////////////////////////////////////////////////////////////////////
wp_enqueue_style('jtg-fa-icons');
wp_enqueue_style( 'jtg-grid' );
wp_enqueue_style('pd-flex-grid');
wp_enqueue_style( 'jtg-noui-styles' );