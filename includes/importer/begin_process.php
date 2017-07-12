<?php
function jtg_process_import()
{
	try
	{
		// Get dates and path to open log file
		$url = plugin_dir_path(dirname(__DIR__)).'includes/importer/';
		$today_ddmmyyyy = date("d-m-y");
		$today_yyyymmddhhiiss = date("d-m-y");
		
    	$log = fopen( $url . "logs/log-".$today_ddmmyyyy . ".txt", "a");
        fwrite($log, "=== LOG ENTRY : " . date('Y-m-d H:i:s') . " Property Drive ===\n");
	}
	catch(Exception $e)
	{
		printf($e->getMessage());
	}
    /********
		Get properties stream from Property Drive
		We fetch the propeties feed with this call located in connectors.php
    ********/
	$inbound_feed = jtg_connector_property_drive();


	// Grab a count of the properties to write into the log
	if ($msg = count($inbound_feed))
	{
		// Write to the lod the amount of properties fetched
        fwrite($log, "Number of properties synced - $msg \n");
    }


    /********
		This is where the properties actually get processed
		We have gottent he feed above with our fetch, we through them through this call to process them.
		Comparison and all hanfling of the feed is done from there.
    ********/
	jtg_import_property_drive($inbound_feed, $log);



	// Check for duplicates and remove them
	jtg_check_duplicates($inbound_feed, $log);

	// Lava Real Estate JSON Cache Generation
	$importer_options = get_option('pm_importer_options');
	// Check if theme compatibility has been turned on
	$compatibility = $importer_options['jtg_theme_compatibility'];
	if ($compatibility == 'wp-residence') {
		jtg_lava_real_estate_json_cache();
	}

	
	// Close log file
    fwrite($log, "=== END OF LOG ENTRY ===\n\n");
    fclose($log);
    
    return $msg;
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Check for duplicates
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function jtg_check_duplicates($properties, $log){
	global $wpdb;
	foreach ($properties as $property) {
		$in_db = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key = 'importer_id' AND meta_value = $property->Id", ARRAY_A);

		foreach ($in_db as $key => $value) {
			if ($key >= 1) {
				jtg_delete_property($value['post_id']);
				fwrite($log, '**** '.$value['post_id']." = Removed Duplicate \n\n");
			}
		}
	}
}


































