<?php
/**
 * Plugin Name: WooCommerce Color Picker
 * Description: Adds a color picker to WooCommerce attributes and replaces variation dropdowns with clickable color swatches.
 * Version: 1.1
 * Author: Ilona de Haan
 * Author URI: https://vyzual.nl
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: woocommerce-color-picker
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Prevent direct access
}

// Define constants
define( 'WCCP_VERSION', '1.1' );
define( 'WCCP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WCCP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Load required files
require_once WCCP_PLUGIN_DIR . 'includes/class-wccp-admin.php';
require_once WCCP_PLUGIN_DIR . 'includes/class-wccp-frontend.php';

// Initialize plugin
function wccp_init() {
    WCCP_Admin::init();
    WCCP_Frontend::init();
}
add_action( 'plugins_loaded', 'wccp_init' );

// Register assets
function wccp_register_assets() {
    wp_register_style( 'wccp-styles', WCCP_PLUGIN_URL . 'assets/css/style.css', [], WCCP_VERSION );
    wp_register_script( 'wccp-scripts', WCCP_PLUGIN_URL . 'assets/js/script.js', [ 'jquery' ], WCCP_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'wccp_register_assets' );

// Load translations
function wccp_load_textdomain() {
    load_plugin_textdomain( 'woocommerce-color-picker', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'wccp_load_textdomain' );
