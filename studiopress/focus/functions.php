<?php
/** Start the engine **/
require_once( TEMPLATEPATH . '/lib/init.php' );
require_once( CHILD_DIR . '/lib/style.php' );

/** Child theme (do not remove) **/
define( 'CHILD_THEME_NAME', 'Focus Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/themes/focus' );

/** Add support for custom background **/
add_custom_background();

/** Add support for custom header **/
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 100 ) );

/** Add support for 3-column footer widgets **/
add_theme_support( 'genesis-footer-widgets', 3 );

/** Add new image sizes **/
add_image_size( 'grid-thumbnail', 100, 100, TRUE );

/** Modify the size of the Gravatar in the author box **/
add_filter( 'genesis_author_box_gravatar_size', 'focus_gravatar_size' );
function focus_gravatar_size( $size ) {
	return 80;
}

/** Add after post section **/
add_action( 'genesis_before_comments', 'focus_after_post_box' );
function focus_after_post_box() {
	if ( is_single() )
	require( CHILD_DIR . '/after-post.php' );
}

/** Register widget areas **/
genesis_register_sidebar( array(
	'id'				=> 'after-post-left',
	'name'			=> __( 'After Post Left', 'focus' ),
	'description'	=> __( 'This is the left section after a post.', 'focus' ),
) );
genesis_register_sidebar( array(
	'id'				=> 'after-post-right',
	'name'			=> __( 'After Post Right', 'focus' ),
	'description'	=> __( 'This is the right section after a post.', 'focus' ),
) );