<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Importer Options Section
///////////////////////////////////////////////////////////////////////////////////////////////////////////
$options = get_option('pm_importer_options');
?>
<div class="jtg-admin-section-header">
	<h2>Importer Settings</h2>
</div>
<div class="jtg-row jtg-clearfix">
	<div class="jtg-admin-notice-light">
		<p>You can Import your properties directly from the Property Drive platform on to your Wordpress website, to do this, add your Property Drive API Key below and select who you wish to import the properties as. </p>
		<p>You can turn auto sync on and select your schedule to run automatically, if this fails to run it could be that Cron Jobs have not been enabled on your webserver. Please contact your hosting company if that's the case.</p>
	</div>
</div>

<div class="jtg-row jtg-clearfix">
<div class="jtg-col-1-2">
	<p><b>Auto Sync</b></p>
	<label class="jtg-admin-switch">
		<input id="jtg_auto_sync_switch" type="checkbox" name="auto_sync" value="1" <?php checked('true', $options['auto_sync']); ?> />
		<div class="jtg-admin-slider jtg-admin-round"></div>
	</label>
</div>


<div class="jtg-col-1-2">
	<p><b>Auto Draft</b></p>
	<label class="jtg-admin-switch">
		<input id="pd_auto_draft_properties" type="checkbox" name="pd_auto_draft_properties" value="1" <?php checked('true', $options['pd_auto_draft_properties']); ?> />
		<div class="jtg-admin-slider jtg-admin-round"></div>
	</label>
	<p><i>Enabling this option will cause all new synced properties to take a draft status and will not be visible on the front end. You will be able to publish manually via an email link or in Wordpress itself.</i></p>
</div>

</div>


<div class="jtg-row jtg-clearfix">
	<div class="jtg-admin-hr"></div>
	<div class="jtg-col-1-2">
		<p><b>Property Drive API Key</b></p>
		<input id='jtg_api_key_field' type='text' name='jtg_pd_api' value="<?php echo $options['pd_api_key'] ?>" />
	</div>
	<div class="jtg-col-1-2">
		<p><b>Assign Properties to User</b></p>
		<?php 
		$user=get_user_by( 'id', $options['property_author']);
		if($user!=null){
			wp_dropdown_users(array('id' => 'jtg_properties_author', 'name' => 'author', 'selected' => $options['property_author']));
		}else{
			wp_dropdown_users(array('id' => 'jtg_properties_author', 'name' => 'author'));
		}
		?>
	</div>
</div>
<div class="jtg-row jtg-clearfix">
	<div class="jtg-col-1-2">
	</div>
	<div class="jtg-col-1-2">
		<?php $options = get_option('pm_importer_options') ?>
		<select name="jtg_importer_schedule" id="jtg_importer_schedule">
			<option value="5min" disabled <?php if ( $options['jtg_importer_schedule'] == '5min' ) echo 'selected="selected"'; ?>>Every 5 Minutes</option>
			<option value="30min" <?php if ( $options['jtg_importer_schedule'] == '30min' ) echo 'selected="selected"'; ?>>Every 30 Minutes</option>
			<option value="hourly" <?php if ( $options['jtg_importer_schedule'] == 'hourly' ) echo 'selected="selected"'; ?>>Every Hour</option>
		</select>
	</div>
</div>