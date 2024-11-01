<?php

/**
 * Fired during plugin activation
 *
 * @link       https://usocial.pro/
 * @since      1.0.0
 *
 * @package    Usocial
 * @subpackage Usocial/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Usocial
 * @subpackage Usocial/includes
 * @author     USOCIAL <hello@usocial.pro>
 */
class Usocial_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		Usocial_Wpdb::u_create_table_init();
	}

}
