<?php

/**
 * Fired during plugin deactivation
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Woodpecker_Connector
 * @subpackage Woodpecker_Connector/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Woodpecker_Connector
 * @subpackage Woodpecker_Connector/includes
 * @author     Wojciech <wojtek@fooz.pl>
 */
class Woodpecker_Connector_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$wpdb->query("DROP TABLE " . $wpdb->prefix . "woodpecker-connector-forms;");
	}

}
