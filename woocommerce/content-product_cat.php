<?php
// Content Services
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Increase loop count
$woocommerce_loop['loop']++;

// set columns
$class = 'col-md-6 cases';
?>
<a class="<?php echo $class;?> services each col-xs-12" href="<?php echo get_term_link( $category );?>">

	<div class="thumb">
		<?php $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id',true ); ?>
		<?php $image = wp_get_attachment_image_src( $thumbnail_id, 'medium', false );?>
		<img src="<?php echo esc_url( $image[0] );?>" alt="<?php echo esc_attr( $category->name );?>" />
	</div><!-- .thumb -->

	<div class="desc">

		<h3><?php echo apply_filters( 'the_title', $category->name );?></h3>
		<div class="product-info">
			<?php _e('View Products', 'odin'); ?>
			<span class="orange">&gt;</span>
		</div><!-- .product-info -->

	</div><!-- .desc -->

</a><!-- .col-md-4 services -->
