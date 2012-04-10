<?php
/** Start the engine */
require_once( TEMPLATEPATH . '/lib/init.php' );
require_once( CHILD_DIR . '/lib/style.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'News Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/themes/news' );

$content_width = apply_filters( 'content_width', 610, 460, 910 );

/** Add support for structural wraps */
add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );

/** Add new image sizes */
add_image_size( 'home-bottom', 110, 110, TRUE );
add_image_size( 'home-middle-left', 280, 165, TRUE );
add_image_size( 'home-middle-right', 50, 50, TRUE );
add_image_size( 'home-tabs', 150, 220, TRUE );

/** Add support for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 110 ) );

/** Reposition the secondary navigation */
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before', 'genesis_do_subnav' );

/** Add after post ad section */
add_action( 'genesis_after_post_content', 'news_after_post_ad', 9 ); 
function news_after_post_ad() {
    if ( is_single() && is_active_sidebar( 'after-post-ad' ) ) {
    echo '<div class="after-post-ad">';
	dynamic_sidebar( 'after-post-ad' );
	echo '</div><!-- end .after-post-ad -->';
	}
}

/** Add after content ad section */
add_action( 'genesis_before_footer', 'news_after_content_ad' ); 
function news_after_content_ad() {
    if ( is_active_sidebar( 'after-content-ad' ) ) {
    echo '<div class="after-content-ad">';
	dynamic_sidebar( 'after-content-ad' );
	echo '</div><!-- end .after-content-ad -->';
	}
}

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Register widget areas */
genesis_register_sidebar( array(
	'id'			=> 'home-top',
	'name'			=> __( 'Home Top', 'news' ),
	'description'	=> __( 'This is the home top section.', 'news' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-left',
	'name'			=> __( 'Home Middle Left', 'news' ),
	'description'	=> __( 'This is the home middle left section.', 'news' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-right',
	'name'			=> __( 'Home Middle Right', 'news' ),
	'description'	=> __( 'This is the home middle right section.', 'news' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-bottom',
	'name'			=> __( 'Home Bottom', 'news' ),
	'description'	=> __( 'This is the home bottom section.', 'news' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'after-post-ad',
	'name'			=> __( 'After Post Ad', 'news' ),
	'description'	=> __( 'This is the after post ad section.', 'news' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'after-content-ad',
	'name'			=> __( 'After Content Ad', 'news' ),
	'description'	=> __( 'This is the after content ad section.', 'news' ),
) );