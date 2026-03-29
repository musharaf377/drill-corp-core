<?php
/*
Plugin Name: DrilllCorp Core
Plugin URI: https://drilllcorp.agency
Description: Plugin to contain short codes and custom post types of the DrilllCorp theme.
Author: DrilllCorp
Author URI: https://drilllcorp.agency
Version: 1.0.0
Text Domain: drilllcorp-core
*/

/**
 * If this file is called directly, abort.
 * @package drilllcorp
 * @since 1.0.0
 */
if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Plugin directory path
 * @package drilllcorp
 * @since 1.0.0
 */
define('DRILLLCORP_CORE_ROOT_PATH', plugin_dir_path(__FILE__));
define('DRILLLCORP_CORE_ROOT_URL', plugin_dir_url(__FILE__));
define('DRILLLCORP_CORE_SELF_PATH', 'drilllcorp-core/drilllcorp-core.php');
define('DRILLLCORP_CORE_VERSION', '2.0.1');
define('DRILLLCORP_CORE_INC', DRILLLCORP_CORE_ROOT_PATH . '/inc');
define('DRILLLCORP_CORE_LIB', DRILLLCORP_CORE_ROOT_PATH . '/lib');
define('DRILLLCORP_CORE_CONFIG', DRILLLCORP_CORE_ROOT_PATH . '/config');
define('DRILLLCORP_CORE_ELEMENTOR', DRILLLCORP_CORE_ROOT_PATH . '/elementor');
define('DRILLLCORP_CORE_ADMIN', DRILLLCORP_CORE_ROOT_PATH . '/admin');
define('DRILLLCORP_CORE_ADMIN_ASSETS', DRILLLCORP_CORE_ROOT_URL . 'admin/assets');
define('DRILLLCORP_CORE_WP_WIDGETS', DRILLLCORP_CORE_ROOT_PATH . '/wp-widgets');
define('DRILLLCORP_CORE_ASSETS', DRILLLCORP_CORE_ROOT_URL . 'assets/');
define('DRILLLCORP_CORE_CSS', DRILLLCORP_CORE_ASSETS . 'css');
define('DRILLLCORP_CORE_JS', DRILLLCORP_CORE_ASSETS . 'js');
define('DRILLLCORP_CORE_IMG', DRILLLCORP_CORE_ASSETS . 'img');


/**
 * Load additional helpers functions
 * @package drilllcorp
 * @since 1.0.0
 */
if (!function_exists('drilllcorp_core')) {
	require_once DRILLLCORP_CORE_INC . '/theme-core-helper-functions.php';
	if (!function_exists('drilllcorp_core')) {
		function drilllcorp_core()
		{
			return class_exists('DrilllCorp_Core_Helper_Functions') ? new DrilllCorp_Core_Helper_Functions() : false;
		}
	}
}
//ob flash
remove_action('shutdown', 'wp_ob_end_flush_all', 1);


/**
 * Load Codestar Framework Functions
 * @package drilllcorp
 * @since 1.0.0
 */
if (!drilllcorp_core()->is_drilllcorp_active()) {
	if (file_exists(DRILLLCORP_CORE_ROOT_PATH . '/inc/csf-functions.php')) {
		require_once DRILLLCORP_CORE_ROOT_PATH . '/inc/csf-functions.php';
	}
}


/**
 * Core Plugin Init
 * @package drilllcorp
 * @since 1.0.0
 */
if (file_exists(DRILLLCORP_CORE_ROOT_PATH . '/inc/theme-core-init.php')) {
	require_once DRILLLCORP_CORE_ROOT_PATH . '/inc/theme-core-init.php';
}
