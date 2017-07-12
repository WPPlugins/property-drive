<div class="jtg-admin-section-header">
	<h2>Main Design Options</h2>
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
<div class="jtg-admin-section-header">
		<h2>Property Grid Shortcode</h2>
</div>
		<p><b>Show Title</b></p>
		<label class="jtg-admin-switch">
			<input id="jtg_shortcode_title_show" type="checkbox" name="featured_title" value="1" <?php checked('true', $options['featured_title']); ?> />
			<div class="jtg-admin-slider jtg-admin-round"></div>
		</label>


		<p><b>Title Background Color</b></p>
		<input id="jtg_shortcode_title_back" type="text" class="color-picker" data-alpha="true" data-default-color="" name="featured_title_background" value="<?php echo $options['featured_title_background']; ?>"/>

		<p><b>Title Text Color</b></p>
		<input id="jtg_shortcode_title_text" type="text" class="color-picker" data-alpha="true" data-default-color="" name="featured_title_color" value="<?php echo $options['featured_title_color']; ?>"/>

		<p><b>Title Text</b></p>
		<input id="jtg_property_grid_title" name="property_grid_title" type="text" value="<?php echo $options['property_grid_title']; ?>">


		<p><b>Show View More Button</b></p>
		<label class="jtg-admin-switch">
			<input id="jtg_show_view_more" type="checkbox" name="show_view_more" value="1" <?php checked('true', $options['show_view_more']); ?> />
			<div class="jtg-admin-slider jtg-admin-round"></div>
		</label>

</div>
