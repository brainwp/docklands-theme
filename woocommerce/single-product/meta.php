<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post, $product;
$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php _e( 'SKU:', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></span></span>

	<?php endif; ?>

	<?php echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '</span>' ); ?>

	<div class="col-md-12">
		<?php $terms = get_the_terms( $post->ID, 'tax_product_type' ); ?>
		<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
	    	<span class="tagged_as">
	    		<?php _e('Product Type:&nbsp;', 'odin');?>
	    		<?php foreach ( $terms as $term ) : ?>
	    			<a href="<?php echo get_term_link( $term->term_id, 'tax_product_type' );?>">
						<?php echo apply_filters( 'the_title', $term->name );?>
					</a>
				<?php endforeach; ?>
			</span>
		<?php endif;?>
	</div><!-- .col-md-12 -->
	<div class="col-md-12">
		<?php $terms = get_the_terms( $post->ID, 'material' ); ?>
		<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
	    	<span class="tagged_as">
	    		<?php _e('Material:&nbsp;', 'odin');?>
	    		<?php foreach ( $terms as $term ) : ?>
	    			<a href="<?php echo get_term_link( $term->term_id, 'material' );?>">
						<?php echo apply_filters( 'the_title', $term->name );?>
					</a>
				<?php endforeach; ?>
			</span>
		<?php endif;?>
		<?php $terms = get_the_terms( $post->ID, 'brands' ); ?>
		<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
	    	<span class="tagged_as">
	    		<?php _e('Brands:&nbsp;', 'odin');?>
	    		<?php foreach ( $terms as $term ) : ?>
	    			<a href="<?php echo get_term_link( $term->term_id, 'brands' );?>">
						<?php echo apply_filters( 'the_title', $term->name );?>
					</a>
				<?php endforeach; ?>
			</span>
		<?php endif;?>
		<?php $terms = get_the_terms( $post->ID, 'product_condition' ); ?>
		<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
	    	<span class="tagged_as">
	    		<?php _e('Product Condition:&nbsp;', 'odin');?>
	    		<?php foreach ( $terms as $term ) : ?>
	    			<a href="<?php echo get_term_link( $term->term_id, 'product_condition' );?>">
						<?php echo apply_filters( 'the_title', $term->name );?>
					</a>
				<?php endforeach; ?>
			</span>
		<?php endif;?>
	</div><!-- .col-md-12 -->
	<?php do_action( 'woocommerce_product_meta_end' ); ?>
</div>
