<?php
////////////////////////////////////////////////////////////////////////////////////////////////
// Property Search v2
////////////////////////////////////////////////////////////////////////////////////////////////
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$meta_query = array();
if ($_GET['group_type'] == 'pm_commercial') {
    $commercial = array(
        'industrial',
        'industrial-distribution',
        'office',
        'retail',
        'warehouse',
        'site',
        'development-site',
        'site-individual'
        );
    $tax_query = array(
        array(
            'taxonomy' => 'property_type',
            'field' => 'slug',
            'terms' => $commercial,
            )
        );
} elseif ($_GET['group_type'] == 'pm_residential') {
    $residential = array(
        'house',
        'apartment',
        'flat',
        'studio',
        'duplex'
        );
    $tax_query = array(
        array(
            'taxonomy' => 'property_type',
            'field' => 'slug',
            'terms' => $residential,
            )
        );
}
if (isset($_GET['property_type'])) {
    $tax_query = array(
        array(
            'taxonomy' => 'property_type',
            'field' => 'slug',
            'terms' => $_GET['property_type'],
            )
        );
}
if (isset($_GET['property_status'])) {
    $tax_query = array(
        array(
            'taxonomy' => 'property_status',
            'field' => 'slug',
            'terms' => $_GET['property_status'],
            )
        );
}
if (isset($_GET['location_area'])) {
    $meta_query[] = array(
        'key' => 'area',
        'value' => $location_area,
        'compare' => '='
        );
}
if ($location_county == '1') {
    $location_county = 'Dublin';
} elseif ($location_county == '2') {
    $location_county = 'Meath';
} elseif ($location_county == '3') {
    $location_county = 'Kildare';
} elseif ($location_county == '4') {
    $location_county = 'Wicklow';
} elseif ($location_county == '5') {
    $location_county = 'Longford';
} elseif ($location_county == '6') {
    $location_county = 'Offaly';
} elseif ($location_county == '7') {
    $location_county = 'Westmeath';
} elseif ($location_county == '8') {
    $location_county = 'Laois';
} elseif ($location_county == '9') {
    $location_county = 'Louth';
} elseif ($location_county == '10') {
    $location_county = 'Carlow';
} elseif ($location_county == '11') {
    $location_county = 'Kilkenny';
} elseif ($location_county == '12') {
    $location_county = 'Waterford';
} elseif ($location_county == '13') {
    $location_county = 'Wexford';
} elseif ($location_county == '14') {
    $location_county = 'Kerry';
} elseif ($location_county == '15') {
    $location_county = 'Cork';
} elseif ($location_county == '16') {
    $location_county = 'Clare';
} elseif ($location_county == '17') {
    $location_county = 'Limerick';
} elseif ($location_county == '18') {
    $location_county = 'Tipperary';
} elseif ($location_county == '19') {
    $location_county = 'Galway';
} elseif ($location_county == '20') {
    $location_county = 'Mayo';
} elseif ($location_county == '21') {
    $location_county = 'Roscommon';
} elseif ($location_county == '22') {
    $location_county = 'Sligo';
} elseif ($location_county == '23') {
    $location_county = 'Leitrim';
} elseif ($location_county == '24') {
    $location_county = 'Donegal';
} elseif ($location_county == '25') {
    $location_county = 'Cavan';
} elseif ($location_county == '26') {
    $location_county = 'Monaghan';
}
if (isset($location_county)) {
    $meta_query[] = array(
        'key' => 'county',
        'value' => $location_county,
        'compare' => '='
        );
}
if (isset($_GET['bedrooms'])) {
    $meta_query[] = array(
        'key' => 'bedrooms',
        'type' => 'NUMERIC',
        'value' => $bedrooms,
        'compare' => '>='
        );
}
if (isset($min_price) && isset($max_price)) {
    $meta_query[] = array(
        'key' => 'price',
        'value' => array($min_price, $max_price ),
        'type' => 'NUMERIC',
        'compare' => 'BETWEEN'
        );
}


$args = array(
    'paged' => $paged,
    'posts_per_page' => 12,
    'post_status' => 'publish',
    'post_type' => 'property',
    'orderby' => 'meta_value',
    'meta_key' => 'property_status',
    'order' => 'ASC',
    'tax_query' => $tax_query,
    'meta_query' => $meta_query
    );
if (isset($_GET['property_keyword'])) {
    $args['s']= $_GET['property_keyword'];
}
$query = new WP_Query( $args );
////////////////////////////////////////////////////////////////////////////////////////////////
// End of Custom Query
////////////////////////////////////////////////////////////////////////////////////////////////
get_header();

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

<div class="pd-page pd-bootstrap">


    <div class="container">
        <section id="grid-page-search">

                <?php 
                $options = get_option('pm_search_options');
                $set_sc = '[jtg_search_type_'.$options['search_type'].']';

                echo do_shortcode("$set_sc"); 
                ?>

            <?php
            $pro_version_enabled = get_option( 'property_drive_pro' );
            if ( is_user_logged_in() && current_user_can( 'edit_posts' ) && $pro_version_enabled == 'true') {
                $dir = plugin_dir_url( __DIR__ );
                wp_register_script('jtg-search-alert-js', $dir.'assets/js/search_alerts.js');
                wp_enqueue_script('jtg-search-alert-js');
                ?>
                <div>
                    <form>
                        <?php echo '<input type="hidden" name="jtg-ajax-nonce" id="jtg-ajax-nonce" value="' . wp_create_nonce( 'jtg-ajax-nonce' ) . '" />'; ?>
                        <input type="hidden" id="property_user_id" value="<?php echo get_current_user_id() ?>">
                        <input type="hidden" id="property_type" value="<?php echo get_query_var('property_type') ?>">
                        <input type="hidden" id="property_status" value="<?php echo get_query_var('property_status') ?>">
                        <input type="hidden" id="property_price_min" value="<?php echo get_query_var('min_price') ?>">
                        <input type="hidden" id="property_price_max" value="<?php echo get_query_var('max_price') ?>">
                        <input type="hidden" id="property_bedrooms" value="<?php echo get_query_var('bedrooms') ?>">
                        <input type="hidden" id="property_bathrooms" value="<?php echo get_query_var('bathrooms') ?>">
                        <input type="hidden" id="property_area" value="<?php echo get_query_var('location_area') ?>">
                        <input type="hidden" id="property_county" value="<?php echo get_query_var('location_county') ?>">
                        <button type="button" id="jtg-save-this-search" class="jtg-save-search-button">Save Search Alert</button>
                    </form>
                </div>
                <?php
            }
            ?>
        </section>
    

    <?php   
    $grid_option = get_option('pm_property_results_options');
    $column_option = $grid_option['results_grid_columns'] ?? '3';

    $style_option = get_option('pm_property_results_options');

    $style = $style_option['property_box_style'];
    ?>

    <ul class="jtg-grid-wrap">
        <?php 

        if ( $query->have_posts() ) : while ($query->have_posts()) : $query->the_post();


        if ($style == 1) {
            include('property_box_1.php');
        } elseif ($style == 2) {
            include('property_box_2.php');
        } elseif ($style == 3) {
            include('property_box_3.php');
        } else {
            include('property_box_1.php');
        }


        ?>
    <?php endwhile; ?>
</ul>
<style>
    .prev-next-posts {
        width: 100%;
    }
    .prev-next-posts a {

        background-color: #000;
        color: #fff;
        padding: 10px 20px;

        font-weight: bold;
        text-decoration: none!important;
        margin-right: 5px;
        margin-bottom: 5px;
    }

    .prev-next-posts a:hover {
        color: #fff;
    }


    .prev-posts-link, .next-posts-link {
        display: inline-block;
    }
</style>

<?php if ($query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
  <div class="pd-bootstrap" style="margin-bottom: 50px; text-align: right">
      <nav class="prev-next-posts">
 <div class="row">
     <div class="col-md-12">
          <div class="next-posts-link">
      <?php echo get_previous_posts_link( 'Previous' ); // display newer posts link ?>
    </div>
    <div class="prev-posts-link">
      <?php echo get_next_posts_link( 'Next', $query->max_num_pages ); // display older posts link ?>
    </div>
     </div>
 </div>
    
  </nav>
  </div>
<?php } ?>
<?php wp_reset_postdata(); ?>


<?php else : ?>
    <!-- No posts found -->

    <div class="jtg-no-results">

        <div  style="text-align: center;">
            <?php $options = get_option('pm_agency_options'); ?>
            <h1>No Results Found</h1>
            <h4>It appears we have no results that match the query you tried, please try again using different search terms.</h4>
            <h4>Let's chat, we would love to hear from you and see how we can help.</h4>
            <h4>Call us on <?php echo $options['agency_phone']; ?></h4>

            <i style="font-size: 32px;" class="fa fa-phone" aria-hidden="true"></i>
        </div>
    </div>
<?php endif; ?>
</div>
</div>


<?php get_footer(); ?>