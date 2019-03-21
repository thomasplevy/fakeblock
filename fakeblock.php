<?php
/**
 * Fakeblock Plugin
 *
 * @package  Fakeblock/Main
 *
 * Plugin Name: Fakeblock
 * Plugin URI: https://fakeblock.us
 * Description: With less than 10 active installs, Fakeblock is the OC WordPress community's privacy software plugin that's also anti-piracy
 * Version: 1.0.0
 * Author: George Maharis
 * Author URI: https://en.wikipedia.org/wiki/George_Maharis
 * Text Domain: fakeblock
 * Domain Path: /i18n
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

defined( 'ABSPATH' ) || exit;

// Define Constants.
if ( ! defined( 'FAKEBLOCK_PLUGIN_FILE' ) ) {
	define( 'FAKEBLOCK_PLUGIN_FILE', __FILE__ );
}

if ( ! defined( 'FAKEBLOCK_PLUGIN_DIR' ) ) {
	define( 'FAKEBLOCK_PLUGIN_DIR', dirname( __FILE__ ) . '/' );
}

if ( ! defined( 'FAKEBLOCK_PLUGIN_URL' ) ) {
	define( 'FAKEBLOCK_PLUGIN_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
}

if ( ! defined( 'FAKEBLOCK_ASSETS_SUFFIX' ) ) {
	define( 'FAKEBLOCK_ASSETS_SUFFIX', '.min' );
}

// Load Plugin.
if ( ! class_exists( 'Fakeblock' ) ) {
	require_once FAKEBLOCK_PLUGIN_DIR . 'class-fakeblock.php';
}

/**
 * Main Plugin Instance
 *
 * @since   1.0.0
 * @version 1.0.0
 * @return  Fakeblock
 */
function Fakeblock() {
	return Fakeblock::instance();
}

return Fakeblock();
