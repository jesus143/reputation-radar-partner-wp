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

class WP_Reputation_Radar_Rating_Site
{

	protected $rrp_queries;

	protected $table_name = "wp_reputation_radar_rating_sites";

	function __construct()
	{
		$this->rrp_queries = new RRP_QUERIES('wp_reputation_radar_rating_sites');
	}

	/**
	 * Get all partners information and rating sites of all partners
	 * @return mixed
	 */
	public function getAll()
	{
		$response = $this->rrp_queries->wpdb_get_result("select * from $this->table_name");
		return $response;
	}

	/**
	 * Get rating sites for specific partner
	 * @param $partner_id
	 * @return mixed
	 */
	public function getRatings($partner_id)
	{
		$response = $this->rrp_queries->wpdb_get_result("select * from $this->table_name
                    WHERE partner_id = $partner_id");
		return $response;
	}

	/**
	 * Get 1 rating site of partner by rating id
	 * @param $id
	 * @return mixed
	 */
	public function getRating($id)
	{
		$response = $this->rrp_queries->wpdb_get_result("select * from $this->table_name
                    WHERE id = $id");
		return $response;
	}

	/**
	 * This will trigger to create new rating site
	 * @param $data
	 * @return bool
	 */
	public function create($data)
	{
		$response = $this->rrp_queries->wpdb_insert($data);
		return $response;
	}
	/**
	 * Delete rating site by rating id
	 * @param $id
	 * @return bool
	 */
	public function delete($id)
	{
		$response = $this->rrp_queries->wpdb_delete(['id'=>$id]);
		return $response;
	}

	/**
	 * Update rating site by rating id and specific data
	 * data - need to be set but ussually its url field update
	 * @param $id
	 * @param $data
	 * @return bool
	 */
	public function update($id, $data)
	{
		$response = $this->rrp_queries->wpdb_update(
		    $data, ['id'=>$id]
		);
		return $response;
	}

	/**
	 * Get specific partner total rating sites
	 * @param $partner_id
	 */
	public function getTotalRatingSite($partner_id)
	{
		return count($this->getRatings($partner_id));
	}
	/**
	 * Display list of partners id
	 * @param $partnerIds
	 */
	public function uiPartnersList($partnerIds)
	{

		?>
		<table id="rrp-alert-not-related" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th>Partner Id</th>
				<th>Full Name</th>
				<th>Email</th>
				<th>Total Rating Site</th>
				<th>Manage Site</th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<th>Partner Id</th>
				<th>Total Rating Site</th>
				<th>Manage Site</th>
			</tr>
			</tfoot>
			<tbody>
			<?php foreach($partnerIds as $partner):

				$partnerId = $partner['id'];
				$firstname = $partner['firstname'];
				$lastname = $partner['lastname'];
				$email = $partner['email'];

				?>
			<tr>
				<td> <?php print $partnerId; ?> </td>
				<td> <?php print $firstname . ' ' . $lastname;  ?> </td>
				<td> <?php print $email;  ?> </td>
				<td> <?php print $this->getTotalRatingSite($partnerId); ?> </td>
				<td> <a href="<?php print rrp_partner_id_list_url; ?>/?partner_id=<?php print $partnerId ?>">Manage Site</a> </td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Display specific partner rating site lists
	 * @param $ratingSites
	 */
	public function uiPartnersRatingSiteList($ratingSites)
	{
		?>
		<table id="rrp-alert-not-related" class="display" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th >Rating Site Url</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<th>Rating Site Url</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			</tfoot>
			<tbody>
			<?php foreach($ratingSites as $ratingSite):



				?>
				<tr>
					<td> <?php print $ratingSite['url']; ?> </td>
					<td> <a href="<?php print rrp_partner_id_list_url; ?>/?partner_id=<?php print $ratingSite['partner_id'] . '&id=' . $ratingSite['id'] . '&status=edit' ?>">Edit</a> </td>
					<td> <a href="<?php print rrp_partner_id_list_url; ?>/?partner_id=<?php print $ratingSite['partner_id'] . '&id=' . $ratingSite['id'] . '&status=delete' ?>">Delete</a> </td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Display form to add new rating site
	 */
	public function uiPartnerAddRattingSiteForm($partner_id)
	{ ?>
		<form  action="<?php print rrp_get_current_site_url_full(); ?>" method="POST" >
			<div class="form-group">
				<label for="exampleInputEmail1">Rating Site Url</label>
				<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Place the rating site url here.." name="url">
				<input type="hidden" value="<?php print $partner_id; ?>" name="partner_id" />
			</div>
			<button type="submit" class="btn btn-primary" name="rating_site_add">Submit</button>
		</form>
	<?php
	}

	/**
	 * Display edit rating site
	 * @param $ratingSite
	 */
	public function uiPartnerEditRattingSiteForm($ratingSite)
	{ ?>
		<form  action="<?php print rrp_get_current_site_url_full(); ?>" method="POST" >
			<div class="form-group">
				<label   for="exampleInputEmail1">Edit Rating</label>
				<input  style="width:96%"  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Place the rating site url here.." name="url" value="<?php print $ratingSite[0]['url']; ?>" >
				<input type="hidden" value="<?php print $ratingSite[0]['id']; ?>" name="id" />
				<input type="hidden" value="<?php print $ratingSite[0]['partner_id']; ?>" name="partner_id" /> 
			</div>
			<button type="submit" class="btn btn-primary" name="rating_site_update">Update</button>
		</form>
	<?php
	}
}

