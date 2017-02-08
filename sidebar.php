<?php
/**
 * The sidebar containing the secondary widget area, displays on homepage, archives and posts.
 *
 * If no active widgets in this sidebar, it will shows Recent Posts, Archives and Tag Cloud widgets.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

<div id="secondary" class="col-md-3" role="complementary">
	<?php if ( is_singular( 'services' ) || is_singular( 'cases' ) ) : ?>
		<?php get_search_form( true );?>
	<?php endif;?>
	<?php
		if ( ! is_singular( 'services' ) && ! is_singular( 'cases' ) ) {
			if ( is_page_template( 'page-faq.php' ) ) {
				dynamic_sidebar( 'faq-sidebar' );
			}


		elseif ( is_page_template( 'page-terms-conditions.php' ) ) {
				dynamic_sidebar( 'terms-sidebar' );
			}


		else {
				if ( ! dynamic_sidebar( 'main-sidebar' ) ) {
					the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ) );
					the_widget( 'WP_Widget_Archives', array( 'count' => 0, 'dropdown' => 1 ) );
					the_widget( 'WP_Widget_Tag_Cloud' );
				}
			}

		} elseif ( is_singular( 'cases' ) ) {
			dynamic_sidebar( 'cases-sidebar' );
		} else {
			dynamic_sidebar( 'services-sidebar' );
		}
	?>
</div><!-- #secondary -->
