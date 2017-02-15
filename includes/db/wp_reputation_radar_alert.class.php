<?php 

namespace App;


/**
 * Class WP_Reputation_Radar_Alert
 * @package App
 * pending = 0
 * set related by agent = 1
 * set  none related by agent = 4
 * set related by partner = 2
 * set none related by partner = 3
 */

class WP_Reputation_Radar_Alert {

	protected $rrp_queries;
	protected $table_name = "wp_reputation_radar_alert";

	function __construct()
	{
			$this->rrp_queries = new RRP_QUERIES('wp_reputation_radar_alert'); 
	}

	public function getPartnersAlertInit($partner_id)
	{
		$alerts = $this->rrp_queries->wpdb_get_result("select * from $this->table_name where status = 0");
		return $alerts;
	}
	public function getPartnersAlertAll($partner_id)
	{
		$alerts = $this->rrp_queries->wpdb_get_result("select * from $this->table_name where partner_id = $partner_id and status = 1");
		return $alerts;
	}

	public function getPartnersAlertRelated($partner_id)
	{
		$alerts = $this->rrp_queries->wpdb_get_result("select * from $this->table_name where partner_id = $partner_id and status = 2");
		return $alerts;
	}

	public function getPartnersAlertNotRelated($partner_id)
	{
		$alerts = $this->rrp_queries->wpdb_get_result("select * from $this->table_name where partner_id = $partner_id and status = 3");
		return $alerts;
	}
	public function updatePartnerAlertToRelatedByAgent($alert_id)
	{
		$alerts = $this->rrp_queries->wpdb_update(['status'=>1], ['id'=>$alert_id]);
		return $alerts;
	}
	public function updatePartnerAlertToRelated($alert_id)
	{
		$alerts = $this->rrp_queries->wpdb_update(['status'=>2], ['id'=>$alert_id]);
		return $alerts;
	}
	public function updatePartnerAlertNotToRelated($alert_id)
	{
		$alerts = $this->rrp_queries->wpdb_update(['status'=>3], ['id'=>$alert_id]);
		return $alerts;
	}
	public function updatePartnerAlertToNotRelatedByAgent($alert_id)
	{
		$alerts = $this->rrp_queries->wpdb_update(['status'=>4], ['id'=>$alert_id]);
		return $alerts;
	}

	public function countTotalAllAlert($partner_id)
	{
		return count($this->getPartnersAlertAll($partner_id));
	}

	public function countTotalRelevantAlert($partner_id)
	{
		return count($this->getPartnersAlertRelated($partner_id));

	}

	public function countTotalNotRelevantAlert($partner_id)
	{
		return count($this->getPartnersAlertNotRelated($partner_id));
	}
	public function deleteAlert($alert_id)
	{
		$alerts = $this->rrp_queries->wpdb_delete(['id'=>$alert_id]);
		return $alerts;
	}


	// ui
	public function uiAlertInit($partnersAlertInit)
	{





		?>

		<script>
			$(document).ready(function () {
				$('#rrp-alert-init').DataTable();
			});
		</script>

		<table id="rrp-alert-init" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th>Company Url</th>
				<th>Name</th>
				<th>Title</th>
				<th>Description</th>
				<th>Url</th>
				<th>Relevant</th>
				<th>Not Relevant</th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<th>Company Url</th>
				<th>Name</th>
				<th>Title</th>
				<th>Description</th>
				<th>Url</th>
				<th>Relevant</th>
				<th>Not Relevant</th>
			</tr>
			</tfoot>
			<tbody>
			<?php foreach ($partnersAlertInit as $alert): ?>
				<tr id="rrp-alert-<?php print $alert['id']; ?>">
					<td> <?php print  rrp_settings_get_current_user_url($alert['partner_id']); ?> </td>
					<td> <?php print  $alert['person_name']; ?> </td>
					<td> <?php print  $alert['title']; ?> </td>
					<td> <?php print  $alert['description']; ?> </td>
					<td>  <?php print $alert['url']; ?> </td>
					<td><input type="button" class="alert alert-info" value="Relevant" onClick="updatePartnerAlertToRelatedByAgent(<?php print $alert['id']; ?>)"/></td>
					<td><input type="button" class="alert alert-info" value="Not Relevant" onClick="updatePartnerAlertToNotRelatedByAgent(<?php print $alert['id']; ?>)"/></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<?php
	}
	public function uiAlertAll($partnersAlertAll)
	{?>


		<script>
			$(document).ready(function() {
				$('#rrp-alert-all').DataTable();
			} );
		</script>


		<table id="rrp-alert-all" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th>Name</th>
				<th>Title</th>
				<th>Description</th>
				<th>Url</th>
				<th>Relevant</th>
				<th>Not Relevant</th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<th>Name</th>
				<th>Title</th>
				<th>Description</th>
				<th>Url</th>
				<th>Relevant</th>
				<th>Not Relevant</th>
			</tr>
			</tfoot>
			<tbody>
			<?php foreach($partnersAlertAll as $alert): ?>
				<tr id="rrp-alert-<?php print $alert['id']; ?>">
					<td> <?php print $alert['person_name']; ?> </td>
					<td> <?php print $alert['title']; ?> </td>
					<td> <?php print $alert['description']; ?> </td>
					<td>  <?php print $alert['url']; ?> </td>
					<td> <input type="button" class="alert alert-info" value="Relevant" onClick="updatePartnerAlertToRelated(<?php print $alert['id']; ?>)" />  </td>
					<td> <input type="button" class="alert alert-info" value="Not Relevant" onClick="updatePartnerAlertNotToRelated(<?php print $alert['id']; ?>)" />  </td>

				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	<?php

	}
	public function uiAlertRelated($partnersAlertAll)
	{?>


		<script>
			$(document).ready(function() {
				$('#rrp-alert-related').DataTable();
			} );
		</script>


		<table id="rrp-alert-related" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th>Name</th>
				<th>Title</th>
				<th>Description</th>
				<th>Url</th>
				<th>Delete</th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<th>Name</th>
				<th>Title</th>
				<th>Description</th>
				<th>Url</th>
				<th>Delete</th>
			</tr>
			</tfoot>
			<tbody>
			<?php foreach($partnersAlertAll as $alert): ?>
				<tr id="rrp-alert-<?php print $alert['id']; ?>">
					<td> <?php print $alert['person_name']; ?> </td>
					<td> <?php print $alert['title']; ?> </td>
					<td> <?php print $alert['description']; ?> </td>
					<td> <?php print $alert['url']; ?> </td>
					<td> <input type="button" class="alert alert-danger" value="Delete" onClick="deleteAlert(<?php print $alert['id']; ?>)" />  </td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	<?php

	}
	public function uiAlertNotRelated($partnersAlertAll)
	{?>


		<script>
			$(document).ready(function() {
				$('#rrp-alert-not-related').DataTable();
			} );
		</script>


		<table id="rrp-alert-not-related" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th>Name</th>
				<th>Title</th>
				<th>Description</th>
				<th>Url</th>
				<th>Delete</th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<th>Name</th>
				<th>Title</th>
				<th>Description</th>
				<th>Url</th>
				<th>Delete</th>
			</tr>
			</tfoot>
			<tbody>
			<?php foreach($partnersAlertAll as $alert): ?>
				<tr id="rrp-alert-<?php print $alert['id']; ?>">
					<td> <?php print $alert['person_name']; ?> </td>
					<td> <?php print $alert['title']; ?> </td>
					<td> <?php print $alert['description']; ?> </td>
					<td> <?php print $alert['url']; ?> </td>
				 <td> <input type="button" class="alert alert-danger" value="Delete" onClick="deleteAlert(<?php print $alert['id']; ?>)" />  </td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	<?php

	}
}

