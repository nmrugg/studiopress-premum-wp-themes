<?php
/** Start the engine */
require_once( TEMPLATEPATH . '/lib/init.php' );
require_once( CHILD_DIR . '/lib/style.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Fabric Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/themes/fabric' );

$content_width = apply_filters( 'content_width', 620, 0, 920 );

/** Unregister 3-column site layouts */
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

/** Add new featured image sizes */
add_image_size('featured', 650, 280, TRUE);
add_image_size('sidebar', 70, 70, TRUE);

/** Add suport for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 100, 'textcolor' => '8f8d85', 'admin_header_callback' => 'fabric_admin_style' ) );

/**
 * Register a custom admin callback to display the custom header preview with the
 * same style as is shown on the front end.
 *
 */
function fabric_admin_style() {

	$headimg = sprintf( '.appearance_page_custom-header #headimg { background: url(%s) no-repeat; font-family: Georgia, Times, Times New Roman, serif; min-height: %spx; }', get_header_image(), HEADER_IMAGE_HEIGHT );
	$h1 = sprintf( '#headimg h1, #headimg h1 a { color: #%s; font-family: Pacifico, arial, serif; font-size: 48px; font-weight: normal; line-height: 60px; margin: 10px 0 0; text-align: center; text-decoration: none; text-shadow: #fff 1px 1px; }', esc_html( get_header_textcolor() ) );
	$desc = sprintf( '#headimg #desc { color: #%s; font-family: Georgia, Times, Times New Roman, serif; font-size: 14px; font-style: italic; text-align: center; text-shadow: #fff 1px 1px; }', esc_html( get_header_textcolor() ) );

	printf( '<style type="text/css">%1$s %2$s %3$s</style>', $headimg, $h1, $desc );

}

/** Reposition the primary navigation */
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_header', 'genesis_do_nav' );

/** Add top section to inner */
add_action('genesis_after_header', 'fabric_inner_top', 20 );
function fabric_inner_top() {
	echo '<div id="inner-top"></div>';
}

/** Reposition breadcrumb  */
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_breadcrumbs' );

/** Add custom field above post title */
add_action('genesis_before_post_title', 'fabric_post_image', 8 );
function fabric_post_image() {

	if ( is_page() ) return;

	if ( $image = genesis_get_image( 'format=url&size=featured' ) ) {
		printf( '<a href="%s" rel="bookmark"><img class="post-photo" src="%s" alt="%s" /></a>', get_permalink(), $image, the_title_attribute( 'echo=0' ) );
	}

}

/** Customize the post info function */
add_filter('genesis_post_info', 'fabric_post_info_filter');
function fabric_post_info_filter($post_info) {
	return '[post_date] by [post_author_posts_link] &middot; [post_comments] [post_edit]';
}

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Add top section to footer widgets */
add_action('genesis_before_footer', 'fabric_footer_widgets_top', 1 );
function fabric_footer_widgets_top() {
	
	if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) {
		echo '<div id="footer-widgets-top"></div>';
	}
	
}

/** Customizes go to top text */
add_filter('genesis_footer_backtotop_text', 'footer_backtotop_filter');
function footer_backtotop_filter($backtotop) {
	return '[footer_backtotop text="Top"]';
}