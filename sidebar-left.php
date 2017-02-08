<?php
/**
 * The sidebar containing the secondary widget area, displays on homepage, archives and posts.
 *
 * If no active widgets in this sidebar, it will shows Recent Posts, Archives and Tag Cloud widgets.
 *
 * @package Odin
 * @since 2.2.0
 */
global $is_advanced_search;
?>

<div id="secondary" class="col-sm-3 left" role="complementary">
<?php global $template; //echo $template; ?>
	<?php

		$is_last_child = 0;

		if ( !is_post_type_archive( 'product' ) && is_tax() && !is_singular() && !is_page( 'cart' ) ) {

			$queried = get_queried_object();

			if ( $queried ) {

				//var_dump($queried);

				$term_current = get_term_by( 'id', $queried->term_taxonomy_id, $queried->taxonomy );

				if ( $term_current ) {

					$children = get_term_children( $term_current->term_id, $queried->taxonomy );

					if( sizeof( $children ) <= 0 ) {
						$is_last_child = 1;
					}
				}

			}

		}

		//echo $is_last_child;
		if ( is_singular( 'product' ) && !is_page( 'cart' ) ) {
			dynamic_sidebar( 'left-sidebar-filters' );
		} elseif ( is_home() || is_front_page() ) {
			dynamic_sidebar( 'left-sidebar-home' );
		} elseif ( is_page() && is_page_template( 'page-about.php' ) ) {
			dynamic_sidebar( 'left-sidebar-about' );
		} elseif ( is_page() && is_page_template( 'page-contact.php' ) ) {
			dynamic_sidebar( 'left-sidebar-contact' );
		} elseif ( is_page() && is_page_template( 'page-pdf.php' ) ) {
			dynamic_sidebar( 'left-sidebar-guides' );
		} elseif ( is_post_type_archive( 'cases' ) ) {
			dynamic_sidebar( 'sidebar-archive-cases' );
		} elseif ( is_post_type_archive( 'services' ) ) {
			dynamic_sidebar( 'sidebar-archive-services' );
		} elseif ( $is_last_child == 1 || is_woocommerce() ) {
			dynamic_sidebar( 'left-sidebar-filters' );
		} elseif ( is_page_template( 'page-advanced-search.php' ) || is_search() || $is_advanced_search == true || is_tax( 'product_cat' ) && $is_last_child != 0 ) {
			dynamic_sidebar( 'left-sidebar-filters' );
		} else {
			dynamic_sidebar( 'left-sidebar' );
		}
		//echo get_page_template_slug();
		//get_template_part( 'parts/form-advanced-search' );
	?>


</div><!-- #secondary -->
