<?php
/**
 * Enqueue Scripts & Styles
 *
 * @package  Fakeblock/Classes
 * @since    1.0.0
 * @version  1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * FKBLK_Assets class.
 */
class FKBLK_Assets {

	/**
	 * Constructor
	 *
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function __construct() {

		add_action( 'wp', array( $this, 'init' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin' ) );

	}

	/**
	 * Register, enqueue, & localize frontend scripts
	 *
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function enqueue() {

		// Only need these on the frontend if the visitor is fakeblocked.
		if ( ! is_fkblkd() ) {
			return;
		}

		wp_register_style( 'fkblk', FAKEBLOCK_PLUGIN_URL . 'assets/css/fkblk' . FAKEBLOCK_ASSETS_SUFFIX . '.css', array(), FAKEBLOCK_VERSION );
		wp_enqueue_style( 'fkblk' );

		wp_style_add_data( 'fkblk', 'rtl', 'replace' );
		wp_style_add_data( 'fkblk', 'suffix', FAKEBLOCK_ASSETS_SUFFIX );

		// wp_register_script( 'fkblk', plugins_url( 'assets/js/fkblk' . $this->minify . '.js', FAKEBLOCK_PLUGIN_FILE ), array( 'jquery' ), FAKEBLOCK_VERSION, true );
		// wp_enqueue_script( 'fkblk' );

	}

	/**
	 * Register, enqueue, & localize admin scripts
	 *
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function enqueue_admin() {

		$screen = get_current_screen();
		if ( ! $screen || 'toplevel_page_fkblk' !== $screen->id ) {
			return;
		}

		wp_register_style( 'fkblk-admin', FAKEBLOCK_PLUGIN_URL . 'assets/css/fkblk-admin' . FAKEBLOCK_ASSETS_SUFFIX . '.css', array(), FAKEBLOCK_VERSION );
		wp_enqueue_style( 'fkblk-admin' );

		wp_style_add_data( 'fkblk', 'rtl', 'replace' );
		wp_style_add_data( 'fkblk', 'suffix', FAKEBLOCK_ASSETS_SUFFIX );

		// wp_register_script( 'fkblk-admin', plugins_url( 'assets/js/fkblk-admin' . $this->minify . '.js', FAKEBLOCK_PLUGIN_FILE ), array( 'jquery' ), FAKEBLOCK_VERSION, true );
		// wp_enqueue_script( 'fkblk-admin' );

	}

	/**
	 * Get started
	 *
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function init() {

		if ( is_admin() ) {
			return;
		}

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );

	}

}

return new FKBLK_Assets();
