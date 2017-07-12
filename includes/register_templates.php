<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Single Property Page Templates
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function single_prop($single_template) {
    global $wp_query, $post;
    if ($post->post_type == 'property'){
        $options = get_option('pm_design_options');
        $single_page_template_option = $options['jtg_single_page_template'];
        if ($single_page_template_option == '1') {
            $single_template = plugin_dir_path(__DIR__) . 'templates/single-property.php';
        } elseif ($single_page_template_option == '2') {
            $single_template = plugin_dir_path(__DIR__) . 'templates/single-property-2.php';
        } elseif ($single_page_template_option == '3') {
            $single_template = plugin_dir_path(__DIR__) . 'templates/single-property-3.php';
        } else {
            $single_template = plugin_dir_path(__DIR__) . 'templates/single-property.php';
        }
    }
    return $single_template;
} 
add_filter( 'single_template', 'single_prop' ) ;







///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Archive Page Template
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function archive_page($archive_template) {
    $options = get_option('pm_property_results_options');
    if ($options['design_option'] == 'list') {
        // Check if custom templates have been added. If they have, override using custom
        $custom_archive = plugin_dir_path(__DIR__) . 'custom_templates/properties-list-page.php';
        if (file_exists($custom_archive)) {
            $archive_template = $custom_archive;
        } else {
            $archive_template = plugin_dir_path(__DIR__) . 'templates/properties-list-page.php';
        }
    } elseif ($options['design_option'] == 'map') {
        $custom_archive = plugin_dir_path(__DIR__) . 'custom_templates/properties-map-page.php';
        if (file_exists($custom_archive)) {
            $archive_template = $custom_archive;
        } else {
            $archive_template = plugin_dir_path(__DIR__) . 'templates/properties-map-page.php';
        }   
    } else {
        $custom_archive = plugin_dir_path(__DIR__) . 'custom_templates/properties-grid-page.php';
        if (file_exists($custom_archive)) {
            $archive_template = $custom_archive;
        } else {
            $archive_template = plugin_dir_path(__DIR__) . 'templates/properties-grid-page.php';
        }   
    }
    return $archive_template;
}
add_filter( 'archive_template', 'archive_page' ) ;

function properties_map_page_install() {

    $post_id = -1;

    // Setup custom vars
    $author_id = 1;
    $slug = 'properties-map';
    $title = 'Properties Map';

    // Check if page exists, if not create it
    if ( null == get_page_by_title( $title )) {

        $new_page = array(
                'comment_status'        => 'closed',
                'ping_status'           => 'closed',
                'post_author'           => $author_id,
                'post_name'             => $slug,
                'post_title'            => $title,
                'post_status'           => 'publish',
                'post_type'             => 'page'
        );

        $post_id = wp_insert_post( $new_page );


        if ( !$post_id ) {

                wp_die( 'Error creating template page' );

        } else {
                
                update_post_meta( $post_id, '_wp_page_template', 'properties-map-page.php' );

        }
    } // end check if

}
add_action('admin_init', 'properties_map_page_install');

function properties_map_page( $template ) {
    $plugindir = plugin_dir_path(__DIR__);

    if ( is_page_template( 'properties-map-page.php' )) {

        $template = plugin_dir_path(__DIR__) . 'templates/properties-map-page.php';
    }

    return $template;
}
add_action( 'template_include', 'properties_map_page' );