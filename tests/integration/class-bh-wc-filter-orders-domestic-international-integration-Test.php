<?php
/**
 * Class Plugin_Test. Tests the root plugin setup.
 *
 * @package BH_WC_Filter_Orders_Domestic_International
 * @author     BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BH_WC_Filter_Orders_Domestic_International;

use BH_WC_Filter_Orders_Domestic_International\includes\BH_WC_Filter_Orders_Domestic_International;

/**
 * Verifies the plugin has been instantiated and added to PHP's $GLOBALS variable.
 */
class Plugin_Integration_Test extends \Codeception\TestCase\WPTestCase {

	/**
	 * Test the main plugin object is added to PHP's GLOBALS and that it is the correct class.
	 */
	public function test_plugin_instantiated() {

		$this->assertArrayHasKey( 'bh_wc_filter_orders_domestic_international', $GLOBALS );

		$this->assertInstanceOf( BH_WC_Filter_Orders_Domestic_International::class, $GLOBALS['bh_wc_filter_orders_domestic_international'] );
	}

}
