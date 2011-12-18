<?php
/** Start the engine */
require_once( TEMPLATEPATH . '/lib/init.php' );
require_once( CHILD_DIR . '/lib/style.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Nitrous Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/themes/nitrous' );

$content_width = apply_filters( 'content_width', 610, 440, 910 );

/** Add new image sizes */
add_image_size( 'featured', 600, 300, TRUE );
add_image_size( 'portfolio', 152, 100, TRUE );
add_image_size( 'sidebar', 250, 100, TRUE );

/** Add suport for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 120, 'textcolor' => '444', 'admin_header_callback' => 'nitrous_admin_style' ) );

/**
 * Register a custom admin callback to display the custom header preview with the
 * same style as is shown on the front end.
 *
 */
function nitrous_admin_style() {

	$headimg = sprintf( '.appearance_page_custom-header #headimg { background: url(%s) no-repeat; font-family: Oswald, arial, serif; min-height: %spx; }', get_header_image(), HEADER_IMAGE_HEIGHT );
	$h1 = sprintf( '#headimg h1, #headimg h1 a { color: #%s; font-size: 48px; font-weight: normal; line-height: 48px; margin: 25px 0 0; text-decoration: none; }', esc_html( get_header_textcolor() ) );
	$desc = sprintf( '#headimg #desc { color: #%s; display: none; }', esc_html( get_header_textcolor() ) );

	printf( '<style type="text/css">%1$s %2$s %3$s</style>', $headimg, $h1, $desc );

}

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Register widget areas */
genesis_register_sidebar( array(
	'id'			=> 'featured',
	'name'			=> __( 'Featured', 'nitrous' ),
	'description'	=> __( 'This is the featured section.', 'nitrous' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'welcome',
	'name'			=> __( 'Welcome', 'nitrous' ),
	'description'	=> __( 'This is the welcome section.', 'nitrous' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'portfolio',
	'name'			=> __( 'Portfolio', 'nitrous' ),
	'description'	=> __( 'This is the portfolio section.', 'nitrous' ),
) );