<?php
/**
 * The template for displaying pages with sidebar.
 * Template name: About Us
 * @package Odin
 * @since 2.2.0
 */

get_header();
?>

	<div id="primary" class="">
		<div id="content" class="site-content" role="main">

			<?php if ( is_page_child() == true ): ?>
				<h3 class="bg-title"><?php echo get_the_title( $post->post_parent ); ?></h3>
			<?php endif ?>

			<?php get_sidebar( 'left' ); ?>

			<div class="col-sm-9 right">

				<?php odin_breadcrumbs(); ?>

				<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

						// Include the page content template.
						get_template_part( 'content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					endwhile;
				?>

			</div><!-- right -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
