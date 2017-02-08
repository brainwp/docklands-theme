<?php
/**
 * WooCommerce latest post view
 *
 * @author Brasa
 */
class Woo_Post_Views{
	public function __construct() {
		//add_action( 'admin_footer', array( $this, 'debug' ) );
	}

	public function get_posts(){
		if ( !isset( $_COOKIE['woocommerce_recently_viewed'] ) || empty( $_COOKIE['woocommerce_recently_viewed'] ) )
			return false;
		$viewed_products = explode( '|', $_COOKIE['woocommerce_recently_viewed'] );
		$viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );
		return $viewed_products;
	}
}
global $woo_post_views;
$woo_post_views = new Woo_Post_Views();
