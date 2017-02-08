<?php
ini_set('max_execution_time', 600);

/**
 * Brasa_Dams_FTP_Update
 *
 * @author Brasa
 */
class Brasa_Dams_FTP_Update{
	public function __construct() {
		add_action('init', array($this,'do_cron'));
	}
	public function add_cron(){
		if( wp_next_scheduled( 'brasa_dams_cron' ) )
			return;

		wp_schedule_event( time(), 'hourly', 'brasa_dams_cron' );
	}
	private function get_xml_file(){
		$cfg = get_option('woo_cfg');
		if($cfg && $cfg['dams_ftp_host']) {
			$ftp_connect = ftp_connect( $cfg['dams_ftp_host'] );
			$login_result = ftp_login( $ftp_connect, $cfg['dams_ftp_user'], $cfg['dams_ftp_pass'] );
			//$connect = sprintf('ftp://%s:%s@%s/Stock.xml', $cfg['dams_ftp_user'], $cfg['dams_ftp_pass'], $cfg['dams_ftp_host']);

			if ( !$ftp_connect || !$login_result ) {
    			die( 'login failed' );
    		}
    		//ftp_chdir( $ftp_connect, '/' );
    		$local = fopen( get_template_directory() . '/inc/temp.xml', 'w' );
    		$result = ftp_fget( $ftp_connect, $local, 'Stock.xml', FTP_BINARY );
			fclose( $local );
			ftp_close( $ftp_connect );

            $content = file_get_contents( get_template_directory() . '/inc/temp.xml' );
			return $content;
		}
	}
	public function do_cron(){
		if(is_admin() || !isset( $_GET['do_dams_cron'] ) )
			return;
		$update_date = sprintf( 'update_stock_last_date_%s', current_time( 'Y-m-d' ) );
		$file = simplexml_load_string( $this->get_xml_file() ) ;
		// WP_Query arguments
		$args = array (
			'post_type'              => array( 'product', 'product_variation'),
			'posts_per_page'		 => 1200,
			'meta_query'             => array(
				'relation' => 'AND',
				array(
					'key'       => '_sku',
					'compare'   => 'EXISTS',
				),
				array(
					'key'     => $update_date,
					'compare' => 'NOT EXISTS',
				),
			),
		);

		// The Query
		$query = new WP_Query( $args );
		// The Loop

		if ( $query->have_posts() ) {
			$i = 0;
			while ( $query->have_posts() ) {
				$i++;
				$query->the_post();
				$path = sprintf('//Product[@Code="%s"]', get_post_meta( get_the_ID(), '_sku', true));
				$xml = json_decode( json_encode( (array) $file->xpath($path)), true );
				if($xml && !empty($xml) && is_array($xml)){
					$qty = $xml[0]['Warehouse']['@attributes']['Available'];
					update_post_meta( get_the_ID(), '_stock', $qty);
					update_post_meta( get_the_ID(), '_manage_stock', 'yes');
					if(intval($qty) > 0){
						update_post_meta( get_the_ID(), '_stock_status', 'instock');
					}
					else{
						update_post_meta( get_the_ID(), '_stock_status', 'outofstock');
					}
					echo 'foi!<br>';
				}
				echo $i;
				update_post_meta( get_the_ID(), $update_date, 'true' );

			}
			die();
		}
		// Restore original Post Data
		wp_reset_postdata();
	}
}
new Brasa_Dams_FTP_Update();
