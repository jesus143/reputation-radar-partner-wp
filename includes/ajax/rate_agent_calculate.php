<?php

 require_once("config.php");

 require_once rrp_site_dir_includes . 'db/wpdb_queries.class.php';

 use APP\RRP_QUERIES;

 $rrp_queries = new RRP_QUERIES();

 $type       = $_POST['type'];
 $hour       = $_POST['hour'];
 $week       = $_POST['week'];
 $day        = $_POST['day'];
 $agent_id   = $_POST['agent_id'];
 $dateNow    = date('Y-m-d');


 $url = get_site_url() . '/reputation-radar-alert/?agent_id='.$agent_id . '&action=view all click';



 if($type == 'hour') {

    $timestamp                = strtotime($hour);

    $timestamp_one_hour_later = $timestamp + 3600; // 3600 sec. = 1 hour

    $later_hour               = strftime('%H:%M', $timestamp_one_hour_later);

    $dateToday = $dateNow . ' ' . $hour;

    $dateTodayLater = $dateNow . ' ' . $later_hour;

    $results = $rrp_queries->wpdb_get_result( "SELECT  count(*) as total_click  FROM wp_reputation_radar_alert WHERE  agent_id = $agent_id and (agent_updated BETWEEN '$dateToday' AND '$dateTodayLater')");

    $totalClick = $results[0]['total_click'];

    $link = "Today between " . rrp_date_time_human_readable($dateToday) . "  and " . rrp_date_time_human_readable($dateTodayLater) . " agent total click is  <b> $totalClick </b>";



 } else if ($type == 'day') {

    if($hour == 'select') {

       $dateToday = $day . ' 00:00:00';

       $dateTodayLater = $day . ' 23:59:00';

       $results = $rrp_queries->wpdb_get_result( "SELECT  count(*) as total_click  FROM wp_reputation_radar_alert WHERE  agent_id = $agent_id and (agent_updated BETWEEN '$dateToday' AND '$dateTodayLater')");

    } else {

     $timestamp                = strtotime($hour);

     $timestamp_one_hour_later = $timestamp + 3600; // 3600 sec. = 1 hour

     $later_hour               = strftime('%H:%M', $timestamp_one_hour_later);

     $dateToday = $day . ' ' . $hour;

     $dateTodayLater = $day . ' ' . $later_hour;

     $results = $rrp_queries->wpdb_get_result( "SELECT  count(*) as total_click  FROM wp_reputation_radar_alert WHERE  agent_id = $agent_id and (agent_updated BETWEEN '$dateToday' AND '$dateTodayLater')");

    }

    $totalClick = $results[0]['total_click'];

    $link = " Total click between " . rrp_date_time_human_readable($dateToday) . " and " . rrp_date_time_human_readable($dateTodayLater) . "  agent total click is   <b> $totalClick </b>";


 } else {


    $weekDateStart = date("Y-m-d", strtotime($week)) . ' 00:00:00';

    $weekDateEnd = date('Y-m-d', strtotime($weekDateStart. ' + 6 days')) . ' 00:00:00';

    $results = $rrp_queries->wpdb_get_result( "SELECT  count(*) as total_click  FROM wp_reputation_radar_alert WHERE  agent_id = $agent_id  and (agent_updated BETWEEN '$weekDateStart' AND '$weekDateEnd')");

    $totalClick = $results[0]['total_click'];

    $link = "Total click between week day " . rrp_date_time_human_readable($weekDateStart) . " to day " . rrp_date_time_human_readable($weekDateEnd) . " is  <b> $totalClick </b>";

 }


$link .= "click  <a href='$url'>here</a> to view all agent clicks";
echo  json_encode(['total_click'=>$link]);
