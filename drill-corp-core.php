<?php
/*
Plugin Name: Drillcorp Core
Plugin URI: https://drillcorp.agency
Description: Plugin to contain short codes and custom post types of the Drillcorp theme.
Author: Drillcorp
Author URI: https://drillcorp.agency
Version: 1.0.0
Text Domain: drillcorp-core
*/


/**
 * If this file is called directly, abort.
 * @package drillcorp
 * @since 1.0.0
 */
if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Plugin directory path
 * @package drillcorp
 * @since 1.0.0
 */
define('DRILLCORP_CORE_ROOT_PATH', plugin_dir_path(__FILE__));
define('DRILLCORP_CORE_ROOT_URL', plugin_dir_url(__FILE__));
define('DRILLCORP_CORE_SELF_PATH', 'drillcorp-core/drillcorp-core.php');
define('DRILLCORP_CORE_VERSION', '2.0.1');
define('DRILLCORP_CORE_INC', DRILLCORP_CORE_ROOT_PATH . '/inc');
define('DRILLCORP_CORE_LIB', DRILLCORP_CORE_ROOT_PATH . '/lib');
define('DRILLCORP_CORE_CONFIG', DRILLCORP_CORE_ROOT_PATH . '/config');
define('DRILLCORP_CORE_ELEMENTOR', DRILLCORP_CORE_ROOT_PATH . '/elementor');
define('DRILLCORP_CORE_ADMIN', DRILLCORP_CORE_ROOT_PATH . '/admin');
define('DRILLCORP_CORE_ADMIN_ASSETS', DRILLCORP_CORE_ROOT_URL . 'admin/assets');
define('DRILLCORP_CORE_WP_WIDGETS', DRILLCORP_CORE_ROOT_PATH . '/wp-widgets');
define('DRILLCORP_CORE_ASSETS', DRILLCORP_CORE_ROOT_URL . 'assets/');
define('DRILLCORP_CORE_CSS', DRILLCORP_CORE_ASSETS . 'css');
define('DRILLCORP_CORE_JS', DRILLCORP_CORE_ASSETS . 'js');
define('DRILLCORP_CORE_IMG', DRILLCORP_CORE_ASSETS . 'img');


/**
 * Load additional helpers functions
 * @package drillcorp
 * @since 1.0.0
 */
if (!function_exists('drillcorp_core')) {
	require_once DRILLCORP_CORE_INC . '/theme-core-helper-functions.php';
	if (!function_exists('drillcorp_core')) {
		function drillcorp_core()
		{
			return class_exists('Drillcorp_Core_Helper_Functions') ? new Drillcorp_Core_Helper_Functions() : false;
		}
	}
}
//ob flash
remove_action('shutdown', 'wp_ob_end_flush_all', 1);


/**
 * Load Codestar Framework Functions
 * @package drillcorp
 * @since 1.0.0
 */
if (!drillcorp_core()->is_drillcorp_active()) {
	if (file_exists(DRILLCORP_CORE_ROOT_PATH . '/inc/csf-functions.php')) {
		require_once DRILLCORP_CORE_ROOT_PATH . '/inc/csf-functions.php';
	}
}


/**
 * Core Plugin Init
 * @package drillcorp
 * @since 1.0.0
 */
if (file_exists(DRILLCORP_CORE_ROOT_PATH . '/inc/theme-core-init.php')) {
	require_once DRILLCORP_CORE_ROOT_PATH . '/inc/theme-core-init.php';
}
