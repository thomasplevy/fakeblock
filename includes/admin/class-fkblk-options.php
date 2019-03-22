<?php
/**
 * Fakeblock options panel.
 *
 * @since    [version]
 * @version  [version]
 */

defined( 'ABSPATH' ) || exit;

/**
 * FKBLK_Options class..
 */
class FKBLK_Options {

	/**
	 * Option keys.
	 *
	 * @var array
	 */
	private $settings = array(
		'privacy_mode' => 'bool',
		'bpm'          => 'int',
		'bars'         => 'int',
		'anti_piracy'  => 'bool',
	);

	/**
	 * Constructor.
	 *
	 * @since    [version]
	 * @version  [version]
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'register' ) );
		add_action( 'admin_init', array( $this, 'save' ) );

	}

	/**
	 * Register Fakeblock options panel.
	 *
	 * @since [version]
	 * @version [version]
	 *
	 * @return void
	 */
	public function register() {

		add_menu_page( __( 'Fakeblock', 'fakeblock' ), __( 'Fakeblock', 'fakeblock' ), 'manage_options', 'fkblk', array( $this, 'output' ), 'dashicons-hidden' );

	}

	/**
	 * Output Fakeblock options panel HTML.
	 *
	 * @since [version]
	 * @version [version]
	 *
	 * @return void
	 */
	public function output() {

		require_once FAKEBLOCK_PLUGIN_DIR . 'includes/admin/views/options.php';

	}

	/**
	 * Sanitize an option value before saving.
	 *
	 * @since [version]
	 * @version [version]
	 *
	 * @param mixed  $val Unsanitized value.
	 * @param string $type Data type.
	 * @return mixed
	 */
	private function sanitize_option( $val, $type ) {

		switch ( $type ) {

			case 'bool':
				// unset means it's unchecked, not yes means you're trying to fake me man stop it.
				if ( is_null( $val ) || 'yes' !== $val ) {
					$val = 'no';
				}
				break;

			case 'int':
				$val = absint( $val );
				break;

		}

		return $val;

	}

	/**
	 * Save options.
	 *
	 * @since [version]
	 * @version [version]
	 *
	 * @return void
	 */
	public function save() {

		$nonce = filter_input( INPUT_POST, 'fkblk_nonce', FILTER_SANITIZE_STRING );

		// Form not submitted.
		if ( is_null( $nonce ) ) {
			return;
		}

		// Invalid nonce.
		if ( ! wp_verify_nonce( $nonce, 'fkblk-options' ) ) {
			return;
		}

		foreach ( $this->settings as $setting => $type ) {

			$val = filter_input( INPUT_POST, 'fkblk_' . $setting, FILTER_SANITIZE_STRING );
			fkblk_set( $setting, $this->sanitize_option( $val, $type ) );

		}

	}



}

return new FKBLK_Options();
