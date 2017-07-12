<?php 
function jtg_search_type_2_shortcode(){
    ob_start();
    wp_enqueue_style('jtg-select2-style');
    ?>
        <div class="pd-bootstrap">
            <form method="get" action="/properties">
            <div class="row ">
                <div class="col-md-4">
                        <div class="col-10 offset-1 mt-3">
                            <?php 
                        global $wpdb;
                        $options = get_option('pm_search_options');
                        if ($options['search_grouping'] == 'true') {
                            $select = '<select id="property_type_select" name="group_type" class="form-control">';
                            $select .= '<option value"" selected disabled>Any Property Type</option>';

                            $select .= '<option value="pm_commercial">Commercial</option>';
                            $select .= '<option value="pm_residential">Residential</option>';
                        } else {
                            $select = '<select id="property_type_select" name="property_type" class="form-control">';
                            $select .= '<option value"" selected disabled>Any Property Type</option>';
                            $terms = get_terms( 'property_type', 'hide_empty=0');

                            foreach($terms as $row){
                                $option = '<option value="'. $row->slug .'">';
                                $option .= $row->name;
                                $option .= '</option>';
                                $select .= $option;
                            }
                        }
                        $select .= '</select>';
                        echo $select;
                        ?>
                        </div>
                </div>
                <div class="col-md-4">
                        <div class="col-10 offset-1 mt-3">
                            <?php 
                        global $wpdb;
                        $jtg_table_name = $wpdb->prefix.'postmeta';
                        $select = '<select id="property_county_select" name="location_county"  class="form-control">';
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
                <div class="col-md-4">
                        <div class="col-10 offset-1 mt-3">
                            <?php
                        echo '<select id="property_area_select" name="location_area"  class="form-control">';
                        echo '<option value="" selected disabled>Any Area</option>';
                        echo '</select>';
                        ?>
                        </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                        <div class="col-10 offset-1 mt-3">
                            <input type="text" id="keyword" name="property_keyword" placeholder="Keyword" class="form-control">
                        </div>
                </div>

                <div class="offset-md-4 col-md-4" style="text-align: center;" >
                    <div class="col-10 offset-1 mt-3">
                        <button type="submit" style="" class="jtg-search-sc-btn" style="margin-top: -20px!important;"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
            </div>
        </form>
        </div>

    <?php wp_enqueue_script('jtg-counties-areas'); ?>

    <?php
    wp_enqueue_script('jtg-select2-script');
    return ob_get_clean();
}
add_shortcode('jtg_search_type_2', 'jtg_search_type_2_shortcode');