<?php
/**
 * Tests for BH_WC_Filter_Orders_Domestic_International main setup class. Tests the actions are correctly added.
 *
 * @package BH_WC_Filter_Orders_Domestic_International
 * @author  BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BrianHenryIE\WC_Filter_Orders_Domestic_International\Includes;

use BrianHenryIE\WC_Filter_Orders_Domestic_International\WooCommerce\Orders_List_Page;

/**
 * Class Develop_Test
 */
class BH_WC_Filter_Orders_Domestic_International_Integration_Test extends \Codeception\TestCase\WPTestCase {



	public function test_action_restrict_manage_posts_filter_orders_by_shipping_destination_ui() {

		$action_name       = 'restrict_manage_posts';
		$expected_priority = 20;
		$class_type        = Orders_List_Page::class;
		$method_name       = 'filter_orders_by_shipping_destination_ui';

		$function_is_hooked = $this->is_function_hooked_on_action( $class_type, $method_name, $action_name, $expected_priority );

		$this->assertNotFalse( $function_is_hooked );

	}

	public function test_action_request_filter_orders_by_shipping_destination_query() {

		$action_name       = 'request';
		$expected_priority = 10;
		$class_type        = Orders_List_Page::class;
		$method_name       = 'filter_orders_by_shipping_destination_query';

		$function_is_hooked = $this->is_function_hooked_on_action( $class_type, $method_name, $action_name, $expected_priority );

		$this->assertNotFalse( $function_is_hooked );

	}

	/**
	 * Verify action to call load textdomain is added.
	 */
	public function test_action_plugins_loaded_load_plugin_textdomain() {

		$action_name       = 'plugins_loaded';
		$expected_priority = 10;
		$class_type        = I18n::class;
		$method_name       = 'load_plugin_textdomain';

		$function_is_hooked = $this->is_function_hooked_on_action( $class_type, $method_name, $action_name, $expected_priority );

		$this->assertNotFalse( $function_is_hooked );

	}


	protected function is_function_hooked_on_action( $class_type, $method_name, $action_name, $expected_priority = 10 ) {

		global $wp_filter;

		$this->assertArrayHasKey( $action_name, $wp_filter, "$method_name definitely not hooked to $action_name" );

		$actions_hooked = $wp_filter[ $action_name ];

		$this->assertArrayHasKey( $expected_priority, $actions_hooked, "$method_name definitely not hooked to $action_name priority $expected_priority" );

		$hooked_method = null;
		foreach ( $actions_hooked[ $expected_priority ] as $action ) {
			$action_function = $action['function'];
			if ( is_array( $action_function ) ) {
				if ( $action_function[0] instanceof $class_type ) {
					if( $method_name === $action_function[1] ) {
						$hooked_method = $action_function[1];
						break;
					}
				}
			}
		}

		$this->assertNotNull( $hooked_method, "No methods on an instance of $class_type hooked to $action_name" );

		$this->assertEquals( $method_name, $hooked_method, "Unexpected method name for $class_type class hooked to $action_name" );

		return true;
	}
}
