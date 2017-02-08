<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>

<div class="preco pull-left col-md-6" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
	<div class="flex">
		<span class="string-preco"><?php _e('Our Price','odin'); ?></span>
		<span class="o-preco"><?php echo woocommerce_price($product->get_price_excluding_tax()); ?></span>
		<span class="imposto-preco">
			<?php printf( __('(Inc. Vat %s)','odin'), woocommerce_price($product->get_price_including_tax()) ); ?>
		</span>
	</div><!-- flex -->
</div>
