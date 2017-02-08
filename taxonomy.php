<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package Odin
 * @since 2.2.0
 * @version 3.0.0
 */

get_header();
?>

	<div id="primary" class="col-sm-12">
		<div id="content" class="site-content home" role="main">

			<?php get_sidebar( 'left' ); ?>

			<div class="col-sm-9 right">
				<?php woocommerce_product_loop_start(); ?>
				<?php woocommerce_product_subcategories(); ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'produto' ); ?>
                <?php endwhile; // end of the loop. ?>
                <?php woocommerce_product_loop_end(); ?>
			</div><!-- right -->

			<div class="col-sm-12 full">

				<div class="col-sm-6 banner">
					<div class="content">
						BANNER
					</div><!-- content -->
				</div><!-- banner -->

				<div class="col-sm-6 video">
					<div class="content">
						VÍDEO
					</div><!-- content -->
				</div><!-- video -->

				<?php if ( $differential = get_field( 'home_differential', 'options' ) ) : ?>

					<div class="differential col-xs-12">
						<h4>Why Docklands are unique:</h4>
						<span><?php echo $differential; ?></span>
					</div><!-- differential -->

				<?php endif ?>

				<?php if ( $banner_2 = get_field( 'home_banner_2', 'options' ) ) : ?>

					<div class="banner col-sm-6">
						<img src="<?php echo $banner_2; ?>" alt="">
					</div><!-- banner -->

				<?php endif ?>

				<?php if ( $banner_3 = get_field( 'home_banner_3', 'options' ) ) : ?>

					<div class="banner col-sm-6">
						<img src="<?php echo $banner_3; ?>" alt="">
					</div><!-- banner -->

				<?php endif ?>

			</div><!-- full -->
			<?php get_template_part( 'parts/recentrly-items' ); ?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
