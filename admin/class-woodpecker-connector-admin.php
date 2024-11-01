<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Woodpecker_Connector
 * @subpackage Woodpecker_Connector/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woodpecker_Connector
 * @subpackage Woodpecker_Connector/admin
 * @author     Wojciech <wojtek@fooz.pl>
 */
class Woodpecker_Connector_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The url of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $url
	 */
	private $url;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $url ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->url = $url;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woodpecker_Connector_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woodpecker_Connector_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// Add the color picker css file
		wp_enqueue_style('wp-color-picker');

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woodpecker-connector-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-map', plugin_dir_url( __FILE__ ) . 'css/woodpecker-connector-admin.css.map', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woodpecker_Connector_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woodpecker_Connector_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// Add the color picker js file
		wp_enqueue_script('wp-color-picker');

		// Add media upload picker js file
		wp_enqueue_media();
		wp_enqueue_script('media-upload');

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woodpecker-connector-admin-min.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */

	public function add_plugin_admin_menu() {

		/*
         * Add a settings page for this plugin to the Settings menu.
         *
         * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
         *
         *        Administration Menus: http://codex.wordpress.org/Administration_Menus
         *
         */
		add_menu_page( 'Woodpecker', 'Woodpecker', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page'), plugin_dir_url( __FILE__ ) . 'images/woodpecker-co.png', 81 );
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */

	public function add_action_links( $links ) {
		/*
        *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
        */
		$settings_link = array(
			'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
		);
		return array_merge(  $settings_link, $links );

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */

	public function display_plugin_setup_page() {
		include_once( 'partials/woodpecker-connector-admin-display.php' );
	}

	/**
	 * Save and update fields
	 *
	 * @since    1.0.0
	 */
	public function options_update() {
		register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	}

	/**
	 * Validate input fields on save
	 *
	 * @since    2.0.0
	 */
	public function validate($input) {

		$valid = array();
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'settings';
		$valid['api_key'] = $input['api_key'];

		$valid['privacy_policy'] = (isset($input['privacy_policy']) && !empty($input['privacy_policy'])) ? strip_tags($input['privacy_policy'], '<p><a><b><strong><h1><h2><h3><h4><h5><span>') : '<p>Accept Privacy Policy</p>';
		$valid['gform_email'] = (isset($input['gform_email']) && !empty($input['gform_email'])) ? sanitize_text_field($input['gform_email']) : 'Email';

		$valid['gform_first'] = (isset($input['gform_first']) && !empty($input['gform_first'])) ? sanitize_text_field($input['gform_first']) : 'First name';
		$valid['gform_first_hide'] = (isset($input['gform_first_hide']) && !empty($input['gform_first_hide'])) ? 1 : 0;

		$valid['gform_last'] = (isset($input['gform_last']) && !empty($input['gform_last'])) ? sanitize_text_field($input['gform_last']) : 'Last name';
		$valid['gform_last_hide'] = (isset($input['gform_last_hide']) && !empty($input['gform_last_hide'])) ? 1 : 0;

		$valid['gform_company'] = (isset($input['gform_company']) && !empty($input['gform_company'])) ? sanitize_text_field($input['gform_company']) : 'Company name';
		$valid['gform_company_hide'] = (isset($input['gform_company_hide']) && !empty($input['gform_company_hide'])) ? 1 : 0;

		$valid['gform_submit'] = (isset($input['gform_submit']) && !empty($input['gform_submit'])) ? sanitize_text_field($input['gform_submit']) : 'Submit';

		/* form messages */

		$valid['message_success'] = (isset($input['message_success']) && !empty($input['message_success'])) ? strip_tags($input['message_success'], '<p><a><b><strong><h1><h2><h3><h4><h5><span>') : '<p>Subscription complete</p>';

		$valid['message_error'] = (isset($input['message_error']) && !empty($input['message_error'])) ? strip_tags($input['message_error'], '<p><a><b><strong><h1><h2><h3><h4><h5><span>') : '<p>You need to fill all labels to submit your form.</p>';

		$valid['message_exist'] = (isset($input['message_exist']) && !empty($input['message_exist'])) ? strip_tags($input['message_exist'], '<p><a><b><strong><h1><h2><h3><h4><h5><span>') : '<p>You have already subscribed. Your data has been updated.</p>';

		/* style */

		$valid['style_active'] = $input['style_active'];

		$valid['color_submit'] = (isset($input['color_submit']) && !empty($input['color_submit'])) ? sanitize_text_field($input['color_submit']) : '#FFF';

		$valid['color_submit_bg'] = (isset($input['color_submit_bg']) && !empty($input['color_submit_bg'])) ? sanitize_text_field($input['color_submit_bg']) : '#5d32e9';

		$valid['color_submit_bg_hover'] = (isset($input['color_submit_bg_hover']) && !empty($input['color_submit_bg_hover'])) ? sanitize_text_field($input['color_submit_bg_hover']) : '#5d32e9';

		$valid['gform_default_style'] = (isset($input['gform_default_style']) && !empty($input['gform_default_style'])) ? 1 : 0;

		return $valid;
	}
}
