<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="woocommerce-tabs col-md-7">
		<ul class="tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>

				<li class="<?php echo $key ?>_tab">
					<a href="#tab-<?php echo $key ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
				</li>

			<?php endforeach; ?>
		</ul>
		<?php foreach ( $tabs as $key => $tab ) : ?>

			<div class="panel entry-content" id="tab-<?php echo $key ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
			</div>

		<?php endforeach; ?>
	</div>
	<div class="col-md-5 pull-right buttons">
		<button class="btn btn-single" id="odin-add-to-cart">
			<?php _e('Add to Enquire','odin'); ?>
		</button>
		<a class="btn btn-single" href="<?php echo home_url('/ask-a-question')?>?url=<?php the_permalink();?>">
			<?php _e('Ask a Question','odin'); ?>
		</a>
		<a href="<?php echo home_url( '/delivery-and-returns/' ); ?>" class="btn btn-single">
			<?php _e('Delivery & Returns','odin'); ?>
		</a>
		<a class="btn btn-single" href="javascript:window.print();">
			<?php _e('Print this Page','odin'); ?>
		</a>
		<a class="btn btn-single" href="<?php echo home_url('/e-mail-a-friend')?>?url=<?php the_permalink();?>&amp;product_title=<?php echo esc_attr(get_the_title());?>">
			<?php _e('E-mail a Friend','odin'); ?>
		</a>
		<a href="<?php echo home_url( '/testimonials/' ); ?>" class="btn btn-single">
			<?php _e('Testimonials','odin'); ?>
		</a>
	</div><!-- .col-md-4 pull-right buttons -->

<?php endif; ?>
