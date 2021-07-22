<?php
/**
 * Tests for I18n. Tests load_plugin_textdomain.
 *
 * @package BH_WC_Filter_Orders_Domestic_International
 * @author  BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BH_WC_Filter_Orders_Domestic_International\includes;

use BH_WC_Filter_Orders_Domestic_International\woocommerce\Orders_List_Page;

/**
 * Class I18n_Test
 *
 * @covers \BH_WC_Filter_Orders_Domestic_International\includes\BH_WC_Filter_Orders_Domestic_International
 */
class BH_WC_Filter_Orders_Domestic_International_WP_Unit_Test extends \Codeception\TestCase\WPTestCase {

	/**
	 *
	 */
	public function test_actions_filters() {


		// I18n
		//'plugins_loaded', array( I18n::class, 'load_plugin_textdomain' ) );

		// Order page.
		// 'restrict_manage_posts', array( Orders_List_Page::class, 'filter_orders_by_shipping_destination_ui' ), 20 );
		// 'request', array( Orders_List_Page::class, 'filter_orders_by_shipping_destination_query' ) );

		// Actions and filters are added immediately on construction.
		new BH_WC_Filter_Orders_Domestic_International();


	}

}
