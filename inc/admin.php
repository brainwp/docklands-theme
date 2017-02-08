<?php
/**
 * Odin admin functions.
 */

/**
 * Custom admin scripts.
 */
function odin_admin_scripts() {
	wp_enqueue_style( 'odin-inc-admin', get_template_directory_uri() . '/inc/assets/css/custom-admin.css' );
}

add_action( 'admin_enqueue_scripts', 'odin_admin_scripts' );
add_action( 'login_enqueue_scripts', 'odin_admin_scripts' );

/**
 * Remove logo from admin bar.
 */
function odin_admin_adminbar_remove_logo() {
	global $wp_admin_bar;

	$wp_admin_bar->remove_menu( 'wp-logo' );
}

add_action( 'wp_before_admin_bar_render', 'odin_admin_adminbar_remove_logo' );

/**
 * Custom Footer.
 */
function odin_admin_footer() {
	echo date( 'Y' ) . ' - ' . get_bloginfo( 'name' );
}

add_filter( 'admin_footer_text', 'odin_admin_footer' );

/**
 * Custom logo URL.
 */
function odin_admin_logo_url() {
	return home_url();
}

add_filter( 'login_headerurl', 'odin_admin_logo_url' );

/**
 * Custom logo title.
 */
function odin_admin_logo_title() {
	return get_bloginfo( 'name' );
}

add_filter( 'login_headertitle', 'odin_admin_logo_title' );

/**
 * Remove widgets dashboard.
 */
function odin_admin_remove_dashboard_widgets() {
	// remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	// remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );

	// Yoast's SEO Plugin Widget
	remove_meta_box( 'yoast_db_widget', 'dashboard', 'normal' );
}

add_action( 'wp_dashboard_setup', 'odin_admin_remove_dashboard_widgets' );

/**
 * Remove Welcome Panel.
 */
remove_action( 'welcome_panel', 'wp_welcome_panel' );
function docklands_add_theme_caps() {
    // gets the author role
    $role = get_role( 'shop_manager' );
    if(!$role || !is_object($role))
    	return;

    // This only works, because it accesses the class instance.
    // would allow the author to edit others' posts for current theme only
    $role->add_cap( 'edit_theme_options' );
 }
add_action( 'admin_init', 'docklands_add_theme_caps');

function docklands_get_user_role() {
    global $current_user;
    $user_roles = $current_user->roles;
    $user_role = array_shift($user_roles);
    return $user_role;
}
add_action( 'admin_menu', 'docklands_adjust_the_wp_menu', 999 );
function docklands_adjust_the_wp_menu() {
	if(docklands_get_user_role() == 'shop_manager'){
		remove_menu_page( 'tools.php' );
		remove_submenu_page( 'options-general.php', 'options-media.php' );
		remove_submenu_page( 'options-general.php', 'options-permalink.php' );
	}
}
