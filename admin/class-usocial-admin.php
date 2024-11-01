<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://usocial.pro/
 * @since      1.0.0
 *
 * @package    Usocial
 * @subpackage Usocial/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Usocial
 * @subpackage Usocial/admin
 * @author     USOCIAL <hello@usocial.pro>
 */
class Usocial_Admin {

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

		add_action("admin_menu", array($this,"register_admin_page_usocial"));
		add_action("admin_init", array($this,"ajax_admin_page"));
	}
	// Add page setting
	function register_admin_page_usocial(){
		add_menu_page( 'USOCIAL — Кнопки поделиться для социальных сетей', 'uSocial', 'edit_others_posts', 'usocial', array($this,'render_admin_page'), 'dashicons-megaphone', 61 );
	}
	// Render page setting
	function render_admin_page(){
		require plugin_dir_path(dirname(__FILE__)).'admin/partials/usocial-admin-display.php';
	}
	// Ajax PHP
	function ajax_admin_page(){
		require plugin_dir_path(dirname(__FILE__)).'admin/ajax-admin.php';
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
		 * defined in Usocial_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Usocial_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/usocial-admin.css', array(), $this->version, 'all' );

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
		 * defined in Usocial_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Usocial_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/usocial-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/usocial-admin.js', array( 'jquery' ), $this->version, false );
        $lang_array = array('delete' => __('Удалить набор №', 'usocial'),
                            'link_site' => __('https://usocial.pro/', 'usocial'));
        wp_localize_script('usocial', 'usocial', $lang_array);
	}

}
