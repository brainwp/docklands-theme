<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package Odin
 * @version 3.0.0
 */

get_header();
?>

	<div id="primary" class="col-sm-12">
		<div id="content" class="site-content home" role="main">

			<?php get_sidebar( 'left' ); ?>

			<div class="col-sm-9 right">

				<?php odin_breadcrumbs(); ?>

				<?php
				/**
				* woocommerce_before_main_content hook
				*
				* @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the conten)
				* @hooked woocommerce_breadcrumb - 20
				*/
				do_action( 'woocommerce_before_main_content' );?>
				<?php while ( have_posts() ) : the_post(); ?>
				    <?php wc_get_template_part( 'content', 'single-product' ); ?>
			    <?php endwhile; // end of the loop. ?>
                <?php
                /**
                * woocommerce_after_main_content hook
                *
                * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                */
                do_action( 'woocommerce_after_main_content' );
                ?>

			</div><!-- right -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
