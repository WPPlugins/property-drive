<?php
	$options = get_option('pm_agency_options');
	$pro_version_enabled = get_option( 'property_drive_pro' );
?>
<div class="jtg-row">
	<div class="col-1-1" style="border: 1px solid #ccc; padding: 15px;">
		<div class="contact-info-box" >
			<div class="contact-image">
				<?php
					if (isset($options['agency_logo'])) {
						$image_url = $options['agency_logo'];
						echo '<img src="'.$image_url.'" width="60%"><br><br>';
					}
				?>
			</div>
			<?php 
				if ($property_details['agent_name'][0]) {
					?>
					<h4><?php echo stripslashes($property_details['agent_name'][0]); ?></h4>
					<?php
				} else {
					?>
					<h4><?php echo stripslashes($options['agency_name']); ?></h4>
					<?php
				}

				if ($property_details['agent_number'][0]) {
					?>
					<h5><?php echo $property_details['agent_number'][0]; ?></h5>
					<?php
				} else {
					?>
					<h4><?php echo stripslashes($options['agency_phone']); ?></h4>
					<?php
				}

				if ($property_details['agent_email'][0]) {
					?>
					<h5><?php echo $property_details['agent_email'][0]; ?></h5>
					<?php
				} else {
					?>
					<h4><?php echo stripslashes($options['agency_email']); ?></h4>
					<?php
				}

				if ($property_details['agent_phone'][0]) {
					?>
					<a href="tel:<?php echo $property_details['agent_phone'][0]; ?>" class="jtg-btn-1-contact pm-button-base" >CALL</a>
					<?php
				} else {
					?>
					<a href="tel:<?php echo $options['agency_phone']; ?>" class="jtg-btn-1-contact pm-button-base" >CALL</a>
					<?php
				}

				if ($property_details['agent_email'][0]) {
					?>
					<a href="mailto:<?php echo $property_details['agent_email'][0]; ?>" class="jtg-btn-2-contact pm-button-secondary">EMAIL</a>
					<?php
				} else {
					?>
					<a href="mailto:<?php echo $options['agency_email']; ?>" class="jtg-btn-2-contact pm-button-secondary">EMAIL</a>
					<?php
				}
			?>
		</div>
	</div>
</div>

<?php if ($pro_version_enabled == 'true'): ?>
	<?php 
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jtg-request-viewing');
		wp_enqueue_style('jtg-request-viewing');

	?>
	<style>


.jtg-viewing-response {
	background-color: #004b85;
	padding: 10px;
	color: #fff;
	text-align: center;
	margin-bottom: 15px;
	display: none;
}

.jtg-request-viewing, .jtg-login-sidebar {
	text-align: center;
}

.jtg-request-viewing input, select {
	width: 80%;
	margin-bottom: 10px;
}

.jtg-request-viewing select {
	font-size: 13px;
	color: #767676;
	padding: 10px 12px;
	background-color: #fdfdfd;
	border: 1px solid #e3e3e3;
	outline: 0;
}

.jtg-request-viewing-btn {
	margin-top: 10px;
	width: 80%;
	background-color: #004b85;
	padding: 10px 15px;
	color: #fff;
	border: 0px;
}

	</style>
	<div class="jtg-row">
		<div class="col-1-1" style="border: 1px solid #ccc; padding: 15px;">
		<div class="jtg-viewing-response"></div>
			<div class="jtg-request-viewing">
				<h4>Request a Viewing</h4>
				<hr width="50%" align="center">
				<br>
				<form id="jtg-request-viewing-form">
					<?php echo '<input type="hidden" name="jtg-ajax-nonce" id="jtg-ajax-nonce" value="' . wp_create_nonce( 'jtg-ajax-nonce' ) . '" />'; ?>
					<input type="hidden" id="jtg-viewing-property-id" value="<?php echo get_the_id(); ?>" required>
					<input type="hidden" id="jtg-viewing-user-id" value="<?php echo get_current_user_id(); ?>" required>
					<input type="text" id="jtg-viewing-first-name" placeholder="First Name" required>
					<input type="text" id="jtg-viewing-last-name" placeholder="Last Name" required>
					<input type="email" id="jtg-viewing-email" placeholder="Email Address" required>
					<input type="text" id="jtg-viewing-phone" placeholder="Phone Number" required>
					<input type="text" id="jtg-viewing-date" placeholder="Preferred Date">

					<select id="jtg-viewing-time">
						<option selected disabled>Select Time</option>
				        <option value="08:30:00">08:30</option>      
				        <option value="09:00:00">09:00</option>      
				        <option value="09:30:00">09:30</option>      
				        <option value="10:00:00">10:00</option>      
				        <option value="10:30:00">10:30</option>      
				        <option value="11:00:00">11:00</option>      
				        <option value="11:30:00">11:30</option>      
				        <option value="12:00:00">12:00</option>      
				        <option value="12:30:00">12:30</option>      
				        <option value="13:00:00">13:00</option>      
				        <option value="13:30:00">13:30</option>      
				        <option value="14:00:00">14:00</option>      
				        <option value="14:30:00">14:30</option>      
				        <option value="15:00:00">15:00</option>      
				        <option value="15:30:00">15:30</option>      
				        <option value="16:00:00">16:00</option>      
				        <option value="16:30:00">16:30</option>      
				        <option value="17:00:00">17:00</option>      
				        <option value="17:30:00">17:30</option>      
				        <option value="18:00:00">18:00</option>      
				        <option value="18:30:00">18:30</option>      
				        <option value="19:00:00">19:00</option>      
				        <option value="19:30:00">19:30</option>      
				        <option value="20:00:00">20:00</option>      
				        <option value="20:30:00">20:30</option>      
				        <option value="21:00:00">21:00</option>      
					</select>
					<button type="button" id="jtg-request-viewing" class="jtg-request-viewing-btn">Request Viewing</button>
				</form>
			</div>
		</div>
	</div>
	<script>
jQuery(document).ready(function($){
	var dateToday = new Date();
    $( "#jtg-viewing-date" ).datepicker({ 
    	dateFormat: 'dd/mm/yy',
    	minDate: dateToday,
    });
  });
  </script>

  	<div class="jtg-row">
		<div class="col-1-1" style="border: 1px solid #ccc; padding: 15px;">
			<div class="jtg-login-sidebar">
				<?php if (is_user_logged_in()): ?>
					<h4>Client Area</h4>
					<hr width="50%" align="center">
					<button type="button" onclick="location.href='<?php echo home_url('/user-dashboard'); ?>';" class="jtg-request-viewing-btn">Dashboard</button>
					<br>
					<button type="button" onclick="location.href='<?php echo wp_logout_url( home_url() ); ?>';" class="jtg-request-viewing-btn">Logout</button>
				<?php else : ?>
					<h4>Client Login</h4>
					<hr width="50%" align="center">
					<button type="button" onclick="location.href='<?php echo home_url('/login'); ?>';" class="jtg-request-viewing-btn">Login</button>
					<br>
					<button type="button" onclick="location.href='<?php echo home_url('/register'); ?>';" class="jtg-request-viewing-btn">Register</button>
				<?php endif ?>
			</div>
		</div>
	</div>
<?php endif ?>

<style type="text/css">
 
#share-buttons img {
width: 35px;
padding: 5px;
border: 0;
box-shadow: 0;
display: inline;
}
 
</style>
<div class="jtg-row">
	<div class="jtg-col-1-1" style="text-align: center; border: 1px solid #ccc; padding: 15px;">
		<h4>Share this Property</h4>
		<hr width="50%" align="center">
		<br>
		<div id="share-buttons">
			<a href="http://www.facebook.com/sharer.php?u=<?php echo the_permalink(); ?>" target="_blank">
				<img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
			</a>
			<a href="https://twitter.com/share?url=<?php echo the_permalink(); ?>&amp;text=Simple%20Share%20Buttons&amp;hashtags=simplesharebuttons" target="_blank">
				<img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
			</a>
			<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo the_permalink(); ?>" target="_blank">
				<img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
			</a>
			<a href="https://plus.google.com/share?url=<?php echo the_permalink(); ?>" target="_blank">
				<img src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
			</a>
			<a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
				<img src="https://simplesharebuttons.com/images/somacro/pinterest.png" alt="Pinterest" />
			</a>
			<a href="mailto:?Subject=<?php echo the_title(); ?>&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 <?php echo the_permalink(); ?>">
				<img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email" />
			</a>
			<a href="javascript:;" onclick="window.print()">
				<img src="https://simplesharebuttons.com/images/somacro/print.png" alt="Print" />
			</a>
			<a href="http://reddit.com/submit?url=<?php echo the_permalink(); ?>&amp;title=<?php echo the_title(); ?>" target="_blank">
				<img src="https://simplesharebuttons.com/images/somacro/reddit.png" alt="Reddit" />
			</a>
			<a href="http://www.digg.com/submit?url=<?php echo the_permalink(); ?>" target="_blank">
				<img src="https://simplesharebuttons.com/images/somacro/diggit.png" alt="Digg" />
			</a>
			<a href="http://www.tumblr.com/share/link?url=<?php echo the_permalink(); ?>&amp;title=<?php echo the_title(); ?>" target="_blank">
				<img src="https://simplesharebuttons.com/images/somacro/tumblr.png" alt="Tumblr" />
			</a>
		</div>
	</div>
</div>