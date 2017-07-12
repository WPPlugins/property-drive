<?php 
	$options = get_option('pm_design_options');
?>
<div class="jtg-admin-section-header">
	<h2>Single Property Page</h2>
</div>
<div class="jtg-row jtg-clearfix">
	<div class="jtg-col-1-1">
		<h4>Property Page Style</h4>
		<select id="jtg_single_page_template">
			<option value="1" <?php if ( $options['jtg_single_page_template'] == '1' ) echo 'selected="selected"'; ?>>Template 1</option>
			<option value="2" <?php if ( $options['jtg_single_page_template'] == '2' ) echo 'selected="selected"'; ?>>Template 2</option>
		</select>
	</div>
</div>
<div class="jtg-row jtg-clearfix">
	<div class="jtg-col-1-1">

		<div style="overflow-x:auto;">
			<table>
				<tr>
					<th>Show Type</th>
					<th>Show Status</th>
					<th>Show Price</th>
					<th>Show BER</th>
					<th>Show Area</th>
					<th>Show Beds</th>
				</tr>
				<tr>
					<td>
						<label class="jtg-admin-switch">
							<input id="jtg_design_show_type" type="checkbox" name="header_show_type" value="1" <?php checked('true', $options['header_show_type']); ?> />
							<div class="jtg-admin-slider jtg-admin-round"></div>
						</label>
					</td>

					<td>
						<label class="jtg-admin-switch">
							<input id="jtg_design_show_status" type="checkbox" name="header_show_status" value="1" <?php checked('true', $options['header_show_status']); ?> />
							<div class="jtg-admin-slider jtg-admin-round"></div>
						</label>
					</td>

					<td>
						<label class="jtg-admin-switch">
							<input id="jtg_design_show_price" type="checkbox" name="header_show_price" value="1" <?php checked('true', $options['header_show_price']); ?> />
							<div class="jtg-admin-slider jtg-admin-round"></div>
						</label>
					</td>

					<td>
						<label class="jtg-admin-switch">
							<input id="jtg_design_show_ber" type="checkbox" name="header_show_ber" value="1" <?php checked('true', $options['header_show_ber']); ?> />
							<div class="jtg-admin-slider jtg-admin-round"></div>
						</label>
					</td>

					<td>
						<label class="jtg-admin-switch">
							<input id="jtg_design_show_area" type="checkbox" name="header_show_area" value="1" <?php checked('true', $options['header_show_area']); ?> />
							<div class="jtg-admin-slider jtg-admin-round"></div>
						</label>
					</td>

					<td>
						<label class="jtg-admin-switch">
							<input id="jtg_design_show_beds" type="checkbox" name="header_show_beds" value="1" <?php checked('true', $options['header_show_beds']); ?> />
							<div class="jtg-admin-slider jtg-admin-round"></div>
						</label>
					</td>
				</tr>
			</table>
		</div>
		<div class="jtg-admin-hr"></div>
		<div>
		<p><b>Auto Play Slider</b></p>
			<label class="jtg-admin-switch">
							<input id="jtg_slider_auto_play" type="checkbox" name="slider_auto_play" value="1" <?php checked('true', $options['slider_auto_play']); ?> />
							<div class="jtg-admin-slider jtg-admin-round"></div>
						</label>
		</div>
		<div>
			<p>Single Property Page Padding</p>
			<input type="text" id="jtg_single_container_padding" name="single_container_padding" value="<?php echo $options['single_container_padding']; ?>">
			<i>Default 100px</i>
		</div>
		<div>
		<p><b>Show Side Bar</b></p>
			<label class="jtg-admin-switch">
							<input id="jtg_show_sidebar" type="checkbox" name="show_sidebar" value="1" <?php checked('true', $options['show_sidebar']); ?> />
							<div class="jtg-admin-slider jtg-admin-round"></div>
						</label>
		</div>

		<div>
			<p>Single Property Page Distance From Top</p>
			<input type="text" id="jtg_single_page_margin_top" name="single_page_margin_top" value="<?php echo $options['single_page_margin_top']; ?>">
			<i>Default 0px</i>
		</div>
	</div>
</div>