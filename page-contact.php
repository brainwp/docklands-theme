<?php
/**
 * Template Name: Contact us
 *
 * The template for displaying pages with sidebar.
 * Template name: News
 * @package Odin
 * @since 2.2.0
 */

get_header();
?>

	<div id="primary" class="">
		<div id="content" class="site-content page-contact" role="main">

			<?php get_sidebar( 'left' ); ?>

			<div class="col-sm-9 right">

			<?php odin_breadcrumbs(); ?>

			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();
				?>
				<h1 class="top-name">
					<?php the_title(); ?>
				</h1><!-- .top-name -->
				<div class="col-md-5 pull-left contact-infos">
					<h4><?php _e('Contact Us/E-mail','odin'); ?></h4>
					<div class="col-sm-4 pull-left">
						<?php _e('E-mail:','odin'); ?>
					</div><!-- .col-sm-4 pull-left -->
					<div class="col-sm-8 pull-right">
						<?php echo get_post_meta( get_the_ID(), 'contact-email', true ); ?>
					</div><!-- .col-sm-8 pull-left -->
					<h4><?php _e('Contact Us/Phone','odin'); ?></h4>
					<div class="col-sm-4 pull-left">
						<?php _e('Office:','odin'); ?>
					</div><!-- .col-sm-4 pull-left -->
					<div class="col-sm-8 pull-right">
						<?php echo get_post_meta( get_the_ID(), 'contact-tel-office', true ); ?>
					</div><!-- .col-sm-8 pull-left -->
					<div class="col-sm-4 pull-left">
						<?php _e('24hr Hot Line:','odin'); ?>
					</div><!-- .col-sm-4 pull-left -->
					<div class="col-sm-8 pull-right">
						<?php echo get_post_meta( get_the_ID(), 'contact-tel-hot-line', true ); ?>
					</div><!-- .col-sm-8 pull-left -->
					<h4><?php _e('Contact Us/Office Hours','odin'); ?></h4>
					<div class="col-sm-4 pull-left">
						<?php _e('Monday:','odin'); ?>
					</div><!-- .col-sm-4 pull-left -->
					<div class="col-sm-8 pull-right">
						<?php echo get_post_meta( get_the_ID(), 'contact-hr-monday', true ); ?>
					</div><!-- .col-sm-8 pull-left -->
					<div class="col-sm-4 pull-left">
						<?php _e('Tuesday:','odin'); ?>
					</div><!-- .col-sm-4 pull-left -->
					<div class="col-sm-8 pull-right">
						<?php echo get_post_meta( get_the_ID(), 'contact-hr-tuesday', true ); ?>
					</div><!-- .col-sm-8 pull-left -->
					<div class="col-sm-4 pull-left">
						<?php _e('Wednesday:','odin'); ?>
					</div><!-- .col-sm-4 pull-left -->
					<div class="col-sm-8 pull-right">
						<?php echo get_post_meta( get_the_ID(), 'contact-hr-wednesday', true ); ?>
					</div><!-- .col-sm-8 pull-left -->
					<div class="col-sm-4 pull-left">
						<?php _e('Thursday:','odin'); ?>
					</div><!-- .col-sm-4 pull-left -->
					<div class="col-sm-8 pull-right">
						<?php echo get_post_meta( get_the_ID(), 'contact-hr-thursday', true ); ?>
					</div><!-- .col-sm-8 pull-left -->
					<div class="col-sm-4 pull-left">
						<?php _e('Friday:','odin'); ?>
					</div><!-- .col-sm-4 pull-left -->
					<div class="col-sm-8 pull-right">
						<?php echo get_post_meta( get_the_ID(), 'contact-hr-friday', true ); ?>
					</div><!-- .col-sm-8 pull-left -->
					<div class="col-sm-4 pull-left">
						<?php _e('Saturday:','odin'); ?>
					</div><!-- .col-sm-4 pull-left -->
					<div class="col-sm-8 pull-right">
						<?php echo get_post_meta( get_the_ID(), 'contact-hr-saturday', true ); ?>
					</div><!-- .col-sm-8 pull-left -->
					<div class="col-sm-4 pull-left">
						<?php _e('Sunday:','odin'); ?>
					</div><!-- .col-sm-4 pull-left -->
					<div class="col-sm-8 pull-right">
						<?php echo get_post_meta( get_the_ID(), 'contact-hr-sunday', true ); ?>
					</div><!-- .col-sm-8 pull-left -->
				</div><!-- .col-md-5 pull-left contact-infos -->

				<div class="col-md-7 pull-left contact-form">
					<?php the_content(); ?>
				</div><!-- .col-md-7 pull-left contact-form -->

				<div class="col-md-12 contact-map">
			    	<?php
			    	$location = get_field('contact-map');
			    	if( !empty($location) ):
			    	?>
			        <div class="map">
			            <?php echo $location; ?>
			        </div>
			        <?php $link = get_field('contact-map-link');?>
		            <?php if(!empty($link)): ?>
		                <a href="<?php echo esc_url($link);?>">
		                	<?php _e('See in Google Maps','odin');?>
		                </a>
		            <?php endif;?>

		            <?php endif; ?>

			    </div><!-- .col-md-12 contact-map -->
				<?php
				endwhile;
			?>
		  </div><!-- .right !-->
		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
