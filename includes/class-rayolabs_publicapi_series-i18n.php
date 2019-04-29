<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://facebook.com/tsal3
 * @since      1.0.0
 *
 * @package    Rayolabs_publicapi_series
 * @subpackage Rayolabs_publicapi_series/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Rayolabs_publicapi_series
 * @subpackage Rayolabs_publicapi_series/includes
 * @author     Tes Sal <tescointsite@gmail.com>
 */
class Rayolabs_publicapi_series_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'rayolabs_publicapi_series',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
