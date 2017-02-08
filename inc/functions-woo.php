<?php
/**
 * Functions to Woo.
 */

function new_arrivals() { ?>
	<h3 class="bg-title">New Arrivals</h3>

	<div class="col-sm-12 arrivals">
		<?php

		// WP_Query arguments
		$args = array (
			'post_type'              => 'product',
			'posts_per_page'         => '3',
		);
		// The Query
		$query = new WP_Query( $args ); ?>

		<?php if ( $query->have_posts() ) : ?>
			<?php while ( $query->have_posts() ): $query->the_post(); ?>
				<?php get_template_part( 'content', 'produto' ); ?>
			<?php endwhile; ?>
		<?php endif; ?>

		<?php wp_reset_postdata(); ?>

	</div><!-- arrivals -->

<?php }

function get_recently_viewed_itens() {

	echo '<div class="col-md-12 full nopadding">';
	get_template_part( 'parts/recentrly-items' );
	echo '</div><!-- full -->';

}



/* Hooks */
add_action( 'woocommerce_after_main_content', 'new_arrivals' );
add_action( 'woocommerce_after_main_content', 'get_recently_viewed_itens' );
add_action( 'woocommerce_end_cart', 'new_arrivals' );
add_action( 'woocommerce_end_cart', 'get_recently_viewed_itens' );