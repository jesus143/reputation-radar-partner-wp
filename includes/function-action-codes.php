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
	if(isset($_POST['rrp_db_submit'])) {
		update_option('rrp_db', $_POST['rrp_db']);
		update_option('rrp_db_user', $_POST['rrp_db_user']);
		update_option('rrp_db_pass', $_POST['rrp_db_pass']);
		update_option('rrp_db_host', $_POST['rrp_db_host']);
		?>
		<br><br><br>
			<div style="color:green; background-color: white; padding:5px; width:50%">
				External database successfully update!
			</div>
	 	<?php
	}
	$rrp_db      = (get_option('rrp_db')) ? get_option('rrp_db') : null;
	$rrp_db_user = (get_option('rrp_db_user')) ? get_option('rrp_db_user') : null;
	$rrp_db_pass = (get_option('rrp_db_pass')) ? get_option('rrp_db_pass') : null;
	$rrp_db_host = (get_option('rrp_db_host')) ? get_option('rrp_db_host') : null;
	?>
		<div>
			<h4>This database connection will connect to external database for partner alerts and so that our agent can manage the partner's alert</h4>
			<form action="<?php print rrp_get_current_site_url_full(); ?>" method="post" >
				<table class="table table-bordered">
					<tbody>
					<tr>
						<td><label class="label">external db</label></td>
						<td><input type="text" name="rrp_db" value="<?php print $rrp_db; ?>" /> <br></td>
					</tr>
					<tr>
						<td><label class="label">external user</label></td>
						<td><input type="text" name="rrp_db_user" value="<?php print $rrp_db_user; ?>" /> <br></td>
					</tr>
					<tr>
						<td><label class="label">external pass</label></td>
						<td><input type="text" name="rrp_db_pass" value="<?php print $rrp_db_pass; ?>" /><br></td>
					</tr>
					<tr>
						<td><label class="label">external host</label></td>
						<td><input type="text" name="rrp_db_host" value="<?php print $rrp_db_host; ?>" /><br></td>
					</tr>
					 <tr>
						<td><input type="submit" value="update" name="rrp_db_submit" /></td>
						<td> </td>
					</tr>
					</tbody>
				</table>
			</form>
		</div>
		<hr>
		<div>
			<div class="wrap">
				<p>This is the settings for reputation radar partner</p>
				<br>rrp_settings - this is the page where settings show and your were able to update<br>
				<br>rrp_alert_partner - this is the page where all the scraped data will show<br>
				<br>rrp_alert_agent - this is the page where agent can see all the pending alerts<br>
				<br>rrp_patners_list_agent - display all partners id and manage<br>
			</div>
		</div>
	<?php
}



function print_site_url_hidden_field() {

	?>
	<input type="hidden" value="<?php print get_site_url(); ?>" id="rrp_ri_site_url"  />

	<?php
}
