<?php
/**
 * The template used for displaying page content.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'each col-md-12' ); ?>>

	<div class="thumb col-md-3">
		<?php the_post_thumbnail( 'half-horizontal-thumb' ); ?>
	</div><!-- thumb -->

	<div class="col-md-9">
		<div class="entry-content">
			<?php
				the_content();
			?>
		</div><!-- .entry-content -->
	</div>
	
</article><!-- #post-## -->
