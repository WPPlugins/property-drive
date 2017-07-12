<?php
function jtg_connector_property_drive()
{
	$options = get_option('pm_importer_options');

    $api_key = $options['pd_api_key'];
	$url = 'http://api2.4pm.ie/api/property/json?Key='.$api_key;
        try {
        	$listingsArray = json_decode(file_get_contents($url));
        	// $listingsArray = json_decode($json, true);
        	// foreach ($json as $property) {
        	// 	print_r($property->Id."\n");
        	// }

        	return $listingsArray;

        	// return $listingsArray;
        } catch (Exception $e) {
        	echo 'Whoops, looks like something ain\'t quite right. Have you put your API Key in right?';
        }
}