<?php
class Usocial_Wpdb {
	public function __construct() {

	}
	//Get current script
	public static function u_get_usocial_script ($u_display_loc) {
		global $wpdb;
		$table_name = $wpdb->get_blog_prefix() . 'usocial_sets';
		$u_added_scripts_result = $wpdb->get_results("SELECT scripts_usocial FROM $table_name WHERE display_locations = '{$u_display_loc}' ORDER BY id DESC");
		$u_added_scripts_result = json_decode(json_encode($u_added_scripts_result),true);
		return $u_added_scripts_result;
	}

	//Get current set or all set's
	public static function u_get_usocial_set ($u_id_set) {
		global $wpdb;
		$table_name = $wpdb->get_blog_prefix() . 'usocial_sets';
		if ($u_id_set == null) {
			$u_added_sets_result = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC");
			return $u_added_sets_result;
		} else {
			$u_current_sets_result = $wpdb->get_results( "SELECT * FROM $table_name WHERE id = {$u_id_set}" );
			$u_current_sets_result = json_decode(json_encode($u_current_sets_result),true);
			return $u_current_sets_result;
		}
	}

	//Update set
	public static function u_update_usocial_set ($u_id,$u_id_usocial,$u_script_usocial,$u_display_loc) {
		global $wpdb;
		$table_name = $wpdb->get_blog_prefix() . 'usocial_sets';
		// ESC_SQL data
		$u_id = esc_sql($u_id);
		$u_id_usocial = esc_sql($u_id_usocial);
		$u_script_usocial = esc_html($u_script_usocial, ENT_QUOTES);
		$u_display_loc = esc_sql($u_display_loc);
		//Date update
		$u_date_update = esc_sql(date("d/m/Y"));


		$wpdb->replace( $table_name, [
			'id'      => $u_id,
			'id_usocial' => $u_id_usocial,
			'scripts_usocial' => $u_script_usocial,
			'dates_create' => $u_date_update,
			'display_locations' => $u_display_loc
		],['%d', '%d', '%s', '%s', '%s'] );
	}

	//Delete set
	public static function u_delete_usocial_set ($u_delete_id_set) {
		global $wpdb;
		$table_name = $wpdb->get_blog_prefix() . 'usocial_sets';
		$wpdb->delete( $table_name, [ 'ID' => $u_delete_id_set ] );
	}

	// Add new set
	public static function u_add_usocial_set ($u_id_usocial, $u_script_usocial, $u_display_loc) {
		global $wpdb;
		$table_name = $wpdb->get_blog_prefix() . 'usocial_sets';
		// ESC_SQL data
		$u_id_usocial = esc_sql($u_id_usocial);
		$u_script_usocial = esc_html($u_script_usocial, ENT_QUOTES);
		$u_display_loc = esc_sql($u_display_loc);
		//Date create
		$u_date_create = esc_sql(date("d/m/Y"));

		// Insert data in table
		$wpdb->insert(
			$table_name, array(
			'id_usocial' => $u_id_usocial,
			'scripts_usocial' => $u_script_usocial,
			'dates_create' => $u_date_create,
			'display_locations' => $u_display_loc
		), array('%d', '%s', '%s', '%s'));
	}

	//Create table during activation plugin
	public static function u_create_table_init() {
		global $wpdb;
		$table_name = $wpdb->get_blog_prefix() . 'usocial_sets';
		$charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		dbDelta("CREATE TABLE IF NOT EXISTS `{$table_name}` (
            `id` INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `id_usocial` INT(11) UNSIGNED NOT NULL,
            `scripts_usocial` TEXT NOT NULL,
            `dates_create` TEXT NOT NULL,
            `display_locations` TEXT NOT NULL
            ) {$charset_collate};");
	}

	//Delete table during deacctivation plugin
	public static function u_delete_table() {
		global $wpdb;
		$table_name = $wpdb->get_blog_prefix() . 'usocial_sets';

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		$sql = "DROP TABLE IF EXISTS `{$table_name}`";
		$wpdb->query($sql);
	}
}