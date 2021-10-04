<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://sigarra.up.pt/up/pt/vld_entidades_geral.entidade_pagina?pct_id=892200
 * @since      1.0.0
 *
 * @package    Uportovouchers
 * @subpackage Uportovouchers/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Uportovouchers
 * @subpackage Uportovouchers/public
 * @author     Pedro Candeias <pcandeias@reit.up.pt>
 */
class Uportovouchers_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Uportovouchers_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Uportovouchers_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

//	wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/uportovouchers-public2.css', array(), $this->version, 'all' );
//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/uportovouchers-public.css', array(), $this->version, 'all' );
wp_enqueue_style( $this->plugin_name, plugins_url(). '/js_composer/assets/lib/bower/font-awesome/css/all.min.css?ver=6.2.0', array(), $this->version, 'all' );
//<link rel="stylesheet" id="vc_font_awesome_5_shims-css" href="http://localhost/vouchers/wp-content/plugins/js_composer/assets/lib/bower/font-awesome/css/v4-shims.min.css?ver=6.2.0" type="text/css" media="all">
//<link rel="stylesheet" id="vc_font_awesome_5-css" href="http://localhost/vouchers/wp-content/plugins/js_composer/assets/lib/bower/font-awesome/css/all.min.css?ver=6.2.0" type="text/css" media="all">

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Uportovouchers_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Uportovouchers_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/uportovouchers-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
* Returns the count of object of the vouchers
*
* @param array $params An array of optional parameters
* quantity Number of quote posts to return
*
* @return object A post object
*/

public function get_vouchers_numbers($params) {
		$return = '';
		$args = array(
			'post_type' => 'vouchers',
			'posts_per_page' => $params,
		);
			$query = new WP_Query( $args );
			if ( is_wp_error( $query ) ) {
				$return = 'Oops!...No posts for you!';
			} else {
				$return = $query->posts;
			}

		return $return;
	} // get_rdm_quotes()
}
