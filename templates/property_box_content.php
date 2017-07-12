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
        <div class="jtg-col-1-<?php echo $column_option; ?>">
            <a href="<?php the_permalink(); ?>">
                <div class="jtg-property-box" >
                                            <?php 
                                                if ($style == 3 || $style == 4) {
                                            ?>
                                                <div class="jtg-pb-title"><?php the_title(); ?></div>
                                            <?php
                                                }
                                            ?>
                        <?php 
                        if ($style == 1 || $style == 2 | $style == 3) {
                             ?>
                             <div class="jtg-pb-top">
                                <span class="jtg-pb-top-status"><?php echo $status; ?></span>
                                <span class="jtg-pb-top-type"><?php echo $type; ?></span>
                            </div>
                        <?php
                         } ?>
                        <div class="jtg-pb-image">
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
                        <?php 
                        if ($style == 4) {
                             ?>
                             <div class="jtg-pb-top">
                             <span class="jtg-pb-top-type"><?php echo $type; ?></span>
                                <span class="jtg-pb-top-status"><?php echo $status; ?></span>
                                
                            </div>
                        <?php
                         } ?>

                        <?php 
                            if ($style == 4) {
                        ?>
                            
                            <div class="jtg-pb-excerpt">
                                <?php 
                                    $string = get_the_excerpt();
                                    echo substr($string, 0, strrpos(substr($string, 0, 160), ' '));
                                ?>
                            </div>
                        <?php
                            }
                        ?>



                        <div class=" jtg-pb-details-box">
                        <?php 
                            if ($column_option == 4) {
                                echo '<br>';
                            }
                        ?>
                            <?php 
                            if ($property_details['_bedrooms'][0]) {
                                echo '<span class="jtg-pb-details"><i class="fa fa-bed"></i> '.$property_details['_bedrooms'][0].'</span>';
                            }
                            if ($property_details['_bathrooms'][0]) {
                                echo '<span class="jtg-pb-details"><i class="fa fa-bath"></i> '.$property_details['_bedrooms'][0].'</span>';
                            }

                        ?>

                        <?php if ($property_details['_price'][0] == 0.00): ?>
                                <span class="jtg-pb-details" ><i class="fa fa-eur"></i>On Request</span>
                            <?php else : ?>
                                <span class="jtg-pb-details" ><i class="fa fa-eur"></i> <?php echo number_format($property_details['_price'][0], 0); ?></span>
                            <?php endif ?>

                        <?php
                        // Call the helper function to check the BER and assign an image - includes/helpers.php
                            $ber_img = jtg_ber_image($property_details['ber'][0]);
                            
                            if ($ber_img) {
                        ?>
                                <span class="jtg-pb-details" style="margin-right: 0px;"><i class="fa fa-thermometer-empty"></i> <?php echo '<img src="'.$ber_img.'">'; ?></span>
                        <?php
                        } else {
                        ?>
                                <span class="jtg-pb-details" style="font-weight: normal!important;"><i class="fa fa-thermometer-empty"></i> pending</span>
                        <?php
                        }
                        ?>

                        
                        

                        </div>
                        
                        <?php 
                            if ($style == 1 || $style == 2) {
                        ?>
                            <div class="jtg-pb-title"><?php the_title(); ?></div>
                        <?php
                            }
                        ?>
                        <?php 
                            if ($style == 3 || $style == 4) {
                                //  do nada
                            } else {
                        ?>
                            <div class="jtg-pb-excerpt">
                                <?php 
                                    $string = get_the_excerpt();
                                    echo substr($string, 0, strrpos(substr($string, 0, 160), ' '));
                                ?>
                            </div>
                        <?php        
                            }
                        ?>
                        </div>
                        </a>
                </div>
            
