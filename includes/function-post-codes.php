<?php  
use App\RRP_QUERIES; 
 	
 // set current user id, authenticated 
 $user_id = rrp_get_authenticated_user_id() ; 

 // set current authenticated, partner id from op
 $partner_id =  rrp_get_authenticated_partner_id();



if(isset($_POST['rrp_post_settings'])) { 


	$_SESSION['rrp_settings_update_status'] = '';
	
	$rrp_queries = new RRP_QUERIES('wp_reputation_radar_settings');  

 	$company_search_keyword  = $_POST['company_search_keyword'];
 	$company_url 		     = $_POST['company_url'];
	$keyword_setting 		 = $_POST['keyword_setting'];

 	$settings = $rrp_queries->wpdb_get_result("select * from wp_reputation_radar_settings where user_id = " . $user_id);

 	if(!empty($settings)) { 
 		// update  
 		if ( $rrp_queries->wpdb_update(['company_search_keyword'=>$company_search_keyword, 'partner_id'=>$partner_id, 'url'=>$company_url, 'keyword_setting'=>$keyword_setting], ['user_id'=>$user_id]) ) {
 			$_SESSION['rrp_settings_update_status'] = "<div class='alert alert-success' > successfully updated </div>";
 		} else {
 			$_SESSION['rrp_settings_update_status'] =  "<div class='alert alert-danger' > failed to updated </div>";
 		}
 	} else {
 		// insert
 		if ( $rrp_queries->wpdb_insert(['user_id'=>$user_id, 'company_search_keyword'=>$company_search_keyword, 'partner_id'=>$partner_id, 'url'=>$company_url, 'keyword_setting'=>$keyword_setting])) {
 			$_SESSION['rrp_settings_update_status'] =  "<div class='alert alert-success' > successfully inserted </div>";
 		} else {
 			$_SESSION['rrp_settings_update_status'] =  "<div class='alert alert-danger' > failed to insert </div>";
 		}
 	} 
}

// // get current value of settings

// $rrp_queries = RRP_QUERIES('wp_reputation_radar_settings'); 
// $settings = $rrp_queries->wpdb_get_result("select * from wp_reputation_radar_settings where user_id = " . rrp_get_authenticated_user_id());

// print_r($settings);



