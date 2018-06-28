<?php
/*
Plugin Name: Example Background Processing
Plugin URI: https://github.com/A5hleyRich/wp-background-processing
Description: Background processing in WordPress.
Author: Ashley Rich
Version: 0.1
Author URI: https://deliciousbrains.com/
Text Domain: example-plugin
Domain Path: /languages/
*/

// error_reporting(E_ERROR | E_PARSE);
// ini_set('display_errors', 1);

class Example_Background_Processing {

	/**
	 * @var WP_Example_Request
	 */
	protected $process_single;

	/**
	 * @var WP_Example_Process
	 */
	protected $process_all;

	/**
	 * Example_Background_Processing constructor.
	 */
	public function __construct() {
		$this->init();
		// add_action( 'plugins_loaded', array( $this, 'init' ) );
		// add_action( 'admin_bar_menu', array( $this, 'admin_bar' ), 100 );
		add_action( 'init', array( $this, 'process_handler' ) );
	}

	/**
	 * Init
	 */
	public function init() {
		require_once 'class-logger.php';
		require_once 'async-requests/class-example-request.php';
		require_once 'background-processes/class-example-process.php';

		$this->process_single = new WP_Example_Request();
		$this->process_all    = new WP_Example_Process();
	}

	/**
	 * Admin bar
	 *
	 * @param WP_Admin_Bar $wp_admin_bar
	 */
	public function admin_bar( $wp_admin_bar ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		
		// $wp_admin_bar->add_menu( array(
		// 	'id'    => 'example-plugin',
		// 	'title' => __( 'Process', 'example-plugin' ),
		// 	'href'  => '#',
		// ) );

		// $wp_admin_bar->add_menu( array(
		// 	'parent' => 'example-plugin',
		// 	'id'     => 'example-plugin-single',
		// 	'title'  => __( 'Single User', 'example-plugin' ),
		// 	'href'   => wp_nonce_url( admin_url( '?process=single'), 'process' ),
		// ) );

		// $wp_admin_bar->add_menu( array(
		// 	'parent' => 'example-plugin',
		// 	'id'     => 'example-plugin-all',
		// 	'title'  => __( 'All Users', 'example-plugin' ),
		// 	'href'   => wp_nonce_url( admin_url( '?process=all'), 'process' ),
		// ) );
	}

	/**
	 * Process handler
	 */
	public function process_handler() {
		if ( ! isset( $_GET['process'] ) || ! isset( $_GET['_wpnonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_GET['_wpnonce'], 'process') ) {
			return;
		}



		if ( 'getprogress' === $_GET['process'] ) {
			$this->get_progress();
		}

		if ( 'update_api' === $_GET['process'] ) {
			$this->handle_update();
		}

		if($_GET['vendor'] == '')
			return;

		if ( 'sync' === $_GET['process'] ) {
			$this->handle_sync($_GET['vendor']);
		}
	}

	/**
	 * Handle sync
	 */
	protected function handle_sync($vendor) {
		$API_KEY = get_option( 'kinetic_api_key' );
		
		$total_products = $this->get_products($API_KEY, $vendor);
		$products_to_be_added = $this->getProductsToBeAdded($total_products);
		$products_to_be_removed = $this->getProductsToBeRemoved($total_products,$vendor);

		$products = array_merge($products_to_be_added,$products_to_be_removed);
 		
 		if(!empty($products)){
 			foreach ( $products as $product ) {
				$this->process_all->push_to_queue( $product );
			}
			set_transient('sync_in_progress','1',3600);
			set_transient('sync_in_progress_total',count($products),3600);
			set_transient('sync_in_progress_done','0',3600);
			$this->process_all->save()->dispatch();
 		}
		header('Location: '.WEBSITE_URL."/wp-admin/admin.php?page=dropmock-marketplace-settings&vendor=".$vendor);
	}



	/**
	 *	Get Sync Pogress
	 */
	protected function get_progress(){
		$total = get_transient('sync_in_progress_total');
		if(get_transient('sync_in_progress_total') && get_transient('sync_in_progress_done')){
			$total = (int)get_transient('sync_in_progress_total');
            $done = (int)get_transient('sync_in_progress_done');
            $percent = ($done/$total)*100;
            $percent = (int)$percent;
			echo '<span id="syncprogress" value="'.$percent.'">SYNC PROGRESS</span>';
			exit();
		}else{
			echo '<span id="syncprogress" value="-1">SYNC PROGRESS</span>';
			exit();
		}
			
	}


	/**
	 * Handle Update API Key 
	 */
	protected function handle_update() {

		
		$args = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'posts_per_page' => 1000,
			'meta_key' => 'wpdmmp_m_type',
			// 'meta_vendor' => $vendor,
		);


		$products = get_posts($args);

 		if(!empty($products)){
 			foreach ( $products as $product ) {
 				$product->action = 'remove';
				$this->process_all->push_to_queue( $product );
			}
            set_transient('delete_in_progress','1',3600);
			$this->process_all->save()->dispatch();
 		}
 		dropmockMarketDisconnectStore();
		header('Location: '.WEBSITE_URL."/wp-admin/admin.php?page=dropmock-marketplace-settings");
	}


	/**
	 * Get products from app.dropmock.com 
	 *
	 * @return array
	 */
	protected function get_products($API_KEY,$vendor) {
		$type = '';
		$url = DM_API_URL . "/api/v1/stages?type=" . $type . "&key=" . $API_KEY."&vendor=".$vendor;
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $items = curl_exec( $ch );
        $products = json_decode($items);
        $total = array();

        if(strtolower($vendor) != 'dropmock'){
        	foreach ($products as $product) {
	        	$product->title = $product->name;
	        	$product->description = 'This is a '.$vendor.' Product of category ['.$product->type.']';
	        	$product->thumbnail = $product->thumbnail_url;
	        	$product->preview_url = $product->thumbnail_url;
	        	$product->type = $vendor;
	        	$product->published = 1;
	        	$product->uuid = '';
	        	$product->extra = '';
	        	$total[] = $product;
	        }
        }else{
        	foreach ($products as $type) {
	        	foreach ($type as $product) {
	        		$total[] = $product;
	        	}
	        }
        }
        return $total;
	}


	/**
	 * Get unique products to be added 
	 *
	 * @return array
	 */
	protected function getProductsToBeAdded($products) {
		$total = array();
    	foreach ($products as $product) {
			if (checkIfProductExists($product->id)) {
	            continue;
	        }
	        $product->action = 'add';
    		$total[] = $product;
    	}

        return $total;
	}


	/**
	 * Get current store products
	 *
	 * @return array
	 */
	protected function getProductsToBeRemoved($products, $vendor) {

		$ids = array();
		$output = array();
		foreach ($products as $product) {
			$ids[] = $product->id;
		}

		$args = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'posts_per_page' => 1000,
			'meta_key' => 'wpdmmp_m_type',
		);


		$current_products = get_posts($args);
		foreach ($current_products as $product) {
			$id 			= get_post_meta($product->ID,'dm_product_id')[0];
			$product_vendor = get_post_meta($product->ID,'wpdmmp_m_vendor')[0];
			if(!in_array($id, $ids) && strtolower($vendor) == strtolower($product_vendor)){
				$product->action = 'remove';
				$product->id = $id;
				$output[] = $product;
			}
		}

		return $output;
	}




}

new Example_Background_Processing();