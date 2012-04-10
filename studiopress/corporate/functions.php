<?php
/** Start the engine */
require_once( TEMPLATEPATH . '/lib/init.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Corporate Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/themes/corporate' );

$content_width = apply_filters( 'content_width', 620, 450, 930 );

/** Add new image sizes */
add_image_size( 'featured', 500, 240, TRUE );
add_image_size( 'home-middle', 275, 100, TRUE );

/** Add suport for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 130, 'textcolor' => 'ffffff', 'admin_header_callback' => 'corporate_admin_style' ) );

/**
 * Register a custom admin callback to display the custom header preview with the
 * same style as is shown on the front end.
 *
 */
function corporate_admin_style() {

	$headimg = sprintf( '.appearance_page_custom-header #headimg { background: url(%s) no-repeat; font-family: Droid Sans, arial, serif; min-height: %spx; text-shadow: #000 1px 1px; }', get_header_image(), HEADER_IMAGE_HEIGHT );
	$h1 = sprintf( '#headimg h1, #headimg h1 a { color: #%s; font-size: 30px; font-weight: normal; line-height: 30px; margin: 40px 0 0 15px; text-decoration: none; }', esc_html( get_header_textcolor() ) );
	$desc = sprintf( '#headimg #desc { color: #%s; font-size: 16px; line-height: 1; margin: 10px 0 0 30px; }', esc_html( get_header_textcolor() ) );

	printf( '<style type="text/css">%1$s %2$s %3$s</style>', $headimg, $h1, $desc );

}

/** Change breadcrumb location */
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs' );

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Register widget areas */
genesis_register_sidebar( array(
	'id'			=> 'featured',
	'name'			=> __( 'Featured', 'corporate' ),
	'description'	=> __( 'This is the featured section.', 'corporate' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-1',
	'name'			=> __( 'Home Middle #1', 'corporate' ),
	'description'	=> __( 'This is the home middle #1 section.', 'corporate' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-2',
	'name'			=> __( 'Home Middle #2', 'corporate' ),
	'description'	=> __( 'This is the home middle #2 section.', 'corporate' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-3',
	'name'			=> __( 'Home Middle #3', 'corporate' ),
	'description'	=> __( 'This is the home middle #3 section.', 'corporate' ),
) );