<div class="jtg-admin-section-header">
            <h2>Property Box Options</h2>
        </div>

<div class="jtg-row jtg-clearfix">
    <div class="jtg-col-1-1">

<?php
$options = get_option('pm_property_results_options');
?>
<p>Select Layout</p>
<select id="jtg_property_box_layout" name="design_option">
	<option disabled>Select Layout</option>
    <option value="grid" <?php if ( $options['design_option'] == 'grid' ) echo 'selected="selected"'; ?>>Grid</option>
    <option value="list" <?php if ( $options['design_option'] == 'list' ) echo 'selected="selected"'; ?>>List</option>
</select>

<p>How many Columns</p>
<select id="jtg_property_box_columns" name="results_grid_columns">
	<option disabled>Select Columns</option>
	<option value="2" <?php if ( $options['results_grid_columns'] == '2' ) echo 'selected="selected"'; ?>>2 Columns</option>
    <option value="3" <?php if ( $options['results_grid_columns'] == '3' ) echo 'selected="selected"'; ?>>3 Columns</option>
    <option value="4" <?php if ( $options['results_grid_columns'] == '4' ) echo 'selected="selected"'; ?>>4 Columns</option>
</select>

<p>Property Card Style</p>
<select id="jtg_property_card_style" name="property_box_style">
	<option disabled>Select Style</option>
    <option value="1" <?php if ( $options['property_box_style'] == '1' ) echo 'selected="selected"'; ?>>Style 1</option>
    <option value="2" <?php if ( $options['property_box_style'] == '2' ) echo 'selected="selected"'; ?>>Style 2</option>
    <option value="3" <?php if ( $options['property_box_style'] == '3' ) echo 'selected="selected"'; ?>>Style 3</option>
    <option disabled value="4" <?php if ( $options['property_box_style'] == '4' ) echo 'selected="selected"'; ?>>Style 4</option>
</select>

</div>
</div>