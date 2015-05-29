<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.conversion-junkies.de
 * @since      1.0.0
 *
 * @package    Wp_impressum
 * @subpackage Wp_impressum/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_impressum
 * @subpackage Wp_impressum/public
 * @author     Marcus Franke <marcus@conversion-junkies.de>
 */
class Wp_impressum_Public {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

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
		 * defined in Wp_impressum_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_impressum_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp_impressum-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_impressum_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_impressum_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp_impressum-public.js', array( 'jquery' ), $this->version, false );

	}
	
	public function add_shortcodes(){
	
		add_shortcode('wp_impressum',array( &$this, 'dataInclude'));
	
	}
	
	public function dataInclude($params) {
	
		ob_start();
	   
		//$url = esc_url_raw($params['src']);
		
		$data = get_option('wp_impressum');
		$text = esc_attr($params['text']);
		$url = $data[$text];
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$response = curl_exec($ch); 
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if($status == "200" AND !empty($response)) {
		
			update_option("wp_impressum_" . $text , $response);
			
			echo $response;
			
		} else {
		
			echo get_option("wp_impressum" . $text);
		
		}
				
		// LINK
		if($params[0] != 'nolink'){
			echo '<a href="http://zentrales-impressum.de/">Mit freundlichen Unterstützung von zentrales-impressum.de</a>';
		}
				
		return ob_get_clean();
		
	}

}
