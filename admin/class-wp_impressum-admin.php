<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.conversion-junkies.de
 * @since      1.0.0
 *
 * @package    Wp_impressum
 * @subpackage Wp_impressum/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_impressum
 * @subpackage Wp_impressum/admin
 * @author     Marcus Franke <marcus@conversion-junkies.de>
 */
class Wp_impressum_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

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
		 * defined in Wp_impressum_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_impressum_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp_impressum-admin.css', array(), $this->version, 'all' );

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
		 * defined in Wp_impressum_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_impressum_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp_impressum-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	public function plugin_menu() {
		add_options_page('Impressum' , 'Impressum' , 'manage_options', 'impressum' , array( $this , 'settings_page' ));
	}

	public function settings_page(){
		
			$impressum = get_option('wp_impressum');
			
			if($_POST['send'] == 'send') {

				$impressum = array();
				$impressum['impressum'] = esc_url_raw($_POST['impressum']);
				$impressum['datenschutz'] = esc_url_raw($_POST['datenschutz']);
				$impressum['agb'] = esc_url_raw($_POST['agb']);
				$impressum['disclaimer'] = esc_url_raw($_POST['disclaimer']);
				
				update_option("wp_impressum" , $impressum);
				
			}
			
		?>
		
			<form action="" method="post">
			
				<h3>Impressum:</h3>
				<input type="text" size="100" name="impressum" value="<?php echo $impressum['impressum']; ?>" placeholder="http://" />
				
				<h3>Datenschutz:</h3>
				<input type="text" size="100" name="datenschutz" value="<?php echo $impressum['datenschutz']; ?>" placeholder="http://" />
				
				<h3>AGB:</h3>
				<input type="text" size="100" name="agb" value="<?php echo $impressum['agb']; ?>" placeholder="http://" />
				
				<h3>Disclaimer:</h3>
				<input type="text" size="100" name="disclaimer" value="<?php echo $impressum['disclaimer']; ?>" placeholder="http://" />
				<br />
				<input type="submit" name="sender" value="speichern" />
				<input type="hidden" name="send" value="send" />
			
			</form>
		
		
		<?php 
	}
	
}
