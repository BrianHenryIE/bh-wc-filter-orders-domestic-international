<?php
/**
 * Basic test on the i18n class, which will probably never change!
 *
 * @package BH_WC_Filter_Orders_Domestic_International
 * @author  BrianHenryIE <BrianHenryIE@gmail.com>
 */

namespace BH_WC_Filter_Orders_Domestic_International\includes;


/**
 * Class I18n_Unit_Test
 * @see I18n
 *
 * @covers \BH_WC_Filter_Orders_Domestic_International\includes\I18n
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
	 * Check load_plugin_textdomain is called with the correct parameters.
	 *
	 * @see load_plugin_textdomain()
	 */
	public function test_i18n_register() {

		$i18n = new I18n();

		global $plugin_root_dir;


		\WP_Mock::userFunction(
			'plugin_basename',
			array(
				'args'   => array(
					\WP_Mock\Functions::type( 'string' )
				),
				'return' => 'bh-wc-filter-orders-domestic-international',
				'times' => 1
			)
		);


		/**
		 * Presumed input `{$plugin_root_dir}/languages/` was actually `./languages/`.
		 */
		\WP_Mock::userFunction(
			'load_plugin_textdomain',
			array(
				'args'   => array(
					'bh-wc-filter-orders-domestic-international',
					false,
					\WP_Mock\Functions::type( 'string' )
				),
				'times' => 1,
			)
		);

		$i18n->load_plugin_textdomain();

	}

}
