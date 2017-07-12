<?php 
function jtg_half_map_search(){
    ob_start();
    ?>
    <style>
        #map {
            height: 615px;
            width: 100%;
        }
        /* Hide all but the first 4 results */
        #jtg-search-response > div:nth-of-type(1n+5) {
            display: none;
        }
        .property-box {
            border: solid 1px #51c5d8;
            background-color: #fff;
            text-align: center;
        }
        .property-box img {
            margin: 10px 0px;
            max-height: 215px;
        }
        .property-title {
            font-weight: bold;
        }
        .property-search i {
            color: #51c5d8!important;
        }
        .custom-select, .jtg-search-sc-btn {
            border-radius: 0px!important;
        }

        .property-box a {
            text-decoration: none!important;
            color: #51c5d8;
        }

        .property-box a:hover, .property-box a:active, .property-box a:focus, .property-box a:visited {
            text-decoration: none!important;
            color: #51c5d8;
        }
        

        .property-title {
            background-color: #51c5d8;
            color: #fff;
            padding: 7.5px 12.5px;
        }


        .property-type {
            background-color: #000;
            color: #fff;
            padding: 7.5px 12.5px;
        }

        .property-status, .property-price {
            border: 1px solid #51c5d8;
padding: 7.5px 12.5px;
        }


    </style>
    <div class="pd-bootstrap" id="property-search">
        <div class="col-md-12 mb-5">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class=" mt-2">
                        <?php 
                        global $wpdb;
                        $jtg_table_name = $wpdb->prefix.'postmeta';
                        $select = '<select id="property_county_select" name="location_county" class="custom-select">';
                        $select .= '<option value"">Any County</option>';
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
                <div class="col-md-4 text-center">
                    <div class=" mt-2">
                        <?php
                        echo '<select id="property_area_select" name="location_area" class="custom-select" >';
                        echo '<option value="" selected disabled>Any Area</option>';
                        echo '</select>';
                        ?>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class=" mt-2">
                        <select name="bedrooms" id="property_bedrooms" class="custom-select">
                            <option disabled selected>Beds</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class=" mt-2">
                        <select id="min_price" class="custom-select">
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
                <div class="col-md-4 text-center">
                    <div class=" mt-2">
                        <select id="max_price" class="custom-select">
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
                <div class="col-md-4 text-center">
                    <div class=" mt-2">
                        <button type="button" id="jtg-run-search" style="width:80%" class="jtg-search-sc-btn">UPDATE SEARCH</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pl-2 pr-2 " >
            <div class="col-md-6">
                <div id="map"></div>
            </div>
            <div class="col-md-6 text-center">
                <div class="row mt-0" id="jtg-search-response"></div>
                <button type="button" id="loadMore" style="width: 50%" class="jtg-search-sc-btn">Load More</button>
            </div>
        </div>
    </div>

    <?php 

        $auto_county = get_option('pm_importer_options');
        $auto_county = $auto_county['jtg_auto_select_county'];

     ?>

     <?php echo $auto_county ?>
    <script>
        jQuery(document).ready(function($){

            if ('<?php echo $auto_county ?>' != 'no-auto-select') {

$(document).ready(function(){
$('option:contains("<?php echo $auto_county ?>")', '#property_county_select').prop('selected', true).change();
});

}

            $( document ).on( 'click', '#jtg-run-search', function(event){
                var data = {
                    action: 'ajax_property_search',
                }
                if ($('#property_county_select').val()) {
                    var location_county = $('#property_county_select').val();
                    data['location_county'] = location_county;
                }
                if ($('#property_area_select').val()) {
                    var location_area = $('#property_area_select').val();
                    data['location_area'] = location_area;
                }
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    data: data,
                    url: ajaxurl, 
                    success: function (response) {
                        console.log(response);
                        $("#jtg-search-response").empty();
                        for (i = 0; i < response.length; i++) {
                            $("#jtg-search-response").append('<div class="col-6 mb-4" id="property_box"><div class="property-box p-4"><a href="' + response[i].link + '"><div class="property-title">' + response[i].title + '</div><div class="property-thumb"><img width="100%" src="' + response[i].img_url + '"></div><div class="property-type">' + response[i].type + '</div><div class="row property-details text-center mt-3"><div class="col-6 property-status">' + response[i].status + '</div><div class="col-6 property-price">€' + response[i].price + '</div></div></a></div></div>');
                        }
                        if (response == null) {
                            $("#jtg-search-response").append('<div>There are no results matching your search query, please try again.</div>');
                        }
                        var res = response;
                        gmapss(res);
                    }
                }).fail(function (data) {
                    console.log(data);
                }); 
            });
            function gmapss (res){
                var infos = [];
                var locations = res;
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 10,
                    center: new google.maps.LatLng(52.842910, -9.432266),
                    scrollwheel: false,
                    scaleControl: true,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
// styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#51c5d8"},{"visibility":"on"}]}],
mapTypeControl: false,
zoomControl: true,
zoomControlOptions: {
    position: google.maps.ControlPosition.LEFT_BOTTOM
},
scaleControl: true,
streetViewControl: true,
streetViewControlOptions: {
    position: google.maps.ControlPosition.LEFT_TOP
},
fullscreenControl: true,
fullscreenControlOptions: {
    position: google.maps.ControlPosition.TOP_LEFT
}
});
                var icon_image = {
                    url: '<?php echo plugins_url( 'assets/images/map_marker_sized.png', dirname(__FILE__) ); ?>',
                };
                var gmarkers = [];
                for (i = 0; i < locations.length; i++) {
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i].lat, locations[i].lng),
                        draggable: false,
                        icon: icon_image,
                        title: locations[i].title,
                        map: map
                    });
                    var content = '<div><a href="' + locations[i].link + '">' + locations[i].title + '<br><br><img width="150px" src="' + locations[i].img_url + '"></div>'
                    var infowindow = new google.maps.InfoWindow();
                    google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
                        return function() {
                            closeInfos();
                            infowindow.setContent(content);
                            infowindow.open(map,marker);
                            infos[0]=infowindow;
                        };
                    })(marker,content,infowindow));
                    gmarkers.push(marker);
                }
                function closeInfos(){
                    if(infos.length > 0){
                        infos[0].set('marker', null);
                        infos[0].close();
                        infos.length = 0;
                    }
                }
                var markerCluster = new MarkerClusterer(map, gmarkers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
            }
        });
    </script>
    <script>
        jQuery(document).ready(function($){
            $("#loadMore").on('click', function (e) {
                e.preventDefault();
                $("#jtg-search-response > div:hidden").slice(0, 4).slideDown();
                $('html,body').animate({
                    scrollTop: $(this).offset().top
                }, 1500);
            });
            $('a[href=#top]').click(function () {
                $('body,html').animate({
                    scrollTop: 0
                }, 600);
                return false;
            });
            $(window).scroll(function () {
                if ($(this).scrollTop() > 50) {
                    $('.totop a').fadeIn();
                } else {
                    $('.totop a').fadeOut();
                }
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-marker-clusterer/1.0.0/markerclusterer.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGAKMgvQocW0aG9EfakJGYZ2b5YGUnNNg"></script>
    <script type="text/javascript">
    </script>
    <?php wp_enqueue_script('jtg-counties-areas');
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('half_map_search', 'jtg_half_map_search');