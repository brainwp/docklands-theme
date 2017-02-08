<?php
/**
 * The template for displaying pages with sidebar.
 * Template name: Product Condition
 *
 * @package Odin
 * @since 2.2.0
 */

get_header();
?>

	<div id="primary" class="">
		<div id="content" class="site-content" role="main">

			<h3 class="bg-title"><?php echo get_the_title(); ?></h3>

			<?php get_sidebar( 'left' ); ?>

			<div class="col-sm-9 right">

				<?php odin_breadcrumbs(); ?>

				<?php

					/* Slug da pagina para comparar com o term de 'product_condition' */
					$slug = basename( get_permalink() );

					/* Lista todos os termos de 'product_cat' */
					$all_terms = get_terms( 'product_cat', array( 'hide_empty' => 0  ) );

					/* Guarda no array $array_terms o resultado de $all_terms */
					$array_terms = array();
					foreach ( $all_terms as $key => $value ) {
						$array_terms[ $key ] = $value->slug;
					}

					/* Args para fazer um query com os termos listados acima */
					$myquery['tax_query'] = array(
					    'relation' => 'AND',
					    array(
					        'taxonomy' => 'product_condition',
					        'terms' => array( $slug ),
					        'field' => 'slug',
					    ),
					    array(
					        'taxonomy' => 'product_cat',
					        'terms' => $array_terms,
					        'field' => 'slug',
					    )
					);

					/* O Query */
					$the_query = new WP_Query( $myquery );

					if ( $the_query->have_posts() ) {
						$final = array();
						while ( $the_query->have_posts() ) {
							
							$the_query->the_post();
							$terms = get_the_terms( $the_query->ID, 'product_cat' );
                         
							if ( $terms && ! is_wp_error( $terms ) ) : 
								foreach ( $terms as $key => $value ) {
									array_push( $final, $value->slug );
								}

							endif;

						}
					} else {
						// no posts found
					}
					$f = array_unique($final);	

					/* Restore original Post Data */
					wp_reset_postdata();

					$current_terms = get_terms( 'product_cat', array( 'hide_empty' => 0 , 'slug' => $f ) );

					foreach ( $current_terms as $category ) { ?>
					<li class="product-category product">

						<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

							<?php
								/**
								 * woocommerce_before_subcategory_title hook
								 *
								 * @hooked woocommerce_subcategory_thumbnail - 10
								 */
								do_action( 'woocommerce_before_subcategory_title', $category );
							?>

							<h3>
								<?php
									echo $category->name;

									if ( $category->count > 0 )
										echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
								?>
							</h3>

							<?php
								/**
								 * woocommerce_after_subcategory_title hook
								 */
								do_action( 'woocommerce_after_subcategory_title', $category );
							?>

						</a>

						<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

					</li>
					<?php }

				?>


			</div><!-- right -->
			
		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
