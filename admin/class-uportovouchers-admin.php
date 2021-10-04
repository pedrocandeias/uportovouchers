<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://sigarra.up.pt/up/pt/vld_entidades_geral.entidade_pagina?pct_id=892200
 * @since      1.0.0
 *
 * @package    Uportovouchers
 * @subpackage Uportovouchers/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Uportovouchers
 * @subpackage Uportovouchers/admin
 * @author     Pedro Candeias <pcandeias@reit.up.pt>
 */
class Uportovouchers_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/uportovouchers-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/uportovouchers-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	* Creates a new custom post type
	*
	* @since 1.0.0
	* @access public
	* @uses register_post_type()
	*/
	public static function new_cpt_uportovouchers() {
		$cap_type = 'post';
		$plural = 'vouchers';
		$single = 'voucher';
		$cpt_name = 'vouchers';
		$opts['can_export'] = TRUE;
		$opts['capability_type'] = $cap_type;
		$opts['description'] = '';
		$opts['exclude_from_search'] = FALSE;
		$opts['has_archive'] = FALSE;
		$opts['hierarchical'] = FALSE;
		$opts['map_meta_cap'] = TRUE;
		$opts['menu_icon'] = 'dashicons-tickets-alt';
		$opts['menu_position'] = 25;
		$opts['public'] = TRUE;
		$opts['publicly_querable'] = TRUE;
		$opts['query_var'] = TRUE;
		$opts['register_meta_box_cb'] = '';
		$opts['rewrite'] = FALSE;
		$opts['show_in_admin_bar'] = TRUE;
		$opts['show_in_menu'] = TRUE;
		$opts['show_in_nav_menu'] = TRUE;
		$opts['supports']  = array( 'title', 'editor', 'thumbnail' );
		$opts['labels']['add_new'] = esc_html__( "Add New {$single}", 'uportovouchers' );
		$opts['labels']['add_new_item'] = esc_html__( "Add New {$single}", 'uportovouchers' );
		$opts['labels']['all_items'] = esc_html__( $plural, 'uportovouchers' );
		$opts['labels']['edit_item'] = esc_html__( "Edit {$single}" , 'uportovouchers' );
		$opts['labels']['menu_name'] = esc_html__( $plural, 'uportovouchers' );
		$opts['labels']['name'] = esc_html__( $plural, 'uportovouchers' );
		$opts['labels']['name_admin_bar'] = esc_html__( $single, 'uportovouchers' );
		$opts['labels']['new_item'] = esc_html__( "New {$single}", 'uportovouchers' );
		$opts['labels']['not_found'] = esc_html__( "No {$plural} Found", 'uportovouchers' );
		$opts['labels']['not_found_in_trash'] = esc_html__( "No {$plural} Found in Trash", 'uportovouchers' );
		$opts['labels']['parent_item_colon'] = esc_html__( "Parent {$plural} :", 'uportovouchers' );
		$opts['labels']['search_items'] = esc_html__( "Search {$plural}", 'uportovouchers' );
		$opts['labels']['singular_name'] = esc_html__( $single, 'uportovouchers' );
		$opts['labels']['view_item'] = esc_html__( "View {$single}", 'uportovouchers' );
		register_post_type( strtolower( $cpt_name ), $opts );
	}
}


// action to add meta boxes
add_action( 'add_meta_boxes', 'uportovouchers_dropdown_metabox' );
// action on saving post
add_action( 'save_post', 'uportovouchers_dropdown_save' );

// function that creates the new metabox that will show on post
function uportovouchers_dropdown_metabox() {
    add_meta_box(
        'uportovouchers_dropdown',  // unique id
        __( 'Estado do voucher', 'uportovouchers' ),  // metabox title
        'uportovouchers_dropdown_display',  // callback to show the dropdown
        'vouchers'   // post type
    );
}

// uportovouchers dropdown display
function uportovouchers_dropdown_display( $post ) {
  // Use nonce for verification
  wp_nonce_field( basename( __FILE__ ), 'uportovouchers_dropdown_nonce' );
  // get current value
  $dropdown_value = get_post_meta( get_the_ID(), 'uportovouchers_dropdown', true );
  ?>
    <select name="uportovouchers_dropdown" id="uportovouchers_dropdown">
        <option value="Ativo" <?php if($dropdown_value == 'Ativo') echo 'selected'; ?>>Ativo</option>
        <option value="Inativo" <?php if($dropdown_value == 'Inativo') echo 'selected'; ?>>Inativo</option>
        <option value="Usado" <?php if($dropdown_value == 'Usado') echo 'selected'; ?>>Usado</option>
    </select>
  <?php
}

// dropdown saving
function uportovouchers_dropdown_save( $post_id ) {
    // if doing autosave don't do nothing
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;
  // verify nonce

if(isset($_POST['uportovouchers_dropdown_nonce'])) {
  if ( !wp_verify_nonce( $_POST['uportovouchers_dropdown_nonce'], basename( __FILE__ ) ) ) {
      return;
	}
}


  // Check permissions
if(isset($_POST['post_type'])) {
  if ( 'page' == $_POST['post_type'] )
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }
}

  // save the new value of the dropdown
	$new_value = isset($_POST['uportovouchers_dropdown']) ? $_POST['uportovouchers_dropdown'] : '';

  update_post_meta( $post_id, 'uportovouchers_dropdown', $new_value );
}
