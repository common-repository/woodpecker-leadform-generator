<?php
/**
 * The plugin Woodpecker for WordPress
 *
 * @link              #
 * @since             1.0.0
 * @package           Woodpecker_Connector
 *
 * @wordpress-plugin
 * Plugin Name:       Woodpecker for WordPress
 * Plugin URI:        https://woodpecker.co/plugins/wordpress-leadform/
 * Description:       Add Woodpecker for WordPress to your Wordpress and enjoy automatic transfer of data from the Woodpecker for WordPress into your Woodpecker campaign. Never lose a lead again.
 * Version:           2.1.0
 * Author:            Woodpecker.co
 * Author URI:        https://woodpecker.co
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woodpecker-connector
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WOODPECKER_PLUGIN_NAME_VERSION', '2.1.0' );

/**
 * Currently plugin url.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WOODPECKER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woodpecker-connector-activator.php
 */
function activate_woodpecker_connector() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woodpecker-connector-activator.php';
	Woodpecker_Connector_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woodpecker-connector-deactivator.php
 */
function deactivate_woodpecker_connector() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woodpecker-connector-deactivator.php';
	Woodpecker_Connector_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woodpecker_connector' );
register_deactivation_hook( __FILE__, 'deactivate_woodpecker_connector' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woodpecker-connector.php';



/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woodpecker_connector() {

	$plugin = new Woodpecker_Connector();
	$plugin->run();

}
run_woodpecker_connector();
