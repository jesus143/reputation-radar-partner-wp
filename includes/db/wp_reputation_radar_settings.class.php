<?php 
namespace App;

class WP_Reputation_Radar_Settings {

	protected $table_name = 'wp_reputation_radar_settings';

	function __construct() 
	{
		$this->rrp_queries = new RRP_QUERIES($this->table_name);
	}

	public function getCurrentPartnerIdFromSettings()
	{
		$user_id = rrp_get_authenticated_user_id();

		$settings = $this->rrp_queries->wpdb_get_result("select * from $this->table_name where user_id =  $user_id ");
		return $settings[0]['partner_id'];
	}
}