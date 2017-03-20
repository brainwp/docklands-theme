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
$options = get_option('home_cfg');
get_header();
global $wp_query;
?>

	<div id="primary" class="col-sm-12">
		<div id="content" class="site-content home" role="main">

			<?php get_sidebar( 'left' ); ?>

			<div class="col-sm-9 right">

				<?php odin_breadcrumbs(); ?>

				<h3 class="bg-title"><?php echo brasa_current_term(); ?></h3>

				<div class="row">
					<?php if ( is_tax() ) : ?>
						<div class="col-md-12">
					<?php endif;?>
					<?php woocommerce_product_loop_start(); ?>
					<?php woocommerce_product_subcategories(); ?>
					<?php if ( is_tax() ) : ?>
						</div>
					<?php endif;?>
					<?php if ( have_posts() ) : ?>

					<?php $count = '0'; ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php $count++; ?>

						<?php get_template_part( 'content', 'produto' ); ?>

						<?php if ( $count == '3' ): ?>
							<div class="clear"></div>
							<?php $count = '0'; ?>
						<?php endif ?>

	                <?php endwhile; // end of the loop. ?>
	                <?php woocommerce_product_loop_end(); ?>
                </div><!-- row -->
				<div class="col-md-12 pagination-control">
				    <div class="col-md-4 nopadding">
					    <label><?php _e('Show','odin');?></label>
					    <select>
                            <option value="<?php echo add_query_arg( 'per_page', '12', $_SERVER['REQUEST_URI'] );?>">
                            	<?php _e('12 per page','odin');?>
                            </option>
                            <option value="<?php echo add_query_arg( 'per_page', '24', $_SERVER['REQUEST_URI'] );?>" <?php if(isset($_GET['per_page'])) selected( $_GET['per_page'], 24 ); ?>>
                            	<?php _e('24 per page','odin');?>
                            </option>
                            <option value="<?php echo add_query_arg( 'per_page', '36', $_SERVER['REQUEST_URI'] );?>" <?php if(isset($_GET['per_page'])) selected( $_GET['per_page'], 36 );?>>
                            	<?php _e('36 per page','odin');?>
                            </option>
					    </select>
					</div><!-- .col-md-4 -->
					<?php if( $wp_query->max_num_pages > 1):?>
					<div class="col-md-4 pull-right">
						<div class="pull-right news-pagination-links">
							<?php brasa_news_pagination( $wp_query->max_num_pages );?>
						</div><!-- .pull-right -->
					</div><!-- .col-md-4 -->
				    <?php endif;?>
				</div><!-- .col-md-12 pagination-control -->
            	<?php else : ?>
            		<?php if ( ! is_tax() ) : ?>
            			<?php get_template_part( 'content', 'none' );?>
            		<?php endif;?>
            	<?php endif;?>
            	<?php get_template_part( 'parts/recentrly-items' ); ?>

			</div><!-- right -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
