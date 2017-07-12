<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Search Settings Section
///////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<div class="jtg-admin-section-header">
	<h2>Search Settings</h2>
</div>
<div class="jtg-admin-notice-light">
	<p>Search is the most important part of your website, we are expanding and refining the search, sort and results capabilities daily.</p>
	<p>You can use different search types in different places using the shortcodes provided, if you change the type here, it will affect the Properties Results Page and the Single Property Page, <b>not the shortcodes</b>.</p>
</div>
<div class="jtg-row jtg-clearfix">
	<div class="jtg-col-1-2">
		<?php
		$options = get_option('pm_search_options');
		?>
		<p><b>Search Type</b></p>
		<select id="jtg-search-type" name="search_type">
			<option disabled>Select Layout</option>
			<option value="1" <?php if ( $options['search_type'] == '1' ) echo 'selected="selected"'; ?>>Type 1</option>
			<option value="2" <?php if ( $options['search_type'] == '2' ) echo 'selected="selected"'; ?>>Type 2</option>
			<option value="3" <?php if ( $options['search_type'] == '3' ) echo 'selected="selected"'; ?>>Type 3</option>
			<option value="4" <?php if ( $options['search_type'] == '4' ) echo 'selected="selected"'; ?>>Type 4</option>
		</select>
		<p><b>Padding Above</b></p>
		<input id="search_space_above" name="search_space_above" type="number" value="<?php echo $options['search_space_above'] ?>" />px
		<p><i>Default - 50px</i></p>
		<p><b>Padding Below</b></p>
		<input id="search_space_below" name="search_space_below" type="number" value="<?php echo $options['search_space_below'] ?>" />px
		<p><i>Default - 50px</i></p>
		<p>Group Property Types into Commercial / Residential</p>
		<label class="jtg-admin-switch">
			<input id="jtg_search_grouping" type="checkbox" name="search_grouping" value="1" <?php checked('true', $options['search_grouping']); ?> />
			<div class="jtg-admin-slider jtg-admin-round"></div>
		</label>
	</div>
	<div class="jtg-col-1-2">
		<p><b>Background Color</b></p>
		<input id="jtg_search_back_color" class="color-picker" data-alpha="true" name="search_background_color" type="text" value="<?php echo $options['search_background_color'] ?>" />
		<p><b>Search Button Background</b></p>
		<input id="jtg_search_btn_back" class="color-picker" data-alpha="true"  name="search_btn_color" type="text" value="<?php echo $options['search_btn_color'] ?>" />
		<p><b>Search Button Hover Background</b></p>
		<p><input id="jtg_search_btn_hover_back" class="color-picker" data-alpha="true" name="search_btn_hover_color" type="text" value="<?php echo $options['search_btn_hover_color'] ?>" /></p>
		<p><b>Search Button Text Color</b></p>
		<p><input id="jtg_search_btn_text_color" class="color-picker" data-alpha="true" name="search_btn_text_color" type="text" value="<?php echo $options['search_btn_text_color'] ?>" /></p>
		<p><b>Search Button Hover Text Color</b></p>
		<p><input id="jtg_search_btn_hover_text_color" class="color-picker" data-alpha="true" name="search_btn_hover_text_color" type="text" value="<?php echo $options['search_btn_hover_text_color'] ?>" /></p>
		<p><b>Price Slider Bar Color</b></p>
		<input id="jtg_price_bar_color" class="color-picker" data-alpha="true" name="price_slider_bar" type="text" value="<?php echo $options['price_slider_bar'] ?>" />
	</div>
</div>

<div class="jtg-row jtg-clearfix">
	<div class="jtg-col-1-2">
		<select id="slider_dropdown">
			<option value="slider" <?php if ( $options['slider_dropdown'] == 'slider' ) echo 'selected="selected"'; ?>>Price Slider</option>
			<option value="dropdown" <?php if ( $options['slider_dropdown'] == 'dropdown' ) echo 'selected="selected"'; ?>>Dropdown Menus</option>
		</select>
	</div>
	<div class="jtg-col-1-2">

	</div>

</div>