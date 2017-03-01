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

function dd($str)
{
	print "<pre>";
	print_r($str);
	print "</pre>";
	die(1);
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
//		return 12345;

		// dummy partner id for my localhost
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

	$API_RESULT = bpc_as_op_query($API_URL, 'GET', $API_DATA, $API_ID, $API_KEY);

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
	return bpc_as_op_query( $API_URL, $method, $API_UDATA, $API_ID, $API_KEY );
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