<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://sugi.test
 * @since      1.0.0
 *
 * @package    Sugi
 * @subpackage Sugi/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sugi
 * @subpackage Sugi/admin
 * @author     sugi <sugi@gmail.com>
 */
class Sugi_Admin {

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
		 * defined in Sugi_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sugi_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sugi-admin.css', array(), $this->version, 'all' );

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
		 * defined in Sugi_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sugi_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sugi-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function register_sugi_menu() {
		add_menu_page( 'title_ajax', 'menu_ajax', 'manage_options', 'tes_ajax', [$this, 'funct_ajax'], 'dashicons-admin-multisite', 2 );
	}

	public function funct_ajax(){	
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/test_ajax.php';
	}

	public function get_data(){
		global $wpdb;
		$ret = array(
			'status' => 'success',
			'message' => 'Berhasil mendapatkan data indikator kegiatan renja',
			'data' => array()
		);

		if(!empty($_POST)){
			$data = $wpdb->get_results($wpdb->prepare('
				SELECT 
					*
				FROM data_petugas
			'),ARRAY_A);
			$ret['data'] = array();
			if(!empty($data)){
				$ret['data'] = $data;
			}
		}else{
			$ret['status']	= 'error';
			$ret['message']	= 'Format Salah!';
		}

		die(json_encode($ret));
	}

}
