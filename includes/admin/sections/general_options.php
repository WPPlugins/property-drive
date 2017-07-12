<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  General Options Section
///////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<div class="jtg-admin-section-header">
	<h2>Main Design Options</h2>
</div>
<div class="jtg-admin-notice-light">
	<p>These are the base settings and options for Property Drive. If you have a theme that already handles properties for you, you can select compatibility here. If you need to turn off control of the styles or taxonomy individually, see the Advanced Options section.</p>
</div>
<div class="jtg-row jtg-clearfix">
	<?php 
	$options = get_option('pm_design_options');
	?>
	<div class="jtg-col-1-2">
		<p>Base Color</p>
		<input id="jtg_main_plugin_color" type="text" class="color-picker" data-alpha="true" data-default-color="" name="base_colour" value="<?php echo $options['base_colour']; ?>"/>
	</div>
	<div class="jtg-col-1-2">
		<p>Secondary Color</p>
		<input id="jtg_secondary_plugin_color" type="text" class="color-picker" data-alpha="true" data-default-color="" name="secondary_colour" value="<?php echo $options['secondary_colour']; ?>"/>
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

<div class="jtg-row jtg-clearfix">
<div class="jtg-col-1-2">
	<?php $options = get_option('pm_design_options'); ?>
	<p>Page Margin Top - Generally the height of your header + 15px</p>
	<input id="pd_page_margin_top" name="pd_page_margin_top" type="text" placeholder="150" value='<?php echo $options["pd_page_margin_top"]; ?>' />px
</div>

<div class="jtg-col-1-2">
	<h4>Auto Select County</h4>
		<?php $options = get_option('pm_importer_options') ?>
		<select name="jtg_auto_select_county" id="jtg_auto_select_county">
		<option value="no-auto-select" <?php if ( $options['jtg_auto_select_county'] == 'no-auto-select' ) echo 'selected="selected"'; ?>>No Auto Select</option>
		<option value="Co. Dublin" <?php if ( $options['jtg_auto_select_county'] == 'Co. Dublin' ) echo 'selected="selected"'; ?>>Co. Dublin</option>
		<option value="Co. Meath" <?php if ( $options['jtg_auto_select_county'] == 'Co. Meath' ) echo 'selected="selected"'; ?>>Co. Meath</option>
		<option value="Co. Kildare" <?php if ( $options['jtg_auto_select_county'] == 'Co. Kildare' ) echo 'selected="selected"'; ?>>Co. Kildare</option>
		<option value="Co. Wicklow" <?php if ( $options['jtg_auto_select_county'] == 'Co. Wicklow' ) echo 'selected="selected"'; ?>>Co. Wicklow</option>
		<option value="Co. Longford" <?php if ( $options['jtg_auto_select_county'] == 'Co. Longford' ) echo 'selected="selected"'; ?>>Co. Longford</option>
		<option value="Co. Offaly" <?php if ( $options['jtg_auto_select_county'] == 'Co. Offaly' ) echo 'selected="selected"'; ?>>Co. Offaly</option>
		<option value="Co. Westmeath" <?php if ( $options['jtg_auto_select_county'] == 'Co. Westmeath' ) echo 'selected="selected"'; ?>>Co. Westmeath</option>
		<option value="Co. Laois" <?php if ( $options['jtg_auto_select_county'] == 'Co. Laois' ) echo 'selected="selected"'; ?>>Co. Laois</option>
		<option value="Co. Louth" <?php if ( $options['jtg_auto_select_county'] == 'Co. Louth' ) echo 'selected="selected"'; ?>>Co. Louth</option>
		<option value="Co. Carlow" <?php if ( $options['jtg_auto_select_county'] == 'Co. Carlow' ) echo 'selected="selected"'; ?>>Co. Carlow</option>
		<option value="Co. Kilkenny" <?php if ( $options['jtg_auto_select_county'] == 'Co. Kilkenny' ) echo 'selected="selected"'; ?>>Co. Kilkenny</option>
		<option value="Co. Waterford" <?php if ( $options['jtg_auto_select_county'] == 'Co. Waterford' ) echo 'selected="selected"'; ?>>Co. Waterford</option>
		<option value="Co. Wexford" <?php if ( $options['jtg_auto_select_county'] == 'Co. Wexford' ) echo 'selected="selected"'; ?>>Co. Wexford</option>
		<option value="Co. Kerry" <?php if ( $options['jtg_auto_select_county'] == 'Co. Kerry' ) echo 'selected="selected"'; ?>>Co. Kerry</option>
		<option value="Co. Cork" <?php if ( $options['jtg_auto_select_county'] == 'Co. Cork' ) echo 'selected="selected"'; ?>>Co. Cork</option>
		<option value="Co. Clare" <?php if ( $options['jtg_auto_select_county'] == 'Co. Clare' ) echo 'selected="selected"'; ?>>Co. Clare</option>
		<option value="Co. Limerick" <?php if ( $options['jtg_auto_select_county'] == 'Co. Limerick' ) echo 'selected="selected"'; ?>>Co. Limerick</option>
		<option value="Co. Tipperary" <?php if ( $options['jtg_auto_select_county'] == 'Co. Tipperary' ) echo 'selected="selected"'; ?>>Co. Tipperary</option>
		<option value="Co. Galway" <?php if ( $options['jtg_auto_select_county'] == 'Co. Galway' ) echo 'selected="selected"'; ?>>Co. Galway</option>
		<option value="Co. Mayo" <?php if ( $options['jtg_auto_select_county'] == 'Co. Mayo' ) echo 'selected="selected"'; ?>>Co. Mayo</option>
		<option value="Co. Roscommon" <?php if ( $options['jtg_auto_select_county'] == 'Co. Roscommon' ) echo 'selected="selected"'; ?>>Co. Roscommon</option>
		<option value="Co. Sligo" <?php if ( $options['jtg_auto_select_county'] == 'Co. Sligo' ) echo 'selected="selected"'; ?>>Co. Sligo</option>
		<option value="Co. Leitrim" <?php if ( $options['jtg_auto_select_county'] == 'Co. Leitrim' ) echo 'selected="selected"'; ?>>Co. Leitrim</option>
		<option value="Co. Donegal" <?php if ( $options['jtg_auto_select_county'] == 'Co. Donegal' ) echo 'selected="selected"'; ?>>Co. Donegal</option>
		<option value="Co. Cavan" <?php if ( $options['jtg_auto_select_county'] == 'Co. Cavan' ) echo 'selected="selected"'; ?>>Co. Cavan</option>
		<option value="Co. Monaghan" <?php if ( $options['jtg_auto_select_county'] == 'Co. Monaghan' ) echo 'selected="selected"'; ?>>Co. Monaghan</option>
		</select>
</div>
</div>