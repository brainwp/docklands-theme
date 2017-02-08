<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main div element.
 *
 * @package Odin
 * @since 2.2.0
 */
$options = get_option('footer_cfg');
?>

		</div><!-- #main -->

		<footer id="footer" role="contentinfo">

			<div class="top">

				<div class="col-sm-2">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'first-footer-menu',
								'depth'          => 1,
								'container'      => false,
								'menu_class'     => 'menu-footer',
								'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
								'walker'         => new Odin_Bootstrap_Nav_Walker()
							)
						);
					?>
				</div>
				<div class="col-sm-2">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'second-footer-menu',
								'depth'          => 1,
								'container'      => false,
								'menu_class'     => 'menu-footer',
								'fallback_cb'    => 'Odin_Bootstrap_Nav_Walker::fallback',
								'walker'         => new Odin_Bootstrap_Nav_Walker()
							)
						);
					?>
				</div>
				<div class="col-sm-4 contacts">

					<span class="title">Contacts:</span>

					<?php if ( $address = $options['footer_address'] ) : ?>
						<span class="address"><?php echo $address; ?></span>
					<?php endif; ?>

					<?php if ( $phone = $options['footer_phone'] ) : ?>
						<span class="phone"><?php echo $phone; ?></span>
					<?php endif; ?>

					<?php if ( $fax = $options['footer_fax'] ) : ?>
						<span class="fax"><?php echo $fax; ?></span>
					<?php endif; ?>

					<?php if ( $email = $options['footer_email'] ) : ?>
						<span class="email"><?php echo $email; ?></span>
					<?php endif; ?>

				</div>

				<div class="col-sm-4 social-media">
					<div class="top">
						<?php $options = get_option('social');?>
						<a class="col-sm-3 youtube" href="<?php if(!empty($options['yt_url'])) echo $options['yt_url'];?>" title="Youtube"></a>
						<a class="col-sm-3 googleplus" href="<?php if(!empty($options['gplus_url'])) echo $options['gplus_url'];?>"title="Google Plus"></a>
						<a class="col-sm-3 twitter" href="<?php if(!empty($options['twitter_url'])) echo $options['twitter_url'];?>" title="Twitter"></a>
						<a class="col-sm-3 facebook" href="<?php if(!empty($options['fb_url'])) echo $options['fb_url'];?>" title="Facebook"></a>
					</div><!-- top -->
					<div class="bottom col-sm-12">
						<span class="join">Join the Docklands Office Furniture Newsletter:</span>
						<span>Sign up now for our latest offers, news and discounts</span>
						<?php if ( is_active_sidebar( 'join-sidebar' ) ) : ?>
							<?php dynamic_sidebar( 'join-sidebar' ); ?>
						<?php endif; ?>
					</div><!-- bottom -->
				</div><!-- social-media -->

			</div><!-- top -->

			<div class="clear"></div>

			<div class="site-info">
				<span><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a> &copy; <?php echo date( 'Y' ); ?></span>
			</div><!-- .site-info -->
		</footer><!-- #footer -->
	</div><!-- .container -->

	<a href="#header" class="btn back-top movescroll"></a>

	<?php wp_footer(); ?>
</body>
</html>
