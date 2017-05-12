<?php
require_once("config.php");

require_once rrp_site_dir_includes . 'db/wpdb_queries.class.php';
require_once rrp_site_dir_includes . 'db/wp_reputation_radar_alert.class.php';

use App\WP_Reputation_Radar_Alert;

$alert    = new WP_Reputation_Radar_Alert();

$alert_id = $_GET['alert_id'];

$status   = $alert->updatePartnerAlertToNotRelatedByAgent($alert_id);

            $alert->addAgentId($alert_id);

            $alert->addAgentUpdated($alert_id);





