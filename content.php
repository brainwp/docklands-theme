<?php
/**
 * The default template for displaying content.
 *
 * Used for both single and index/archive/author/catagory/search/tag.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title single">', '</h1>' );
			else :
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			endif;
		?>

		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-date">
				<?php echo get_the_date(); ?>
			</div><!-- .entry-date -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : ?>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

	<?php elseif ( is_page_template( 'page-news.php' ) ) : ?>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-summary col-sm-7">
				<?php echo brasa_continue_reading( get_the_excerpt(), get_permalink() ); ?>
			</div><!-- .entry-summary -->

			<div class="thumb col-sm-5 pull-right">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'medium' ); ?>
				</a>
			</div><!-- thumb -->
		<?php else : ?>
			<div class="entry-summary col-sm-12">
				<?php echo brasa_continue_reading( get_the_excerpt(), get_permalink() );?>
			</div><!-- .entry-summary -->
		<?php endif; ?>
		<?php if ( function_exists( 'sharing_display' ) ) : ?>
			<?php echo sharing_display(); ?>
		<?php endif;?>
	<?php else : ?>

		<div class="entry-content">
			<?php
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'odin' ) );
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'odin' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
				if ( ! is_page_template( 'page-faq.php') ) ;
			?>
			<?php if ( is_singular( 'cases' ) ) : ?>
				<?php $link = get_post_type_archive_link( 'testimonials' );?>
				<a href="<?php echo esc_url( $link );?>" class="btn btn-warning">
					<b><?php _e( 'See Testimonials', 'odin');?></b>
				</a>
				<div class="col-md-12 clear" style="height:1px;clear:both;"></div><!-- .col-md-12 clear -->
			<?php endif;?>
		</div><!-- .entry-content -->

	<?php endif; ?>

		<footer class="entry-meta">
			<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) ) : ?>
				<span class="cat-links"><?php echo __( 'Posted in:', 'odin' ) . ' ' . get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'odin' ) ); ?></span>
			<?php endif; ?>
			<?php the_tags( '<span class="tag-links">' . __( 'Tagged as:', 'odin' ) . ' ', ', ', '</span>' ); ?>
			<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'odin' ), __( '1 Comment', 'odin' ), __( '% Comments', 'odin' ) ); ?></span>
			<?php endif; ?>

				<p><?php _e( 'Posted by ', 'odin' );?><?php the_author_posts_link(); ?></p>
		</footer>

</article><!-- #post-## -->
