<?php

class Single_Post_Meta_Manager {

    protected $loader;

    protected $plugin_slug;

    protected $version;

    public function __construct() {
        $this->load_dependencies();
        $this->define_actions();
        $this->define_shortcodes();
        $this->load_files();
        $this->define_variables();

    }

    private function load_dependencies() {

        require_once( ABSPATH . "wp-includes/link-template.php");
        require_once( ABSPATH . "wp-includes/user.php");
        require_once( ABSPATH . "wp-includes/pluggable.php");
    }

    private function load_files() {

        require_once plugin_dir_path( __FILE__ ) . 'db/wpdb_queries.class.php';
        require_once plugin_dir_path( __FILE__ ) . 'db/wp_reputation_radar_alert.class.php';
        require_once plugin_dir_path( __FILE__ ) . 'db/wp_reputation_radar_settings.class.php';
        require_once plugin_dir_path( __FILE__ ) . '/initialized.php';
        require_once plugin_dir_path( __FILE__ ) . '/helper.php';
        require_once plugin_dir_path( __FILE__ ) . '/function-short-codes.php';
        require_once plugin_dir_path( __FILE__ ) . '/function-action-codes.php';
        require_once plugin_dir_path( __FILE__ ) . '/function-post-codes.php'; 
        require_once plugin_dir_path( __FILE__ ) . '/function-hook-codes.php';
    }
    private function define_variables() {
        define('rrp_site_url', get_site_url() . '/wp-content/plugins/reputation-radar-partner/');
        define('rrp_site_dir_includes', plugin_dir_path( __FILE__ ));
    }
    private function define_admin_hooks()
    {
    }

    private function define_actions()
    {
        add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );
        add_action( 'admin_menu', 'rrp_admin_menu' );

    }

    private function define_shortcodes()
    {
        add_shortcode("rrp_settings", 'rrp_settings_func');
        add_shortcode("rrp_alert_partner", 'rrp_alert_partner_func');
        add_shortcode("rrp_alert_agent", 'rrp_alert_agent_func');
    }

    public function run()
    {
        //
    }

    public function get_version()
    {
        //
    }


}