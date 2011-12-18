<?php
/** Start the engine */
require_once( TEMPLATEPATH . '/lib/init.php' );
require_once( CHILD_DIR . '/lib/style.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Scribble Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/themes/scribble' );

/** Load CSS and JS **/
add_action( 'get_header', 'scribble_scripts' );
function scribble_scripts() {
	if ( is_admin() )
		return;

	/** Load JS to animate scroll **/
	wp_enqueue_script( 'scroll', CHILD_URL . '/js/scroll.js', array('jquery'), '', true );
	
}

$content_width = apply_filters( 'content_width', 580, 0, 910 );

/** Add new image sizes */
add_image_size( 'home-blog', 280, 120, TRUE );
add_image_size( 'home-photos', 120, 120, TRUE );

/** Unregister 3-column site layouts */
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

/** Add support for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 100 ) );

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Register widget areas */
genesis_register_sidebar( array(
	'id'			=> 'welcome',
	'name'			=> __( 'Welcome', 'scribble' ),
	'description'	=> __( 'This is the welcome section.', 'scribble' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'about',
	'name'			=> __( 'About', 'scribble' ),
	'description'	=> __( 'This is the about section.', 'scribble' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'blog',
	'name'			=> __( 'Blog', 'scribble' ),
	'description'	=> __( 'This is the blog section.', 'scribble' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'photos',
	'name'			=> __( 'Photos', 'scribble' ),
	'description'	=> __( 'This is the photos section.', 'scribble' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'services',
	'name'			=> __( 'Services', 'scribble' ),
	'description'	=> __( 'This is the services section.', 'scribble' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'contact',
	'name'			=> __( 'Contact', 'scribble' ),
	'description'	=> __( 'This is the contact section.', 'scribble' ),
) );