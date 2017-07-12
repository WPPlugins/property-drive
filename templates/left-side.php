<!-- begin listing header -->
	<section id="listing-header">
		<div class="jtg-row jtg-clearfix" >

						<div class="listing-header-box">

						<?php

						$options = get_option('pm_design_options');
						if ($options['header_show_type'] == true) {
							?>
							<div class="jtg-col-1-6" style="border: 1px solid #ccc; ">
								<span class="listing-header-item" style="height:160px!important;"><i class="fa fa-home"></i><br><h3 style=" font-size: 18px;">TYPE</h3><hr width="50%" align="center"><?php echo $type; ?></span>
							</div>
						<?php
							}
						if ($options['header_show_status'] == true) {
							?>
							<div class="jtg-col-1-6" style="border: 1px solid #ccc; ">
								<span class="listing-header-item" style="height:160px!important;"><i class="fa fa-th"></i><br><h3 style=" font-size: 18px;">STATUS</h3><hr width="50%" align="center"><?php echo $status; ?></span>
							</div>
						<?php
							}
						if ($options['header_show_price'] == true) {
							?>
							<div class="jtg-col-1-6" style="border: 1px solid #ccc; position: relative; ">
							<?php
                                $currency_options = get_option('pm_importer_options');
                                $currency = $currency_options['jtg_currency'];
                                $currency_info = jtg_currency_symbol($currency);
                                $currency_symbol = $currency_info['symbol'];
                                $currency_icon = $currency_info['icon_class'];
                                if ($property_details['price'][0] == 0) {
                                    echo '<span class="listing-header-item" style="height:160px!important;"><i class="'.$currency_icon.'"></i><br><h3 style=" font-size: 18px;">PRICE</h3><hr width="50%" align="center">Price on Request</span>';
                                } elseif (!$property_details['price'][0]) {
                                    echo '<span class="listing-header-item" style="height:160px!important;"><i class="'.$currency_icon.'"></i><br><h3 style=" font-size: 18px;">PRICE</h3><hr width="50%" align="center">Price on Request</span>';
                                } else {
                                    echo '<span class="listing-header-item" style="height:160px!important;"><i class="'.$currency_icon.'"></i><br><h3 style=" font-size: 18px;">PRICE</h3><hr width="50%" align="center">'.$currency_symbol.''.number_format($property_details['price'][0], 0).'</span>';
                                }

                                if ($property_details['price_term'][0]) {
                                    echo '<span class="jtg-price-term">'.$property_details['price_term'][0].'</span>';
                                }
                            ?>
							</div>
						<?php
							}
						if ($options['header_show_beds'] == true && $property_details['bedrooms'][0] > 0) {
							?>
							<div class="jtg-col-1-6" style="border: 1px solid #ccc; ">
								<span class="listing-header-item" style="height:160px!important;"><i class="fa fa-bed"></i><br><h3 style=" font-size: 18px;">BEDS</h3><hr width="50%" align="center"><?php echo $property_details['bedrooms'][0]; ?></span>
							</div>
						<?php
							}
						if ($options['header_show_ber'] == true) {
							$ber_img = jtg_single_property_ber($property_details['ber_rating'][0]);
							?>
							<div class="jtg-col-1-6" style="border: 1px solid #ccc; ">
								<span class="listing-header-item" style="height:160px!important;"><i class="fa fa-thermometer-empty"></i><br><h3 style=" font-size: 18px;">BER</h3><hr width="50%" align="center"><?php echo $ber_img; ?></span>
							</div>
						<?php
							}

							if ($property_details['brochure_1'][0] != []) {

								?>
									<div class="jtg-col-1-6" style="border: 1px solid #ccc; ">
								<span class="listing-header-item" style="height:160px!important;"><i class="fa fa-file"></i><br><h3 style=" font-size: 18px;">PDF</h3><hr width="50%" align="center"><a target="_blank" href="<?php echo $property_details['brochure_1'][0]; ?>">BROCHURE</a></span>
							</div>
								<?php
							} elseif ($options['header_show_area'] == true && $property_details['brochure_1'][0] == []) {
							?>
							<div class="jtg-col-1-6" style="border: 1px solid #ccc; ">
								<span class="listing-header-item" style="height:160px!important;"><i class="fa fa-map-pin"></i><br><h3 style=" font-size: 18px;">AREA</h3><hr width="50%" align="center"><?php echo $property_details['area'][0]; ?></span>
							</div>
						<?php
							}
							?>
					</div>
		</div>
	</section>
	<div class="listing-spacer" id="headeration"></div>
	<!-- end listing header -->
<!-- begin listing description -->
<section id="listing-description">
	<div class="jtg-row jtg-clearfix">

			<div class="jtg-col-1-1" style="border: 1px solid #ccc;">
				<div class="listing-description">
					<h3>Description</h3>
					<hr width="30%" align="left">
					<!-- Display movie review contents -->
            <div id="listing-description" class="entry-content"><?php the_content(); ?></div>
            <div class="jtg-property-view-counter" style="text-align: right;">
		<i>Viewed <?php print_r($view_counter); ?> times</i>
	</div>
				</div>
			</div>

	</div>
</section>
<div class="listing-spacer"></div>
<!-- end listing description -->
