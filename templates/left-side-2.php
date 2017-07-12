<!-- begin listing header -->
<style>
	.lSSlideOuter .lSPager.lSpg>li {
		margin-top: 10px;
	}
</style>

<section id="pd-property-page-slider">
	<div id="listing-image">
		<div class="row">
			<div class="col-md-12 jtg-image-slider-wrapper">
			<ul id="pd-property-image-wrapper" class="" style="margin-left: 0px!important;">
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
	</div>
</section>


<section id="pd-property-page-description">
	<div class="row">
		<div class="col-md-12">
			<div class="listing-description">
				<h4 class="listing-section-title">Description</h4>
				<!-- Display movie review contents -->
				<div class=""><?php the_content(); ?></div>
				<div class="jtg-property-view-counter" style="text-align: right;">
					<i>Viewed <?php print_r($view_counter); ?> times</i>
				</div>
			</div>
		</div>
	</div>
</section>


<?php if ($property_details['property_accommodation'][0]): ?>
	<section id="pd-page-accommodation">
		<div class="row">
			<div class="col-md-12">
				<div class="listing-description">
					<h4 class="listing-section-title">Accommodation</h4>
					<p><?php echo $property_details['property_accommodation'][0]; ?></p>
				</div>
			</div>
		</div>
	</section>
<?php endif ?>


<?php if ($property_details['property_features'][0]): ?>
	<section id="pd-property-page-features">
		<div class="row">
			<div class="col-md-12">
				<div class="listing-description">
					<h4 class="listing-section-title">Features</h4>
					<ul style="padding-top: 10px;"><?php 
						$features = get_post_meta(get_the_ID(), 'property_features', true);
						foreach ($features as $key => $value) {
							echo '<i class="fa fa-star"></i><b> '.$value.'</b><br>';
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</section>
<?php endif ?>

<?php if ($property_details['ber_rating'][0]): ?>
	<section id="pd-property-page-energy-details">
		<div class="row">
			<div class="col-md-12">
				<div class="listing-energy">
					<h4 class="listing-section-title">Building Energy Rating</h4>
					<?php
					if ($options['header_show_ber'] == true) {
						$ber_img = jtg_single_property_ber($property_details['ber_rating'][0]);
						?>
						<p class="" style="margin-top: 15px; padding: 0px 15px;">BER RATING <?php echo $ber_img; ?><br>
							<?php 
							if (get_post_meta(get_the_ID(), 'ber_number', true)) {
								echo 'BER No. '.get_post_meta(get_the_ID(), 'ber_number', true).'<br>';
							}
							if (get_post_meta(get_the_ID(), 'energy_details', true)) {
								echo 'EPI '.get_post_meta(get_the_ID(), 'energy_details', true);
							}
							?>
						</p>
						<?php
					}?>
				</div>
			</div>
		</div>
	</section>
<?php endif ?>

	<script>
		jQuery(document).ready(function($) { 
       $('#pd-property-image-wrapper').lightSlider({
        gallery: true,
        item:1,
        loop:true,
        autoWidth: false,
        auto: true,
        speed: 500,
        pause: 2500,
        thumbItem:9,
        adaptiveHeight: false,
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
                    slideMove:1,
                    gallery: false,
                    pager: false
                  }
            }
        ],
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#pd-property-image-wrapper a',
                download: false,
            });
        }   
    });  
        });
	</script>