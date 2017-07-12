<?php 
function jtg_simple_map(){
	ob_start();
?>

			
<?php 
$query = array(
	'posts_per_page' => -1,
    'post_type' => 'property',
    'post_status' => 'publish'   
);
$loop = new WP_Query($query);

// while ( $loop->have_posts() ) : $loop->the_post();
while ( $loop->have_posts() ) : $loop->the_post();

	$post_thumbnail_id = get_post_thumbnail_id();

	if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
	  $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
	} else {
	    $post_thumbnail_url = plugins_url( 'assets/images/no-image.jpg', dirname(__FILE__) );
	}



	 $property = get_post_meta(get_the_id());
	 $title = get_the_title();
	 $link = get_the_permalink();
	 $lng = $property['longitude'][0];
	 $img_url = $post_thumbnail_url;
	 $lat = $property['latitude'][0];
	 $description = 'Something';
	 $locations[]=array('title' => $title,'lat'=>$lat, 'lng'=> $lng, 'link' => $link, 'img_url' => $img_url, 'description' => $description );
endwhile;
$markers = json_encode( $locations );

$icon_url = plugins_url( 'assets/images/map_marker_sized.png', dirname(__FILE__) );
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/js-marker-clusterer/1.0.0/markerclusterer.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGAKMgvQocW0aG9EfakJGYZ2b5YGUnNNg"></script>

 <style>
          #map {
            height: 450px;
            width: 100%;
           }
        </style>
<div id="map"></div>
    <script type="text/javascript">
var infos = [];

    var locations = <?php echo $markers; ?>;

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
    url: '<?php echo $icon_url; ?>',
    // This marker is 20 pixels wide by 32 pixels high.
    // size: new google.maps.Size(25, 50)
    // The origin for this image is (0, 0).
    // origin: new google.maps.Point(0, 0),
    // // The anchor for this image is the base of the flagpole at (0, 32).
    // anchor: new google.maps.Point(0, 32)
  };

        var gmarkers = [];
    for (i = 0; i < locations.length; i++) {

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i].lat, locations[i].lng),
            draggable: false,
            icon: icon_image,
            title: locations[i].title,
            animation: google.maps.Animation.DROP,
            map: map
        });

        var content = '<div><a href="' + locations[i].link + '">' + locations[i].title + '<br><br><img width="150px" src="' + locations[i].img_url + '"></div>'

        var infowindow = new google.maps.InfoWindow();

        google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
            return function() {
                /* close the previous info-window */
                closeInfos();
                infowindow.setContent(content);
                infowindow.open(map,marker);
                /* keep the handle, in order to close it on next click event */
                infos[0]=infowindow;
            };
        })(marker,content,infowindow));
        gmarkers.push(marker);
    }

    function closeInfos(){
       if(infos.length > 0){
          /* detach the info-window from the marker ... undocumented in the API docs */
          infos[0].set('marker', null);
          /* and close it */
          infos[0].close();
          /* blank the array */
          infos.length = 0;
       }
    }

    var markerCluster = new MarkerClusterer(map, gmarkers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    </script>
        

        
        
<?php
return ob_get_clean();
}
add_shortcode('simple_property_map', 'jtg_simple_map');