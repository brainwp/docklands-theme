<?php
/**
 * Display woocommerce bar
 */
global $woocommerce;
if(isset($woocommerce) && is_object($woocommerce)):
?>
<?php if($woocommerce->cart->cart_contents_count != 0): ?>
    <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="text-left">
    	<?php _e('My Enquiries','odin'); ?>
    </a>
<?php endif;?>
<div class="dropdown">
	<a href="#" class="text-left" id="account-dropdown" data-toggle="dropdown" aria-expanded="true">
		<?php _e('Your Account','odin'); ?>
		<span class="caret"></span>
	</a>
	<ul class="dropdown-menu" role="menu" aria-labelledby="account-dropdown">
		<?php if ( is_user_logged_in() ): ?>
		    <li role="presentation">
		    	<a role="menuitem" tabindex="-1" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
		    		<?php _e('My Account','odin'); ?>
		    	</a>
		    </li>
		    <li role="presentation">
		    	<a role="menuitem" tabindex="-1" href="<?php echo wp_logout_url(home_url());?>">
		    		<?php _e('Logout','odin'); ?>
		    	</a>
		    </li>
	    <?php else: ?>
	        <li role="presentation">
	        	<a role="menuitem" tabindex="-1" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
	        		<?php _e('Login / Register','odin'); ?>
	        	</a>
	        </li>
        <?php endif ?>
	</ul>
</div><!--.dropdown!-->
<div class="line"></div><!-- .line -->
<div class="cart-container">
	<img src="<?php bloginfo('template_url'); ?>/assets/images/header-cart.jpg">
	<?php echo sprintf('<span class="cart-items">(%s)</span>',$woocommerce->cart->cart_contents_count); ?>
	<span class="cart-items"><?php echo $woocommerce->cart->get_cart_total(); ?></span>
	<?php if($woocommerce->cart->cart_contents_count != 0): ?>
	    <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="btn cart pull-right">
	    	<?php _e('Check out','odin'); ?>
	    </a>
	<?php endif;?>
</div><!-- .cart-container -->
<form action="<?php echo home_url('/');?>" method="get" class="search-container">
	<input name="post_type" type="hidden" value="product">
	<input name="s" type="text" placeholder="<?php _e('Enter Search..','odin');?>">
	<button></button>
</form><!-- .search-container -->
<?php endif;?>
