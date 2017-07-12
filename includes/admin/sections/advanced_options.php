<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Advanced Options Section
///////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<div class="jtg-admin-section-header">
	<h2>Advanced Property Drive Options</h2>
</div>
<div class="jtg-row jtg-clearfix">
	<button class="jtg-delete-all-btn" id="jtg-delete-all-btn">Delete All Properties</button>
</div>
<?php 
$options = get_option('pm_importer_options');
?>
<div class="jtg-row jtg-clearfix">
	<h4>Allow Taxonomy</h4>
	<label class="jtg-admin-switch">
		<input id="jtg_allow_tax_switch" type="checkbox" name="allow_tax" value="1" <?php checked('true', $options['allow_tax']); ?> />
		<div class="jtg-admin-slider jtg-admin-round"></div>
	</label>
	<h4>Allow Styling</h4>
	<label class="jtg-admin-switch">
		<input id="jtg_allow_styles_switch" type="checkbox" name="allow_styling" value="1" <?php checked('true', $options['allow_styling']); ?> />
		<div class="jtg-admin-slider jtg-admin-round"></div>
	</label>
</div>