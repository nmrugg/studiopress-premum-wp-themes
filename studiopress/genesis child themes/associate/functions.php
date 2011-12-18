<?php
/** Start the engine */
require_once( TEMPLATEPATH . '/lib/init.php' );
require_once( CHILD_DIR . '/lib/style.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Associate Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/themes/associate' );

$content_width = apply_filters( 'content_width', 580, 0, 910 );

/** Unregister 3-column site layouts */
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

/** Add new featured image sizes */
add_image_size('home-bottom', 150, 130, TRUE);
add_image_size('home-middle', 287, 120, TRUE);

/** Add suport for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 120, 'textcolor' => 'ffffff', 'admin_header_callback' => 'associate_admin_style' ) );

/**
 * Register a custom admin callback to display the custom header preview with the
 * same style as is shown on the front end.
 *
 */
function associate_admin_style() {

	$headimg = sprintf( '.appearance_page_custom-header #headimg { background: url(%s) no-repeat; font-family: Shanti, arial, serif; min-height: %spx; }', get_header_image(), HEADER_IMAGE_HEIGHT );
	$h1 = sprintf( '#headimg h1, #headimg h1 a { color: #%s; font-family: Shanti, arial, serif; font-size: 48px; font-weight: normal; line-height: 48px; margin: 10px 0 0; text-align: center; text-decoration: none; text-shadow: #fff 1px 1px; }', esc_html( get_header_textcolor() ) );
	$desc = sprintf( '#headimg #desc { color: #%s; font-family: Arial, Helvetica, Tahoma, sans-serif; font-size: 14px; font-style: italic; }', esc_html( get_header_textcolor() ) );

	printf( '<style type="text/css">%1$s %2$s %3$s</style>', $headimg, $h1, $desc );

}

/** Add support for structural wraps */
add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Register widget areas */
genesis_register_sidebar( array(
	'id'			=> 'featured',
	'name'			=> __( 'Featured', 'associate' ),
	'description'	=> __( 'This is the featured section.', 'associate' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-1',
	'name'			=> __( 'Home Middle #1', 'associate' ),
	'description'	=> __( 'This is the first column of the home middle section.', 'associate' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-2',
	'name'			=> __( 'Home Middle #2', 'associate' ),
	'description'	=> __( 'This is the second column of the home middle section.', 'associate' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-3',
	'name'			=> __( 'Home Middle #3', 'associate' ),
	'description'	=> __( 'This is the third column of the home middle section.', 'associate' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-bottom-1',
	'name'			=> __( 'Home Bottom #1', 'associate' ),
	'description'	=> __( 'This is the first column of the home bottom section.', 'associate' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-bottom-2',
	'name'			=> __( 'Home Bottom #2', 'associate' ),
	'description'	=> __( 'This is the second column of the home bottom section.', 'associate' ),
) );