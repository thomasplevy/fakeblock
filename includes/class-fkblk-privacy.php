<?php
/**
 * Fakeblock Privacy
 *
 * @since    [version]
 * @version  [version]
 */

defined( 'ABSPATH' ) || exit;

/**
 * FKBLK_Privacy class..
 */
class FKBLK_Privacy {

	/**
	 * Constructor.
	 *
	 * @since    [version]
	 * @version  [version]
	 */
	public function __construct() {

		add_action( 'init', array( $this, 'maybe_unblock' ) );

		if ( ! is_admin() && 'yes' === fkblk_get( 'privacy_mode' ) ) {
			add_filter( 'template_include', array( $this, 'maybe_fakeblock' ) );
			// add_filter( 'the_content', array( $this, 'content_privacy' ), 999999 );
		}

		add_filter( 'body_class', array( $this, 'body_class' ) );

	}

	/**
	 * Add a CSS class to the body when the visitor is fakeblocked
	 *
	 * @since [version]
	 * @version [version]
	 *
	 * @param array $classes CSS class list as an array.
	 * @return array
	 */
	public function body_class( $classes ) {
		if ( is_fkblkd() ) {
			$classes[] = 'fkblkd';
		}
		return $classes;
	}

	/**
	 * Serves the visitor a block if they are fakeblocked.
	 *
	 * @since [version]
	 * @version [version]
	 *
	 * @param string $template Template include path.
	 * @return string
	 */
	public function maybe_fakeblock( $template ) {

		if ( is_fkblkd() ) {
			return FAKEBLOCK_PLUGIN_DIR . '/includes/views/blocked.php';
		}

		return $template;

	}

	/**
	 * Handles unblock form submission.
	 *
	 * @since [version]
	 * @version [version]
	 *
	 * @return [type]
	 */
	public function maybe_unblock() {

		$nonce = filter_input( INPUT_POST, 'fkblk_nonce', FILTER_SANITIZE_STRING );

		// Form not submitted.
		if ( is_null( $nonce ) ) {
			return;
		}

		// Invalid nonce.
		if ( ! wp_verify_nonce( $nonce, 'fkblk-unblk' ) ) {
			return;
		}

		$hash = fkblk_set_unblock();
		$data = fkblk_get( $hash );

		setcookie( 'fkblk', $hash, $data[1], '/' );

		wp_redirect( filter_input( INPUT_SERVER, 'REQUEST_URI' ) );
		exit;

	}

}

return new FKBLK_Privacy();
