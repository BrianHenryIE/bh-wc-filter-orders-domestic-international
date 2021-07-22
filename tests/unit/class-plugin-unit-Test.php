<?php
/**
 * Tests for the root plugin file.
 *
 * @package BH_WC_Filter_Orders_Domestic_International
 * @author  BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\WC_Filter_Orders_Domestic_International;

use BrianHenryIE\WC_Filter_Orders_Domestic_International\Includes\BH_WC_Filter_Orders_Domestic_International;

/**
 * Class Plugin_WP_Mock_Test
 */
class Plugin_Unit_Test extends \Codeception\Test\Unit {

	protected function _before() {
		\WP_Mock::setUp();
	}

	// This is required for `'times' => 1` to be verified.
	protected function _tearDown() {
		parent::_tearDown();
		\WP_Mock::tearDown();
	}

	/**
	 * Verifies the plugin does not output anything to screen.
	 */
	public function test_plugin_include_no_output() {

		$plugin_root_dir = dirname( __DIR__, 2 ) . '/src';

        // Prevents code-coverage counting.
        \Patchwork\redefine(
            array( BH_WC_Filter_Orders_Domestic_International::class, '__construct' ),
            function() {}
        );

		\WP_Mock::userFunction(
			'plugin_dir_path',
			array(
				'args'   => array( \WP_Mock\Functions::type( 'string' ) ),
				'return' => $plugin_root_dir . '/',
			)
		);


		\WP_Mock::userFunction(
			'is_admin',
			array(
				'return' => true
			)
		);

		ob_start();

		require_once $plugin_root_dir . '/bh-wc-filter-orders-domestic-international.php';

		$printed_output = ob_get_contents();

		ob_end_clean();

		$this->assertEmpty( $printed_output );

	}

}
