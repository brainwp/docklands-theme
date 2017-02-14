<?php
ini_set('max_execution_time', 600);

/**
 * Brasa_Dams_FTP_Update
 *
 * @author Brasa
 */
class Brasa_Dams_FTP_Update{

	/**
	 * @var array|boolean
	 */
	private $log_file = false;
	/**
	 * construct class
	 */
	public function __construct() {
		add_action('init', array($this,'do_cron'));
	}
	/**
	 * Get product ID by SKU
	 * @param string $sku
	 * @return boolean|int
	 */
	private function get_product_by_sku( $sku ) {
		global $wpdb;
		$product_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $sku ) );

		if ( $product_id ) {
			return $product_id;
		}

		return false;
	}
	/**
	 * Get XML file content, load from FTP if not loaded yet
	 * @return string
	 */
	private function get_xml_file(){
		$cfg = get_option('woo_cfg');
		if($cfg && $cfg['dams_ftp_host']) {
    		//ftp_chdir( $ftp_connect, '/' );
    		$file_name = sprintf( '%s.xml', current_time( 'Y-m-d' ) );
    		$file_location = WP_CONTENT_DIR . '/dams/' . $file_name;
    		if ( ! file_exists( $file_location ) ) {
    			if( ! file_exists( WP_CONTENT_DIR . '/dams' ) ) {
    				mkdir( WP_CONTENT_DIR . '/dams', 0755 );
    			}
    			$ftp_connect = ftp_connect( $cfg['dams_ftp_host'] );
				$login_result = ftp_login( $ftp_connect, $cfg['dams_ftp_user'], $cfg['dams_ftp_pass'] );
				//$connect = sprintf('ftp://%s:%s@%s/Stock.xml', $cfg['dams_ftp_user'], $cfg['dams_ftp_pass'], $cfg['dams_ftp_host']);

				if ( !$ftp_connect || !$login_result ) {
    				die( 'login failed' );
    			}

    			$local = fopen( $file_location, 'w' );
    			$result = ftp_fget( $ftp_connect, $local, 'Stock.xml', FTP_BINARY );
				fclose( $local );
				ftp_close( $ftp_connect );
    		}
            $content = file_get_contents( $file_location );
			return $content;
		}
	}
	/**
	 * Log messages on a txt file located in wp-content/dams
	 * @param type $message
	 * @return type
	 */
	private function log( $message ) {
    	$file_name = sprintf( '%s_log.txt', current_time( 'Y-m-d' ) );
		$file_location = WP_CONTENT_DIR . '/dams/' . $file_name;
		if ( ! file_exists( $file_location ) ) {
    		if( ! file_exists( WP_CONTENT_DIR . '/dams' ) ) {
    			mkdir( WP_CONTENT_DIR . '/dams', 0755 );
    		}
    	}
    	if ( false === $this->log_file ) {
    		$this->log_file = fopen( $file_location, 'a+' );
    	}
    	fwrite( $this->log_file, $message . "\n" );
    	//echo $message . '<br>';
	}
	/**
	 * Close open files and kill execution
	 */
	private function close_cron() {
		if ( false !== $this->log_file ) {
			$this->log( "---- STOPPED ---\n" );
			fclose( $this->log_file );
		}
		die();
	}
	/**
	 * Execute Dams Cron
	 */
	public function do_cron(){
		if(is_admin() || !isset( $_GET['do_dams_cron'] ) )
			return;
		$update_date = sprintf( 'update_stock_last_date_%s', current_time( 'Y-m-d' ) );
		$file = simplexml_load_string( $this->get_xml_file() );
		$xml_data = (array) json_decode( json_encode( (array) $file ), true );
		$max_per_load = 1000;
		$stopped_on = get_option( sprintf( 'dams_stopped_%s', current_time( 'Y-m-d' ) ), 0 );
		if ( 'executed' === $stopped_on ) {
			$this->close_cron();
		}
		$updated_products = intval( get_option( sprintf( 'dams_updated_%s', current_time( 'Y-m-d' ) ), 0 ) );
		$count = 0;
		$stopped_on = intval( $stopped_on );
		for ( $i = intval( $stopped_on ); $count < $max_per_load; $i++ ) {
			if( ! isset( $xml_data[ 'Product'][ $i ] ) ) {
				break;
			}
			$product = $xml_data['Product'][ $i ];
			$count++;
			$product = ( array )$product;
			$log_message = sprintf( 'Index[%s]: ', $i );
			if ( ! isset( $product[ '@attributes' ][ 'Code' ] ) ) {
				$this->log( $log_message . 'não tem atributo Code no XML' );
				$i++;
				continue;
			}
			if ( ! isset( $product[ '@attributes' ][ 'Code' ] ) ) {
				$this->log( $log_message . 'não tem atributo Code no XML' );
				$i++;
				continue;
			}

			$log_message = sprintf( 'Index[%s] - Code[%s]: ', $i, $product[ '@attributes' ][ 'Code' ] );
			$product_id = $this->get_product_by_sku( $product[ '@attributes' ][ 'Code' ] );
			if ( false === $product_id ) {
				$this->log( $log_message . 'não foi encontrado produto com esse SKU no banco' );
				$i++;
				continue;
			}
			$sku = get_post_meta( $product_id, '_sku', true );
			$this->log( $log_message . 'SKU no banco: ' . $sku );
			$log_message = sprintf( 'Index[%s] - Code[%s] - WPID[%s]: ', $i, $product[ '@attributes' ][ 'Code' ], $product_id );
			if ( ! isset( $product['Warehouse']['@attributes']['Available'] ) ) {
				$this->log( $log_message . 'não tem atributo Available no XML' );
				$i++;
				continue;
			}
			$qty = $product['Warehouse']['@attributes']['Available'];
			$qty_old = get_post_meta( $product_id, '_stock', true );
			update_post_meta( $product_id, '_stock', $qty);
			update_post_meta( $product_id, '_manage_stock', 'yes');
			if(intval($qty) > 0){
				update_post_meta( $product_id, '_stock_status', 'instock');
			} else {
				update_post_meta( $product_id, '_stock_status', 'outofstock');
			}
			$this->log( $log_message . sprintf( 'Atualizado! {Quantidade anterior: %s} {Nova Quantidade: %s}', $qty_old, $qty ) );
			$updated_products++;
		}
		update_option( sprintf( 'dams_updated_%s', current_time( 'Y-m-d' ) ), $updated_products );
		if ( $i >= count( $xml_data[ 'Product'] ) ) {
			update_option( sprintf( 'dams_stopped_%s', current_time( 'Y-m-d' ) ), 'executed' );
			$this->log( "--- END OF FILE (UPDATED PRODUCTS = $updated_products )---\n" );
		} else {
			update_option( sprintf( 'dams_stopped_%s', current_time( 'Y-m-d' ) ), $i );
		}
		$this->close_cron();
	}
}
new Brasa_Dams_FTP_Update();
