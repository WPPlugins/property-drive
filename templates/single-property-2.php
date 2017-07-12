<?php
////////////////////////////////////////////////////////////
///  Single Property Page - Template 3
///////////////////////////////////////////////////////////

// It is essential to call pd-bootstrap to make sure that 
// bootstrap is being loaded for the layout
	get_header(); 
	$single_page_options = get_option('pm_design_options');
	$slider_auto_play = $single_page_options['slider_auto_play'];
	wp_enqueue_style('jtg-single-property-3');
	wp_enqueue_style('jtg-light-slider-styles');
	wp_enqueue_style('jtg-light-gallery-styles');
	?>
	<style>
		.ghost_div {
			height: 140px;
			background-color: #fff;
		}
	</style>

	<?php while ( have_posts() ) : the_post();?>
		
		<article id="pd-property-<?php the_ID();?>" <?php post_class(); ?>>
<div class="pd-bootstrap"> <!-- Begin PD Bootstrap -->
			<?php
// Count the property views
			$view_counter = jtg_property_view_count(get_the_id());
			$property_details = get_post_meta(get_the_id());
			$property_type = get_the_terms(get_the_id(), 'property_type');
			$property_status = get_the_terms(get_the_id(), 'property_status');
			?>

			<?php 
			$pro_version_enabled = get_option( 'property_drive_pro' );
			if ($pro_version_enabled == 'true' && is_user_logged_in()):
				?>
			<section id="pd-property-favourite">
				<div class="row">
					<div class="jtg-favourite-wrap" style="display: block; width: 100%; height: 50px; margin-bottom: -50px; ">
						<?php 
						$property_favourites = get_posts(array(
							'post_type' => 'property_favourite',
							'posts_per_page' => 1,
							'post_status' => 'publish',
							'post_author' => get_current_user_id(),
							'meta_key' => 'favourite_property_id',
							'meta_value' => get_the_id()
							));
							?>
							<?php if (!$property_favourites): ?>
								<span id="jtg-user-favourite-btn" style="float:right; font-size: 40px; color: red;">
									<form>
										<?php echo '<input type="hidden" name="jtg-ajax-nonce" id="jtg-ajax-nonce" value="' . wp_create_nonce( 'jtg-ajax-nonce' ) . '" />'; ?>
										<input type="hidden" id="jtg-favourite-property-id" value="<?php echo get_the_id(); ?>">
										<input type="hidden" id="jtg-favourite-user-id" value="<?php echo get_current_user_id(); ?>">
										<i class="fa fa-heart" style="cursor: pointer;" id="jtg-favourite-btn"></i>
									</form>
								</span>
							<?php else: ?>
								<span id="jtg-user-remove-favourite-btn" style="float:right; font-size: 40px; color: red;">
									<form>
										<?php echo '<input type="hidden" name="jtg-ajax-nonce" id="jtg-ajax-nonce" value="' . wp_create_nonce( 'jtg-ajax-nonce' ) . '" />'; ?>
										<input type="hidden" id="jtg-favourite-property-id" value="<?php echo $property_favourites[0]->ID ?>">
										<i class="fa fa-heart-o" style="cursor: pointer;" id="jtg-remove-favourite-btn"></i>
									</form>
								</span>
							<?php endif ?>
						</div>
					</div>
				</section>
			<?php endif ?>


			<section id="pd-property-page-title">
				<div class="ghost_div" >
					<div id="jtg-property-title">
						<div class="col-12">
							<div class="jtg-single-property-title">
								<h2 style="margin-bottom: 10px;"><?php the_title(); ?></h2>
							</div>
						</div>

						<div class="row text-center">
							<?php

							$options = get_option('pm_design_options');
							if ($options['header_show_type'] == true) {
								?>
								<div class="col-md-2 col-xs-6" >
									<span class="listing-header-item" ><i class="fa fa-home"></i><?php echo $property_type[0]->name; ?></span>
								</div>
								<?php
							}
							if ($options['header_show_status'] == true) {
								?>
								<div class="col-md-2 col-xs-6" >
									<span class="listing-header-item" ><i class="fa fa-th"></i><?php echo $property_status[0]->name; ?></span>
								</div>
								<?php
							}
							if ($options['header_show_price'] == true) {
								?>
								<div class="col-md-2 col-xs-6" style=" position: relative; ">
									<?php
									$currency_options = get_option('pm_importer_options');
									$currency = $currency_options['jtg_currency'];
									$currency_info = jtg_currency_symbol($currency);
									$currency_symbol = $currency_info['symbol'];
									$currency_icon = $currency_info['icon_class'];
									if ($property_details['price'][0] == 0) {
										echo '<span class="listing-header-item" ><i class="'.$currency_icon.'"></i>Price on Request</span>';
									} elseif (!$property_details['price'][0]) {
										echo '<span class="listing-header-item" ><i class="'.$currency_icon.'"></i>Price on Request</span>';
									} else {
										echo '<span class="listing-header-item" ><i class="'.$currency_icon.'"></i>'.number_format($property_details['price'][0], 0).'</span>';
									}

									if ($property_details['price_term'][0]) {
										echo '<span class="jtg-price-term">/ '.$property_details['price_term'][0].'</span>';
									}
									?>
								</div>
								<div class="col-md-2 col-xs-6" >
									<?php
								}
								if ($options['header_show_beds'] == true && $property_details['bedrooms'][0] > 0) {
									?>

									<span class="listing-header-item" ><i class="fa fa-bed"></i><?php echo $property_details['bedrooms'][0]; ?></span>

									<?php
								}


								if ($property_details['bathrooms'][0] > 0) {
									?>

									<span class="listing-header-item" >&nbsp;<i class="fa fa-bath"></i><?php echo $property_details['bathrooms'][0]; ?></span>

									<?php
								}
								?>
							</div>

							<?php
							if ($options['header_show_ber'] == true) {
								$ber_img = jtg_single_property_ber($property_details['ber_rating'][0]);
								?>
								<div class="col-md-2 col-xs-6" >
									<span class="listing-header-item" ><i class="fa fa-thermometer-empty"></i><?php echo $ber_img; ?></span>
								</div>
								<?php
							}

							if ($property_details['brochure_1'][0] != []) {

								?>
								<div class="col-md-2 col-xs-6" >
									<span class="listing-header-item" ><i class="fa fa-file"></i><a target="_blank" href="<?php echo $property_details['brochure_1'][0]; ?>">BROCHURE</a></span>
								</div>
								<?php
							} elseif ($options['header_show_area'] == true && $property_details['brochure_1'][0] == []) {
								?>
								<div class="col-md-2 col-xs-6" >
									<span class="listing-header-item" ><i class="fa fa-arrows-alt"></i><?php echo strtok($property_details['property_size'][0], 'm').'m.'; ?></span>
								</div>
								<?php
							}
							?>
						</div>

						<div class="pd-title-border"></div>
					</div>			
				</div>
			</section>







			<section id="pd-property-page-content">
				<div class="container">
					<div class="row" id="jtg-property-content">
					<?php 
					if ($single_page_options['show_sidebar'] == 'true') {
						$left_side = 'col-md-8';
						$right_side = 'col-md-4';
					} elseif(!$single_page_options['show_sidebar']) {
						$left_side = 'col-md-8';
						$right_side = 'col-md-4';
					} else {
						$left_side = 'col-md-12';
						$right_side = 'jtg-hidden';
					}
					?>
					<div class="<?php echo $left_side ?>">
						<?php include 'left-side-3.php'; ?>
					</div>
					<div class="<?php echo $right_side ?>">
						<?php 
						if ($single_page_options['show_sidebar'] == 'true') {
							include 'right-side-3.php';
						} elseif (!$single_page_options['show_sidebar']) {
							include 'right-side-3.php';
						}
						?>
					</div>
				</div>
				</div>
			</section>





			<section id="pd-property-page-map">
				<div class="container">
					<div class="row">
					<div id="jtg-listing-map" class="col-md-12">
					<h4 class="listing-section-title" style="margin-bottom: 20px;">Location</h4>
					<?php
					$location = $property_details['latitude'][0].','.$property_details['longitude'][0];
					?>
					<div id='gmap_canvas' style='height:350px;width:100%;'></div>
				</div>
				</div>
				</div>
			</section>





			<section id="pd-property-page-search">
				<div class="container">
					<div class="col-md-12">
					<div id="listing-search">
					<?php 
					$options = get_option('pm_search_options');
					$set_sc = '[jtg_search_type_'.$options['search_type'].']';
					echo do_shortcode("$set_sc"); 
					?>
				</div>
				</div>
				</div>
			</section>




			<section id="pd-property-page-related">


				<div class="container">
					<div class="row" id="related-properties">

					<div class="col-md-12">
						<h4 class="listing-section-title" style="padding-left: 10px">Related Properties</h4>
					</div>


					<?php 
					$custom_taxterms = wp_get_object_terms( $post->ID, 'property_type', array('fields' => 'ids') );
					$args = array(
						'post_type' => 'property',
						'post_status' => 'publish',
						'posts_per_page' => 2,
						'orderby' => 'rand',
						'tax_query' => array(
							array(
								'taxonomy' => 'property_type',
								'field' => 'id',
								'terms' => $custom_taxterms
								)
							),
						'post__not_in' => array ($post->ID),
						);
					$related_items = new WP_Query( $args );

					$grid_option = get_option('pm_property_results_options');
					$column_option = $grid_option['results_grid_columns'] ?? '3';

					$style_option = get_option('pm_property_results_options');

					$style = $style_option['property_box_style'];

					$style_options = get_option('pm_property_results_options');

					if ($style_options['property_box_style'] == 1) {
						wp_enqueue_style('jtg-property-box-1');
					} elseif ($style_options['property_box_style'] == 2) {
						wp_enqueue_style('jtg-property-box-2');
					} elseif ($style_options['property_box_style'] == 3) {
						wp_enqueue_style('jtg-property-box-3');
					} elseif ($style_options['property_box_style'] == 4) {
						wp_enqueue_style('jtg-property-box-4');
					} else {
						wp_enqueue_style('jtg-property-box-1');
					}
					?>
					<div class="col-md-12">
						<ul class="jtg-grid-wrap">
						<?php
						if ( $related_items->have_posts() ) : while ($related_items->have_posts()) : $related_items->the_post();
						if ($style == 1) {
							include('property_box_1.php');
						} elseif ($style == 2) {
							include('property_box_2.php');
						} elseif ($style == 3) {
							include('property_box_3.php');
						} else {
							include('property_box_1.php');
						}
						endwhile;
						endif; ?>
					</ul>
					</div>
					<?php wp_reset_postdata(); ?>
				</div>
			</section>
			</div>
				</div>
		</article>

<!-- End of PD Bootstrap -->
		<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAdXyOzKLpt8QBolGnH-gL8njC8mqZ_2do'></script>
		<script>
			function init_map(){
				var myOptions = {
					zoom:15,
					draggable:false,
					scrollwheel: false,
					navigationControl: false,
					mapTypeControl: false,
					center:new google.maps.LatLng(<?php echo $location; ?>),
					mapTypeId: google.maps.MapTypeId.ROADMAP};
					map = new google.maps.Map(document.getElementById('gmap_canvas'), 
						myOptions);
					marker = new google.maps.Marker
					({
						map: map,position: new google.maps.LatLng(<?php echo $location; ?>)
					});
					google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);
					});
				}
				google.maps.event.addDomListener(window, 'load', init_map);
			</script>



			<script>
				jQuery(document).ready(function($){
					var stickyNavTop = $('header').offset().top + 50; 
					var topHeight = 50;
					var stickyNav = function(){  
						var scrollTop = $(window).scrollTop();  
						if (scrollTop >= stickyNavTop) {  
						$('#jtg-property-title').css({
								'z-index': '999'
							});  
							$(window).resize(function() {
								if($(window).width() <= 700) {
									$('#jtg-property-title').css({
										'position': 'relative',
										'top': '0px',
									});  

								} else {
									$('#jtg-property-title').css({
										'position': 'fixed',
										'top': '0px'
									});  
								}
							}).resize();
						} else {  
							$('#jtg-property-title').css({
								'position': 'relative',
								'top': '0',
								'z-index' : '10',
							});  

						}  
					};  
					stickyNav();  
					$(window).scroll(function() {  
						stickyNav();  
					});
				});
			</script>
			<?php 
			wp_enqueue_script('jtg-light-slider-scripts');
			wp_enqueue_script('jtg-light-gallery-scripts');
			wp_enqueue_script('jtg-add-favourite-js');
			wp_enqueue_script('jtg-remove-favourite-js');
			?>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
		<?php get_footer(); ?>