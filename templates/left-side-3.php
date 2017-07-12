<!-- begin listing header -->



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


<section id="pd-property-page-map">
				<div class="row">
					<div id="jtg-listing-map" class="col-md-12">
					<h4 class="listing-section-title" style="margin-bottom: 20px;">Location</h4>
					<?php
					$location = $property_details['latitude'][0].','.$property_details['longitude'][0];
					?>
					<div id='gmap_canvas' style='height:350px;width:100%;'></div>
				</div>
				</div>
			</section>


