<?php
/** Start the engine */
require_once( TEMPLATEPATH . '/lib/init.php' );
require_once( CHILD_DIR . '/lib/style.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Magazine Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/themes/magazine' );

$content_width = apply_filters( 'content_width', 610, 460, 910 );

/** Add support for structural wraps */
add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );

/** Add new image sizes */
add_image_size('home-bottom', 280, 150, TRUE);
add_image_size('slider', 600, 250, TRUE);
add_image_size('square', 120, 120, TRUE);
add_image_size('tabs', 580, 250, TRUE);

/** Add support for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 115 ) );

/** Reposition the primary navigation */
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before', 'genesis_do_nav' );

/** Add after post ad section */
add_action( 'genesis_after_post_content', 'magazine_after_post_ad', 9 ); 
function magazine_after_post_ad() {
    if ( is_single() && is_active_sidebar( 'after-post-ad' ) ) {
    echo '<div class="after-post-ad">';
	dynamic_sidebar( 'after-post-ad' );
	echo '</div><!-- end .after-post-ad -->';
	}
}

/** Add after content ad section */
add_action( 'genesis_before_footer', 'magazine_after_content_ad' ); 
function magazine_after_content_ad() {
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
	'name'			=> __( 'Home Top', 'magazine' ),
	'description'	=> __( 'This is the home top section.', 'magazine' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-left',
	'name'			=> __( 'Home Left', 'magazine' ),
	'description'	=> __( 'This is the home left section.', 'magazine' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-right',
	'name'			=> __( 'Home Right', 'magazine' ),
	'description'	=> __( 'This is the home right section.', 'magazine' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-bottom',
	'name'			=> __( 'Home Bottom', 'magazine' ),
	'description'	=> __( 'This is the home bottom section.', 'magazine' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'after-post-ad',
	'name'			=> __( 'After Post Ad', 'magazine' ),
	'description'	=> __( 'This is the after post ad section.', 'magazine' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'after-content-ad',
	'name'			=> __( 'After Content Ad', 'magazine' ),
	'description'	=> __( 'This is the after content ad section.', 'magazine' ),
) );