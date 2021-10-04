<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://sigarra.up.pt/up/pt/vld_entidades_geral.entidade_pagina?pct_id=892200
 * @since      1.0.0
 *
 * @package    Uportovouchers
 * @subpackage Uportovouchers/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Uportovouchers
 * @subpackage Uportovouchers/includes
 * @author     Pedro Candeias <pcandeias@reit.up.pt>
 */
class Uportovouchers_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'uportovouchers',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
