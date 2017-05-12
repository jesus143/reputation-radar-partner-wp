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
 *
 *
 *
 * pages:
 * reputation-radar-settings  - shortcode -> [rrp_settings]
 * reputation-radar-alert - shortcode -> [rrp_alert_partner]
 * reputation-radar-alert-agent  - shortcode -> [rrp_alert_agent]
 */


if ( ! defined( 'WPINC' ) ) {
    die;
}

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
