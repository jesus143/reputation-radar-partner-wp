<?php
require_once('E:/xampp/htdocs/practice/wordpress/wp-load.php');



require_once rrp_site_dir_includes . 'db/wpdb_queries.class.php';
require_once rrp_site_dir_includes . 'db/wp_reputation_radar_alert.class.php';



use App\WP_Reputation_Radar_Alert;
$alert = new WP_Reputation_Radar_Alert();

//$partner_id = 1486755452;
//print "<pre>";
//print_r($test->getPartnersAlertNotRelated($partner_id));
//$test->updatePartnerAlertToRelated(44);
//print " all " . $test->countTotalAllAlert($partner_id);
//print " relevant " . $test->countTotalRelevantAlert($partner_id);
//print " not relevant " . $test->countTotalNotRelevantAlert($partner_id);


$alert_id = $_GET['alert_id'];
$type     = $_GET['type'];

if($type == 'related') {
    print "related";
    $status = $alert->updatePartnerAlertToRelated($alert_id);
} else {
    print "not related";
    $status = $alert->updatePartnerAlertNotToRelated($alert_id);
}

if($status) {
    print json_encode(['status'=>'success']);
}





