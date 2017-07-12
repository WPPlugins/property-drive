<?php
function jtg_sold_properties_grid($atts, $content = null){

    $a = shortcode_atts( array(
    'title' => 'My Title',
    'columns' => 2,
), $atts );

if ($a['columns'] == 2) {
    ?> 
    <style>
        .jtg-grid-item {
            flex-basis: 49%;
        }
    </style>

    <?php
}
// Begin the object to be returned
    ob_start();

// Setup the query
    global $wp_query;

    $col_opt = get_option('pm_property_results_options');
    $col_opt = $col_opt['results_grid_columns'];

    $query_args_meta = array(
        'posts_per_page' => 12,
        'post_type' => 'property',
        'post_status' => 'publish',
        'tax_query' => array(
                array(
                    'taxonomy' => 'property_status',
                    'field' => 'slug',
                    'terms' => array('sold', 'sale-agreed'),
                ),
            ),
        );

// Execute the query
    $query = new WP_Query($query_args_meta);

// Style option selector
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

// Grid / Column option selector
    $grid_option = get_option('pm_property_results_options');
    $column_option = $grid_option['results_grid_columns'] ?? '3';

    $style_option = get_option('pm_property_results_options');
    $style = $style_option['property_box_style'];

// Title on or off option
    $title_option = get_option('pm_design_options');
    $title = $title_option['featured_title'];

    if ($title == 'true') {
    ?>
    <div class="jtg-row jtg-clearfix" style="margin-bottom: -5px;">
        <div class="jtg-col-1-1" >
            <div class="jtg-featured-title">

            <?php 
            $options_featured = get_option('pm_design_options');
            $featured_title = $options_featured['property_grid_title'];
            ?>
                <h5 style=""><?php echo $a['title'] ?></h5>
            </div>
        </div>
    </div>

        <?php
    }
?>
<?php   
    $grid_option = get_option('pm_property_results_options');
    $column_option = $grid_option['results_grid_columns'] ?? '3';

    $style_option = get_option('pm_property_results_options');

    $style = $style_option['property_box_style'];
?>
<div class="jtg-row jtg-clearfix">
<ul class="jtg-grid-wrap" style="list-style: none!important;">
<?php 

    if ( $query->have_posts() ) : while ($query->have_posts()) : $query->the_post();
   
                    $plugin_dir = plugin_dir_path(__DIR__).'templates/';

                    // print_r($plugin_dir);
                    if ($style == 1) {
                        include($plugin_dir.'property_box_1.php');
                    } elseif ($style == 2) {
                        echo '
                            <style>
                                .jtg-box-detail-item img {
                                    bottom: 1px!important;
                                }
                            </style>
                        ';
                        include($plugin_dir.'property_box_2.php');
                    } elseif ($style == 3) {
                        echo '
                            <style>
                                .jtg-box-detail-item img {
                                    bottom: 1px!important;
                                }
                            </style>
                        ';
                        include($plugin_dir.'property_box_3.php');
                    } else {
                        include($plugin_dir.'property_box_1.php');
                    }


?>
<?php endwhile; ?>
</ul>
</div>
<?php wp_reset_postdata(); ?>
<!-- View More Section -->
<!-- Begin Row -->

    <?php 
    $options = get_option('pm_design_options');
    $featured_title = $options['show_view_more'];
        if ($featured_title == 'true') {
            ?>
            <div class="jtg-row jtg-clearfix">
                <div class="col-1-1" style="text-align: center; margin-top: 40px; margin-bottom: 40px;">
                    <a href="/properties" class="jtg-view-more-btn">View More</a>
                </div>
            </div>

    <?php
        }

    ?>
<!-- End of Row -->
<?php else : ?>
    <!-- No Results Found Section -->
    <div class="jtg-row jtg-clearfix">
        <div class="jtg-col-1-1" style="text-align: center;">
            <h1>No Results Found</h1>
                <h4>It appears there are no properties to display here. Please add some to enable the property grid box</h4>
                    <i style="font-size: 32px;" class="fa fa-warning" aria-hidden="true"></i>
        </div>
    </div>
<?php endif; ?>
<?php
// Return the cleaned object as per WP codex
return ob_get_clean();
}
add_shortcode('jtg_sold_properties', 'jtg_sold_properties_grid');