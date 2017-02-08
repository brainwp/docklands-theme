<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 *
 * Template name: Guides/PDF
 *
 * @package Odin
 * @since 2.2.0
 */

get_header();
?>

	<div id="primary" class="col-sm-12">
		<div id="content" class="site-content home" role="main">

			<?php get_sidebar( 'left' ); ?>

			<div class="col-sm-9 right">

				<?php odin_breadcrumbs(); ?>

				<div class="col-sm-12">
					<h3 class="bg-title"><?php the_title(); ?></h3>
				</div>

				<div class="col-sm-12 full">
					<?php $args = array(
						'post_type' 		=> 'page',
						'post_parent' 		=> get_the_ID(),
						'posts_per_page'	=> -1
						);
					$query = new WP_Query( $args );
					?>
					<?php if ( $query->have_posts() ) : ?>
						<?php while ( $query->have_posts() ): $query->the_post(); ?>
							<?php get_template_part('content','services'); ?>
						<?php endwhile; ?>
					<?php endif; ?>

				</div><!-- arrivals -->
				<h3 class="bg-title-news">
					<a><?php _e('New Arrivals','odin');?></a>
				</h3>
				<div class="col-sm-12 arrivals full">
					<?php
						// Count loop
						$count = 0;
						// WP_Query arguments
						$args = array (
							'post_type'              => 'product',
							'posts_per_page'         => 3
						);
						// The Query
						$query = new WP_Query( $args );
					?>
					<?php if ( $query->have_posts() ) : ?>
						<?php while ( $query->have_posts() ): $query->the_post(); ?>

							<?php get_template_part('content','produto'); ?>
							<?php $count++; ?>
							<?php if ( $count == 3 ): ?>
								<div class="clear"></div>
							<?php endif ?>

						<?php endwhile; ?>
					<?php endif; ?>
					<?php wp_reset_postdata(); ?>

				</div><!-- arrivals -->
				<?php get_template_part( 'parts/recentrly-items' ); ?>

			</div><!-- right -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
