<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Setup Admin Options Page
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function pm_menu_links(){
	add_menu_page('Property Drive Settings', 'Property Drive', 'manage_options', 'jtg_property_drive_settings', 'jtg_build_admin_page', 'dashicons-admin-home', 58);
}
add_action('admin_menu', 'pm_menu_links');

// Link on Admin Bar
add_action('admin_bar_menu', 'jtg_add_toolbar_items', 100);
function jtg_add_toolbar_items($admin_bar){
    $admin_bar->add_menu( array(
        'id'    => 'pd-options-admin-link',
        'title' => 'Property Drive Plugin',
        'href'  => '/wp-admin/admin.php?page=jtg_property_drive_settings',
        'meta'  => array(
            'title' => __('Property Drive Options'),            
        ),
    ));
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Display Admin Page
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function jtg_build_admin_page() {

	$jtg_plugin_logo = plugin_dir_url(dirname(__DIR__)).'assets/images/square_web.png';

	$dir = plugin_dir_url( dirname(__DIR__) );

	wp_register_script('jtg-admin-ajax-js', $dir.'assets/js/admin_ajax.js', __FILE__, time());
	wp_register_script('jtg-admin-import-js', $dir.'assets/js/import_ajax.js', __FILE__);
	wp_register_script('jtg-admin-rm-properties-js', $dir.'assets/js/delete_all.js', __FILE__);
	wp_register_script('jtg-admin-ui-js', $dir.'assets/js/admin_ui.js', __FILE__);

	wp_register_style( 'jtg-admin-ui', $dir.'assets/css/jtg_admin_ui.css', __FILE__);
	wp_register_style( 'jtg-grid', $dir.'assets/css/jtg_grid.css', __FILE__);
	wp_register_style('jtg-fa-icons', $dir.'assets/css/font-awesome.min.css', __FILE__);

	wp_enqueue_style('jtg-admin-ui');
	wp_enqueue_style('jtg-grid');
	wp_enqueue_style('jtg-fa-icons');

	$plugin_version_dir = plugin_dir_path(dirname(__DIR__)).'property_drive.php';
	$plugin_version = get_plugin_data($plugin_version_dir, 'Version');

	?>
	<div class="jtg-container" style="margin: 15px; margin-left: -5px; border: solid 1px #ddd; border-radius: 5px;">
		<form action="options.php" method="post" id="jtg-ajax-form" enctype="multipart/form-data">
			<?php echo '<input type="hidden" name="jtg-ajax-nonce" id="jtg-ajax-nonce" value="' . wp_create_nonce( 'jtg-ajax-nonce' ) . '" />'; ?>
			<div class="jtg-row jtg-clearfix">
				<div class="jtg-col-1-1">
					<div class="jtg-admin-header">
						<div class="jtg-header-logo">
							<img src="<?php echo $jtg_plugin_logo; ?>" alt="">
						</div>
						<div class="jtg-header-version">
							Property Drive
							<br>
							Version <?php echo $plugin_version['Version'] ?>
							<?php 
							if (get_option('property_drive_pro') == 'true'){
								echo '<br>Pro Version Activated';
							}
							?>
						</div>
						<input name="Submit" type="submit" class="jtg-update-settings-btn "  style="float:right; margin-top:30px;" value="Update All Settings"/>
						<div id="phone-home-results"></div>
					</div>
				</div>
			</div>
			<div class="jtg-row jtg-clearfix">
				<div class="jtg-admin-col-left">
					<div class="jtg-admin-sidebar">
						<?php include('admin_sidebar.php'); ?>
					</div>
				</div>
				<div class="jtg-admin-col-right">
					<div class="jtg-admin-main-content">
						<div class="jtg-ajax-response"></div>
						<section id="jtg-welcome-section" class="jtgcontentlink jtgdefaultOpen">
							<div>
								<?php include('sections/welcome_section.php'); ?>
							</div>
						</section>

						<section id="jtg-agency-options" class="jtgcontentlink">
							<div>
								<?php include('sections/agency_options.php'); ?>
							</div>
						</section>

						<section id="jtg-general-options" class="jtgcontentlink">
							<div>
								<?php include('sections/general_options.php'); ?>
							</div>
						</section>

						<section id="jtg-property-cards" class="jtgcontentlink">
							<div>
								<?php include('sections/property_box_options.php'); ?>
							</div>
						</section>

						<section id="jtg-search-options" class="jtgcontentlink">
							<div>
								<?php include('sections/search_options.php'); ?>
							</div>
						</section>

						<section id="jtg-single-property-options" class="jtgcontentlink">
							<div>
								<?php include('sections/single_property_options.php'); ?>
							</div>
						</section>

						<section id="jtg-shortcode-options" class="jtgcontentlink">
							<div>
								<?php include('sections/shortcode_options.php'); ?>
							</div>
						</section>

						<section id="jtg-shortcode-guide" class="jtgcontentlink">
							<div>
								<?php include('sections/shortcodes_guide.php'); ?>
							</div>
						</section>

						<section id="jtg-logs-section" class="jtgcontentlink">
							<div id="place-logs-here">
								<?php // include('logs.php'); ?>
							</div>
						</section>

						<section id="jtg-advanced-options" class="jtgcontentlink">
							<div>
								<?php include('sections/advanced_options.php'); ?>
							</div>
						</section>

						<section id="jtg-importer-settings" class="jtgcontentlink">
							<div>
								<?php include('sections/importer_options.php'); ?>
							</div>
						</section>

						<?php 
						$pro_version_enabled = get_option('property_drive_pro');
						if ($pro_version_enabled == 'true') {
							jtg_show_admin_section();
						}
						?>
					</div>
				</div>
			</div>
			<div class="jtg-row jtg-clearfix">
				<div class="jtg-admin-footer">
					<span>
						<button class="jtg-manual-import-btn" id="jtg-manual-import-btn">Run Manual Import</button>
						<span id="jtg-manual-import-spinner">
							<i style="color: #fff;" class="fa fa-cog fa-spin fa-4x fa-fw"></i>
							<span class="sr-only">Loading...</span>
						</span>
					</span>
					<input name="Submit" type="submit" class="jtg-update-settings-btn "  style="float:right; margin-right: 20px; margin-top:30px;" value="Update All Settings"/>
				</div>
			</div>
		</form>
	</div>
	<script>
		jQuery(document).ready(function($){
			$('#open-logs').on('click', function (){
				$.ajax({
					url: '<?php echo plugin_dir_url(dirname(__DIR__)).'includes/admin/logs.php'; ?>',
					success: function(data) {
						$('#place-logs-here').html(data);
						console.log('Logs have been loaded...');
					}
				});
			});
		});
	</script>


	<script>
		
jQuery(document).ready(function($){

    $( document ).on( 'click', '#jtg-phone-home', function(event){

        event.preventDefault();

        
        // var jtg_security = $('#jtg-ajax-nonce').val();
        
        // Use ajax to do something...
        var postData = {
            action: 'jtg_run_send_tracking_data',
        }
        //Ajax load more posts
        $.ajax({
            type: "POST",
            data: postData,
            dataType:"json",
            url: ajaxurl, 
            //This fires when the ajax 'comes back' and it is valid json
            success: function (response) {
                $("#phone-home-results").fadeIn().html(response.data).show();
            }
            //This fires when the ajax 'comes back' and it isn't valid json
        }).fail(function (data) {
            console.log(data.responseText);
        }); 

    });

});
	</script>
	<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///  Enqueue Scripts
///////////////////////////////////////////////////////////////////////////////////////////////////////////
	wp_enqueue_script('jtg-admin-ui-js');
	wp_enqueue_script('jtg-admin-ajax-js');
	wp_enqueue_script('jtg-admin-import-js');
	wp_enqueue_script('jtg-admin-rm-properties-js');
}