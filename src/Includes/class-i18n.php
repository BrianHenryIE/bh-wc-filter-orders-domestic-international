<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://github.com/BrianHenryIE/bh-wc-filter-orders-domestic-international/
 * @since      1.0.0
 *
 * @package    BH_WC_Filter_Orders_Domestic_International
 * @subpackage BH_WC_Filter_Orders_Domestic_International/includes
 */

namespace BrianHenryIE\WC_Filter_Orders_Domestic_International\Includes;

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    BH_WC_Filter_Orders_Domestic_International
 * @subpackage BH_WC_Filter_Orders_Domestic_International/includes
 * @author     BrianHenryIE <BrianHenryIE@gmail.com>
 */
class I18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @hooked plugins_loaded
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'bh-wc-filter-orders-domestic-international',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
