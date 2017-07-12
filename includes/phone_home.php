<?php 
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Schedule Analytical Callback Home - propertydrive.io
///////////////////////////////////////////////////////////////////////////////////////////////////////////

function jtg_custom_tracking_schedules($schedules){
    if(!isset($schedules["5min"])){
        $schedules["5min"] = array(
            'interval' => 5*60,
            'display' => __('Once every 5 minutes'));
    }
    if(!isset($schedules["30min"])){
        $schedules["30min"] = array(
            'interval' => 30*60,
            'display' => __('Once every 30 minutes'));
    }
    return $schedules;
}
add_filter('cron_schedules','jtg_custom_tracking_schedules');

function jtg_phone_home() {  

// Check if User has allowed tracking here
$tracking = get_option('jtg_allow_tracking', true);

	if ($tracking == 'true') {
		jtg_send_tracking_data();
	}

}
add_action('jtg_run_phone_home','jtg_phone_home');



function jtg_schedule_phone_home() {
    if (! wp_next_scheduled ( 'jtg_run_phone_home' )) {
      wp_schedule_event(time(), 'daily', 'jtg_run_phone_home');
    }
}

function jtg_unschedule_phone_home() {
    // Unset schedule
    wp_clear_scheduled_hook('jtg_run_phone_home');
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Connect to Property Drive - Analytical Data Sharing (only functions if allowed)
///////////////////////////////////////////////////////////////////////////////////////////////////////////

function jtg_send_tracking_data() {
	// Grab Data
	$site_info = array(
		'url' => site_url(),
		'name' => get_bloginfo( 'name' ),
		'version' => get_bloginfo( 'version' ),
		'multisite' => is_multisite(),
		'users' => count( get_users() ),
		'lang' => get_locale(),
	);

	$data_to_send = array(
			'site_info' => $site_info
		);

	// Turn the Array in to JSON
	$data_to_send = json_encode($data_to_send);

	// Send it to tracking.propertydrive.io

	$url = 'https://tracking.xaylo.com/api/answer-the-phone';
	$send_data = 'url='.site_url().'&site_name='.get_bloginfo('name').'&wordpress_version='.get_bloginfo('version').'&multisite_enabled='.is_multisite().'&users_count='.count(get_users()).'&site_language='.get_locale().'&admin_email='.get_bloginfo('admin_email').'&text_direction='.get_bloginfo('text_direction');

	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_POST, 1);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $send_data);
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $ch, CURLOPT_HEADER, 0);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

	$response = curl_exec( $ch );

	echo $response;

	die();



}
add_action( 'wp_ajax_' . 'jtg_run_send_tracking_data', 'jtg_send_tracking_data' );