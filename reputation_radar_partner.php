<?php
if(!session_id()) {
    session_start();
}
/* 
 * Plugin Name:       Reputation Radar Partner
 * Plugin URI:
 * Description:       This is the reputation radar for partner ui and functions
 * Version:           0.1.0
 * Author:            Tom McFarlin
 * Author URI:
 * Text Domain:
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 *  
 * pages:
 * 
 *  [rrp_settings]
 *  This shortcode is to display the settings for scraping in google
 * 
 * [rrp_alert_partner]
 * This is to display all the alerts for partner that has been already rated by agents
 * 
 * [rrp_alert_agent]
 * All alert display and need the rating of the agents
 * 
 * reputation-radar-alert-agent-list  - shortcode -> [rrp_patners_list_agent_func]
 * 
 *
 * 
 * Note:
 * Database is in testing....uk.com
 * so reputation.radar is connected to testing
 * also cronjobs queries is connected to testing database
 *
 *
 * If the domain is updated then also change it to the rrp_pages
 */
 
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Pages 
 */
$_SESSION['rrp_pages'] = ['reputation-radar-alert', 'reputation-radar-alert-agent', 'reputation-radar', 'reputation-radar-test', 'reputation-radar-partners-agent'];
 
require_once plugin_dir_path( __FILE__ ) . '/includes/class-single-post-meta-manager.php';

function run_single_post_meta_manager() {

    $spmm = new Single_Post_Meta_Manager();
}

run_single_post_meta_manager();

/**
 * Create database table when plugin is activated
 */
register_activation_hook( __FILE__, 'rrp_table_install' );

function rrp_table_install()
{

    global $jal_db_version;
    $jal_db_version = '1.0';

    global $wpdb;
    global $jal_db_version;

    $table_name = $wpdb->prefix . 'reputation_radar_alert';

    $charset_collate = $wpdb->get_charset_collate();

    $sql1 = "CREATE TABLE $table_name (
		id int(9) NOT NULL AUTO_INCREMENT,
        partner_id int(9) NOT NULL,
        agent_id int(11) NOT NULL, /** user_id as agent_id */
        agent_updated datetime NOT NULL, /** This will update date when agent click relevant or not relevant with in alert */
        title varchar(255) NOT NULL,
        description text NOT NULL,
        person_name varchar(255) NOT NULL,
        url varchar(255) NOT NULL,
        status smallint(2) NOT NULL,
        comment text NOT NULL,
        rate varchar(50) NOT NULL,
        keyword varchar(255) NOT NULL,
        updated_at datetime NOT NULL,
        created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY  (id)
	) $charset_collate;";

    $table_name = $wpdb->prefix . 'reputation_radar_settings';
    $sql2 = "CREATE TABLE $table_name (
        id int(11) NOT NULL AUTO_INCREMENT,
        url varchar(255) NOT NULL,
        partner_id int(11) NOT NULL,
        user_id int(11) NOT NULL,
        company_search_keyword varchar(255) NOT NULL,
        keyword_setting varchar(50) NOT NULL,
        updated_at datetime NOT NULL,
        created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    ) $charset_collate;";    


    $table_name = $wpdb->prefix . 'reputation_radar_rating_sites';
    $sql3 = "CREATE TABLE $table_name (
        id int(11) NOT NULL AUTO_INCREMENT, 
        partner_id int(11) NOT NULL,
        url  text NOT NULL, 
        updated_at datetime NOT NULL,
        created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    $table_name = $wpdb->prefix . 'reputation_radar_setting_batch';
    $sql4 = "CREATE TABLE $table_name (
		id int(11) NOT NULL AUTO_INCREMENT, 
        index_pos int(11) NOT NULL,
        updated_at datetime NOT NULL,
        created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY  (id)
	) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql1);
    dbDelta($sql2);
    dbDelta($sql3);
    dbDelta($sql4);

    add_option('jal_db_version', $jal_db_version);
}
