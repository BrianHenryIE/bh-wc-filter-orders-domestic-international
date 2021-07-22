<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * frontend-facing side of the site and the admin area.
 *
 * @link       http://github.com/BrianHenryIE/bh-wc-filter-orders-domestic-international/
 * @since      1.0.0
 *
 * @package    BH_WC_Filter_Orders_Domestic_International
 * @subpackage BH_WC_Filter_Orders_Domestic_International/includes
 */

namespace BrianHenryIE\WC_Filter_Orders_Domestic_International\Includes;

use BrianHenryIE\WC_Filter_Orders_Domestic_International\WooCommerce\Orders_List_Page;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * frontend-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    BH_WC_Filter_Orders_Domestic_International
 * @subpackage BH_WC_Filter_Orders_Domestic_International/includes
 * @author     BrianHenryIE <BrianHenryIE@gmail.com>
 */
class BH_WC_Filter_Orders_Domestic_International {

	/**
	 * Define the core functionality of the plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->set_locale();

		$this->define_woocommerce_hooks();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	protected function set_locale() {

		$plugin_i18n = new I18n();

		add_action( 'plugins_loaded', array( $plugin_i18n, 'load_plugin_textdomain' ) );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	protected function define_woocommerce_hooks() {

		$woocommerce_orders = new Orders_List_Page();

		// add bulk order filter for exported / non-exported orders
		add_action( 'restrict_manage_posts', array( $woocommerce_orders, 'filter_orders_by_shipping_destination_ui' ), 20 );
		add_filter( 'request', array( $woocommerce_orders, 'filter_orders_by_shipping_destination_query' ), 10, 1 );

	}

}
