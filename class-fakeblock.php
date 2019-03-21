<?php
/**
 * Fakeblock main class
 *
 * @package  Fakeblock/Classes
 * @since    1.0.0
 * @version  1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Fakeblock class.
 */
final class Fakeblock {

	/**
	 * Current version of the plugin
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * Singleton instance of the class
	 *
	 * @var     obj
	 */
	private static $_instance = null;

	/**
	 * Singleton Instance of the Fakeblock class
	 *
	 * @return   obj  instance of the Fakeblock class
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function __construct() {

		if ( ! defined( 'FAKEBLOCK_VERSION' ) ) {
			define( 'FAKEBLOCK_VERSION', $this->version );
		}

		add_action( 'init', array( $this, 'load_textdomain' ), 0 );

		// get started.
		add_action( 'plugins_loaded', array( $this, 'init' ), 5 );

	}



	/**
	 * Include files and instantiate classes
	 *
	 * @return  void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function includes() {

		require_once FAKEBLOCK_PLUGIN_DIR . 'includes/functions-fkblk.php';

		require_once FAKEBLOCK_PLUGIN_DIR . 'includes/class-fkblk-assets.php';
		require_once FAKEBLOCK_PLUGIN_DIR . 'includes/class-fkblk-privacy.php';

		if ( is_admin() ) {
			require_once FAKEBLOCK_PLUGIN_DIR . 'includes/admin/class-fkblk-options.php';
		}


	}

	/**
	 * Include all required files and classes
	 *
	 * @return  void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function init() {

		// load includes.
		add_action( 'plugins_loaded', array( $this, 'includes' ) );

	}

	/**
	 * Load l10n files
	 * The first loaded file takes priority.
	 *
	 * Files can be found in the following order:
	 * 		WP_LANG_DIR/fakeblock/fakeblock-LOCALE.mo
	 * 		WP_LANG_DIR/plugins/fakeblock-LOCALE.mo
	 *
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function load_textdomain() {

		// load locale.
		$locale = apply_filters( 'plugin_locale', get_locale(), 'fakeblock' );

		// load a specific locale file if one exists.
		load_textdomain( 'fakeblock', WP_LANG_DIR . '/fakeblock/fakeblock-' . $locale . '.mo' );

		// load localization files.
		load_plugin_textdomain( 'fakeblock', false, dirname( plugin_basename( __FILE__ ) ) . '/i18n' );

	}


}
