<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://usocial.pro/
 * @since             1.0.1
 * @package           Usocial
 *
 * @wordpress-plugin
 * Plugin Name:       USOCIAL — Кнопки поделиться для социальных сетей
 * Plugin URI:        https://help.usocial.pro/ru/knowledge-bases/2/articles/53-wordpress-plagin-dlya-ustanovki-knopok
 * Description:       uSocial – конструктор для создания кнопок поделиться и мне нравится для сайта.
 * Version:           1.0.1
 * Author:            USOCIAL
 * Author URI:        https://usocial.pro/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       usocial
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.1 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'USOCIAL_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-usocial-activator.php
 */
function activate_usocial() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-usocial-activator.php';
	Usocial_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-usocial-deactivator.php
 */
function deactivate_usocial() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-usocial-deactivator.php';
	Usocial_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_usocial' );
register_deactivation_hook( __FILE__, 'deactivate_usocial' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-usocial.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-usocial-wpdb.php';
add_filter("plugin_action_links_".plugin_basename(__FILE__), "add_link_setting_usocial");

// Add link setting page
function add_link_setting_usocial($link) {
	$custom_link = "<a href='admin.php?page=usocial'>".__( 'Настройки', 'usocial' )."</a>";
	array_push($link, $custom_link);
	return $link;
}
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_usocial() {

	$plugin = new Usocial();
	$plugin->run();

}
run_usocial();
