<?php
get_header(); 
$single_page_options = get_option('pm_design_options');

$slider_auto_play = $single_page_options['slider_auto_play'];

wp_enqueue_style('jtg-single-property-styles');
wp_enqueue_style('jtg-light-slider-styles');
wp_enqueue_script('jtg-light-slider-scripts');
wp_enqueue_style('jtg-light-gallery-styles');
wp_enqueue_script('jtg-light-gallery-scripts');

?>

<?php while ( have_posts() ) : the_post();?>

<article id="post-<?php the_ID();?>" <?php post_class(); ?>>
<?php
	// Count the property views
	$view_counter = jtg_property_view_count(get_the_id());
	$property_details = get_post_meta(get_the_id());
	$property_types = get_the_terms(get_the_id(), 'property_type');
	if ($property_types) {
		foreach ($property_types as $type) {
			$type = $type->name;
		}
	}
	$property_statuses = get_the_terms(get_the_id(), 'property_status');
	if ($property_statuses) {
		foreach ($property_statuses as $status) {
			$status = $status->name;
		}
	}
?>

<style>
.lSSlideOuter .lSPager.lSpg>li {
   margin-top: 10px;
}
</style>
	<section id="listing-image">

			<div class="jtg-image-slider-wrapper">
			

					<?php 
					if ( ( function_exists('has_post_thumbnail') ) && ( has_post_thumbnail() ) ) { 
						$post_thumbnail_id = get_post_thumbnail_id();
						$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
					}
					?>

					<ul id="lightSlider" class="cs-hidden">
							<?php
							$media = get_attached_media( 'image' );

							if ($media) {
								foreach ($media as $image) {
									$img_url = $image->guid;

										echo '<li data-thumb="'.$img_url.'"><a href="'.$img_url.'"><img width="100%" src="'.$img_url.'"></a></li>';
								}
							} else {
								$no_img_url = plugins_url( 'assets/images/no-image.jpg', dirname(__FILE__) );
								echo '<li data-thumb="'.$no_img_url.'"><img src="'.$no_img_url.'"></li>';
							} 
							?>
					</ul>
						

				</div>
			</div>

	</section>
	<script>
		jQuery(document).ready(function($) { 
       $('#lightSlider').lightSlider({
        gallery:false,
        item:2,
        loop:true,
        autoWidth: false,
        auto: true,
        speed: 500,
        pause: 2500,
        thumbItem:9,
        slideMargin:10,
        enableDrag: false,
        currentPagerPosition:'center',
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
                    slideMove:1
                  }
            }
        ],
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#lightSlider a',
                download: false,
            });
        }   
    });  
        });
	</script>
	<section id="jtg-property-title">
		<div>
			<div class="jtg-single-property-title">
				<h1><?php the_title(); ?></h1>
				<br>
				<span><?php echo $type; ?> / <?php echo $status; ?></span>
				<?php 
				$pro_version_enabled = get_option( 'property_drive_pro' );
				if ($pro_version_enabled == 'true'): ?>
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
				
					<span id="jtg-user-favourite-btn" style="position: relative; float:right; font-size: 40px; bottom: 15px; color: red;">
						<form>
							<?php echo '<input type="hidden" name="jtg-ajax-nonce" id="jtg-ajax-nonce" value="' . wp_create_nonce( 'jtg-ajax-nonce' ) . '" />'; ?>
						<input type="hidden" id="jtg-favourite-property-id" value="<?php echo get_the_id(); ?>">
						<input type="hidden" id="jtg-favourite-user-id" value="<?php echo get_current_user_id(); ?>">
						<i class="fa fa-heart" style="cursor: pointer;" id="jtg-favourite-btn"></i>
						</form>
					</span>
				<?php else: ?>
					<span id="jtg-user-remove-favourite-btn" style="position: relative; float:right; font-size: 40px; bottom: 15px; color: red;">
						<form>
							<?php echo '<input type="hidden" name="jtg-ajax-nonce" id="jtg-ajax-nonce" value="' . wp_create_nonce( 'jtg-ajax-nonce' ) . '" />'; ?>
						<input type="hidden" id="jtg-favourite-property-id" value="<?php echo $property_favourites[0]->ID ?>">
						<i class="fa fa-heart-o" style="cursor: pointer;" id="jtg-remove-favourite-btn"></i>
						</form>
					</span>
				<?php endif ?>
				<?php endif ?>
			</div>
		</div>
	<?php wp_enqueue_script('jtg-add-favourite-js'); ?>
	<?php wp_enqueue_script('jtg-remove-favourite-js'); ?>
	</section>
	<section id="jtg-property-content">
		<div class="jtg-container">
			<div class="jtg-row jtg-clearfix">
			<?php 
				if ($single_page_options['show_sidebar'] == 'true') {
					$left_side = 'jtg-col-3-4';
					$right_side = 'jtg-side-1-4';
				} elseif(!$single_page_options['show_sidebar']) {
					$left_side = 'jtg-col-3-4';
					$right_side = 'jtg-side-1-4';
				} else {
					$left_side = 'jtg-col-1-1';
					$right_side = 'jtg-hidden';
				}
			?>
				<div class="<?php echo $left_side ?>">
					<?php include 'left-side.php'; ?>
				</div>
				<div class="<?php echo $right_side ?>">
				<?php 
					if ($single_page_options['show_sidebar'] == 'true') {
						include 'right-side.php';
					} elseif (!$single_page_options['show_sidebar']) {
						include 'right-side.php';
					}
				?>
				</div>
			</div>
		</div>
	</section>
	<section id="jtg-listing-map">
		<?php
			$location = $property_details['latitude'][0].','.$property_details['longitude'][0];
		?>
		<div class="jtg-row jtg-clearfix">
			<div class="jtg-col-1-1">
				<div id='gmap_canvas' style='height:350px;width:100%;'></div>
			</div>
		</div>
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
	</section>
	
<div class="listing-spacer"></div>
<section id="listing-search">
	<div class="jtg-container" style="padding-top: 25px;">
		<?php 
        $options = get_option('pm_search_options');
        $set_sc = '[jtg_search_type_'.$options['search_type'].']';

        echo do_shortcode("$set_sc"); 
        ?>
	</div>
</section>

<section id="related-properties">
<div class="jtg-row jtg-clearfix">
	<h3 style="padding-left: 10px">Related Properties</h3>
</div>
	<div class="jtg-row jtg-clearfix">
		
	<?php 
 
// get the custom post type's taxonomy terms
 
$custom_taxterms = wp_get_object_terms( $post->ID, 'property_type', array('fields' => 'ids') );
// arguments
$args = array(
'post_type' => 'property',
'post_status' => 'publish',
'posts_per_page' => 2, // you may edit this number
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

// loop over query
?>
<?php   
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
<?php
// Reset Post Data
wp_reset_postdata();
?>
	</div>
</section>
</article>
<?php endwhile; ?>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>