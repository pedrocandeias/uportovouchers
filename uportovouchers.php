<?php

/**
 * The plugin bootstrap file
 *
 *
 * @link              https://sigarra.up.pt/up/pt/vld_entidades_geral.entidade_pagina?pct_id=892200
 * @since             1.0.0
 * @package           Uportovouchers
 *
 * @wordpress-plugin
 * Plugin Name:       U.Porto Vouchers
 * Plugin URI:        https://up.pt
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.1
 * Author:            Pedro Candeias
 * Author URI:        https://sigarra.up.pt/up/pt/vld_entidades_geral.entidade_pagina?pct_id=892200
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       uportovouchers
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'UPORTOVOUCHERS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-uportovouchers-activator.php
 */
function activate_uportovouchers() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-uportovouchers-activator.php';
	Uportovouchers_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-uportovouchers-deactivator.php
 */
function deactivate_uportovouchers() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-uportovouchers-deactivator.php';
	Uportovouchers_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_uportovouchers' );
register_deactivation_hook( __FILE__, 'deactivate_uportovouchers' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-uportovouchers.php';
// require plugin_dir_path( __FILE__ ) . 'includes/qrcode.php';
require plugin_dir_path( __FILE__ ) . 'wp-mpdf.php';

/* Filter the single_template with our custom function*/
function load_uportovouchers_template( $template ) {
    global $post;

    if ( 'vouchers' === $post->post_type && locate_template( array( 'single-vouchers.php' ) ) !== $template ) {
        return plugin_dir_path( __FILE__ ) . '/templates/single-vouchers.php';
    }

    return $template;
}

add_filter( 'single_template', 'load_uportovouchers_template' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_uportovouchers() {

	$plugin = new Uportovouchers();
	$plugin->run();

}
run_uportovouchers();
