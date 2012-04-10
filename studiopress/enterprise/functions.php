<?php
/** Start the engine */
require_once( TEMPLATEPATH . '/lib/init.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Enterprise Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/themes/enterprise' );

$content_width = apply_filters( 'content_width', 600, 420, 900 );

/** Add new featured image sizes */
add_image_size('mini', 65, 65, TRUE);
add_image_size('homepage', 270, 80, TRUE);
add_image_size('slideshow', 600, 235, TRUE);

/** Add support for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 120, 'textcolor' => '333', 'admin_header_callback' => 'enterprise_admin_style' ) );

/**
 * Register a custom admin callback to display the custom header preview with the
 * same style as is shown on the front end.
 *
 */
function enterprise_admin_style() {

	$headimg = sprintf( '.appearance_page_custom-header #headimg { background: url(%s) no-repeat; font-family: Droid Sans, arial, serif; min-height: %spx; }', get_header_image(), HEADER_IMAGE_HEIGHT );
	$h1 = sprintf( '#headimg h1, #headimg h1 a { color: #%s; font-size: 36px; font-weight: normal; line-height: 42px; margin: 25px 0 0; text-decoration: none; }', esc_html( get_header_textcolor() ) );
	$desc = sprintf( '#headimg #desc { color: #%s; }', esc_html( get_header_textcolor() ) );

	printf( '<style type="text/css">%1$s %2$s %3$s</style>', $headimg, $h1, $desc );

}

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Register widget areas */
genesis_register_sidebar( array(
	'id'			=> 'home-top-1',
	'name'			=> __( 'Home Top #1', 'enterprise' ),
	'description'	=> __( 'This is home top #1 section.', 'enterprise' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-top-2',
	'name'			=> __( 'Home Top #2', 'enterprise' ),
	'description'	=> __( 'This is home top #2 section.', 'enterprise' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-1',
	'name'			=> __( 'Home Middle #1', 'enterprise' ),
	'description'	=> __( 'This is home middle #1 section.', 'enterprise' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-2',
	'name'			=> __( 'Home Middle #2', 'enterprise' ),
	'description'	=> __( 'This is home middle #2 section.', 'enterprise' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-3',
	'name'			=> __( 'Home Middle #3', 'enterprise' ),
	'description'	=> __( 'This is home middle #3 section.', 'enterprise' ),
) );