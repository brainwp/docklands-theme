
<?php
ini_set('max_execution_time', 300);
require_once untrailingslashit( ABSPATH ) . str_replace( get_site_url(), '', plugins_url() ) . '/woocommerce/woocommerce.php';
new WooCommerce();
//page migracao
// WP_Query arguments
$args = array (
	'post_type'              => array( 'product'),
	'posts_per_page'         => -1,
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		// do somethin
		$_id = get_the_ID();
		$price = get_post_meta( $_id, '_price', true );
		$price = intval($price);
		if( $price <= 299 ){
			$name = sprintf('Under %s299', get_woocommerce_currency_symbol());
			$search_term = get_term_by( 'name', $name, 'price', OBJECT );
			if($search_term){
				wp_set_post_terms( $_id, $search_term->term_id, 'price' );
			}
			else{
				$term = wp_insert_term( $name, 'price', array());
				wp_set_post_terms( $_id, array($term['term_id']), 'price' );
			}
		}
		if( $price >= 300 && $price <= 599 ){
			$name = sprintf('%s300 to %s599', get_woocommerce_currency_symbol(), get_woocommerce_currency_symbol());
			$search_term = get_term_by( 'name', $name, 'price', OBJECT );
			if($search_term){
				wp_set_post_terms( $_id, $search_term->term_id, 'price' );
			}
			else{
				$term = wp_insert_term( $name, 'price', array());
				wp_set_post_terms( $_id, array($term['term_id']), 'price' );
			}
		}
		if( $price >= 600 && $price <= 899 ){
			$name = sprintf('%s600 to %s899', get_woocommerce_currency_symbol(), get_woocommerce_currency_symbol());
			$search_term = get_term_by( 'name', $name, 'price', OBJECT );
			if($search_term){
				wp_set_post_terms( $_id, $search_term->term_id, 'price' );
			}
			else{
				$term = wp_insert_term( $name, 'price', array());
				wp_set_post_terms( $_id, array($term['term_id']), 'price' );
			}
		}
		if( $price >= 900 && $price <= 1199 ){
			$name = sprintf('%s900 to %s1,199', get_woocommerce_currency_symbol(), get_woocommerce_currency_symbol());
			$search_term = get_term_by( 'name', $name, 'price', OBJECT );
			if($search_term){
				wp_set_post_terms( $_id, $search_term->term_id, 'price' );
			}
			else{
				$term = wp_insert_term( $name, 'price', array());
				wp_set_post_terms( $_id, array($term['term_id']), 'price' );
			}
		}
		if( $price >= 1200 && $price <= 1499 ){
			$name = sprintf('%1,200 to %s1,499', get_woocommerce_currency_symbol(), get_woocommerce_currency_symbol());
			$search_term = get_term_by( 'name', $name, 'price', OBJECT );
			if($search_term){
				wp_set_post_terms( $_id, $search_term->term_id, 'price' );
			}
			else{
				$term = wp_insert_term( $name, 'price', array());
				wp_set_post_terms( $_id, array($term['term_id']), 'price' );
			}
		}
		if( $price >= 1500 && $price <= 1799 ){
			$name = sprintf('%s1,500 to %s1,799', get_woocommerce_currency_symbol(), get_woocommerce_currency_symbol());
			$search_term = get_term_by( 'name', $name, 'price', OBJECT );
			if($search_term){
				wp_set_post_terms( $_id, $search_term->term_id, 'price' );
			}
			else{
				$term = wp_insert_term( $name, 'price', array());
				wp_set_post_terms( $_id, array($term['term_id']), 'price' );
			}
		}
		if( $price >= 1800 && $price <= 2099 ){
			$name = sprintf('%s1,800 to %s2,099', get_woocommerce_currency_symbol(), get_woocommerce_currency_symbol());
			$search_term = get_term_by( 'name', $name, 'price', OBJECT );
			if($search_term){
				wp_set_post_terms( $_id, $search_term->term_id, 'price' );
			}
			else{
				$term = wp_insert_term( $name, 'price', array());
				wp_set_post_terms( $_id, array($term['term_id']), 'price' );
			}
		}
		if( $price >= 2100 && $price <= 2399 ){
			$name = sprintf('%s2,100 to %s2,399', get_woocommerce_currency_symbol(), get_woocommerce_currency_symbol());
			$search_term = get_term_by( 'name', $name, 'price', OBJECT );
			if($search_term){
				wp_set_post_terms( $_id, $search_term->term_id, 'price' );
			}
			else{
				$term = wp_insert_term( $name, 'price', array());
				wp_set_post_terms( $_id, array($term['term_id']), 'price' );
			}
		}
		if( $price >= 2400 && $price <= 2699 ){
			$name = sprintf('%s2,400 to %s2,699', get_woocommerce_currency_symbol(), get_woocommerce_currency_symbol());
			$search_term = get_term_by( 'name', $name, 'price', OBJECT );
			if($search_term){
				wp_set_post_terms( $_id, $search_term->term_id, 'price' );
			}
			else{
				$term = wp_insert_term( $name, 'price', array());
				wp_set_post_terms( $_id, array($term['term_id']), 'price' );
			}
		}
		if( $price >= 2700 && $price <= 3999 ){
			$name = sprintf('%s2,700 to %s3,999', get_woocommerce_currency_symbol(), get_woocommerce_currency_symbol());
			$search_term = get_term_by( 'name', $name, 'price', OBJECT );
			if($search_term){
				wp_set_post_terms( $_id, $search_term->term_id, 'price' );
			}
			else{
				$term = wp_insert_term( $name, 'price', array());
				wp_set_post_terms( $_id, array($term['term_id']), 'price' );
			}
		}
		if( $price >= 4000 ){
			$name = sprintf('Above %s4,000', get_woocommerce_currency_symbol(), get_woocommerce_currency_symbol());
			$search_term = get_term_by( 'name', $name, 'price', OBJECT );
			if($search_term){
				wp_set_post_terms( $_id, $search_term->term_id, 'price' );
			}
			else{
				$term = wp_insert_term( $name, 'price', array());
				wp_set_post_terms( $_id, array($term['term_id']), 'price' );
			}
		}

	}
}


// Restore original Post Data
wp_reset_postdata();
?>
