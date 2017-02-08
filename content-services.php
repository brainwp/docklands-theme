<?php
// Content Services
$class = 'col-md-4';
if ( is_post_type_archive( 'cases' ) || is_post_type_archive( 'services' ) ) :
	$class = 'col-md-6 cases';
endif;
?>
<a class="<?php echo $class;?> services each col-xs-12" href="<?php the_permalink(); ?>">

	<div class="thumb">
		<?php the_post_thumbnail('square-thumb'); ?>
	</div><!-- .thumb -->

	<div class="desc">

		<h3><?php the_title(); ?></h3>
		<div class="product-info">
			<?php if ( is_post_type_archive( 'cases' ) ) : ?>
				<?php _e('View Cases', 'odin'); ?>
			<?php elseif ( is_page() && is_page_template( 'page-pdf.php' ) ) : ?>
				<?php _e( 'See Now', 'odin' );?>
			<?php else : ?>
				<?php _e('View Service', 'odin'); ?>
			<?php endif;?>
			<span class="orange">&gt;</span>
		</div><!-- .product-info -->

	</div><!-- .desc -->

</a><!-- .col-md-4 services -->
