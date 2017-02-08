<?php
/**
 * The Template for displaying Recentrly viewed items.
 * use get_template_part() to apply in your template.
 */
global $woo_post_views;
?>

	<?php
		// WP_Query arguments
		$args = array (
			'post_type'              => 'product',
			'posts_per_page'         => 5,
			'post__in'               => $woo_post_views->get_posts(),
			'_is_wc_query'			 => true
		);

		// The Query
		$query = new WP_Query( $args );
	?>

	<?php if ( $query->have_posts() ) : ?>
	<div class="col-sm-12 recentrly-items">

			<span class="col-xs-12 title">Recentrly viewed items</span>

			<div class="loop">

				<?php while ( $query->have_posts() ): $query->the_post(); ?>
					<a href="<?php echo get_the_permalink(); ?>">
					<div class="col-sm-2 each">
						<div class="thumb">
							<?php if ( has_post_thumbnail() ) : ?>

								<?php the_post_thumbnail( 'thumbail' ); ?>

							<?php else : ?>

								<span>No Image Avaliable</span>

							<?php endif; ?>
						</div><!-- thumb -->

						<div class="desc">

							<?php the_title(); ?>
							<span class="link">View <span class="orange">></span></span>

						</div><!-- desc -->

					</div><!-- each -->
					</a>
				<?php endwhile; ?>

			</div><!-- loop -->

		</div><!-- recentrly-items -->

	<?php endif; ?>

<?php wp_reset_postdata(); ?>
