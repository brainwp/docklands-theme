<?php
/**
 * The template for displaying News/Blog.
 * Template name: News
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>

	<div class="col-sm-12">
		
		<?php odin_breadcrumbs(); ?>

		<h3 class="bg-title-news">
			<a><?php _e( 'News', 'odin' ); ?></a>
		</h3>
	</div>

<?php get_sidebar( 'news' ); ?>

	<section id="primary" class="col-md-9">
		<div id="content" class="site-content" role="main">
			    <?php $args = array(
			    	'post_type' => 'post',
			    	'posts_per_page' => 12,
			    	'paged' => get_query_var('paged',1)
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
				<?php $posts_query = new WP_Query($args);?>
				<?php while($posts_query->have_posts()) : $posts_query->the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile;?>
				<?php global $wp_query;?>
				<div class="col-md-12 pagination-control">
					<div class="col-md-4">
					    <label><?php _e('Sort by','odin');?></label>
					    <select>
					    	<option value=""><?php _e('Category','odin');?></option>
					    	<?php $categories = get_categories('hide_empty=0');?>
					    	<?php foreach($categories as $cat):?>
					    	    <?php if(isset($_GET['by_cat'])):?>
					    	    <option value="<?php echo get_permalink($wp_query->post->ID);?>?by_cat=<?php echo $cat->slug;?>" <?php selected( $_GET['by_cat'], $cat->slug );?>>
					    	    	<?php echo $cat->name;?>
					    	    </option>
					    	    <?php else:?>
					    	    <option value="<?php echo get_permalink($wp_query->post->ID);?>?by_cat=<?php echo $cat->slug;?>">
					    	    	<?php echo $cat->name;?>
					    	    </option>
					    	    <?php endif;?>
					        <?php endforeach;?>
					    </select>
					</div><!-- .col-md-4 -->
				    <div class="col-md-4">
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
					<?php if($posts_query->max_num_pages > 1):?>
					<div class="col-md-4 pull-right">
						<div class="pull-right news-pagination-links">
							<?php brasa_news_pagination($posts_query->max_num_pages);?>
						</div><!-- .pull-right -->
					</div><!-- .col-md-4 -->
				    <?php endif;?>
				</div><!-- .col-md-12 pagination-control -->
				<?php wp_reset_postdata(); // reset the query ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_footer();
