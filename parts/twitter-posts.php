<?php
/*
Display twitter posts
*/
$opts = get_option('social');
?>
<div id="twitter-container">
	<a href="<?php echo esc_url($opts['twitter_url']); ?>">
		<img src="<?php bloginfo('template_url'); ?>/assets/images/twitter-link.jpg">
	</a>
	<?php dynamic_sidebar( 'twitter-home' );?>
</div><!-- #twitter-container -->
