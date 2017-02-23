<?php
require_once("config.php");
require_once rrp_site_dir_includes . 'db/wpdb_queries.class.php';
require_once rrp_site_dir_includes . 'db/wp_reputation_radar_alert.class.php';

use App\WP_Reputation_Radar_Alert;
$alert    = new WP_Reputation_Radar_Alert();
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





