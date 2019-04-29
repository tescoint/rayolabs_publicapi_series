<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://facebook.com/tsal3
 * @since             1.0.0
 * @package           Rayolabs_publicapi_series
 *
 * @wordpress-plugin
 * Plugin Name:       RayoLabs Series King plugin
 * Plugin URI:        https://publicapi.org.ng
 * Description:       The RayoLabs Content Series King plugin (developed by Tes Sal CTO PublicApi.org.ng) is a powerful, lightweight and easy to use Atom/RSS aggregation and movie series content curation plugin for WordPress.
 * Version:           1.0.0
 * Author:            Tes Sal
 * Author URI:        https://facebook.com/tsal3
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rayolabs_publicapi_series
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
define( 'RAYOLABS_PUBLICAPI_SERIES_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rayolabs_publicapi_series-activator.php
 */
function activate_rayolabs_publicapi_series() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rayolabs_publicapi_series-activator.php';
	Rayolabs_publicapi_series_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rayolabs_publicapi_series-deactivator.php
 */
function deactivate_rayolabs_publicapi_series() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rayolabs_publicapi_series-deactivator.php';
	Rayolabs_publicapi_series_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rayolabs_publicapi_series' );
register_deactivation_hook( __FILE__, 'deactivate_rayolabs_publicapi_series' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rayolabs_publicapi_series.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rayolabs_publicapi_series() {

	$plugin = new Rayolabs_publicapi_series();
	$plugin->run();

}
run_rayolabs_publicapi_series();
