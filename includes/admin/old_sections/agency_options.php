<div class="jtg-admin-section-header">
	<h2>Agency Details</h2>
</div>
<div class="jtg-row jtg-clearfix">
	<div class="jtg-admin-notice-light">
		<p>It is important to fill out this information as it is used on the Property Sidebar, if you have a feed being imported with agents listed, your Sidebar will automatically show those values, if they do not exist, this information is shown.</p>
		<p><i>The email address & Agency Name are also used to send system emails to users of your website. If you find your emails are not being sent, this is usually down to the PHP Mail setings on your webserver. We recommend installing <a target="_blank" href="https://wordpress.org/plugins/postman-smtp/">Postman SMTP</a>, this will enable you to connect your email service to your website.</i></p>
	</div>
</div>
<div class="jtg-row jtg-clearfix">
	<div class="jtg-col-1-2">
		<?php $options = get_option('pm_agency_options'); ?>
		<div class="jtg-admin-agency-fields">
			<label for="plugin_agency_name">Estate Agency Name</label>
			<input id='plugin_agency_name' type='text' name='agency_name' value='<?php echo stripslashes($options['agency_name']) ?>'>

			<label for="plugin_agency_email">Estate Agency Email Address</label>
			<input id='plugin_agency_email' type='text' name='agency_email' value='<?php echo $options['agency_email'] ?>'>
			
			<label for="plugin_agency_phone">Estate Agency Phone Number</label>
			<input id='plugin_agency_phone' type='text' name='agency_phone' value='<?php echo $options['agency_phone'] ?>'>
		</div>
	</div>
	<div class="jtg-col-1-2" style="text-align: center;">
		<div class="jtg-admin-logo">
			<?php

		$options = get_option('pm_agency_options');

		if ($options['agency_logo']) {
			$image_url = $options['agency_logo'];
			echo '<img src="'.$image_url.'" width="50%"><br><br>';
		} else {
			$image_url = plugin_dir_url(dirname(__DIR__)).'assets/images/no-image.jpg';
			echo '<img src="'.$image_url.'" width="50%"><br><br>';
		}

		global $wpdb;

		if ( !empty( $_POST['image'] ) ) {
			$image_url = $_POST['image']; 
		}

		wp_enqueue_media();
		?>
		

		<input id="pm-image-url" type="hidden" name="agency_logo" value="<?php echo $options['agency_logo']; ?>" />
		<input id="pm-upload-image-btn" type="button" class="jtg-logo-upload-btn" value="Upload Your Logo" />
		</div>
	</div>

</div>
<script>
	jQuery(document).ready(function($){

		var mediaUploader;

		$('#pm-upload-image-btn').click(function(e) {
			e.preventDefault();
// If the uploader object has already been created, reopen the dialog
if (mediaUploader) {
	mediaUploader.open();
	return;
}
// Extend the wp.media object
mediaUploader = wp.media.frames.file_frame = wp.media({
	title: 'Choose Image',
	button: {
		text: 'Choose Image'
	}, multiple: false });

// When a file is selected, grab the URL and set it as the text field's value
mediaUploader.on('select', function() {
	var attachment = mediaUploader.state().get('selection').first().toJSON();
	$('#pm-image-url').val(attachment.url);
});
// Open the uploader dialog
mediaUploader.open();
});

	});
</script>