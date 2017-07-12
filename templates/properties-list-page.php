<?php get_header(); ?>

<div class="container" style="padding-top: 50px;">
	<div class="col-md-3">
		<?php include('sidebar_search.php'); ?>
	</div>
	<div class="col-md-9">
		<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
	<div class="row" style="margin-bottom: 25px;">

		<div class="col-md-12" style="border: 1px #ccc solid; padding: 15px 0px;">
			<div class="property-list-box">
			<a href="<?php the_permalink(); ?>">
				<?php
					$post_thumbnail_id = get_post_thumbnail_id();

					if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
					  $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
					} else {
						$post_thumbnail_url = plugins_url( 'assets/images/no-image.jpg', dirname(__DIR__) );
					}

				?>
				<div class="col-md-3 property-list-image">
					<img width="100%" src="<?php echo $post_thumbnail_url; ?>"  alt="">
				</div>
				<?php 
				$property_details = get_post_meta(get_the_id());
                $property_types = get_the_terms(get_the_id(), 'property_type');

                foreach ($property_types as $type) {
                    $type = $type->name;
                }

                $property_statuses = get_the_terms(get_the_id(), 'property_status');

                foreach ($property_statuses as $status) {
                    $status = $status->name;
                }
				?>
				<div class="col-md-9 pm-list-style-border">
					<span class="property-status-grid"><?php echo $status; ?></span>
			<div class="property-box-price-grid"><?php echo '€'.number_format($property_details['_price'][0], 2); ?></div>
				
				<div class="property-box-type-grid"><?php echo $type; ?>
					
				</div>
				<div class="property-box-heading-grid"><?php the_title(); ?></div>
				<?php 
					if ($property_details['_bedrooms'][0]) {
						echo '<span style="display:inline-block;"><i class="fa fa-bed"> '.$property_details['_bedrooms'][0].'</i></span>';
					}
					if ($property_details['_bathrooms'][0]) {
						echo '<span style="display:inline-block;"><i class="fa fa-bath"> '.$property_details['_bedrooms'][0].'</i></span>';
					}

				?>
				</div>
				

			</a>
			</div>
		</div>  

	</div><!--/.row-->
	<div class="clearfix"></div>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>

<div class="listings-pagination">
	<?php
	the_posts_pagination( array(
		'mid_size'  => 2,
		'prev_text' => __( 'Back', 'textdomain' ),
		'next_text' => __( 'Next', 'textdomain' ),
		) );
		?>
	</div>

<?php else : ?>
	<!-- No posts found -->
	<div class="col-md-offset-3 col-md-6" style="text-align: center;">
		<h1>No Results Found</h1>
		<h4>It appears we have no results that match the query you tried, please try again using different search terms.</h4>

		<i style="font-size: 32px;" class="fa fa-search" aria-hidden="true"></i>
	</div>
	<div class="col-md-12">
		<?php include(plugin_dir_path( __DIR__ ).'/templates/search_shortcode.php'); ?>
	</div>

<?php endif; ?>

</div>
</div>
<?php get_footer(); ?>