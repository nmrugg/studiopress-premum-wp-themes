<?php
/** Start the Genesis engine */
require_once( get_template_directory() . '/lib/init.php' );

/** Load child theme libraries */
require_once( CHILD_DIR . '/lib/custom-header.php' );

/** Child theme info (do not remove) */
define( 'CHILD_THEME_NAME', 'Tapestry Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/themes/tapestry' );

/** Content width */
$content_width = 640;

/** Add support for custom background and header */
add_custom_background();
add_custom_image_header( 'tapestry_header_style', 'tapestry_admin_header_style' );

/** Add support for post formats */
add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
add_theme_support( 'genesis-post-format-images' );

/** Unregister other site layouts */
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

/** Unregister secondary sidebar */
unregister_sidebar( 'sidebar-alt' );

/** Main navigation */
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_content', 'genesis_do_nav', 1 );

/** Move breadcrumbs */
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_loop', 'genesis_do_breadcrumbs', 1 );

add_action( 'genesis_before_post', 'tapestry_remove_elements' );
/**
 * If post has post format, remove the title, post info, and post meta.
 * If post does not have post format, then it is a default post. Add
 * title, post info, and post meta back.
 *
 * @since 1.0
 */
function tapestry_remove_elements() {
	
	// Remove if post has format
	if ( get_post_format() ) {
		remove_action( 'genesis_post_title', 'genesis_do_post_title' );
		remove_action( 'genesis_before_post_content', 'genesis_post_info' );
		remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
	}
	// Add back, as post has no format
	else {
		add_action( 'genesis_post_title', 'genesis_do_post_title' );
		add_action( 'genesis_before_post_content', 'genesis_post_info' );
		add_action( 'genesis_after_post_content', 'genesis_post_meta' );
	}
	
}


add_action( 'genesis_before_sidebar_widget_area', 'tapestry_before_sidebar_widget_area' );
/**
 * Opens div.wrap before #sidebar
 */
function tapestry_before_sidebar_widget_area() {
	echo '<div class="wrap">';
}

add_action( 'genesis_after_sidebar_widget_area', 'tapestry_after_sidebar_widget_area' );
/**
 * Closes div.wrap after #sidebar
 */
function tapestry_after_sidebar_widget_area() {
	echo '</div>';
}

add_action( 'genesis_before_sidebar_widget_area', 'tapestry_sidebar_top_graphic' );
/**
 * Add sidebar graphic
 */
function tapestry_sidebar_top_graphic() {
?>
	<div class="sidebar-top-graphic"></div>
	<div class="sidebar-bottom-graphic"></div>
<?php
}


add_action( 'genesis_before_loop', 'tapestry_before_loop' );
/**
 * Opens div.wrap before loop
 */
function tapestry_before_loop() {
	echo '<div class="wrap">';
}

add_action( 'genesis_after_loop', 'tapestry_after_loop' );
/**
 * Adds float clearing div.
 * Closes div.wrap after loop.
 */
function tapestry_after_loop() {
	echo '
	<div class="clear"></div>
	</div>';
}


add_filter( 'genesis_comment_list_args', 'tapestry_comment_list_args' );
/**
 * Change avatar size
 */
function tapestry_comment_list_args( $args ) {
    $args = array(
		'type' => 'comment',
		'avatar_size' => 33,
		'callback' => 'genesis_comment_callback'
	);
		
	return $args;
}


add_filter( 'genesis_footer_creds_text', 'tapestry_footer_creds_text' );
/**
 * Customize the footer section
 */ 
function tapestry_footer_creds_text( $creds ) { 
	return __('Copyright', 'tapestry') . ' [footer_copyright] [footer_childtheme_link] ' . __('on', 'tapestry') . ' [footer_genesis_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]'; 
}