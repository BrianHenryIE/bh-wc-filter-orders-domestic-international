<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://github.com/BrianHenryIE/bh-wc-filter-orders-domestic-international/
 * @since      1.0.0
 *
 * @package    BH_WC_Filter_Orders_Domestic_International
 * @subpackage BH_WC_Filter_Orders_Domestic_International/admin
 */

namespace BrianHenryIE\WC_Filter_Orders_Domestic_International\WooCommerce;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    BH_WC_Filter_Orders_Domestic_International
 * @subpackage BH_WC_Filter_Orders_Domestic_International/admin
 * @author     BrianHenryIE <BrianHenryIE@gmail.com>
 */
class Orders_List_Page {

	/**
	 * Add select option on orders screen for selecting domestic/international.
	 *
	 * @hooked restrict_manage_posts
	 *
	 * @since 1.0.0
	 */
	public function filter_orders_by_shipping_destination_ui() {
		global $typenow;

		if ( 'shop_order' === $typenow ) {

			$destination_options = array(
				'domestic'      => 'Domestic Orders',
				'international' => 'International Orders',
			);

			?>
			<select name="_shop_order_shipping_destination" id="dropdown_shop_order_shipping_destination">
				<option value="">
					<?php esc_html_e( 'All Shipping Destinations', 'wc-filter-orders-by-payment' ); ?>
				</option>

				<?php foreach ( $destination_options as $id => $destination ) : ?>
					<option value="<?php echo esc_attr( $id ); ?>" <?php echo esc_attr( isset( $_GET['_shop_order_shipping_destination'] ) ? selected( $id, $_GET['_shop_order_shipping_destination'], false ) : '' ); ?>>
						<?php echo esc_html( $destination ); ?>
					</option>
				<?php endforeach; ?>
			</select>
			<?php
		}
	}


	/**
	 * Process bulk filter order payment method
	 *
	 * @hooked request
	 *
	 * @see WP::parse_request()
	 *
	 * @since 1.0.0
	 *
	 * @param array $vars query vars without filtering
	 * @return array $vars query vars with (maybe) filtering
	 */
	public function filter_orders_by_shipping_destination_query( $vars ) {
		global $typenow;

		if ( 'shop_order' === $typenow && isset( $_GET['_shop_order_shipping_destination'] ) && ! empty( $_GET['_shop_order_shipping_destination'] ) ) {

			$country_code = WC()->countries->get_base_country();

			$vars['meta_key']   = '_shipping_country';
			$vars['meta_value'] = $country_code;

			if ( 'domestic' !== $_GET['_shop_order_shipping_destination'] ) {

				$vars['meta_compare'] = '!=';
			}
		}

		return $vars;
	}

}
