<?php
/**
 * Test the hooks and actions added.
 *
 * @package BH_WC_Filter_Orders_Domestic_International
 * @author  BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BH_WC_Filter_Orders_Domestic_International\includes;


use BH_WC_Filter_Orders_Domestic_International\woocommerce\Orders_List_Page;

/**
 * Class Plugin_WP_Mock_Test
 *
 * @covers BH_WC_Filter_Orders_Domestic_International
 */
class BH_WC_Filter_Orders_Domestic_International_Unit_Test extends \Codeception\Test\Unit {

	protected function _before() {
		\WP_Mock::setUp();
	}

	// This is required for `'times' => 1` to be verified.
	protected function _tearDown() {
		parent::_tearDown();
		\WP_Mock::tearDown();
	}

	/**
	 *
	 */
	public function test_hooks_and_action() {

		$this->markTestSkipped( 'How do we test for class-type, since we dont have a handle on the instance?' );

		// I18n
		\WP_Mock::expectActionAdded( 'plugins_loaded', array( I18n::class, 'load_plugin_textdomain' ) );

		// Order page.
		\WP_Mock::expectActionAdded( 'restrict_manage_posts', array( Orders_List_Page::class, 'filter_orders_by_shipping_destination_ui' ), 20 );
		\WP_Mock::expectFilterAdded('request', array( Orders_List_Page::class, 'filter_orders_by_shipping_destination_query' ) );

		// Actions and filters are added immediately on construction.
		new BH_WC_Filter_Orders_Domestic_International();

	}

}
