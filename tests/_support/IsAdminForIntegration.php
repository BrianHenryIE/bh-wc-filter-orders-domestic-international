<?php
/**
 * There must be an easier way to do this.
 */

use \Codeception\Events;


class IsAdminForIntegration extends \Codeception\Extension
{
	// list events to listen to
	// Codeception\Events constants used to set the event

	public static $events = array(
		Events::MODULE_INIT  => 'beforeModule'

	);

	public function beforeModule(\Codeception\Event\SuiteEvent $e) {
		define( 'WP_ADMIN', true );
	}

}