<?php 
////////////////////////////////////////////////////////////////
///  Auto Draft Properties
///////////////////////////////////////////////////////////////
// add_action('new_to_pending', 'pd_auto_draft');
// add_action('draft_to_pending', 'pd_auto_draft');
// add_action('auto-draft_to_pending', 'pd_auto_draft');
add_action('init', 'approve_post');
add_action('init', 'preview_post');

function set_html_content_type() { return 'text/html'; }

function pd_auto_draft( $property_id ) {
global $post;
	$post = get_post($property_id);
  // get author of post
  $author = new WP_User($post->post_author);


$logo = plugin_dir_url(dirname(__DIR__)).'assets/images/square_web.png';
$image = get_the_post_thumbnail_url($property_id);
$title = $post->post_title;




  // create an url vor verify link with some variables: key, post id, and email
  $url_preview = add_query_arg( array('preview'=>$post->ID), site_url() );
  $url_approve = add_query_arg( array('approve'=>$post->ID), site_url() );

  // set the content for the email
  $content .= '<div style="">';
  $content .= '<div style="width: 100%;">';
$content .= '<div style="display: inline-block;"><img src="https://oneill.propertydrive.io/wp-content/uploads/2016/12/ONeill-Logo-New.png" width="200px"></div>';
$content .= '<div style="display:inline-block; float:right; margin-top: 15px;"><a style="background-color: #d35400; margin-right: 15px; border-radius: 5px; text-transform: uppercase; padding: 15px 20px; font-weight: bold; color: #fff; text-decoration: none;" href="' . site_url() . '">Visit Site</a></div>';
$content .= '</div>';
$content .= '<hr>';
$content .= '<img src="'.$image.'" width="100%">';

$content .= '<div style="width: 100%; text-align: center;">';
$content .= '<h2>'.$title.'</h2>';



$content .= '<br><br>';
  $content .= '<div style="display:inline-block;"><a style="background-color: #8e44ad; margin-right: 15px; border-radius: 5px; text-transform: uppercase; padding: 15px 20px; font-weight: bold; color: #fff; text-decoration: none;" href="' . $url_preview . '">Preview Property</a></div>';


  $content .= '<div style="display:inline-block;"><a style="background-color: #27ae60; border-radius: 5px; text-transform: uppercase; padding: 15px 20px; font-weight: bold; color: #fff; text-decoration: none;" href="' . $url_approve . '">Approve Property</a></div>';
$content .= '</div>';
$content .= '<br><br>';
$content .= '<hr>';
$content .= '<br><br>';
$content .= '<div style="width: 100%; text-align: center;">';
  $content .= '<h4>Powered by Property Drive &trade;</h4><br><img src="'.$logo.'" width="150px">';
$content .= '</div>';
$content .= '</div>';





  $from = 'O\'Neill & Co';
  $from_email = 'info@propertydrive.io';
  $headers = 'From: ' . $from . ' <' . $from_email . '>' . "\r\n";
  // sending email in html format
  add_filter( 'wp_mail_content_type', 'set_html_content_type' );
  wp_mail( $author->user_email.',jay@4pm.ie, james@4pm.ie', 'Approval Required - New Property Posted', $content, $headers);
  remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
}

function approve_post( ) {

	if (isset($_GET['approve'])) {
		$post = get_post($_GET['approve']);
		$update_post_status = array(
				'ID' => $_GET['approve'],
				'post_status' => 'publish',
			);
		wp_update_post($update_post_status);

		wp_redirect(get_permalink($_GET['approve']));

		exit;

	}

}



function preview_post( ) {

	if (isset($_GET['preview'])) {
		$post = get_post($_GET['preview']);


		wp_redirect(get_permalink($_GET['preview']));
		exit;
	}

}



function the_posts_preview_draft_posts($posts, $wp_query) {

    //abort if $posts is not empty, this query ain't for us...
    if ( count($posts) ) {
        return $posts;
    }

    $p = get_query_var('p');

    //get our post instead and return it as the result...
    if ( !empty($p) ) {
        return array(get_post($p));
    }
}

add_filter('the_posts', 'the_posts_preview_draft_posts', 10, 2);