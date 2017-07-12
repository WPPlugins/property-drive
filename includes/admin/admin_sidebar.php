<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Admin Area Navigation Sidebar
///////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<div class="jtg-admin-nav">
	<div class="jtg-admin-nav-item">
		<a id="jtg-default-open" class="jtgmenulink" onclick="jtg_open_content(event, 'jtg-welcome-section')">Property Drive</a>
	</div>
	<div class="jtg-admin-nav-item">
		<a class="jtgmenulink" onclick="jtg_open_content(event, 'jtg-agency-options')">Agency Details</a>
	</div>
	<div class="jtg-admin-nav-item">
		<a class="jtgmenulink" onclick="jtg_open_content(event, 'jtg-general-options')">General Options</a>
	</div>
	<hr style="color: #fff; margin-left: 10px;" width="50%" align="left">
	<div class="jtg-admin-nav-item">
		<a class="jtgmenulink" onclick="jtg_open_content(event, 'jtg-property-cards')">Property Cards</a>
	</div>
	<div class="jtg-admin-nav-item">
		<a class="jtgmenulink" onclick="jtg_open_content(event, 'jtg-search-options')">Search Options</a>
	</div>
	<div class="jtg-admin-nav-item">
		<a class="jtgmenulink" onclick="jtg_open_content(event, 'jtg-single-property-options')">Property Page</a>
	</div>
	<hr style="color: #fff; margin-left: 10px;" width="50%" align="left">
	<div class="jtg-admin-nav-item">
		<a class="jtgmenulink" onclick="jtg_open_content(event, 'jtg-shortcode-options')">Shortcode Options</a>
	</div>
	<div class="jtg-admin-nav-item">
		<a class="jtgmenulink" onclick="jtg_open_content(event, 'jtg-shortcode-guide')">Shortcode Guide</a>
	</div>
	<hr style="color: #fff; margin-left: 10px;" width="50%" align="left">
	<div class="jtg-admin-nav-item">
		<a class="jtgmenulink" onclick="jtg_open_content(event, 'jtg-importer-settings')">Importer Settings</a>
	</div>
	<?php 
	$pro_version_enabled = get_option('property_drive_pro');
	if ($pro_version_enabled == 'true') {
		jtg_pro_sidebar();
	}
	?>
	<hr style="color: #fff; margin-left: 10px;" width="50%" align="left">
	<div class="jtg-admin-nav-item">
		<a class="jtgmenulink" href="https://wordpress.org/support/plugin/property-drive" target="_blank">Help</a>
	</div>
	<div class="jtg-admin-nav-item">
		<a id="open-logs" class="jtgmenulink" onclick="jtg_open_content(event, 'jtg-logs-section')">Logs</a>
	</div>
	<hr style="color: #fff; margin-left: 10px;" width="50%" align="left">
	<div class="jtg-admin-nav-item">
		<a  class="jtgmenulink" onclick="jtg_open_content(event, 'jtg-advanced-options')">Advanced Options</a>
	</div>
</div>