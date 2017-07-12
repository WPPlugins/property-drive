<?php 
$options = get_option('pm_importer_options');
?>
<div class="jtg-admin-section-header">
			<h2>Importer Settings</h2>
		</div>

<div class="jtg-row jtg-clearfix">

<div style="overflow-x:auto;">
			<table>
			<tr>
				<th>Auto Sync</th>
				<th>Allow Taxonomies</th>
				<th>Allow Styling</th>
			</tr>
			<tr>
				<td>
					<label class="jtg-admin-switch">
							<input id="jtg_auto_sync_switch" type="checkbox" name="auto_sync" value="1" <?php checked('true', $options['auto_sync']); ?> />
							<div class="jtg-admin-slider jtg-admin-round"></div>
						</label>
				</td>
				<td>
					<label class="jtg-admin-switch">
							<input id="jtg_allow_tax_switch" type="checkbox" name="allow_tax" value="1" <?php checked('true', $options['allow_tax']); ?> />
							<div class="jtg-admin-slider jtg-admin-round"></div>
						</label>
				</td>
				<td>
					<label class="jtg-admin-switch">
							<input id="jtg_allow_styles_switch" type="checkbox" name="allow_styling" value="1" <?php checked('true', $options['allow_styling']); ?> />
							<div class="jtg-admin-slider jtg-admin-round"></div>
						</label>
				</td>
			</tr>
			</table>
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
 		<button class="jtg-delete-all-btn" id="jtg-delete-all-btn">Delete All Properties</button>
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

 <div class="jtg-row jtg-clearfix">
 	<div class="jtg-col-1-2">
	<h4>Currency</h4>
 	<?php $options = get_option('pm_importer_options') ?>
 		<select name="jtg_currency" id="jtg_currency">
 			<option value="euro" <?php if ( $options['jtg_currency'] == 'euro' ) echo 'selected="selected"'; ?>>Euro</option>
 			<option value="gbp" <?php if ( $options['jtg_currency'] == 'gbp' ) echo 'selected="selected"'; ?>>Pound Sterling</option>
 			<option value="usd" <?php if ( $options['jtg_currency'] == 'usd' ) echo 'selected="selected"'; ?>>US Dollar</option>
 		</select>
 	</div>
 </div>

  <div class="jtg-row jtg-clearfix">
 	<div class="jtg-col-1-2">
 	<h4>Theme Compatability</h4>
 	<?php $options = get_option('pm_importer_options') ?>
 		<select name="jtg_theme_compatibility" id="jtg_theme_compatibility">
 			<option value="none" <?php if ( $options['jtg_theme_compatibility'] == 'none' ) echo 'selected="selected"'; ?>>No Compatibility</option>
 			<option value="wp-residence" <?php if ( $options['jtg_theme_compatibility'] == 'wp-residence' ) echo 'selected="selected"'; ?>>WP Residence v1.20.2</option>
 			<option value="lava-real-estate" <?php if ( $options['jtg_theme_compatibility'] == 'lava-real-estate' ) echo 'selected="selected"'; ?>>Lava Real Estate Manager</option>
 		</select>
 	</div>

 	<div class="jtg-col-1-2">
 	<h4>Email Alert Frequency</h4>
 	<?php $options = get_option('pm_importer_options') ?>
 		<select name="jtg_email_alert_frequency" id="jtg_email_alert_frequency">
 			<option value="daily" <?php if ( $options['jtg_email_alert_frequency'] == 'daily' ) echo 'selected="selected"'; ?>>Daily</option>
 			<option value="weekly" <?php if ( $options['jtg_email_alert_frequency'] == 'weekly' ) echo 'selected="selected"'; ?>>Weekly</option>
 			<option value="bi-weekly" <?php if ( $options['jtg_email_alert_frequency'] == 'bi-weekly' ) echo 'selected="selected"'; ?>>Bi-Weekly</option>
 		</select>
 	</div>
 </div>