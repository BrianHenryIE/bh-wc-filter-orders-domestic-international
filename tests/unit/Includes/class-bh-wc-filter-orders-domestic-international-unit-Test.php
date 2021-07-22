<?php
/**
 * Test the hooks and actions added.
 *
 * @package BH_WC_Filter_Orders_Domestic_International
 * @author  BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\WC_Filter_Orders_Domestic_International\Includes;


use BrianHenryIE\WC_Filter_Orders_Domestic_International\WooCommerce\Orders_List_Page;
use WP_Mock\Matcher\AnyInstance;

/**
 * Class Plugin_WP_Mock_Test
 *
 * @coversDefaultClass \BrianHenryIE\WC_Filter_Orders_Domestic_International\Includes\BH_WC_Filter_Orders_Domestic_International
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
	 * @covers ::set_locale
	 */
	public function test_i18n_hooks()
    {

        // I18n
        \WP_Mock::expectActionAdded('plugins_loaded', array(new AnyInstance(I18n::class), 'load_plugin_textdomain'));

        // Actions and filters are added immediately on construction.
        new BH_WC_Filter_Orders_Domestic_International();

    }

    /**
     * @covers ::define_woocommerce_hooks
     */
    public function test_woocommerce_hooks()
    {
        // Order page.
		\WP_Mock::expectActionAdded( 'restrict_manage_posts', array( new AnyInstance( Orders_List_Page::class ), 'print_filter_orders_by_shipping_destination_ui'), 20 );
		\WP_Mock::expectFilterAdded('request', array( new AnyInstance( Orders_List_Page::class), 'filter_orders_by_shipping_destination_query' ) );

		// Actions and filters are added immediately on construction.
		new BH_WC_Filter_Orders_Domestic_International();

	}

}
