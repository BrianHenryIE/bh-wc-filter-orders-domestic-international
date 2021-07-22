<?php
/**
 * Loads all required classes
 *
 * Uses classmap, PSR4 & wp-namespace-autoloader.
 *
 * @link              http://github.com/BrianHenryIE/bh-wc-filter-orders-domestic-international/
 * @since             1.0.0
 * @package           BH_WC_Filter_Orders_Domestic_International
 *
 * @see https://github.com/pablo-sg-pacheco/wp-namespace-autoloader/
 */

namespace BH_WC_Filter_Orders_Domestic_International;

use BH_WC_Filter_Orders_Domestic_International\Pablo_Pacheco\WP_Namespace_Autoloader\WP_Namespace_Autoloader;

require_once __DIR__ . '/strauss/autoload.php';

$class_map_file = __DIR__ . '/autoload-classmap.php';
if ( file_exists( $class_map_file ) ) {

	$class_map = include $class_map_file;

	if ( is_array( $class_map ) ) {
		spl_autoload_register(
			function ( $classname ) use ( $class_map ) {

				if ( array_key_exists( $classname, $class_map ) && file_exists( $class_map[ $classname ] ) ) {
					require_once $class_map[ $classname ];
				}
			}
		);
	}
}
unset( $class_map_file, $class_map );

$wpcs_autoloader = new WP_Namespace_Autoloader();
$wpcs_autoloader->init();
