<?php

namespace BH_WC_Filter_Orders_Domestic_International\woocommerce;

/**
 * Class Order_List_Page_WP_Unit_Test
 * @package BH_WC_Filter_Orders_Domestic_International\woocommerce
 *
 * @covers \BH_WC_Filter_Orders_Domestic_International\woocommerce\Orders_List_Page
 */
class Order_List_Page_WP_Unit_Test extends \Codeception\TestCase\WPTestCase {


	/**
	 * Test needs to be here because it will use `WC()->countries->get_base_country();`.
	 *
	 * Check domestic filter adds the query arguments but does not set the compare argument.
	 */
	public function test_add_domestic_query_args() {

		// Probably UK.
		$country_code = WC()->countries->get_base_country();

		$sut = new Orders_List_Page();

		global $typenow;
		$typenow = 'shop_order';

		$_GET['_shop_order_shipping_destination'] = 'domestic';

		$query = $sut->filter_orders_by_shipping_destination_query( array() );

		$this->assertArrayHasKey( 'meta_key', $query);
		$this->assertArrayHasKey( 'meta_value', $query);

		$this->assertEquals( '_shipping_country', $query['meta_key'] );
		$this->assertEquals( $country_code, $query['meta_value'] );

		$this->assertArrayNotHasKey( 'meta_compare', $query);

	}



	/**
	 *
	 * Check international filter adds the query arguments and _does_ set the compare argument.
	 */
	public function test_add_international_query_args() {

		// Probably UK.
		$country_code = WC()->countries->get_base_country();


		$sut = new Orders_List_Page();

		global $typenow;
		$typenow = 'shop_order';

		$_GET['_shop_order_shipping_destination'] = 'international';

		$query = $sut->filter_orders_by_shipping_destination_query( array() );

		$this->assertArrayHasKey( 'meta_key', $query);
		$this->assertArrayHasKey( 'meta_value', $query);

		$this->assertEquals( '_shipping_country', $query['meta_key'] );
		$this->assertEquals( $country_code, $query['meta_value'] );

		$this->assertArrayHasKey( 'meta_compare', $query);
		$this->assertEquals( '!=', $query['meta_compare'] );

	}


}
