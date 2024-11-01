<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://usocial.pro/
 * @since      1.0.0
 *
 * @package    Usocial
 * @subpackage Usocial/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Usocial
 * @subpackage Usocial/public
 * @author     USOCIAL <hello@usocial.pro>
 */
class Usocial_Public {

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

		add_action("wp_footer", array($this,"add_script_body"), 20);
		add_filter("the_content", array($this,"add_script_title"));
		add_action("woocommerce_after_add_to_cart_button", array($this, "add_script_product_page"), 20);
	}

	public function add_script_body() {
		$u_script_product_page = Usocial_Wpdb::u_get_usocial_script("body");
		if ($u_script_product_page != null) {
			$u_script_product_page = $u_script_product_page[0]['scripts_usocial'];
			echo htmlspecialchars_decode(esc_html(stripslashes($u_script_product_page)), ENT_QUOTES);
		}
	}
	public function add_script_title( $content ) {
		if ( is_singular('post')) {
			$u_script_product_page = Usocial_Wpdb::u_get_usocial_script( "h1_title" );
			if ($u_script_product_page != null) {
				$u_script_product_page = $u_script_product_page[0]['scripts_usocial'];
				return htmlspecialchars_decode(esc_html(stripslashes( $u_script_product_page )), ENT_QUOTES) . $content;
			} else {return $content;}
		} else {
			return $content;
		}
	}
	public function add_script_product_page() {
		$u_script_product_page = Usocial_Wpdb::u_get_usocial_script("product_page");
		if ($u_script_product_page != null) {
			$u_script_product_page = $u_script_product_page[0]['scripts_usocial'];
			echo htmlspecialchars_decode(esc_html(stripslashes($u_script_product_page)), ENT_QUOTES);
		}
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
		 * defined in Usocial_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Usocial_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/usocial-public.css', array(), $this->version, 'all' );

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
		 * defined in Usocial_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Usocial_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/usocial-public.js', array( 'jquery' ), $this->version, false );

	}

}
