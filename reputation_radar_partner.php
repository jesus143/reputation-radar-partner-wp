<?php
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
 */  

if ( ! defined( 'WPINC' ) ) {
    die;
} 
require_once plugin_dir_path( __FILE__ ) . '/includes/class-single-post-meta-manager.php'; 
function run_single_post_meta_manager() { 
    $spmm = new Single_Post_Meta_Manager(); 
} 

run_single_post_meta_manager(); 