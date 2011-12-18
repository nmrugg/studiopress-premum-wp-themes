<?php
/** Start the engine **/
require_once( TEMPLATEPATH . '/lib/init.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Blissful Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/themes/blissful' );

/** Add support for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 120 ) );

/** Unregister 3-column site layouts */
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Add new image sizes */
add_image_size( 'mini-thumbnail', 75, 75, TRUE );
add_image_size( 'small-thumbnail', 110, 110, TRUE );

/** Reposition the Primary Navigation */
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_header', 'genesis_do_nav' );


add_filter( 'genesis_post_info', 'blissful_post_info_filter' );
/**
 * Customize the post info function
 */
function blissful_post_info_filter( $post_info ) {
	return g_ent( '[post_date] by [post_author_posts_link] &middot; [post_comments] [post_edit]' );
}

add_filter( 'genesis_post_meta', 'blissful_post_meta_filter' );
/**
 * Customize the post meta function
 */
function blissful_post_meta_filter($post_meta) {
	return g_ent( '[post_categories] &middot; [post_tags]' );
}

add_filter( 'genesis_author_box_gravatar_size', 'blissful_gravatar_size' );
/**
 * Modify the size of the Gravatar in the author box
 */
function blissful_gravatar_size( $size ) {
	return 78;
}

add_action( 'genesis_after_sidebar_widget_area', 'blissful_split_sidebars' );
/**
 * Add split sidebars underneath the primary sidebar
 */
function blissful_split_sidebars() {
	foreach ( array( 'sidebar-split-left', 'sidebar-split-right', 'sidebar-split-bottom' ) as $area ) {
		echo '<div class="' . $area . '">';
		dynamic_sidebar( $area );
		echo '</div><!-- end #' . $area . '-->';
	}
}

add_filter( 'genesis_footer_backtotop_text', 'blissful_footer_backtotop_filter' );
/**
 * Customizes go to top text
 */
function blissful_footer_backtotop_filter( $backtotop ) {
		return '[footer_backtotop text="Top of Page"]';
}

/** Register widget areas */
genesis_register_sidebar( array(
	'id'			=> 'home-top',
	'name'			=> __( 'Home Top', 'blissful' ),
	'description'	=> __( 'This is the top section of the homepage', 'blissful' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'sidebar-split-left',
	'name'			=> __( 'Sidebar Split Left', 'blissful' ),
	'description'	=> __( 'This is the left side of the split sidebar', 'blissful' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'sidebar-split-right',
	'name'			=> __( 'Sidebar Split Right', 'blissful' ),
	'description'	=> __( 'This is the right side of the split sidebar', 'blissful' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'sidebar-split-bottom',
	'name'			=> __( 'Sidebar Split Bottom', 'blissful' ),
	'description'	=> __( 'This is the bottom of the split sidebar', 'blissful' ),
) );