<div class="search-box-shortcode">
        <form method="get" action="/property">
        <div class="col-md-12">
                <?php 
                global $wpdb;
                $select = '<select name="property_status" class="form-control">';
                $select .= '<option value"" selected disabled>Select Property Status</option>';
                $terms = get_terms( 'property_status', 'hide_empty=0');
                foreach($terms as $row){

                    $option = '<option value="'. $row->slug .'">';
                    $option .= $row->name;
                    $option .= '</option>';

                    $select .= $option;
                }
                $select .= '</select>';
                echo $select;
                ?>
                <br>
        </div>
        <div class="col-md-12">
                <?php 
                global $wpdb;
                $select = '<select name="property_type" class="form-control">';
                $select .= '<option value"" selected disabled>Select Property Type</option>';
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
                <br>
            </div>
            
            <div class="col-md-12">
                <?php 
                global $wpdb;
                $select = '<select name="location_county" class="form-control">';
                $select .= '<option value"" selected disabled>Select County</option>';
                $prop_area = $wpdb->get_results("SELECT DISTINCT meta_value from wp_postmeta where meta_key='location_county' ORDER BY meta_value ASC");
                foreach($prop_area as $row){
                    $option = '<option value="'. $row->meta_value .'">';
                    $option .= $row->meta_value;
                    $option .= '</option>';
                    $select .= $option;
                }
                $select .= '</select>';
                echo $select;
                ?>
                <br>
            </div>
            
            <div class="col-md-12">
                <?php 
                global $wpdb;
                $select = '<select name="location_area" class="form-control">';
                $select .= '<option value"" selected disabled>Select Area</option>';
                $prop_area = $wpdb->get_results("SELECT DISTINCT meta_value from wp_postmeta where meta_key='location_area' ORDER BY meta_value ASC");
                foreach($prop_area as $row){
                    $option = '<option value="'. $row->meta_value .'">';
                    $option .= $row->meta_value;
                    $option .= '</option>';
                    $select .= $option;
                }
                $select .= '</select>';
                echo $select;
                ?>
                <br>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <!-- Bedrooms selection / works by doing 1+ / 2+ 3+ etc -->
                <select class="form-control" name="bedrooms">
                    <option disabled selected>Select Bedrooms</option>
                    <option value="1">1+</option>
                    <option value="2">2+</option>
                    <option value="3">3+</option>
                    <option value="4">4+</option>
                    <option value="5">5+</option>
                    <option value="6">6+</option>
                    <option value="7">7+</option>
                    <option value="8">8+</option>
                </select>
                <br>
            </div>
            <div class="col-md-12" style="margin-top: 50px; padding: 0px 40px;">
                <div id="price-range"></div>
                <input type="hidden" name="min_price" id="min_price" value="">
                <input type="hidden" name="max_price" id="max_price" value="">
            </div>
            <div class="col-md-12" >
                <br>
                <button type="submit" style="" class="pm-search-button btn btn-primary"><i class="fa fa-search-o"> </i>Search</button>
            </div>
        </form>
    </div>
    <?php 
    global $wpdb;
    $max_price_in_db = $wpdb->get_results("SELECT max( cast(meta_value as unsigned)) as meta_value FROM wp_postmeta WHERE meta_key='_price'");
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