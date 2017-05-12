<?php

class Single_Post_Meta_Manager {

    protected $loader;

    protected $plugin_slug;

    protected $version;

    public function __construct() {

        $this->load_dependencies();
        $this->define_actions();
        $this->define_shortcodes();
        $this->connect();
        $this->load_files();
        $this->define_variables();
        $this->default_fields();


    }


    private function getFullUrl()
    {
        $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
        return $escaped_url;
    }
    private function connect()
    {
        global $database;
        global $wpdb;
        $url = $this->getFullUrl();
        //        print "This is the url <br><br><br><br>" . $url;
        $pos = strpos($url, 'putationradar.umbrellasupport.co.uk');

        //        print "position " . $pos;
        //        exit;
        if($pos < 1)
        {
            $database = $wpdb;
        }
        else
        {

            // $databaseInfo = getExternalDatabaseInfo();
            // $database = new wpdb('root', '1234567890', 'practice_wordpress', 'localhost');
             $database = new wpdb('dbo639369002', '1qazxsw2!QAZXSW@', 'db639369002', 'db639369002.db.1and1.com');
            // $database = new wpdb($databaseInfo['rrp_db_user'], $databaseInfo['rrp_db_pass']  , $databaseInfo['rrp_db'], $databaseInfo['rrp_db_host']);
        }
    }

    private function default_fields()
    {


    }

    private function load_dependencies() {

        require_once( ABSPATH . "wp-includes/wp-db.php");
        require_once( ABSPATH . "wp-includes/link-template.php");
        require_once( ABSPATH . "wp-includes/user.php");
        require_once( ABSPATH . "wp-includes/pluggable.php");
        require_once( ABSPATH . "wp-includes/functions.wp-scripts.php");
    }

    private function load_files()
    {
        require_once plugin_dir_path( __FILE__ ) . 'db/wpdb_queries.class.php';
        require_once plugin_dir_path( __FILE__ ) . 'db/wp_reputation_radar_alert.class.php';
        require_once plugin_dir_path( __FILE__ ) . 'db/wp_reputation_radar_rating_sites.class.php';
        require_once plugin_dir_path( __FILE__ ) . 'db/wp_reputation_radar_settings.class.php';
        require_once plugin_dir_path( __FILE__ ) . '/initialized.php';
        require_once plugin_dir_path( __FILE__ ) . '/helper.php';
        require_once plugin_dir_path( __FILE__ ) . '/function-short-codes.php';
        require_once plugin_dir_path( __FILE__ ) . '/function-action-codes.php';
        require_once plugin_dir_path( __FILE__ ) . '/function-post-codes.php'; 
        require_once plugin_dir_path( __FILE__ ) . '/function-hook-codes.php';
    }

    private function define_variables()
    {
        define('rrp_site_url', get_site_url() . '/wp-content/plugins/reputation-radar-partner/');
        define('rrp_site_dir_includes', plugin_dir_path( __FILE__ ));
        define('rrp_site', get_site_url());
        define("rrp_partner_id_list_url", rrp_site . '/reputation-radar-partners-agent');
    }

    private function define_admin_hooks()
    {
        //
    }

    private function define_actions()
    {
        add_action( 'admin_menu', 'rrp_admin_menu', 99 );
        add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts', 100 );
        add_action( 'body_begin', 'my_function');

        //        add_action( 'after_body', function($after_body){
        //            $after_body.='<input type="hidden" value="' . get_site_url() . '" id="rrp_ri_site_url"  />';
        //            return $after_body;
        //        });
    }

    private function define_shortcodes()
    {
        add_shortcode("rrp_settings", 'rrp_settings_func');

        add_shortcode("rrp_alert_partner", 'rrp_alert_partner_func');

        add_shortcode("rrp_alert_agent", 'rrp_alert_agent_func');

        add_shortcode("rrp_patners_list_agent", 'rrp_patners_list_agent_func');

        add_shortcode("rrp_alert_data_tables_test", 'rrp_alert_data_tables_test_func');

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
