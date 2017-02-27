<?php 

/**
 * Proper way to enqueue scripts and styles.
 */
function wpdocs_theme_name_scripts() {

   ?>

	<!-- data table requirements -->
	<script src="//code.jquery.com/jquery-1.12.4.js" > </script>
	<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js" ></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">


	<!-- local css -->
	<script src="<?php print get_site_url(); ?>/wp-content/plugins/reputation-radar-partner/public/js/custom_js.js"></script>

	<link rel="stylesheet" type="text/css" href="<?php print get_site_url(); ?>/wp-content/plugins/reputation-radar-partner/public/css/custom_style.css">

	<!-- bootstrap -->
	<!-- Optional theme -->
	<script src="<?php print get_site_url(); ?>/wp-content/plugins/reputation-radar-partner/public/js/custom_js.js"></script>

	<link rel="stylesheet" type="text/css" href="<?php print get_site_url(); ?>/wp-content/plugins/reputation-radar-partner/public/css/bootstrap-custom.css">

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

	<!-- run data tables  -->
	<script>
   	$.noConflict();
  	jQuery( document ).ready(function( $ ) {
		$('#this-is-jus-a-testing-for-data-tables').DataTable();
		$('#rrp-alert-init').DataTable({
			"order": [[0, "desc" ]]
		});
		$('#rrp-alert-all').DataTable({
			"order": [[0, "desc" ]]
		});
		$('#rrp-alert-related').DataTable({
			"order": [[0, "desc" ]]
		});
		$('#rrp-alert-not-related').DataTable({
			"order": [[0, "desc" ]]
		});
	});




	</script>

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