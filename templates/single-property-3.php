<div class="pd-bootstrap"> <!-- Being PD Bootstrap -->
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
	<?php  ?>
	<style>

	.pd-bootstrap .navbar {
		position: fixed;
		width: 100%;
		height: 150px;
		z-index: 9;
	}

		.pd-slider-overlay {
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			height: auto;
			min-height: 350px;
			background-color: rgba(0,0,0, 0.60);
			color: #fff;
			display: flex;
			justify-content: center;
			align-items: center;
			margin-bottom: 15px;
			padding-top: 15px;
			padding-bottom: 15px;


		}

		.pd-slider-overlay a, .pd-slider-overlay a:hover {
			color: #fff;
			text-decoration:  none;
		}

		.pd-slider-overlay h2 {
			color: #51c5d8;
		}


		.pd-slider-overlay i {
			display: inline-block;
			margin: 10px;
		}

.pd-slide-image img {
		height: auto; 
		max-height: 700px;
	}

@media only screen and (max-width: 720px) {
	#pd-property-page-slider {
		margin-top: 165px;
		margin-bottom: 25px;

	}

	.pd-slide-image img {
		max-height: 500px;
	}
}

	</style>
	<?php while ( have_posts() ) : the_post();?>
		<article id="pd-property-<?php the_ID();?>" <?php post_class(); ?> style="margin-top: -15px;">
			<?php
// Count the property views
			$view_counter = jtg_property_view_count(get_the_id());
			$property_details = get_post_meta(get_the_id());
			$property_type = get_the_terms(get_the_id(), 'property_type');
			$property_status = get_the_terms(get_the_id(), 'property_status');
			?>

			



<section id="pd-property-page-slider" style="margin-left: -15px; margin-right: -15px; min-height: 350px; overflow: hidden;">
	<div id="listing-image">
		<div class="row">
			<div class="col-md-12 jtg-image-slider-wrapper" style="">
			<ul id="pd-property-image-wrapper" style="margin-left: 0px!important;">
					<?php
					$media = get_attached_media( 'image' );
					if ($media) {
						$i = 0;
						foreach ($media as $image) {

								$img_url = $image->guid;
								echo '<li class="pd-slide-image" data-thumb="'.$img_url.'"><a href="'.$img_url.'"><img width="100%" style="" src="'.$img_url.'"></a></li>';

							$i++;
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
</section>


<?php 


$currency_options = get_option('pm_importer_options');
									$currency = $currency_options['jtg_currency'];
									$currency_info = jtg_currency_symbol($currency);
									$currency_symbol = $currency_info['symbol'];
									$currency_icon = $currency_info['icon_class'];
									if ($property_details['price'][0] == 0) {
										$currency_box = '<span class="listing-header-item" ><i class="'.$currency_icon.'"></i>Price on Request</span>';
									} elseif (!$property_details['price'][0]) {
										$currency_box = '<span class="listing-header-item" ><i class="'.$currency_icon.'"></i>Price on Request</span>';
									} else {
										$currency_box = '<span class="listing-header-item" ><i class="'.$currency_icon.'"></i>'.number_format($property_details['price'][0], 0).'</span>';
									}

									if ($property_details['price_term'][0]) {
										$currency_box = '<span class="jtg-price-term">/ '.$property_details['price_term'][0].'</span>';
									}


$ber_img = jtg_single_property_ber($property_details['ber_rating'][0]);
$property_title = get_the_title();
$property_title_overlay = '

	<div class="pd-property-info-box" >
	<div class="col-12 text-center">
		<div class="jtg-single-property-title">
			<h2 style="margin-bottom: 10px;">'.$property_title.'</h2>
			<hr width="50%" align="center">
		</div>
	</div>



	<div class="row text-center">
	<div class="col-md-4 col-xs-6" >
		<span class="listing-header-item" ><i class="fa fa-home"></i>'.$property_type[0]->name.'</span>
	</div>

	<div class="col-md-4 col-xs-6" >
		<span class="listing-header-item" ><i class="fa fa-th"></i>'.$property_status[0]->name.'</span>
	</div>


	<div class="col-md-4 col-xs-6" style=" position: relative; ">
	'.$currency_box.'
	</div>
	</div>
<div class="row text-center">
	<div class="col-md-4 col-xs-6" >
		<span class="listing-header-item" ><i class="fa fa-bed"></i>'.$property_details['bedrooms'][0].'</span>
		<span class="listing-header-item" >&nbsp;<i class="fa fa-bath"></i>'.$property_details['bathrooms'][0].'</span>
	</div>
	

	<div class="col-md-4 col-xs-6" >
		<span class="listing-header-item" ><i class="fa fa-thermometer-empty"></i>'.$ber_img.'</span>
	</div>

	<div class="col-md-4 col-xs-6" >
		<span class="listing-header-item" ><i class="fa fa-file"></i><a target="_blank" href="'.$property_details['brochure_1'][0].'">BROCHURE</a></span>
	</div>
	</div>
	</div>

';

?>



<script>
	jQuery(document).ready(function($) { 
		var property_info = <?php echo json_encode($property_title_overlay) ?>;
		$(document).ready( function(){
$('.jtg-image-slider-wrapper').append('<div class="pd-slider-overlay" >' + property_info + '</div>');
		});

		$('.jtg-image-slider-wrapper').hover(function () {
    $(".pd-slider-overlay").delay(500).hide('fade', { direction: 'out' }, 500);
},function () {
    $(".pd-slider-overlay").show('fade', { direction: 'in' }, 500);
});
		
	});
</script>
	<script>
		jQuery(document).ready(function($) { 
       $('#pd-property-image-wrapper').lightSlider({
        gallery: false,
        item:1,
        loop: true,
        autoWidth: false,
        auto: true,
        speed: 500,
        pause: 4000,
        thumbItem:9,
        adaptiveHeight: false,
        enableDrag: false,
        currentPagerPosition:'center',
        pager: false,
        responsive : [
            {
                breakpoint:800,
                settings: {
                    item:2,
                    slideMove:1,
                    slideMargin:6,
                  }
            },
            {
                breakpoint:480,
                settings: {
                    item:1,
                    slideMove:1,
                    gallery: false,
                    pager: false
                  }
            }
        ],
        onSliderLoad: function(el) {
        	var maxHeight = 0,
        container = $(el),
        children = container.children();

    children.each(function () {
        var childHeight = $(this).height();
        if (childHeight > maxHeight) {
            maxHeight = childHeight;
        }
    });
    container.height(maxHeight);

            el.lightGallery({
                selector: '#pd-property-image-wrapper a',
                download: false,
            });
        }
    });  
        });
	</script>






			







			<section id="pd-property-page-content" class="container">
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
			</section>





			





			<section id="pd-property-page-search">
			<div class="">
						<h4 class="listing-section-title" style="padding-left: 10px">Search</h4>
					</div>
				<div class="col-md-12">
					<div id="listing-search">
					<?php 
					$options = get_option('pm_search_options');
					$set_sc = '[jtg_search_type_'.$options['search_type'].']';
					echo do_shortcode("$set_sc"); 
					?>
				</div>
				</div>
			</section>

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


			<section id="pd-property-page-related">


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
		</article>
</div>
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
					var stickyNavTop = $('header').offset().top + 150; 
					var topHeight = 150;
					var stickyNav = function(){  
						var scrollTop = $(window).scrollTop();  
						if (scrollTop >= stickyNavTop) {   
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
								'top': '0'
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