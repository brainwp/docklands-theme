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
global $is_advanced_search;
$is_advanced_search = true;
get_header();
?>

	<div id="primary" class="col-sm-12 advanced-search">
		<div id="content" class="site-content home" role="main">

			<?php get_sidebar( 'left' ); ?>

			<div class="col-sm-9 right">

				<?php odin_breadcrumbs(); ?>

				<?php
				// WP_Query arguments
				$args = array (
					'post_type'			=> 'product',
					'posts_per_page'	=> 9,
					'paged'				=> get_query_var( 'paged', 1 )
					);
				// The Query
				$query = new WP_Query( $args );
				?>
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<?php get_template_part( 'content', 'produto' ); ?>
                <?php endwhile; // end of the loop. ?>
				<div class="col-md-12 pagination-control">
				    <div class="col-md-4 nopadding">
					    <label><?php _e('Show','odin');?></label>
					    <select>
                            <option value="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) );?>">
                            	<?php _e('12 per page','odin');?>
                            </option>
                            <option value="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) );?>?per_page=24" <?php if(isset($_GET['per_page'])) selected( $_GET['per_page'], 24 ); ?>>
                            	<?php _e('24 per page','odin');?>
                            </option>
                            <option value="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) );?>?per_page=36" <?php if(isset($_GET['per_page'])) selected( $_GET['per_page'], 36 );?>>
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

                <?php get_template_part( 'parts/recentrly-items' ); ?>
			</div><!-- right -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
