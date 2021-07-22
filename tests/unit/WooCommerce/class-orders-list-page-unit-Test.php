<?php
/**
 *
 *
 * @package BH_WC_Filter_Orders_Domestic_International
 * @author  BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\WC_Filter_Orders_Domestic_International\WooCommerce;


use DOMNodeList;

class Orders_List_Page_Unit_Test extends \Codeception\Test\Unit {

	protected function _before() {
		\WP_Mock::setUp();
	}

	// This is required for `'times' => 1` to be verified.
	protected function _tearDown() {
		parent::_tearDown();
		\WP_Mock::tearDown();
	}

	/**
	 * Test the UI prints a HTML select with the three options.
	 *
	 * @covers \BrianHenryIE\WC_Filter_Orders_Domestic_International\WooCommerce\Orders_List_Page::filter_orders_by_shipping_destination_ui
	 */
	public function test_add_ui() {

		$sut = new Orders_List_Page();

		// Arrange.
		global $typenow;
		$typenow = 'shop_order';

		ob_start();

		$sut->filter_orders_by_shipping_destination_ui();

		$ui = ob_get_clean();

		$dom = new \DOMDocument();
		$dom->loadHTML( $ui );


		$select_node = $dom->getElementsByTagName( 'select' )->item( 0 );

		/** @var DOMNodeList $options */
		$options = $select_node->getElementsByTagName( 'option' );

		// There should be three options.
		$this->assertEquals( 3, $options->count() );


		$expected_titles = array( 'All Shipping Destinations', 'Domestic Orders', 'International Orders');


		/** @var \DOMNode $child */
		foreach( range( 1, $options->count() ) as $index ) {

			$title = trim( $options->item( $index - 1 )->nodeValue );

			$this->assertEquals( array_shift( $expected_titles ), $title );

		}
	}

	/**
	 * @covers \BrianHenryIE\WC_Filter_Orders_Domestic_International\WooCommerce\Orders_List_Page::filter_orders_by_shipping_destination_query
	 */
	public function test_dont_add_query_args() {

		$sut = new Orders_List_Page();

		global $typenow;
		$typenow = 'anything_other_than_shop_order';

		$query = $sut->filter_orders_by_shipping_destination_query( array() );

		$this->assertCount( 0, $query );

	}

}
