<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Shortcode Options Section
///////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<div class="jtg-admin-section-header">
	<h2>Property Grid Shortcode</h2>
</div>
<div class="jtg-row jtg-clearfix">
	<div class="jtg-admin-notice-light">
		<p>Find the shortcode you wish to modify below, please be aware this will modify shortcodes site wide.</p>
		<p>If you wish to add a custom shortcode to Property Drive, we support that, either refer to our docs, contact our great support team or ask a good Wordpress developer to help you out :)</p>
	</div>
	<p><b>Show Title</b></p>
	<label class="jtg-admin-switch">
		<input id="jtg_shortcode_title_show" type="checkbox" name="featured_title" value="1" <?php checked('true', $options['featured_title']); ?> />
		<div class="jtg-admin-slider jtg-admin-round"></div>
	</label>
	<p><b>Title Background Color</b></p>
	<input id="jtg_shortcode_title_back" type="text" class="color-picker" data-alpha="true" data-default-color="" name="featured_title_background" value="<?php echo $options['featured_title_background']; ?>"/>
	<p><b>Title Text Color</b></p>
	<input id="jtg_shortcode_title_text" type="text" class="color-picker" data-alpha="true" data-default-color="" name="featured_title_color" value="<?php echo $options['featured_title_color']; ?>"/>
	<p><b>Title Text</b></p>
	<input id="jtg_property_grid_title" name="property_grid_title" type="text" value="<?php echo $options['property_grid_title']; ?>">
	<p><b>Show View More Button</b></p>
	<label class="jtg-admin-switch">
		<input id="jtg_show_view_more" type="checkbox" name="show_view_more" value="1" <?php checked('true', $options['show_view_more']); ?> />
		<div class="jtg-admin-slider jtg-admin-round"></div>
	</label>
</div>

<div class="jtg-admin-section-header">
	<h2>Search Type 3</h2>

</div>
<div class="jtg-admin-notice-light">
	<p>Here you can images to a slider behind the search bar, the recommended image size is w1200px x h650px</p>
	<p><i>Adding only 1 image will result in a static background</i></p>
			<p><i>Removing images here does not delete them from your server, incase you are using those images elsewhere :)</i></p>
	</div>

<div class="jtg-row jtg-clearfix">

	<div class="jtg-col-1-1" style="text-align: center;">
		<div class="jtg-row jtg-clearfix" id="jtg-admin-logo">
			<?php

		$search_type_3_options = get_option('search_type_3_options');

        $slides = $search_type_3_options['search_type_3_images'];

		if ($slides) {

        $slides = explode(',',$slides);
        $i = 0;
        foreach ($slides as $slide) {
            echo '<span id="slide_image_'.$i.'" style="float: left; width:24%"><img style="width: 100%; height: 150px;" src="'.$slide.'" alt=""><i id="delete_slide_image_'.$i.'" style="cursor: pointer; position: relative; top: 15px; right: 15px; color: red;" class="fa fa-trash fa-2x"></i></span>';

            echo '
				<script>
					jQuery(document).ready(function($){
						$("#delete_slide_image_'.$i.'").click(function(){
							$("#search_type_3_images").val($("#search_type_3_images").val().replace("'.$slide.'", ""));
							$("#slide_image_'.$i.'").fadeOut();
						});
					});
				</script>
            ';
            $i++;
        }
		} else {
			$image_url = plugin_dir_url(dirname(__DIR__)).'assets/images/no-image.jpg';
			echo '<span style="float: left; width:24%"><img src="'.$image_url.'" width="100%"></span>';
		}

		global $wpdb;

		if ( !empty( $_POST['search_type_3_images'] ) ) {
			$image_url = $_POST['search_type_3_images']; 
		}

		wp_enqueue_media();
		?>
		

		
		</div>
		<div class="jtg-row jtg-clearfix">
			<input id="search_type_3_images" type="hidden" name="search_type_3_images[]" value="<?php echo $search_type_3_options['search_type_3_images']; ?>" />
		<input id="search_type_3_img_btn" type="button" class="jtg-logo-upload-btn" value="Upload Slider Images" />
		</div>
	</div>
</div>

<script>
	jQuery(document).ready(function($){
var jtg_media_frame;

$('#search_type_3_img_btn').click(function() {

  if ( jtg_media_frame ) {
    jtg_media_frame.open();
    return;
  }

  jtg_media_frame = wp.media.frames.jtg_media_frame = wp.media({
    multiple: true,
    library: {
      type: 'image'
    },
  });

  jtg_media_frame.on('select', function(){
    var selection = jtg_media_frame.state().get('selection');
    selection.map( function( attachment ) {
      attachment = attachment.toJSON();

          console.log(attachment);

          	$('#search_type_3_images').val(function(i,val) { 
     return val + (val ? ',' : '') + attachment.url;
});
	$("#jtg-admin-logo").after("<img width='40%'src=" +attachment.url+">");
    });
  });

  jtg_media_frame.open();

});

	});
</script>

<div class="jtg-row jtg-clearfix">
	<div class="jtg-col-1-2">
		<p><b>Search Background Color</b></p>
		<p>Control the background colour for the search bar on top of the image. You may use RGBA to control transparency too</p>
	<input id="search_3_background_color" type="text" class="color-picker" data-alpha="true" data-default-color="" value="<?php echo $search_type_3_options['search_3_background_color']; ?>"/>

	</div>
	<div class="jtg-col-1-2">
	<p><b>Image Slider Duration</b></p>

		<select id="slider_pause_time">
			<option value="1000" <?php if ( $search_type_3_options['slider_pause_time'] == '1000' ) echo 'selected="selected"'; ?>>1 Second</option>
			<option value="2000" <?php if ( $search_type_3_options['slider_pause_time'] == '2000' ) echo 'selected="selected"'; ?>>2 Seconds</option>
			<option value="3000" <?php if ( $search_type_3_options['slider_pause_time'] == '3000' ) echo 'selected="selected"'; ?>>3 Seconds</option>
			<option value="4000" <?php if ( $search_type_3_options['slider_pause_time'] == '4000' ) echo 'selected="selected"'; ?>>4 Seconds</option>
			<option value="5000" <?php if ( $search_type_3_options['slider_pause_time'] == '5000' ) echo 'selected="selected"'; ?>>5 Seconds</option>
			<option value="6000" <?php if ( $search_type_3_options['slider_pause_time'] == '6000' ) echo 'selected="selected"'; ?>>6 Seconds</option>
			<option value="7000" <?php if ( $search_type_3_options['slider_pause_time'] == '7000' ) echo 'selected="selected"'; ?>>7 Seconds</option>
			<option value="8000" <?php if ( $search_type_3_options['slider_pause_time'] == '8000' ) echo 'selected="selected"'; ?>>8 Seconds</option>
			<option value="9000" <?php if ( $search_type_3_options['slider_pause_time'] == '9000' ) echo 'selected="selected"'; ?>>9 Seconds</option>
			<option value="10000" <?php if ( $search_type_3_options['slider_pause_time'] == '10000' ) echo 'selected="selected"'; ?>>10 Seconds</option>
		</select>
	</div>
</div>