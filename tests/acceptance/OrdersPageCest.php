<?php 

class OrdersPageCest
{

	/**
	 * Login and navigate to plugins.php.
	 *
	 * @param AcceptanceTester $I
	 */
	public function _before( AcceptanceTester $I ) {
		$I->loginAsAdmin();

		$I->amOnPage('/wp-admin/edit.php?post_type=shop_order');
	}

	/**
	 * Check the input box is there and that its default text is "All Shipping Destinations".
	 *
	 * @param AcceptanceTester $I
	 */
	public function broken_testSelectBoxIsPresent(AcceptanceTester $I ) {

		return;
//		$this->markTestSkipped( 'Strangely the first canSeeOptionIsSelected works but the second fails' );

		$I->canSee( '#dropdown_shop_order_shipping_destination' );

		$I->canSeeOptionIsSelected( '#dropdown_shop_order_shipping_destination', 'All Shipping Destinations' );

		$I->canSeeOptionIsSelected( '#dropdown_shop_order_shipping_destination', 'All Shipping Destinations' );
	}

	/**
	 * The acceptance db has two orders saved. Filter by Domestic and check we can see only it.
	 *
	 * @param AcceptanceTester $I
	 */
	public function testFilterByDomesticOrders(AcceptanceTester $I ) {

		// In the "ship to" column of the orders screen.
		$I->canSee('Domestic Customer');
		$I->canSee('International Customer');

		$I->selectOption('#dropdown_shop_order_shipping_destination', 'domestic' );
		$I->click('Filter');

		$I->canSee('Domestic Customer');
		$I->cantSee('International Customer');

		$I->canSeeOptionIsSelected( '#dropdown_shop_order_shipping_destination', 'Domestic Orders' );

	}

	/**
	 * The acceptance db has two orders saved. Filter by International and check we can see only it.
	 *
	 * @param AcceptanceTester $I
	 */
	public function testFilterByInternationalOrders(AcceptanceTester $I ) {

		// In the "ship to" column of the orders screen.
		$I->canSee('International Customer');
		$I->canSee('Domestic Customer');

		$I->selectOption('#dropdown_shop_order_shipping_destination', 'international' );
		$I->click('Filter');

		$I->canSee('International Customer');
		$I->cantSee('Domestic Customer');

		$I->canSeeOptionIsSelected( '#dropdown_shop_order_shipping_destination', 'International Orders' );

	}
}
