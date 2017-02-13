<?php  
use App\RRP_QUERIES; 
 
if(!function_exists('rrp_get_current_site_url_full')) {
	function rrp_get_current_site_url_full()
	{ 
	    $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; 
		$escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );  
	    return $escaped_url;  
	}
}
 
function rrp_settings_get_current_user_keyword()
{  
	$rrp_queries = new RRP_QUERIES('wp_reputation_radar_settings'); 
 	$settings = $rrp_queries->wpdb_get_result("select * from wp_reputation_radar_settings where user_id = " . rrp_get_authenticated_user_id());
 	// print_r($settings); 
 	return (empty($settings[0]['company_search_keyword'])) ? null : $settings[0]['company_search_keyword']; 
} 

function rrp_get_authenticated_user_id() 
{
	return 1; 
}    

function rrp_get_authenticated_partner_id() 
{   
	// $rrp_queries = new RRP_QUERIES('wp_reputation_radar_settings'); 
 	// $settings = $rrp_queries->wpdb_get_result("select * from wp_reputation_radar_settings where user_id = " . rrp_get_authenticated_user_id());   
	return 1486757155; 
}


function dd($str)
{
	print "<pre>";
		print_r($str);
	print "</pre>";
	die(1);
}