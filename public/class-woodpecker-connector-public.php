<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Woodpecker_Connector
 * @subpackage Woodpecker_Connector/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Woodpecker_Connector
 * @subpackage Woodpecker_Connector/public
 * @author     Wojciech <wojtek@fooz.pl>
 */
class Woodpecker_Connector_Public {

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
	 * The form ID of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $formId
	 */
	private $formId;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $url ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->url = $url;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woodpecker-connector-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-map', plugin_dir_url( __FILE__ ) . 'css/woodpecker-connector-public.css.map', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woodpecker-connector-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Registers shortcodes at once
	 *
	 * @since    1.0.0
	 */

	public function register_shortcodes() {
		add_shortcode( $this->plugin_name, array( $this, 'shortocde_woodpecker_connector' ) );
	}

	/**
	 * Registers shortcode
	 *
	 * @since    2.0.0
	 */
	public function shortocde_woodpecker_connector( $atts = array() )
	{
		define('woodpecker-shortcode', TRUE);
		$options = $this->wp_cbf_options;
		$formId = abs(crc32(uniqid()));
		$atts = shortcode_atts( array(
			'form_name' => $this->plugin_name . '-form-' . $formId,
			'id' => 0,
		), $atts );

		ob_start();

		include( 'partials/woodpecker-connector-public-shortcode.php' );

		$output = ob_get_contents();
		ob_end_clean();

		return $output;

	}

	/**
	 * Registers function to add prospects
	 *
	 * @since    2.0.0
	 */

	public function add_prospect_to_campaing() {
		$options = get_option($this->plugin_name);
		$parameters = (array) $_POST['parameters'];
		$remsomestring = strlen($this->plugin_name.'-');
		$prospect = array();
		$campaign = 0;
		$isValid = true;

		foreach($parameters as $k => $v){
			if(substr(strip_tags($v['name']),$remsomestring) == 'accept_policy' && $v['val'] != 1){
				$isValid = false;
			}else{
				if(substr(strip_tags($v['name']),$remsomestring) == 'campaign'){
					$campaign = (int) $v['val'];
				}else{
					$prospect[substr(strip_tags($v['name']),$remsomestring)] = strip_tags($v['val']);
				}
			}
		}

		if($isValid){
			if($campaign > 0){
				$linkToAPI = '/rest/v1/add_prospects_campaign';
				$addprospecjson = '{
					"campaign":{
						"campaign_id": '.$campaign.'
					},
							"update": "true",'.'
							"prospects": ['.json_encode($prospect, true).']
						}';
			}else{
				$linkToAPI = '/rest/v1/add_prospects_list';
				$addprospecjson = '{
							"update": "true",'.'
							"prospects": ['.json_encode($prospect, true).']
						}';
			}

			$addprospects = new Woodpecker_Connector_Curl($linkToAPI,
				$options['api_key'], $addprospecjson);
			$getaddprospects = $addprospects->getJson();
			$getaddprospectObject = $getaddprospects->prospects;
			$response = array();

			if($getaddprospectObject[0]->status == 'ERROR' ){
				$response['action'] = 'ERROR';
				$response['message'] = 	__($options['message_error'], $this->plugin_name);
				$response['code'] = $getaddprospectObject[0]->code;
			}else if($getaddprospectObject[0]->prospect_campaign == 'DUPLICATE'){
				$response['action'] = 'DUPLICATE';
				$response['message'] = 	__($options['message_exist'], $this->plugin_name);
			}else{
				$response['action'] = 'SUCCESS';
				$response['message'] = 	__($options['message_success'], $this->plugin_name);
			}

		} else {
			$response['action'] = 'ERROR';
			$response['message'] = 	__($options['message_error'], $this->plugin_name);
			$response['code'] = 'POLICY';
		}


		echo json_encode($response, JSON_HEX_QUOT | JSON_HEX_TAG);

		wp_die();
	}

}
