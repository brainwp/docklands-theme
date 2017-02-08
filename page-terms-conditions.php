<?php
/**
 * The template for displaying pages with sidebar.
 * Template name: Terms & Conditions/Delivery & returns
 * @package Odin
 * @since 2.2.0
 */

get_header();
$page_id = get_the_ID();
?>

	<div id="primary" class="terms-conditions">
		<div id="content" class="site-content" role="main">
			<div class="page-contact">
				<h1 class="top-name">
					<?php the_title(); ?>
				</h1><!-- .top-name -->
			</div><!-- .page-contact -->
			<?php get_sidebar(); ?>

			<div class="col-sm-9 right">

				<?php odin_breadcrumbs(); ?>

				<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();
				?>


					<?php
					    $args = array(
					    	'post_type' => 'page',
					    	'post_parent' => $page_id,
					    	'paged' => get_query_var('paged',1),
					    	'posts_per_page' => 12
					   );

					?>
					<?php if(isset($_GET['per_page']) && $_GET['per_page'] == '12'):?>
				    	<?php $args['posts_per_page'] = 12; ?>
					<?php endif;?>
					<?php if(isset($_GET['per_page']) && $_GET['per_page'] == '24'):?>
				    	<?php $args['posts_per_page'] = 24; ?>
					<?php endif;?>
					<?php if(isset($_GET['per_page']) && $_GET['per_page'] == '36'):?>
				    	<?php $args['posts_per_page'] = 36; ?>
					<?php endif;?>
			    	<?php if(isset($_GET['by_cat'])):?>
				    	<?php $args['category_name'] = $_GET['by_cat']; ?>
					<?php endif;?>
					<?php
					$subpages_query = new WP_Query( $args );

					if( $subpages_query->have_posts() ) {

					while ( $subpages_query->have_posts() ) : $subpages_query->the_post(); ?>

					<div class="each row">
						<div class="left col-md-7">
							<h2><?php the_title(); ?></h2>
							<?php the_excerpt(); ?>
						</div><!-- left -->
						<div class="thumb col-md-5">
							<a href="<?php the_permalink(); ?>">
								<?php if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'square-thumb' );
								} ?>
							</a>
						</div><!-- thumb -->

					</div><!-- each -->

					<?php
					    endwhile;
					    }
					    ?>
					<div class="col-md-12 nopadding pagination-control">
				    <div class="col-md-4 nopadding">
					    <label><?php _e('Show','odin');?></label>
					    <select>
                            <option value="<?php echo get_permalink($wp_query->post->ID);?>">
                            	<?php _e('12 per page','odin');?>
                            </option>
                            <option value="<?php echo get_permalink($wp_query->post->ID);?>?per_page=24" <?php if(isset($_GET['per_page'])) selected( $_GET['per_page'], 24 ); ?>>
                            	<?php _e('24 per page','odin');?>
                            </option>
                            <option value="<?php echo get_permalink($wp_query->post->ID);?>?per_page=36" <?php if(isset($_GET['per_page'])) selected( $_GET['per_page'], 36 );?>>
                            	<?php _e('36 per page','odin');?>
                            </option>
					    </select>
					</div><!-- .col-md-4 -->
					<?php if($subpages_query->max_num_pages > 1):?>
					<div class="col-md-4 pull-right">
						<div class="pull-right news-pagination-links">
							<?php brasa_news_pagination($subpages_query->max_num_pages);?>
						</div><!-- .pull-right -->
					</div><!-- .col-md-4 -->
				    <?php endif;?>
				</div><!-- .col-md-12 pagination-control -->
				<?php wp_reset_postdata(); // reset the query ?>


				<?php
					endwhile;
				?>
			</div>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
