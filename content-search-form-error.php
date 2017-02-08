<?php
/**
 * The template for displaying Search Form Error.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

<form method="get" id="searchform" class="form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<div class="form-group-error col-md-7">
		<label for="s" class="sr-only"><?php _e( 'Search', 'odin' ); ?></label>
		<input type="text" class="form-control" name="s" id="s" placeholder="<?php _e('Enter Search..','odin');?>" />
		<input type="submit" class="search-icon" />
	</div>
</form>
