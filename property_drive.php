    <?php
/*
* Property Drive
*
* @package     PropertyDrive
* @author      Jay the Geek
* @copyright   2017 Jay the Geek
* @license     GPL-2.0+
*
* @wordpress-plugin
* Plugin Name: Property Drive
* Plugin URI:  http://propertydrive.io
* Description: Adds properties to your Wordpress website, designed to work with any theme. Property Drive can also be a stand alone importer from the propertydrive.io feed.
* Version:     5.4.7
* Author:      Jay the Geek
* Author URI:  http://propertydrive.io
* License:     GNU General Public License v2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  System / Dependencies Check / Activation Settings
///////////////////////////////////////////////////////////////////////////////////////////////////////////
require_once 'includes/setup_plugin_options.php';
// On Plugin Activation we install the basic settings for usage
register_activation_hook( __FILE__, 'jtg_check_settings_first_time' );
// On Plugin Activation setup the Counties / Areas Table in the DB
register_activation_hook( __FILE__, 'jtg_setup_counties_areas' );
// On Plugin Activation setup the Auto Sync Job
register_activation_hook( __FILE__, 'jtg_on_activation' );
// Deactivation unhook Auto Sync
register_deactivation_hook(__FILE__,'jtg_on_deactivation');
// Activate Phone Home
register_activation_hook( __FILE__, 'jtg_schedule_phone_home' );
// Deactivate Phone Home
register_deactivation_hook(__FILE__,'jtg_unschedule_phone_home');


///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Add Role / User Redirections / Remove Admin Bar
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function jtg_add_role_activation() {
   $result = add_role(
	    'property_user',
	    __( 'Property Searcher' ),
	    array(
	        'read'         => true,
	        'edit_posts'   => true,
	        'delete_posts' => true,
	    )
	);
	}
register_activation_hook( __FILE__, 'jtg_add_role_activation' );
function jtg_redirect_user_login(){
	if( is_admin() && !defined('DOING_AJAX') && ( current_user_can('property_user') ) ){
		show_admin_bar(false);
		wp_redirect(home_url().'/properties');
		exit;
	}
}
add_action('init','jtg_redirect_user_login');
add_action('after_setup_theme', 'jtg_remove_admin_bar');
function jtg_remove_admin_bar() {
	if (current_user_can('property_user')) {
	  show_admin_bar(false);
	}
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Enable Taxonomy + Property Admin Page
///////////////////////////////////////////////////////////////////////////////////////////////////////////	
$options = get_option('pm_importer_options');
if ($options['allow_tax'] === 'true') {
	require_once 'includes/importer/taxonomies.php';
	require_once 'includes/importer/admin_properties.php';
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Setup Importer Settings
///////////////////////////////////////////////////////////////////////////////////////////////////////////
require_once 'includes/importer/connectors.php';
require_once 'includes/importer/database.php';
require_once 'includes/importer/begin_process.php';
require_once 'includes/importer/process_properties.php';
require_once 'includes/importer/setup_import_meta.php';
require_once 'includes/importer/auto_sync.php';
require_once 'includes/importer/compatibility/lava_real_estate.php';
require_once 'includes/counties_areas_setup.php';
require_once 'includes/importer/auto_draft.php';


///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Connect to Property Drive - Analytical Data Sharing
///////////////////////////////////////////////////////////////////////////////////////////////////////////
require_once 'includes/phone_home.php';


///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Build Admin Area
///////////////////////////////////////////////////////////////////////////////////////////////////////////
require_once 'includes/admin/build_admin_page.php';
require_once 'includes/admin/admin_ajax.php';


///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Helper Functions
///////////////////////////////////////////////////////////////////////////////////////////////////////////
require_once 'includes/helpers.php';
require_once 'includes/ajax_search.php';


///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Shortcodes + Styles
///////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($options['allow_styling'] === 'true') {
	// Pages & Snippets
	require_once 'includes/register_templates.php';
	require_once 'includes/page_styling.php';
	require_once 'includes/inline_styling.php';
	require_once 'includes/property_search.php';

	// Shortcodes
	require_once 'shortcodes/search_type_1.php';
	require_once 'shortcodes/search_type_2.php';
	require_once 'shortcodes/search_type_3.php';
	require_once 'shortcodes/search_type_4.php';
	require_once 'shortcodes/residential_otw.php';
	require_once 'shortcodes/commercial_otw.php';
	require_once 'shortcodes/property_grid.php';
	require_once 'shortcodes/sold_properties.php';
    require_once 'shortcodes/simple_map.php';
    require_once 'shortcodes/half_map_search.php';
    require_once 'templates/local_info.php';
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Property Drive Pro File + Security Checks
///////////////////////////////////////////////////////////////////////////////////////////////////////////
$pro_features_dir = plugin_dir_path( __DIR__ ).'property_drive_pro';
if ($pro_files = glob($pro_features_dir . "/*")) {
	require_once $pro_features_dir.'/property_drive_pro.php';
	if ( get_option( 'property_drive_pro' ) !== false ) {
	    update_option( 'property_drive_pro', 'true' );
	} else {
	    $deprecated = null;
	    $autoload = 'no';
	    add_option( 'property_drive_pro', 'true', $deprecated, $autoload );
	}
} else {
	if ( get_option( 'property_drive_pro' ) !== false ) {
	    update_option( 'property_drive_pro', 'false' );
	} else {
	    $deprecated = null;
	    $autoload = 'no';
	    add_option( 'property_drive_pro', 'false', $deprecated, $autoload );
	}
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Add Admin Color Picker
///////////////////////////////////////////////////////////////////////////////////////////////////////////
wp_enqueue_style( 'wp-color-picker' );
wp_enqueue_script( 'wp-color-picker-alpha', plugins_url( '/assets/js/wp-color-picker-alpha.min.js',  __FILE__ ), array( 'wp-color-picker' ), '1.0.0', true );


///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Admin Pointers
///////////////////////////////////////////////////////////////////////////////////////////////////////////

add_action( 'admin_enqueue_scripts', 'my_admin_enqueue_scripts' );
function my_admin_enqueue_scripts() {
    // Using Pointers
    wp_enqueue_style( 'wp-pointer' );
    wp_enqueue_script( 'wp-pointer' );

    // Register our action
    $allow_tracking = get_option('jtg_allow_tracking');
    if (!$allow_tracking)
    	add_action( 'admin_print_footer_scripts', 'my_admin_print_footer_scripts' );
}


function my_admin_print_footer_scripts() {
    $pointer_content = '<h3>Property Drive Compatibility</h3>';
    $pointer_content .= '<p>To ensure theme & plugin compatibility this plugin needs to collect technical data once a week & send it to Property Drive. This will not impact performance.<br><a href="https://propertydrive.io/plugin-data-tracking" target="_blank">Find out more</p>';
    $pointer_content .= '<div class="jtg-pointer-btn-wrap" style="text-align: right;" id="jtg-pointers"><a href="#jtg-disallow-tracking" id="jtg-disallow-tracking" class="button-secondary" style="margin-right: 7.5px;">No Thanks</a><a id="jtg-allow-tracking" href="#jtg-allow-tracking" class="button-primary" style="margin-right: 15px;">Send Technical Data</a></div>';

?>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready( function($) {
    $('#wpadminbar').pointer({
        content: '<?php echo $pointer_content; ?>',
        position: {
            edge: 'top',
            align: 'middle'
        }
    }).pointer('open');
    $('.wp-pointer-buttons > a').hide();

     $('#jtg-allow-tracking').on( 'click', function(){


        var postData = {
            action: 'jtg_run_allow_tracking',
        }

        //Ajax load more posts
        $.ajax({
            type: "POST",
            data: postData,
            dataType:"json",
            url: ajaxurl, 
            //This fires when the ajax 'comes back' and it is valid json
            success: function (response) {
            	console.log(response);
            	$('#wp-pointer-0').fadeOut();

            }
            //This fires when the ajax 'comes back' and it isn't valid json
        }).fail(function (response) {
            console.log(response);
            $('#wp-pointer-0').fadeOut();
        }); 

    })

     $('#jtg-disallow-tracking').on( 'click', function(){


        var postData = {
            action: 'jtg_run_disallow_tracking',
        }

        //Ajax load more posts
        $.ajax({
            type: "POST",
            data: postData,
            dataType:"json",
            url: ajaxurl, 
            //This fires when the ajax 'comes back' and it is valid json
            success: function (response) {
            	console.log(response);
            	$('#wp-pointer-0').fadeOut();

            }
            //This fires when the ajax 'comes back' and it isn't valid json
        }).fail(function (response) {
            console.log(response);
            $('#wp-pointer-0').fadeOut();
        }); 

    })
});
//]]>
</script>
<?php
}


function jtg_run_allow_tracking_request(){
	if (current_user_can('manage_options')) {
		update_option('jtg_allow_tracking', 'true');
		jtg_send_tracking_data();
		return 'Tracking enabled!';
	} else {
		return wp_send_json_error('Ooops, looks like something went wrong, please contact support.');
	}
    //Make sure you die when finished doing ajax output.
    die(); 
}
add_action( 'wp_ajax_' . 'jtg_run_allow_tracking', 'jtg_run_allow_tracking_request' );



function jtg_run_disallow_tracking_request(){
	if (current_user_can('manage_options')) {
		update_option('jtg_allow_tracking', 'false');
		return 'Tracking Disabled!';
	} else {
		return wp_send_json_error('Ooops, looks like something went wrong, please contact support.');
	}
    //Make sure you die when finished doing ajax output.
    die(); 
}
add_action( 'wp_ajax_' . 'jtg_run_disallow_tracking', 'jtg_run_disallow_tracking_request' );
