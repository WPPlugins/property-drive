<?php 
function jtg_search_type_3_shortcode(){
    ob_start();
    wp_enqueue_style('jtg-select2-style');
    wp_enqueue_style('jtg-search-type-3');
    wp_enqueue_style('jtg-light-slider-styles');
    ?>

    <div class="search_type_3">
        <ul id="lightSlider" class="cS-hidden search_3_slide" style="margin-left: 0px!important;">
            <?php 

            $search_type_3_options = get_option('search_type_3_options');

            $slides = $search_type_3_options['search_type_3_images'];
            $slides = explode(',',$slides);
            foreach ($slides as $slide) {
                echo '<li style="margin-left: 0px!important;" data-thumb="'.$slide.'"><img width="100%" src="'.$slide.'"></li>';
            }
            ?>
        </ul>
        <div class="search_type_3_inner">
            <form method="get" action="/properties">
                <div class="property-tabs-wrapper">
                    <button type="button" id="type_residential" class="property-type-tab" >Residential</button>
                    <button type="button" id="type_commercial" class="property-type-tab" >Commercial</button>
                </div>
                <div class="pd-row pd-center-xs">
                    <div class="pd-col-md-4 pd-col-xs-12">
                        <input type="hidden" id="property_type" name="group_type">
                        <div class="jtg-select-wrap">
                            <input type="text" id="keyword" name="property_keyword" placeholder="Keyword">
                        </div>
                    </div>
                    <div class="pd-col-md-4 pd-col-xs-12">
                        <div class="jtg-select-wrap">
                            <?php 
                            global $wpdb;
                            $jtg_table_name = $wpdb->prefix.'postmeta';
                            $select = '<select id="property_county_select" style="width:80%;" name="location_county" class="">';
                            $select .= '<option value"" selected disabled>Any County</option>';
                            $counties = $wpdb->get_results("SELECT DISTINCT meta_value from $jtg_table_name where meta_key='county' ORDER BY meta_value ASC");
                            foreach ($counties as $county) {
                                $county_details = jtg_county_id($county->meta_value);
                                $option = '<option value="'. $county_details['county_id'] .'">';
                                $option .= $county_details['county_name'];
                                $option .= '</option>';
                                $select .= $option;
                            }
                            $select .= '</select>';
                            echo $select;
                            ?>
                        </div>
                    </div>
                    <div class="pd-col-md-4 pd-col-xs-12">
                        <div class="jtg-select-wrap">
                            <?php
                            echo '<select id="property_area_select" style="width:80%;" name="location_area" class="">';
                            echo '<option value="" selected disabled>Any Area</option>';
                            echo '</select>';
                            ?>
                        </div>
                    </div>
                </div>
                <div class="pd-row pd-center-xs">
                    <style>
                        div#price-range {
                            position: relative;
                            bottom: -10px;
                        }
                        .noUi-horizontal .noUi-tooltip {
                            bottom: -155%;
                        }

                    </style>
                    <div class="pd-col-md-8 pd-col-xs-12">
                        <div id="price-range"></div>
                        <input type="hidden" name="min_price" id="min_price" value="">
                        <input type="hidden" name="max_price" id="max_price" value="">
                    </div>
                    <div class="pd-col-md-4 pd-col-xs-12" style="text-align: center;" >
                        <button type="submit" style="" class="jtg-search-sc-btn" style="margin-top: -20px!important;"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php wp_enqueue_script('jtg-counties-areas'); ?>
    <script>
        jQuery(document).ready(function($) { 
            $('#lightSlider').lightSlider({
                gallery:false,
                item:1,
                loop:true,
                auto: true,
                speed: 1000,
                pause: <?php echo $search_type_3_options['slider_pause_time'] ?? '5000' ?>,
                thumbItem:0,
                slideMargin:0,
                enableDrag: false,
                currentPagerPosition:'center',
                controls: false,
                pager: false,
                mode: "slide",
                useCSS: true,
                cssEasing: 'ease',
                easing: 'linear',
                onSliderLoad: function() {
                    $('#lightSlider').removeClass('cS-hidden');
                }
            });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function($) { 
            $(document).ready(function() {
                $("#property_status_select").select2({
                });
            });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function($) { 
            $(document).ready(function() {
                $("#property_county_select").select2({
                });
            });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function($) { 
            $(document).ready(function() {
                $("#property_area_select").select2({
                });
            });
        });
    </script>
    <?php 
    global $wpdb;
    $jtg_table_name = $wpdb->prefix.'postmeta';
    $max_price_in_db = $wpdb->get_results("SELECT max( cast(meta_value as unsigned)) as meta_value FROM $jtg_table_name WHERE meta_key='price'");
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) { 
            var rangeSlider = document.getElementById('price-range');
            noUiSlider.create(rangeSlider, {
                start: [0, <?php echo $max_price_in_db[0]->meta_value; ?>],
                connect: true,
                step: 10000,
                tooltips: [ true, true ],
                range: {
                    'min': [0],
                    'max': [<?php echo $max_price_in_db[0]->meta_value; ?>]
                }
            });
            var stepSliderValueElement = [document.getElementById('min_price'),
            document.getElementById('max_price')
            ];
            rangeSlider.noUiSlider.on('update', function(values, handle) {
                stepSliderValueElement[0].value = values[0];
                stepSliderValueElement[1].value = values[1];
            });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function($) { 
            $('#type_residential').click(function(){
                $('#property_type').val('pm_residential');
                $('#type_residential').toggleClass('active');
                $('#type_commercial').removeClass('active');
            });
            $('#type_commercial').click(function(){
                $('#property_type').val('pm_commercial');
                $('#type_commercial').toggleClass('active');
                $('#type_residential').removeClass('active');
            });
            $('#type_residential').trigger("click");
        });
    </script>

    <div class="listing-spacer"></div>
    <?php
    wp_enqueue_script('jtg-select2-script');
    wp_enqueue_script('jtg-light-slider-scripts');
    return ob_get_clean();
}
add_shortcode('jtg_search_type_3', 'jtg_search_type_3_shortcode');