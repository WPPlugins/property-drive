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


<div class="jtg-col-1-<?php echo $column_option ?>">
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
                          <?php 
                            if ($property_details['bedrooms'][0]) {
                                echo '<span class="jtg-box-detail-item"><i class="fa fa-bed"></i> '.$property_details['bedrooms'][0].'</span>';
                            }
                            if ($property_details['bathrooms'][0]) {
                                echo '<span class="jtg-box-detail-item"><i class="fa fa-bath"></i> '.$property_details['bathrooms'][0].'</span>';
                            }

                        ?>

                        <?php if ($property_details['price'][0] == 0.00): ?>
                                <span class="jtg-box-detail-item" ><i class="fa fa-eur"></i> On Request</span>
                            <?php else : ?>
                                <span class="jtg-box-detail-item" ><i class="fa fa-eur"></i> <?php echo number_format($property_details['price'][0], 0); ?></span>
                            <?php endif ?>

                        <?php
                        // Call the helper function to check the BER and assign an image - includes/helpers.php
                            $ber_img = jtg_ber_image($property_details['ber_rating'][0]);
                            
                            if ($ber_img) {
                        ?>
                                <span class="jtg-box-detail-item" style="margin-right: 0px;"><i class="fa fa-thermometer-empty"></i> <?php echo '<img width="50px" src="'.$ber_img.'">'; ?></span>
                        <?php
                        }
                        ?>
                    </div>

</div>
</div>