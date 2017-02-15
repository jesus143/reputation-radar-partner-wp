<?php 

/**
 * Proper way to enqueue scripts and styles.
 */
function wpdocs_theme_name_scripts() {
   ?> 
		 <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
		<script type="text/javascript" src="http://getbootstrap.com/dist/js/bootstrap.js"></script>
		<script type="text/javascript" src="http://localhost/practice/wordpress/wp-content/plugins/reputation-radar-partner/public/js/custom_js.js"></script>
		<link type="text/css" rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.css"/>

		  
   <?php 
}

function rrp_admin_menu() {
	add_options_page( 'Radar Reputation', 'Radar Reputation', 'manage_options', 'radar-reputation', 'rrp_plugin_options' );
}

/** Step 3. */
function rrp_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<p>This is the settings for reputation radar partner</p>';
	echo '	<br>rrp_settings - this is the page where settings show and your were able to update<br>
			<br>rrp_alert_partner - this is the page where all the scraped data will show<br>
			<br>rrp_alert_agent - this is the page where agent can see all the pending alerts<br>';
	echo '</div>';
}