<?php
get_header();
wp_enqueue_style('jtg-select2-style');
?>

<style>
    body {
        background-color: #51c5d8!important;
    }
    #map {
        height: 665px;
        width: 100%;
    }
	
    .property-box {
    	flex-basis: 43%;
    	padding:10px;
    	margin: 10px;
    	background-color: #fff;
    	box-sizing: border;
    	text-align: center;
    }
    @media (max-width: 500px){
    	.property-box {
    		flex-basis: 100%;
    	}
    	.jtg-select-wrap {
    		margin-bottom: 15px;
    		text-align: center;
    	}
    }
    .property-box img {
		margin: 10px 0px;
		max-height: 215px;
    }

    .property-title {
		font-weight: bold;
    }
    .jtg-select-wrap {
	display: flex;
    justify-content: center;
}

.jtg-select-wrap select {
    	width: 80%!important;
    }

.jtg-select-wrap input[type=text] {
	height: 35px;
	width: 80%;
	color: #777;
}
</style>
<div class="jtg-row jtg-clearfix" style="margin-top:120px">
    <div class="jtg-col-1-2"  style="border-right: solid 5px #fff;">
        <div id="map"></div>
    </div>
    <!-- NEXT COLUMN -->
    <div class="jtg-col-1-2">

    <div class="jtg-row jtg-clearfix" style="margin-top: 25px;">
        <div class="jtg-col-1-3">
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
        <div class="jtg-col-1-3">
            <div class="jtg-select-wrap">
            <?php
                            echo '<select id="property_area_select" style="width:80%;" name="location_area" class="">';
                            echo '<option value="" selected disabled>Any Area</option>';
                            echo '</select>';
                            ?>
            </div>
        </div>
        <div class="jtg-col-1-3">
            <button type="button" id="jtg-run-search" class="jtg-search-sc-btn">UPDATE SEARCH</button>
        </div>
    </div>













        
        <div id="jtg-search-response" style="display: flex; flex-wrap: wrap; max-height: 600px; overflow: scroll;">
            
        </div>

        <script>
            jQuery(document).ready(function($){
    // var $loading = $('#jtg-manual-import-spinner').hide();
    // $loading.hide();
    /**
     * When your ajax trigger button is clicked 
     * (if the button's class is .my-button)
     *
     */
    $( document ).on( 'click', '#jtg-run-search', function(event){
        

        // if ($('#property_status').val()) {
        //     var property_status = $('#property_status').val();
        //     push(data, {property_status:property_status})
        // }

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

                	$("#jtg-search-response").append('<div class="property-box"><a href="' + response[i].link + '"><div class="property-title">' + response[i].title + '<br><img width="100%" src="' + response[i].img_url + '"></div></a></div>');

                }

                if (response == null) {
                	$("#jtg-search-response").append('<div>Nothing to show</div>');
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
        zoom: 7,
        center: new google.maps.LatLng(53.400947, -7.638369),
        scrollwheel: false,
        scaleControl: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#51c5d8"},{"visibility":"on"}]}],
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
$('#jtg-run-search').click();
});
        </script>
    </div>
</div>
<!-- Get the Properties -->

<!-- Build Google Maps -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-marker-clusterer/1.0.0/markerclusterer.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGAKMgvQocW0aG9EfakJGYZ2b5YGUnNNg"></script>
<script type="text/javascript">
</script>
<?php wp_enqueue_script('jtg-counties-areas'); ?>
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
wp_enqueue_script('jtg-select2-script');
wp_reset_postdata();
?>
<?php get_footer(); ?>