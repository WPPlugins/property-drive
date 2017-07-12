<?php
/********
    When the plugin is activated we check if the settings are in the DB
    If they are we leave them be, if they aren't in there, we add basic settings
    Also turning off the Auto Sync by default - To initiate a background import
    Add API key, turn Auto Sync on, deactivate plugin and reactivate ;)
********/
function jtg_check_settings_first_time(){
    $options = get_option('pm_importer_options', true);
    if ($options == 'false') {
        do_action( 'jtg_setup_basic_options' );
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Setup the default variables on Activation
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function jtg_add_basic_settings(){
    $plugin_settings = array(
        'auto_sync'     => 'false',
        'pd_api_key'   => 'ENTER API KEY HERE',
        'jtg_importer_schedule' => 'hourly',
        'allow_tax' => 'true',
        'allow_styling' => 'true',
        'jtg_currency' => 'euro'
    );
    update_option( 'pm_importer_options', $plugin_settings );

    $design_settings = array(
        'design_option' => 'grid',
        'base_colour' => '#004b85',
        'secondary_colour' => '#ccc',
        'header_show_type' => 'true',
        'header_show_status' => 'true',
        'header_show_price' => 'true',
        'header_show_ber' => 'true',
        'header_show_area' => 'true',
        'header_show_beds' => 'true',
        'featured_title' => 'true',
        'featured_title_background' => '#004b85',
        'featured_title_color' => '#fff',
        'property_grid_title' => 'LATEST PROPERTIES',
        'show_view_more' => 'true',
        'slider_auto_play' => 'true',
        'single_container_padding' => '100',
        'show_sidebar' => 'true',
        'jtg_single_page_template' => '1'
    );
    update_option( 'pm_design_options', $design_settings );

    $custom_css = '// Additional CSS goes here

                .something {
                    display: inline-block;
                }';

    update_option('pm_css_options', $custom_css);


    $search_options = array(
                'search_type' => 1,
                'search_space_above' => '50',
                'search_space_below' => '50',
                'search_background_color' => '#fff',
                'search_btn_color' => '#004b85',
                'search_btn_text_color' => '#fff',
                'search_btn_hover_text_color' => '#004b85',
                'search_btn_hover_color' => '#ccc',
                'price_slider_bar' => '#004b85',
                'search_grouping' => false,
                'slider_dropdown' => 'slider'
                
            );

        // Update the option in the DB
        $update_search = update_option('pm_search_options', $search_options);

        $dir = plugin_dir_url( __DIR__ );
        $no_image_url = $dir.'assets/images/no-image.jpg';

        $agency_details = array(
                'agency_name' => 'Example Agency',
                'agency_email' => 'info@exampleagency.com',
                'agency_phone' => '+44 123 456789',
                'agency_logo' => $no_image_url
            );

        // Update the option in the DB
        $update_name = update_option('pm_agency_options', $agency_details);


        $property_box_options = array(
                'design_option' => 1,
                'results_grid_columns' => 4,
                'property_box_style' => 1


            );

        // Update the option in the DB
        $update_design = update_option('pm_property_results_options', $property_box_options);



        $search_type_3_options = array(
                'search_3_background_color' => 'rgba(255,255,255,0.85)',
                'slider_pause_time' => '5000'

            );

        // Update the option in the DB
        $update_search_type_3 = update_option('search_type_3_options', $search_type_3_options);

}
add_action( 'jtg_setup_basic_options', 'jtg_add_basic_settings' );