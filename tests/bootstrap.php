<?php
/**
 * Testing Bootstrap
 *
 * @package Fakeblock/Tests
 * @since   1.0.0
 * @version 1.0.0
 */

require_once './vendor/lifterlms/lifterlms-tests/bootstrap.php';

class FKBLK_Tests_Bootstrap extends LLMS_Tests_Bootstrap {

	/**
	 * __FILE__ reference, should be defined in the extending class
	 *
	 * @var [type]
	 */
	public $file = __FILE__;

	/**
	 * Name of the testing suite
	 *
	 * @var string
	 */
	public $suite_name = 'Fakeblock';

	/**
	 * Main PHP File for the plugin
	 *
	 * @var string
	 */
	public $plugin_main = 'fakeblock.php';

}

return new FKBLK_Tests_Bootstrap();
