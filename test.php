<?php
require_once('E:/xampp/htdocs/practice/wordpress/wp-load.php');
//require_once plugin_dir_path( __FILE__ ) . '/includes/db/wpdb_queries.class.php';
//require_once plugin_dir_path( __FILE__ ) . '/includes/db/wp_reputation_radar_alert.class.php';
//use App\WP_Reputation_Radar_Alert;
//$test = new WP_Reputation_Radar_Alert();
//$partner_id = 1486755452;
//print "<pre>";
//print_r($test->getPartnersAlertNotRelated($partner_id));
//$test->updatePartnerAlertToRelated(44);
//print " all " . $test->countTotalAllAlert($partner_id);
//print " relevant " . $test->countTotalRelevantAlert($partner_id);
//print " not relevant " . $test->countTotalNotRelevantAlert($partner_id);


$partnersId = getAllPartnerId();

print "<pre>";
print_r($partnersId);