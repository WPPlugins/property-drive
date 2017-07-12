<?php 

if ( !defined('ABSPATH') ) {
    //If wordpress isn't loaded load it up.
    $path = $_SERVER['DOCUMENT_ROOT'];
    include_once $path . '/wp-load.php';
}
 ?>
<div class="jtg-admin-section-header">
			<h2>Importer Logs</h2>
		</div>

<div class="jtg-row jtg-clearfix">
	<div class="jtg-col-1-1">
<b>
	<?php
	$log_file = plugin_dir_path(__DIR__).'importer/logs/log-'.date("d-m-y").'.txt';

	if (file_exists($log_file)) {
		$log_file = file($log_file,FILE_TEXT);
		$lines = array_reverse($log_file);
		// print_r($lines);
			$i=0;
			while(strpos($lines[$i], 'Number')===false){	
				$i++;
				if($i>50){
					break;	
				}
			}
			$count=substr($lines[$i],-4);
			$date=date("F j, Y g:i a", strtotime(substr($lines[$i+1],16,19)) );
			echo '<p>Updated on - '.$date.'<br>
			<b>'.$count.'</b> properties were updated.</p>';
		} else {
			$create_file = fopen(plugin_dir_path(__DIR__).'importer/logs/log-'.date("d-m-y").'.txt', 'w');
		}
?>
</b>
<pre style="background-color: #f5f5f5; padding: 15px;"><?php

$args = array(
	'numberposts' => 25,
	'post_type' => 'property',
	'post_status' => array(
					'publish',
					'draft'),
	'suppress_filters' => true
	);

$posts_array = get_posts( $args );
	foreach ( $posts_array as $post ){
		setup_postdata( $post );
		echo $post->post_title;
		echo "</br>";
		wp_reset_postdata();
	}

?>
</pre>

<b><p>Todays Log</p></b>
<pre style="background-color: #f5f5f5; padding: 15px;"><?php
	$log_file = plugin_dir_path(__DIR__).'importer/logs/log-'.date("d-m-y").'.txt';
if (file_exists($log_file)) {
	echo file_get_contents($log_file);
} else {
	echo 'No log file has been found!';
}

?>
</pre>

</div>
</div>