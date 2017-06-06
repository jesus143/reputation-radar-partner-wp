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
 	return (empty($settings[0]['company_search_keyword'])) ? null : $settings[0]['company_search_keyword'];
}


function rrp_settings_get_current_user_url()
{

	$user_id = rrp_get_authenticated_user_id();

	$rrp_queries = new RRP_QUERIES('wp_reputation_radar_settings');
 	$settings = $rrp_queries->wpdb_get_result("select * from wp_reputation_radar_settings where user_id = " . $user_id );
 	return (empty($settings[0]['url'])) ? null : $settings[0]['url'];
}


function rrp_setting_get_current_user_keyword_setting()
{
	$user_id = rrp_get_authenticated_user_id();

	$rrp_queries = new RRP_QUERIES('wp_reputation_radar_settings');
	$settings = $rrp_queries->wpdb_get_result("select * from wp_reputation_radar_settings where user_id = " . $user_id );
	return (empty($settings[0]['keyword_setting'])) ? null : $settings[0]['keyword_setting'];
}



function rrp_settings_get_specific_company_url_by_partner_id($partner_id)
{
	$rrp_queries = new RRP_QUERIES('wp_reputation_radar_settings');
	$settings = $rrp_queries->wpdb_get_result("select * from wp_reputation_radar_settings where partner_id = " . $partner_id );
	return (empty($settings[0]['url'])) ? null : $settings[0]['url'];
}

function rrp_alert_get_scraped_keyword_by_partner_id($alert_id)
{
	$rrp_queries = new RRP_QUERIES('wp_reputation_radar_alert');
	$settings = $rrp_queries->wpdb_get_result("select * from wp_reputation_radar_alert where id = " . $alert_id);
	$keyword = (empty($settings[0]['keyword'])) ? null : $settings[0]['keyword'];
	return $keyword;
}


function rrp_settings_get_specific_company_search_keyword_by_partner_id($partner_id, $alert_id, $rating)
{
	if($rating > 0) {

		$rrp_queries = new RRP_QUERIES('wp_reputation_radar_alert');
		$settings = $rrp_queries->wpdb_get_result("select * from wp_reputation_radar_alert where id = " . $alert_id);
		$url = (empty($settings[0]['url'])) ? null : $settings[0]['url'];

 		$url_name = explode("/", $url );

		$link_name = $url_name[2];

		return " <a href='"  . $url . "' target='_blank' >  " . $link_name . " </a>";

	} else {

		$rrp_queries = new RRP_QUERIES('wp_reputation_radar_alert');
		$settings = $rrp_queries->wpdb_get_result("select * from wp_reputation_radar_alert where id = " . $alert_id);
		$url = (empty($settings[0]['url'])) ? null : $settings[0]['url'];
		$title = (empty($settings[0]['title'])) ? null : $settings[0]['title'];



		return " <a href='"  . $url . "' target='_blank' >  " . $title . " </a>";




//		$rrp_queries = new RRP_QUERIES('wp_reputation_radar_settings');
//		$settings = $rrp_queries->wpdb_get_result("select * from wp_reputation_radar_settings where partner_id = " . $partner_id);


//		$url = (empty($settings[0]['url'])) ? null : $settings[0]['url'];
//		$title = 'aooglle';// (empty($settings[0]['title'])) ? null : $settings[0]['title'];
//
//		return " <a href='"  . $url . "' target='_blank'> " . $title . "   </a>";
	}

}


if(!function_exists('dd')) {

	function dd($str)
	{
		print "<pre>";
		print_r($str);
		print "</pre>";
		die(1);
	}
}


function rrp_get_authenticated_user_id()
{
	return  get_current_user_id();
}
function rrp_get_authenticated_partner_id()
{
	return rrp_as_get_current_user_partner_id();
}
// get current user partner id from ontraport
function rrp_as_get_current_user_partner_id()
{
	if(rrp_as_is_localhost() ){
		return 54321;
	} else if (rrp_is_reputation_radar() == true) {
		return false;
	} else {
		$opResponse = rrp_as_get_ontraport_info();
		$opResponse = json_decode($opResponse, true );
		return $opResponse['data'][0]['id'];
	}
}
function rrp_as_get_ontraport_info()
{
	$faceBookEmail = '';
	$method = 'GET';
	$user   = wp_get_current_user();
	$API_URL    = 'https://api.ontraport.com/1/objects?';
	//      print "<brr> current user email " . $user->user_email;

	$API_DATA   = array(
			'objectID'      => 0,
			'performAll'    => 'true',
			'sortDir'       => 'asc',
			'condition'     => "email='".$user->user_email."'", //use this format since its a sql query condition. For other fields, you may change this value to something else.
			'searchNotes'   => 'true'
	);

	$API_KEY                = 'fY4Zva90HP8XFx3';
	$API_ID                 = '2_7818_AFzuWztKz';

	//$API_RESULT   = query_api_call($postargs, $API_ID, $API_KEY);

	$API_RESULT = rrp_as_op_query($API_URL, 'GET', $API_DATA, $API_ID, $API_KEY);

	$getName    = json_decode($API_RESULT);

	//      var_dump($getName->data[0]); //sample for getting all data from the decoded json

	$PARTNER_ID     = $getName->data[0]->id;
	//      echo $PARTNER_ID; //partner ID

	$FACEBOOK_EMAILSAMPLE = $faceBookEmail;

	$API_UDATA  = array(
			'objectID'          => 0,
			'id'            => $PARTNER_ID,
			'f1583'         => $FACEBOOK_EMAILSAMPLE
	);

	//GET PUT RESULT
	return rrp_as_op_query( $API_URL, $method, $API_UDATA, $API_ID, $API_KEY );
}
function rrp_as_op_query($url, $method, $data, $appID, $appKey){
	$ch = curl_init( );
	switch ($method){
		case 'POST': {
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen(json_encode($data)), 'Api-Appid:' . $appID, 'Api-Key:' . $appKey));
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			break;
		}
		case 'PUT': {
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen(json_encode($data)), 'Api-Appid:' . $appID, 'Api-Key:' . $appKey));
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			break;
		}
		case 'GET': {
			$finalURL = $url . urldecode(http_build_query($data));
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt ($ch, CURLOPT_URL, $finalURL);
			curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Api-Appid:' . $appID, 'Api-Key:' . $appKey));
			break;
		}
	}
	$response  = curl_exec($ch);
	curl_close($ch);

	return $response;
}
function rrp_as_is_localhost() {
	$whitelist = array( '127.0.0.1', '::1' );
	if( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) ) {
		return true;
	}
}
function rrp_is_limit_str($str, $limit=10) {
	if (strlen($str) > $limit)
		$str = substr($str, 0, $limit) . '...';


	return $str ;
}

if(!function_exists('rrp_is_local')) {
	function rrp_is_local()
	{
		if ($_SERVER['HTTP_HOST'] == 'localhost'
				|| substr($_SERVER['HTTP_HOST'], 0, 3) == '10.'
				|| substr($_SERVER['HTTP_HOST'], 0, 7) == '192.168'
		) return true;
		return false;
	}
}

function rrp_script_and_style()
{
	?>

		<script src="https://code.jquery.com/jquery-3.2.1.min.js"> </script>



	<?php
}


function rrp_time_elapsed_string($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function rrp_redirect($url) {
	?>
	<script>
		document.location = '<?php print $url; ?>';
	</script>

	<?php
}



function getExternalDatabaseInfo() {
	$rrp_db      = (get_option('rrp_db')) ? get_option('rrp_db') : 'db639369002';
	$rrp_db_user = (get_option('rrp_db_user')) ? get_option('rrp_db_user') : 'dbo639369002';
	$rrp_db_pass = (get_option('rrp_db_pass')) ? get_option('rrp_db_pass') : '1qazxsw2!QAZXSW@';
	$rrp_db_host = (get_option('rrp_db_host')) ? get_option('rrp_db_host') : 'db639369002.db.1and1.com';

	$databaseInfo['rrp_db'] = $rrp_db;
	$databaseInfo['rrp_db_user'] = $rrp_db_user;
	$databaseInfo['rrp_db_pass'] = $rrp_db_pass;
	$databaseInfo['rrp_db_host'] = $rrp_db_host;

	return $databaseInfo;
}

function getAllPartnerId()
{
	//	$API_KEY  = '2_7818_ubHppKG8C';
	$API_KEY  = 'fY4Zva90HP8XFx3';
	//	$API_ID  = 'Kiok5B2tzM00Oqf';
	$API_ID  = '2_7818_AFzuWztKz';
	$API_DATA = array(
			'objectID'    => 0,
			'performAll'  => 'true',
			'sortDir'     => 'asc',
			'searchNotes' => 'true'
	);
	$url = 'https://api.ontraport.com/1/objects?';

	$ch = curl_init();
	$finalURL = $url . urldecode(http_build_query($API_DATA));

	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt ($ch, CURLOPT_URL, $finalURL);
	curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Api-Appid:' . $API_ID, 'Api-Key:' . $API_KEY));
	$response  = curl_exec($ch);
	curl_close($ch);

	$API_INFO  = json_decode($response, true);

	//	print "<pre>";
	//		print_r($API_INFO['data']);
	//	print "</pre>";
	//
	//	exit;

	return $API_INFO['data'];
}


/**
 *
 * Get times as option-list.
 *
 * @return string List of times
 */
function rrp_get_times( $default = '19:00', $interval = '+1 hour' ) {

	$output = '';

	$current = strtotime( '00:00' );
	$end = strtotime( '23:59' );

	$output .= "<option value='select' selected>Whole day</option>";

	while( $current <= $end ) {
		$time = date( 'H:i', $current );
		$sel = ( $time == $default ) ? ' selected' : '';

		$output .= "<option value=\"{$time}\"{$sel}>" . date( 'h.i A', $current ) .'</option>';
		$current = strtotime( $interval, $current );
	}

	return $output;
}

function rrp_get_user_full_name($user_id){
	$user_info = get_userdata($user_id);

	if(empty($user_info->last_name) and empty($user_info->first_name)) {
		return null;
  	} else {
		return $user_info->last_name .  ", " . $user_info->first_name;
	}


}

function rrp_date_time_human_readable($dateTime) {
	return date("F j/D Y , g:i:s a",strtotime($dateTime));
}


function rrp_get_date_today() {
	return date('Y-m-d');
}

function rrp_get_current_url() {
	$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
	$escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
	return $escaped_url;
}

function rrp_is_reputation_radar() {
	$url = rrp_get_current_url();

	$pos = strpos($url, 'putationradar.umbrellasupport.co.uk');

	if($pos < 1) {
		return false;
	} else {
	 	return true;
	}
} 

function rrp_is_logged_in()
{ 
	if(is_user_logged_in()) {
		return true; 
	} else { 
		return false;
	} 
}

function rrp_check_login_redirect_login_page() 
{
	
	if(!rrp_is_logged_in()) { 

		// get site url and concat with wp-login.php 
		$url = get_site_url() . '/wp-login.php';  

		// redirect to url
		rrp_redirect($url);

		exit; 
	} else {

	}
}