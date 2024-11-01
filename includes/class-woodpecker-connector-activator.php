<?php

/**
 * Fired during plugin activation
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Woodpecker_Connector
 * @subpackage Woodpecker_Connector/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Woodpecker_Connector
 * @subpackage Woodpecker_Connector/includes
 * @author     Wojciech <wojtek@fooz.pl>
 */
class Woodpecker_Connector_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		#
		# Table structure for table 'woodpecker-connector-forms'
		#
		# CREATE TABLE woodpecker-connector-forms (

		$sql = "CREATE TABLE " . $wpdb->prefix . "woodpecker-connector-forms (
			id int(11) unsigned NOT NULL auto_increment,
			create_date DATE format 'YYYY-MM-DD' NOT NULL DEFAULT to_date('2000-01-01','YYYY-MM-DD'),
			last_mod_date DATE format 'YYYY-MM-DD' NOT NULL DEFAULT to_date('2000-01-01','YYYY-MM-DD'),
			form_id int(100) DEFAULT '0' NOT NULL,
			email int(1) DEFAULT '1' NOT NULL,
			email_label varchar(255) DEFAULT 'Email' NOT NULL,
			email_hide  int(1) DEFAULT '1' NOT NULL,
			first_name int(1) DEFAULT '1' NOT NULL,
			first_name_label varchar(255) DEFAULT 'First name' NOT NULL,
			first_name_hide int(1) DEFAULT '1' NOT NULL,
			last_name int(1) DEFAULT '1' NOT NULL,
			last_name_label varchar(255) DEFAULT 'Last name' NOT NULL,
			last_name_hide int(1) DEFAULT '1' NOT NULL,
			status int(1) DEFAULT '0' NOT NULL,
			status_label varchar(255) DEFAULT '' NOT NULL,
			status_hide int(1) DEFAULT '0' NOT NULL,
			tags int(1) DEFAULT '0' NOT NULL,
			tags_label varchar(255) DEFAULT '' NOT NULL,
			tags_hide int(1) DEFAULT '0' NOT NULL,
			company int(1) DEFAULT '0' NOT NULL,
			company_label varchar(255) DEFAULT '' NOT NULL,
			company_hide int(1) DEFAULT '0' NOT NULL,
			industry int(1) DEFAULT '0' NOT NULL,
			industry_label varchar(255) DEFAULT '' NOT NULL,
			industry_hide int(1) DEFAULT '0' NOT NULL,
			default_style int(1) DEFAULT '1' NOT NULL,
			title int(1) DEFAULT '0' NOT NULL,
			title_label varchar(255) DEFAULT '' NOT NULL,
			title_hide int(1) DEFAULT '0' NOT NULL,
			phone int(1) DEFAULT '0' NOT NULL,
			phone_label varchar(255) DEFAULT '' NOT NULL,
			phone_hide int(1) DEFAULT '0' NOT NULL,
			address int(1) DEFAULT '0' NOT NULL,
			address_label varchar(255) DEFAULT '' NOT NULL,
			address_hide int(1) DEFAULT '0' NOT NULL,
			city int(1) DEFAULT '0' NOT NULL,
			city_label varchar(255) DEFAULT '' NOT NULL,
			city_hide int(1) DEFAULT '0' NOT NULL,
			state int(1) DEFAULT '0' NOT NULL,
			state_label varchar(255) DEFAULT '' NOT NULL,
			state_hide int(1) DEFAULT '0' NOT NULL,
			country int(1) DEFAULT '0' NOT NULL,
			country_label varchar(255) DEFAULT '' NOT NULL,
			country_hide int(1) DEFAULT '0' NOT NULL,
			website int(1) DEFAULT '0' NOT NULL,
			website_label varchar(255) DEFAULT '' NOT NULL,
			website_hide int(1) DEFAULT '0' NOT NULL,
			snippet1 int(1) DEFAULT '0' NOT NULL,
			snippet1_label varchar(255) DEFAULT '' NOT NULL,
			snippet1_hide int(1) DEFAULT '0' NOT NULL,
			snippet2 int(1) DEFAULT '0' NOT NULL,
			snippet2_label varchar(255) DEFAULT '' NOT NULL,
			snippet2_hide int(1) DEFAULT '0' NOT NULL,
			snippet3 int(1) DEFAULT '0' NOT NULL,
			snippet3_label varchar(255) DEFAULT '' NOT NULL,
			snippet3_hide int(1) DEFAULT '0' NOT NULL,
			snippet4 int(1) DEFAULT '0' NOT NULL,
			snippet4_label varchar(255) DEFAULT '' NOT NULL,
			snippet4_hide int(1) DEFAULT '0' NOT NULL,
			snippet5 int(1) DEFAULT '0' NOT NULL,
			snippet5_label varchar(255) DEFAULT '' NOT NULL,
			snippet5_hide int(1) DEFAULT '0' NOT NULL,
			snippet6 int(1) DEFAULT '0' NOT NULL,
			snippet6_label varchar(255) DEFAULT '' NOT NULL,
			snippet6_hide int(1) DEFAULT '0' NOT NULL,
			snippet7 int(1) DEFAULT '0' NOT NULL,
			snippet7_label varchar(255) DEFAULT '' NOT NULL,
			snippet7_hide int(1) DEFAULT '0' NOT NULL,
			snippet8 int(1) DEFAULT '0' NOT NULL,
			snippet8_label varchar(255) DEFAULT '' NOT NULL,
			snippet8_hide int(1) DEFAULT '0' NOT NULL,
			snippet9 int(1) DEFAULT '0' NOT NULL,
			snippet9_label varchar(255) DEFAULT '' NOT NULL,
			snippet9_hide int(1) DEFAULT '0' NOT NULL,
			snippet10 int(1) DEFAULT '0' NOT NULL,
			snippet10_label varchar(255) DEFAULT '' NOT NULL,
			snippet10_hide int(1) DEFAULT '0' NOT NULL,
			snippet11 int(1) DEFAULT '0' NOT NULL,
			snippet11_label varchar(255) DEFAULT '' NOT NULL,
			snippet11_hide int(1) DEFAULT '0' NOT NULL,
			snippet12 int(1) DEFAULT '0' NOT NULL,
			snippet12_label varchar(255) DEFAULT '' NOT NULL,
			snippet12_hide int(1) DEFAULT '0' NOT NULL,
			snippet13 int(1) DEFAULT '0' NOT NULL,
			snippet13_label varchar(255) DEFAULT '' NOT NULL,
			snippet13_hide int(1) DEFAULT '0' NOT NULL,
			snippet14 int(1) DEFAULT '0' NOT NULL,
			snippet14_label varchar(255) DEFAULT '' NOT NULL,
			snippet14_hide int(1) DEFAULT '0' NOT NULL,
			snippet15 int(1) DEFAULT '0' NOT NULL,
			snippet15_label varchar(255) DEFAULT '' NOT NULL,
			snippet15_hide int(1) DEFAULT '0' NOT NULL,

			PRIMARY KEY (id)
		);
		"; //end sql im_xml_realty_objects

		dbDelta( $sql );
	}

}
