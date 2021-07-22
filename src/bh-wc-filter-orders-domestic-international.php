<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://github.com/BrianHenryIE/bh-wc-filter-orders-domestic-international/
 * @since             1.0.0
 * @package           BH_WC_Filter_Orders_Domestic_International
 *
 * @wordpress-plugin
 * Plugin Name:       Filter Orders by Domestic/International
 * Plugin URI:        http://github.com/BrianHenryIE/bh-wc-filter-orders-domestic-international/
 * Description:       Adds a filter on WooCommerce orders screen to show only domestic/international orders.
 * Version:           1.0.1
 * Author:            BrianHenryIE
 * Author URI:        http://BrianHenry.ie
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bh-wc-filter-orders-domestic-international
 * Domain Path:       /languages
 *
 * @see https://gist.github.com/bekarice/41bce677437cb8f312ed77e9f226a812
 */

namespace BrianHenryIE\WC_Filter_Orders_Domestic_International;

use BrianHenryIE\WC_Filter_Orders_Domestic_International\Includes\BH_WC_Filter_Orders_Domestic_International;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die; // @codeCoverageIgnore
}

require_once plugin_dir_path( __FILE__ ) . 'autoload.php';

/**
 * Current plugin version.
 */
define( 'BH_WC_FILTER_ORDERS_DOMESTIC_INTERNATIONAL_VERSION', '1.0.1' );


/**
 * Begins execution of the plugin.
 *
 * Check we're inside wp-admin.
 *
 * @since    1.0.0
 */
function instantiate_bh_wc_filter_orders_domestic_international() {

	if ( ! is_admin() ) {
		return;
	}

	// TODO: Is `global $typenow;` defined at this point?

	new BH_WC_Filter_Orders_Domestic_International();
}

instantiate_bh_wc_filter_orders_domestic_international();

