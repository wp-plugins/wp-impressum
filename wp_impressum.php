<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.conversion-junkies.de
 * @since             1.0.0
 * @package           Wp_impressum
 *
 * @wordpress-plugin
 * Plugin Name:       wp_impressum
 * Plugin URI:        http://www.conversion-junkies.de
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Marcus Franke
 * Author URI:        http://www.conversion-junkies.de
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp_impressum
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp_impressum-activator.php
 */
function activate_wp_impressum() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp_impressum-activator.php';
	Wp_impressum_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp_impressum-deactivator.php
 */
function deactivate_wp_impressum() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp_impressum-deactivator.php';
	Wp_impressum_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_impressum' );
register_deactivation_hook( __FILE__, 'deactivate_wp_impressum' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp_impressum.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_impressum() {

	$plugin = new Wp_impressum();
	$plugin->run();

}
run_wp_impressum();
