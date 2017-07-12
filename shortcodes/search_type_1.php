<?php 
function jtg_search_type_1_shortcode(){
	ob_start();
?>

<div class="pd-bootstrap">
	<form method="get" action="/properties">
		<div class="row">
			<div class="col-md-4 text-center col-xs-12">
		<div class="">
			<?php 
			global $wpdb;
			$select = '<select name="property_status" class="form-control">';
			$select .= '<option value"" selected disabled>Any Property Status</option>';
			$terms = get_terms( 'property_status', 'hide_empty=0');
			foreach($terms as $row){

				if ($row->slug === 'for-saleto-let') {
					continue;
				} else {
					$option = '<option value="'. $row->slug .'">';
					$option .= $row->name;
					$option .= '</option>';
					$select .= $option;
				}
			}
			$select .= '</select>';
			echo $select;
			?>
			</div>
		</div>
		<div class="col-md-4 text-center col-xs-12">
			<div class="">
			<?php 
			global $wpdb;
			$options = get_option('pm_search_options');
			if ($options['search_grouping'] == 'true') {
			$select = '<select name="group_type" class="form-control">';
			$select .= '<option value"" selected disabled>Any Property Type</option>';
			
                $select .= '<option value="pm_commercial">Commercial</option>';
                $select .= '<option value="pm_residential">Residential</option>';
            } else {
            	$select = '<select name="property_type" class="form-control">';
				$select .= '<option value"" selected disabled>Any Property Type</option>';
				$terms = get_terms( 'property_type', 'hide_empty=0');

				foreach($terms as $row){
					$option = '<option value="'. $row->slug .'">';
					$option .= $row->name;
					$option .= '</option>';
					$select .= $option;
				}
			}
			$select .= '</select>';
			echo $select;
			?>
			</div>
		</div>
		<div class="col-md-4 text-center col-xs-12" style="text-align: center;" >
			<button type="submit" style="" class="jtg-search-sc-btn" style=""><i class="fa fa-search"></i> Search</button>
		</div>
		</div>
	</form>
</div>
<div class="listing-spacer"></div>
<?php
return ob_get_clean();
}
add_shortcode('jtg_search_type_1', 'jtg_search_type_1_shortcode');