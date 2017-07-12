<?php 
function jtg_search_type_4_shortcode(){
    ob_start();
    wp_enqueue_style('jtg-select2-style');
    wp_enqueue_style('jtg-search-type-4');
    ?>
    <div class="jtg_search_type_4">
        <div class="search_type_4_inner">
            
            <form method="get" action="/properties">
                <div class="pd-row pd-center-xs">
                <div class="pd-col-md-3">
                <div class="property-tabs-wrapper">
                        <button type="button" id="type_residential" class="property-type-tab" >Residential</button>
                <button type="button" id="type_commercial" class="property-type-tab" >Commercial</button>
                    </div>
                    </div>
                <div class="div pd-col-md-3">
                    <div class="">
                        <?php 
            global $wpdb;
            $options = get_option('pm_search_options');
                $select = '<select name="property_type" id="property_type_select" style="width:80%;" class="">';
                $select .= '<option value"" selected disabled>Any Property Type</option>';
                $terms = get_terms( 'property_type', 'hide_empty=0');

                foreach($terms as $row){
                    $option = '<option value="'. $row->slug .'">';
                    $option .= $row->name;
                    $option .= '</option>';
                    $select .= $option;
                }

            $select .= '</select>';
            echo $select;
            ?>
                    </div>
                </div>

                    <div class="pd-col-md-3">
                        <input type="hidden" id="property_type" name="group_type">
                        <div class="">
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
                    <div class="pd-col-md-3">
                        <div class="">
                            <?php
                            echo '<select id="property_area_select" style="width:80%;" name="location_area" class="">';
                            echo '<option value="" selected disabled>Any Area</option>';
                            echo '</select>';
                            ?>
                        </div>
                    </div>
                    
                </div>
                <div class="pd-row pd-center-xs" style="margin-top: -10px;">
                    <style>
                        div#price-range {
                            position: relative;
                            bottom: -10px;
                        }
                        .noUi-horizontal .noUi-tooltip {
                            bottom: -155%;
                        }

                    </style>
                   
                        <?php if ($price_type == 'slider'): ?>
                             <div class="jtg-col-3-4">
                            <div id="price-range"></div>
                                <input type="hidden" name="min_price" id="min_price" value="">
                                <input type="hidden" name="max_price" id="max_price" value="">
                                </div>

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
                        <?php else: ?>

                            <div class="pd-col-md-3">
                                <div class="">
                                    <select id="min_price" style="width:80%;">
                                <option selected disabled>Min Price</option>
                                <option value="10000">10,000</option>
                                <option value="20000">20,000</option>
                                <option value="50000">50,000</option>
                                <option value="75000">75,000</option>
                                <option value="100000">100,000</option>
                                <option value="200000">200,000</option>
                                <option value="300000">300,000</option>
                            </select>
                                </div>
                            </div>

                            <div class="pd-col-md-3">
                                <div class="">
                                    <select id="max_price" style="width:80%;">
                                <option selected disabled>Max Price</option>
                                <option value="10000">10,000</option>
                                <option value="20000">20,000</option>
                                <option value="50000">50,000</option>
                                <option value="75000">75,000</option>
                                <option value="100000">100,000</option>
                                <option value="200000">200,000</option>
                                <option value="300000">300,000</option>
                                <option value="400000">400,000</option>
                                <option value="500000">500,000</option>
                                <option value="600000">600,000</option>
                                <option value="700000">700,000</option>
                                <option value="800000">800,000</option>
                                <option value="900000">900,000</option>
                                <option value="1000000">1,000,000</option>
                            </select>
                                </div>
                            </div>

                            <div class="pd-col-md-3">
                                <div class="">
                            <input type="text" id="keyword" name="property_keyword" placeholder="Keyword">
                        </div>
                            </div>
                            
                        <?php endif ?>
                    
                    <div class="pd-col-md-3" style="text-align: center;" >
                        <button type="submit" style="" class="jtg-search-sc-btn" style="margin-top: -20px!important;"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php wp_enqueue_script('jtg-counties-areas'); ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) { 
            $(document).ready(function() {
                $("#property_type_select").select2({
                });
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
    
     <script type="text/javascript">
        jQuery(document).ready(function($) { 
            $(document).ready(function() {
                $("#min_price").select2({
                });
            });
        });
    </script>
     <script type="text/javascript">
        jQuery(document).ready(function($) { 
            $(document).ready(function() {
                $("#max_price").select2({
                });
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
    return ob_get_clean();
}
add_shortcode('jtg_search_type_4', 'jtg_search_type_4_shortcode');