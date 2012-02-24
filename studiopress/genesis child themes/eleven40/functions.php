<?php
/** Start the engine */
require_once( get_template_directory() . '/lib/init.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'eleven40 theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/themes/eleven40' );

/** Create additional color style options */
add_theme_support( 'genesis-style-selector', array( 'eleven40-blue' => 'Blue', 'eleven40-green' => 'Green', 'eleven40-red' => 'Red' ) );

/** Add support for structural wraps */
add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );

/** Add new image sizes */
add_image_size( 'grid-thumbnail', 270, 100, TRUE );

/** Add Viewport meta tag for mobile browsers */
add_action( 'genesis_meta', 'eleven40_viewport_meta_tag' );
function eleven40_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

/** Add the page title section */
add_action( 'genesis_before_content_sidebar_wrap', 'eleven40_page_title' );
function eleven40_page_title() {
   genesis_widget_area( 'page-title', array(
       'before' => '<div class="page-title widget-area">',
   ) );
}

/** Add the after post section */
add_action( 'genesis_after_post_content', 'eleven40_after_post' );
function eleven40_after_post() {
   if ( ! is_singular( 'post' ) )
       return;
   genesis_widget_area( 'after-post', array(
       'before' => '<div class="after-post widget-area">',
   ) );
}

/** Add 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Register widget areas */
genesis_register_sidebar( array(
	'id'			=> 'page-title',
	'name'			=> __( 'Page Title', 'eleven40' ),
	'description'	=> __( 'This is the page title section.', 'eleven40' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'after-post',
	'name'			=> __( 'After Post', 'eleven40' ),
	'description'	=> __( 'This is the after post section.', 'eleven40' ),
) );