<?php 
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


<li class="jtg-grid-item">
<div class="jtg-box">
<a href="<?php the_permalink(); ?>">
                    <div class="jtg-box-image">
                        <?php
                                $post_thumbnail_id = get_post_thumbnail_id();

                                if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                                  $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                                } else {
                                    $post_thumbnail_url = plugins_url( 'assets/images/no-image.jpg', dirname(__FILE__) );
                                }
                        ?>
                            
                                <img width="100%" src="<?php echo $post_thumbnail_url; ?>" alt="">
                    </div>
                    </a>
                    <div class="jtg-box-title">
                        <?php the_title(); ?>
                    </div>
                    <div class="jtg-box-status-type">
                        <span><?php echo $type; ?> - <?php echo $status; ?></span>
                    </div>

                    <div class="jtg-box-excerpt">
                    <?php 
                        $string = get_the_excerpt();
                        echo substr($string, 0, strrpos(substr($string, 0, 145), ' '));
                    ?>
                    </div>

                    <div class="jtg-box-details">
                        <div class="jtg-box-details-left">
                            <?php
                                $currency_options = get_option('pm_importer_options');
                                $currency = $currency_options['jtg_currency'];
                                $currency_info = jtg_currency_symbol($currency);
                                $currency_symbol = $currency_info['symbol'];
                                $currency_icon = $currency_info['icon_class'];
                                if ($property_details['price'][0] == 0) {
                                    echo '<span class="jtg-box-detail-item">Price on Request</span>';
                                } elseif (!$property_details['price'][0]) {
                                    echo '<span class="jtg-box-detail-item">Price on Request</span>';
                                } else {
                                    echo '<span class="jtg-box-detail-item">'.$currency_symbol.' '.number_format($property_details['price'][0], 0).'</span>';
                                }

                                if ($property_details['price_term'][0]) {
                                    echo '<span class="jtg-box-detail-item"> / '.$property_details['price_term'][0].'</span>';
                                }
                            ?>
        

                            </div>
                            <div class="jtg-box-details-right">
                            <?php

                            if ($property_details['bedrooms'][0]) {
                                echo '<span class="jtg-box-detail-item"><i class="fa fa-bed"></i> '.$property_details['bedrooms'][0].'</span>';
                            }
                            if ($property_details['bathrooms'][0]) {
                                echo '<span class="jtg-box-detail-item"><i class="fa fa-bath"></i> '.$property_details['bathrooms'][0].'</span>';
                            }

                        ?>

                        

                        <?php
                        // Call the helper function to check the BER and assign an image - includes/helpers.php
                            $ber_img = jtg_ber_image($property_details['ber_rating'][0]);
                            
                            if ($ber_img) {
                                if (strpos($ber_img, 'on_request') == true) {
                                    $ber_width = '80px';
                                } else {
                                    $ber_width = '50px';
                                }
                        ?>
                                <span class="jtg-box-detail-item" style="margin-right: 0px;"><i class="fa fa-thermometer-empty"></i> <?php echo '<img width="'.$ber_width.'" src="'.$ber_img.'">'; ?></span>
                        <?php
                        }
                        ?>
                        </div>
                    </div>

</div>
</li>