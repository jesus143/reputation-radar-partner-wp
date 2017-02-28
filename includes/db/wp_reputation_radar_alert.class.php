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
		$alerts = $this->rrp_queries->wpdb_get_result("select * from $this->table_name where status = 0 order by id desc");
		return $alerts;
	}
	public function getPartnersAlertAll($partner_id)
	{
		$alerts = $this->rrp_queries->wpdb_get_result("select * from $this->table_name where partner_id = $partner_id and status = 1 ");
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
		<table id="rrp-alert-init" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th style="width:5%" >Id</th>
				<th style="width:10%" >Partner Id</th>
				<th  style="width:10%" >Source Url</th>
				<th  style="width:20%" >keyword</th>
				<th style="width:7%" >Rate</th>
				<th style="width:25%"  >Description</th>
				<th>Time</th>
				<th>Relevant <br> Not Relevant</th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<th>Id</th>
				<th>Partner Id</th>
				<th>Source Url</th>
				<th>keyword</th>
				<th>Rate</th>
				<th>Description</th>
				<th>Time</th>
				<th>Relevant <br> Not Relevant</th>
			</tr>
			</tfoot>
			<tbody>
			<?php foreach ($partnersAlertInit as $alert): ?>
				<tr id="rrp-alert-<?php print $alert['id']; ?>">

					<td> <?php print  $alert['id']; ?> </td>
					<td> <?php print  $alert['partner_id']; ?> </td>
					<td> <?php print  rrp_settings_get_specific_company_search_keyword_by_partner_id($alert['partner_id'],$alert['id'],  $alert['rate']); ?> </td>
					<td> <?php print  rrp_alert_get_scraped_keyword_by_partner_id($alert['id']); ?> </td>
					<td> <?php print  $alert['rate']; ?> </td>
					<td> <?php print  rrp_is_limit_str($alert['description'], 100); ?> </td>
					<td>
						<small><?php print rrp_time_elapsed_string($alert['created_at']); ?></small>
					</td>

					<td>
						<input type="button" class="alert alert-info" value="Relevant" onClick="updatePartnerAlertToRelatedByAgent('<?php print $alert['id']; ?>', '#alert-loader-relevant-<?php print $alert['id']; ?>' )"/>
						<div style="display:none" class="rrp-loader" id="alert-loader-relevant-<?php print $alert['id']; ?>"  ></div>
						<br>
						<input type="button" class="alert alert-info" value="Not Relevant" onClick="updatePartnerAlertToNotRelatedByAgent('<?php print $alert['id']; ?>',  '#alert-loader-not-relevant-<?php print $alert['id']; ?>')"/>
						<div style="display:none" class="rrp-loader" id="alert-loader-not-relevant-<?php print $alert['id']; ?>" ></div>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<?php
	}
	public function uiAlertAll($partnersAlertAll)
	{
		?>

		<table id="rrp-alert-all" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
			<tr>
				<th style="width:5%" >Id</th>
				<th style="width:4%" >Partner Id</th>
				<th  style="width:4%" >Source Url</th>
				<th  style="width:10%" >keyword</th>
				<th style="width:7%" >Rate</th>
				<th style="width:25%"  >Description</th>
				<th>Time</th>
				<th>Relevant <br> Not Relevant</th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<th>Id</th>
				<th>Partner Id</th>
				<th>Source Url</th>
				<th>keyword</th>
				<th>Rate</th>
				<th>Description</th>
				<th style="width:5%">Time</th>
				<th>Relevant <br> Not Relevant</th>
			</tr>
			</tfoot>
			<tbody>
			<?php foreach($partnersAlertAll as $alert): ?>
				<tr id="rrp-alert-<?php print $alert['id']; ?>">
					<td> <?php print  $alert['id']; ?> </td>
					<td > <?php print  $alert['partner_id']; ?> </td>
					<td> <?php print  rrp_settings_get_specific_company_search_keyword_by_partner_id($alert['partner_id'],$alert['id'],  $alert['rate']); ?> </td>
					<td> <?php print  rrp_alert_get_scraped_keyword_by_partner_id($alert['id']); ?> </td>
					<td> <?php print  $alert['rate']; ?> </td>
					<td> <?php print  rrp_is_limit_str($alert['description'], 100); ?> </td>
					<td>
						<small><?php print rrp_time_elapsed_string($alert['created_at']); ?></small>
					</td>
					<td>
						<input type="button" class="alert alert-info" value="Relevant" onClick="updatePartnerAlertToRelated('<?php print $alert['id']; ?>', '#alert-loader-relevant-<?php print $alert['id']; ?>' )" />
						<div style="display:none" class="rrp-loader" id="alert-loader-relevant-<?php print $alert['id']; ?>"  ></div>
				 		<br>
						<input type="button" class="alert alert-info" value="Not Relevant" onClick="updatePartnerAlertNotToRelated('<?php print $alert['id']; ?>', '#alert-loader-not-relevant-<?php print $alert['id']; ?>' )" />
						<div style="display:none" class="rrp-loader" id="alert-loader-not-relevant-<?php print $alert['id']; ?>" ></div>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	<?php

	}
	public function uiAlertRelated($partnersAlertAll)
	{?>




		<table id="rrp-alert-related" class="display" cellspacing="0" width="100%">

			<thead>
			<tr>
				<th style="width:5%" >Id</th>
				<th style="width:8%" >Partner Id</th>
				<th  style="width:5%" >Source Url</th>
				<th  style="width:10%" >Keyword</th>
				<th style="width:7%" >Rate</th>
				<th style="width:25%"  >Description</th>
				<th style="width:5%" >Time</th>
				<th style="width:10%" >Delete</th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<th>Id</th>
				<th>Partner Id</th>
				<th>Source Url</th>
				<th>Keyword</th>
				<th>Rate</th>
				<th>Description</th>
				<th>Time</th>
				<th>delete/th>
			</tr>
			</tfoot>

			<tbody>
			<?php foreach($partnersAlertAll as $alert): ?>
				<tr id="rrp-alert-<?php print $alert['id']; ?>">
					<td> <?php print  $alert['id']; ?> </td>
					<td > <?php print  $alert['partner_id']; ?> </td>
					<td> <?php print  rrp_settings_get_specific_company_search_keyword_by_partner_id($alert['partner_id'],$alert['id'],  $alert['rate']); ?> </td>
					<td> <?php print  rrp_alert_get_scraped_keyword_by_partner_id($alert['id']); ?> </td>
					<td> <?php print  $alert['rate']; ?> </td>
					<td> <?php print  rrp_is_limit_str($alert['description'], 100); ?> </td>
					<td>
						<small><?php print rrp_time_elapsed_string($alert['created_at']); ?></small>
					</td>
					<td>
						<input type="button" class="alert alert-danger" value="Delete" onClick="deleteAlert('<?php print $alert['id']; ?>', '#alert-loader-delete-<?php print $alert['id']; ?>')" />
						<div style="display:none" class="rrp-loader" id="alert-loader-delete-<?php print $alert['id']; ?>"  ></div>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>

		</table>
	<?php

	}
	public function uiAlertNotRelated($partnersAlertAll)
	{?>



		<table id="rrp-alert-not-related" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th style="width:5%" >Id</th>
				<th style="width:8%" >Partner Id</th>
				<th  style="width:5%" >Source Url</th>
				<th  style="width:10%" >Keyword</th>
				<th style="width:7%" >Rate</th>
				<th style="width:25%"  >Description</th>
				<th style="width:5%" >Time</th>
				<th style="width:10%" >Delete</th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<th>Id</th>
				<th>Partner Id</th>
				<th>Source Url</th>
				<th>Keyword</th>
				<th>Rate</th>
				<th>Description</th>
				<th>Time</th>
				<th>Delete</th>
			</tr>
			</tfoot>
			<tbody>
			<?php foreach($partnersAlertAll as $alert): ?>
				<tr id="rrp-alert-<?php print $alert['id']; ?>">
					<td> <?php print  $alert['id']; ?> </td>
					<td > <?php print  $alert['partner_id']; ?> </td>
					<td> <?php print  rrp_settings_get_specific_company_search_keyword_by_partner_id($alert['partner_id'],$alert['id'],  $alert['rate']); ?> </td>
					<td> <?php print  rrp_alert_get_scraped_keyword_by_partner_id($alert['id']); ?> </td>
					<td> <?php print  $alert['rate']; ?> </td>
					<td> <?php print  rrp_is_limit_str($alert['description'], 100); ?> </td>
					<td>
						<small><?php print rrp_time_elapsed_string($alert['created_at']); ?></small>
					</td>
					<td>
						 <input type="button" class="alert alert-danger" value="Delete" onClick="deleteAlert('<?php print $alert['id']; ?>', '#alert-loader-delete-<?php print $alert['id']; ?>')" />
						 <div style="display:none" class="rrp-loader" id="alert-loader-delete-<?php print $alert['id']; ?>"  ></div>
					 </td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	<?php

	}
}

