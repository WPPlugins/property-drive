<?php 
function build_property_admin() {
	$labels = array(
		'name'               => _x( 'Properties', 'post type general name', '4pm-importer' ),
		'singular_name'      => _x( 'Property', 'post type singular name', '4pm-importer' ),
		'menu_name'          => _x( 'Properties', 'admin menu', '4pm-importer' ),
		'name_admin_bar'     => _x( 'Property', 'add new on admin bar', '4pm-importer' ),
		'add_new'            => _x( 'Add New', 'property', '4pm-importer' ),
		'add_new_item'       => __( 'Add New Property', '4pm-importer' ),
		'new_item'           => __( 'New Property', '4pm-importer' ),
		'edit_item'          => __( 'Edit Property', '4pm-importer' ),
		'view_item'          => __( 'View Property', '4pm-importer' ),
		'all_items'          => __( 'All Properties', '4pm-importer' ),
		'search_items'       => __( 'Search Properties', '4pm-importer' ),
		'parent_item_colon'  => __( 'Parent Properties:', '4pm-importer' ),
		'not_found'          => __( 'No properties found.', '4pm-importer' ),
		'not_found_in_trash' => __( 'No properties found in Trash.', '4pm-importer' ),
		);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', '4pm-importer' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'property' ),
		'capability_type'    => 'post',
		'has_archive'        => 'properties',
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'			 => 'dashicons-admin-home',
		'supports'           => array( 'title', 'editor', 'thumbnail'),
		'register_meta_box_cb' => 'jtg_add_admin_meta_boxes'
		);

	register_post_type( 'property', $args );
}
add_action( 'init', 'build_property_admin', 1 );

///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Add metaboxes for Property
///////////////////////////////////////////////////////////////////////////////////////////////////////////
if( !function_exists('jtg_add_admin_meta_boxes') ):
	function jtg_add_admin_meta_boxes() {
		add_meta_box('new_tabbed_interface', 'Property Details', 'jtg_meta_interface', 'property', 'normal', 'high' );
	}
endif; // end   jtg_add_admin_meta_boxes  


if( !function_exists('jtg_meta_interface') ):
	function jtg_meta_interface() {
		global $post;
		$post_id = $post->ID;

		$latitude = get_post_meta($post_id, 'latitude', true);
		$longitude = get_post_meta($post_id, 'longitude', true);


		$property_price = get_post_meta($post_id, 'price', true);
		$price_term = get_post_meta($post_id, 'price_term', true);

		$property_size = get_post_meta($post_id, 'property_size', true);
		$property_floors = get_post_meta($post_id, 'property_floors', true);

		$bathrooms = get_post_meta($post_id, 'bathrooms', true);
		$bedrooms = get_post_meta($post_id, 'bedrooms', true);

		$ber_rating = get_post_meta($post_id, 'ber_rating', true);
		$energy_details = get_post_meta($post_id, 'energy_details', true);

		$agent_id = get_post_meta($post_id, 'agent_id', true);
		$agent_name = get_post_meta($post_id, 'agent_name', true);
		$agent_email = get_post_meta($post_id, 'agent_email', true);
		$agent_number = get_post_meta($post_id, 'agent_number', true);
		$agent_mobile = get_post_meta($post_id, 'agent_mobile', true);

		$brochure_1 = get_post_meta($post_id, 'brochure_1', true);
		$brochure_2 = get_post_meta($post_id, 'brochure_2', true);
		$brochure_3 = get_post_meta($post_id, 'brochure_3', true);

		$residential_otw = get_post_meta($post_id, 'residential_otw', true);
		$commercial_otw = get_post_meta($post_id, 'commercial_otw', true);

		$is_featured = get_post_meta($post_id, 'is_featured', true);

		$dir = plugin_dir_url( dirname(__DIR__) );
		wp_register_script('jtg-admin-property-js', $dir.'assets/js/admin_property.js');
		wp_enqueue_script('jtg-admin-property-js');
		wp_register_script('jtg-admin-ui-js', $dir.'assets/js/admin_ui.js', __FILE__);
		wp_register_style( 'jtg-admin-ui', $dir.'assets/css/jtg_admin_ui.css', __FILE__);
		wp_register_style( 'jtg-grid', $dir.'assets/css/jtg_grid.css', __FILE__);
		wp_enqueue_style( 'jtg-admin-ui' );
		wp_enqueue_style( 'jtg-grid' );
		?>
		<div class="jtg-row jtg-clearfix">
			<div class="jtg-col-1-1">
				<div class="jtg-admin-notice-light">
					<p>Please be aware that importing or having auto sync enabled may overwrite this data if it is different to your feed.</p>
				</div>
				<?php echo '<input type="hidden" name="jtg-ajax-nonce" id="jtg-ajax-nonce" value="' . wp_create_nonce( 'jtg-ajax-nonce' ) . '" />'; ?>
				<?php echo '<input type="hidden" name="post_id" id="jtg_property_id" value="' . $post_id . '" />'; ?>
				<div class="tab">
					<button type="button" id="jtg-default-tab" class="tablinks" onclick="jtg_open_property_details(event, 'jtg-property-details')">Details</button>
					<button type="button" class="tablinks" onclick="jtg_open_property_details(event, 'jtg-property-images')">Gallery</button>
					<button type="button" class="tablinks" onclick="jtg_open_property_details(event, 'jtg-property-location')">Property Location</button>
					<button type="button" class="tablinks" onclick="jtg_open_property_details(event, 'jtg-property-agent-details')">Agent Details</button>
					<button type="button" class="tablinks" onclick="jtg_open_property_details(event, 'jtg-property-attachments')">Attachments</button>
					
				</div>
				<div id="jtg-property-details" class="tabcontent">
					<div class="jtg-row jtg-clearfix">
						<div class="jtg-col-1-4">
							<p>Price</p>
							<input autocomplete="off" id="jtg_price" type="text" name="price" value="<?php echo $property_price ?>">
							<br>
							<p>Price Term</p>
							<input autocomplete="off" id="jtg_price_term" type="text" name="price_term" value="<?php echo $price_term ?>">
							<br>
						</div>
						<div class="jtg-col-1-4">
							<p>Bedrooms</p>
							<input autocomplete="off" id="jtg_bedrooms" type="text" name="bedrooms" value="<?php echo $bedrooms ?>">
							<br>
							<p>Bathrooms</p>
							<input autocomplete="off" id="jtg_bathrooms" type="text" name="bathrooms" value="<?php echo $bathrooms ?>">
						</div>
						<div class="jtg-col-1-4">
							<p>Property Size</p>
							<input autocomplete="off" id="jtg_property_size" type="text" name="property_size" value="<?php echo $property_size ?>">
							<br>
							<p>Property Floors</p>
							<input autocomplete="off" id="jtg_property_floors" type="text" name="property_floors" value="<?php echo $property_floors ?>">
							<br>
						</div>
						<div class="jtg-col-1-4">
							<p>BER Rating</p>
							<input autocomplete="off" id="jtg_ber_rating" type="text" name="ber_rating" value="<?php echo $ber_rating ?>">
							<br>
							<p>Energy Details</p>
							<input autocomplete="off" id="jtg_energy_details" type="text" name="energy_details" value="<?php echo $energy_details ?>">

						</div>
					</div>
					<div class="jtg-row jtg-clearfix">
						<div class="jtg-col-1-2">
						<h4>Residential of the Week</h4>
							<label class="jtg-admin-switch">
								<input id="residential_otw" type="checkbox" value="1" <?php checked('true', $residential_otw); ?> />
								<div class="jtg-admin-slider jtg-admin-round"></div>
							</label>
						</div>
						<div class="jtg-col-1-2">
						<h4>Commercial of the Week</h4>
							<label class="jtg-admin-switch">
								<input id="commercial_otw" type="checkbox" value="1" <?php checked('true', $commercial_otw); ?> />
								<div class="jtg-admin-slider jtg-admin-round"></div>
							</label>
						</div>
					</div>
					<div class="jtg-row jtg-clearfix">
						<div class="jtg-col-1-1">
							<h4>Featured Property</h4>
							<label class="jtg-admin-switch">
								<input id="is_featured" type="checkbox" value="1" <?php checked('true', $is_featured); ?> />
								<div class="jtg-admin-slider jtg-admin-round"></div>
							</label>
						</div>
					</div>
				</div>
				<div id="jtg-property-images" class="tabcontent">
					<div class="jtg-row jtg-clearfix">
						<div class="jtg-col-1-1">
								<ul class="jtg-grid-wrap">
								<?php
								$media = get_attached_media( 'image' );

								if ($media) {
									foreach ($media as $image) {
										$img_url = $image->guid;

											echo '<li class="jtg-admin-grid-item"><img width="100%" src="'.$img_url.'"></li>';
									}
								} else {
									$no_img_url = plugins_url( 'assets/images/no-image.jpg', dirname(__FILE__) );
									echo '<li data-thumb="'.$no_img_url.'"><img src="'.$no_img_url.'"></li>';
								} 
								?>
							</ul>
						</div>
					</div>

				</div>
				<div id="jtg-property-location" class="tabcontent">
					<div class="jtg-row jtg-clearfix">
						<div class="jtg-col-1-2">
							<p>Latitude</p>
							<input autocomplete="off" id="jtg_latitude" type="text" name="latitude" value="<?php echo $latitude ?>">

						</div>
						<div class="jtg-col-1-2">
							<p>Longitude</p>
							<input autocomplete="off" id="jtg_longitude" type="text" name="longitude" value="<?php echo $longitude ?>">
						</div>
					</div>
				</div>
				<div id="jtg-property-agent-details" class="tabcontent">
					<div class="jtg-row jtg-clearfix">
						<div class="jtg-col-1-3">
							<p>Agent ID</p>
							<input autocomplete="off" id="jtg_agent_id" type="text" name="agent_id" value="<?php echo $agent_id ?>">
							<br>

							<p>Agent Name</p>
							<input autocomplete="off" id="jtg_agent_name" type="text" name="agent_name" value="<?php echo $agent_name ?>">
						</div>
						<div class="jtg-col-1-3">
							<p>Agent Email</p>
							<input autocomplete="off" id="jtg_agent_email" type="text" name="agent_email" value="<?php echo $agent_email ?>">
							<br>

							<p>Agent Phone</p>
							<input autocomplete="off" id="jtg_agent_number" type="text" name="agent_number" value="<?php echo $agent_number ?>">
						</div>
						<div class="jtg-col-1-3">
							<p>Agent Mobile</p>
							<input autocomplete="off" id="jtg_agent_mobile" type="text" name="agent_mobile" value="<?php echo $agent_mobile ?>">
						</div>
					</div>
				</div>

				<div id="jtg-property-attachments" class="tabcontent">
					<div class="jtg-row jtg-clearfix">
						<div class="jtg-col-1-3">
							<p>Brochure 1</p>
							<input autocomplete="off" id="jtg_brochure_1" type="text" name="brochure_1" value="<?php echo $brochure_1 ?>">
						</div>



						<div class="jtg-col-1-3">
							<p>Brochure 2</p>
							<input autocomplete="off" id="jtg_brochure_2" type="text" name="brochure_2" value="<?php echo $brochure_2 ?>">

						</div>

						<div class="jtg-col-1-3">
							<p>Brochure 3</p>
							<input autocomplete="off" id="jtg_brochure_3" type="text" name="brochure_3" value="<?php echo $brochure_3 ?>">

						</div>
					</div>

				</div>

				

				<div style="text-align: right;">
					<span id="jtg-update-property-btn"><button class="jtg-update-settings-btn">Save Property Details</button></span>
				</div>
				<div class="jtg-ajax-response">

				</div>
			</div>
		</div>

		<script>
			function jtg_open_property_details(evt, sectionName) {
// Declare all variables
var i, tabcontent, tablinks;

// Get all elements with class="tabcontent" and hide them
tabcontent = document.getElementsByClassName("tabcontent");
for (i = 0; i < tabcontent.length; i++) {
	tabcontent[i].style.display = "none";
}

// Get all elements with class="tablinks" and remove the class "active"
tablinks = document.getElementsByClassName("tablinks");
for (i = 0; i < tablinks.length; i++) {
	tablinks[i].className = tablinks[i].className.replace(" active", "");
}

// Show the current tab, and add an "active" class to the button that opened the tab
document.getElementById(sectionName).style.display = "block";
evt.currentTarget.className += " active";
}
document.getElementById("jtg-default-tab").click();
</script>
<?php
}
endif; // end   jtg_add_admin_meta_boxes 