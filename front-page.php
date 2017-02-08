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
 */
$options = get_option('home_cfg');
get_header('shop');
?>

	<div id="primary" class="col-sm-12">
		<div id="content" class="site-content home" role="main">

			<?php get_sidebar( 'left' ); ?>

			<div class="col-sm-9 right">
				<div class="col-md-12">
					<?php wc_print_notices(); ?>
				</div><!-- .col-md-12 -->
				<div class="slider-home">
					<?php echo do_shortcode( '[brasa_slider name="Slider Home"]' ); ?>
				</div><!-- slider-home -->
				<?php get_template_part( 'parts/slider-product' ); ?>
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
							'posts_per_page'         => '6'
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
			</div><!-- right -->

			<div class="col-sm-12 full">

				<?php if ( $banner_1 = $options['home_banner_1'] ) : ?>
				    <?php $link = (!empty($options['home_banner_1_link']))? $options['home_banner_1_link'] : ''; ?>

					<div class="banner col-sm-6 wrapper-image">
						<div class="content">
							<a href="<?php echo $link;?>">
								<?php $image_attributes = wp_get_attachment_image_src( $banner_1, 'full' ); ?>
								<img src="<?php echo $image_attributes[0]; ?>" />
							</a>
						</div><!-- content -->
					</div><!-- banner wrapper-image -->

				<?php endif ?>

				<div class="col-sm-6 video">
					<div class="content">
						<?php echo strip_tags($options['home_video'],'<iframe>'); ?>
					</div><!-- content -->
				</div><!-- video -->

			</div><!-- full -->

			<div class="col-sm-12 full">

				<?php if ( $differential = $options['home_differential'] ) : ?>

					<div class="differential">
						<h4>Why Docklands are unique:</h4>
						<span><?php echo $differential; ?></span>
					</div><!-- differential -->

				<?php endif ?>

			</div><!-- full -->

			<div class="col-sm-12 full">

				<?php if ( $banner_2 = $options['home_banner_2'] ) : ?>
				    <?php $link = (!empty($options['home_banner_2_link']))? $options['home_banner_2_link'] : 'javascript:void(0)'; ?>

					<div class="banner col-sm-6">
						<a href="<?php echo $link;?>">
							<?php echo wp_get_attachment_image($banner_2,'half-horizontal-thumb'); ?>
						</a>
					</div><!-- banner -->

				<?php endif; ?>

				<?php if ( $banner_3 = $options['home_banner_3'] ) : ?>
				    <?php $link = (!empty($options['home_banner_3_link']))? $options['home_banner_3_link'] : 'javascript:void(0)'; ?>

					<div class="banner col-sm-6">
						<a href="<?php echo $link;?>">
							<?php echo wp_get_attachment_image($banner_3,'half-horizontal-thumb'); ?>
						</a>
					</div><!-- banner -->

				<?php endif; ?>

			</div><!-- full -->

			<div class="col-md-6 pull-left cloud-sidebar">
				<?php dynamic_sidebar( 'cloud-sidebar' ); ?>
			</div><!-- .col-md-6 -->

			<div class="col-md-6 pull-right twitter-posts">
				<?php get_template_part( 'parts/twitter-posts' ); ?>
			</div><!-- .col-md-6 -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
