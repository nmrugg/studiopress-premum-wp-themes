<?php
/** Start the engine */
require_once( get_template_directory() . '/lib/init.php' );
require_once( get_stylesheet_directory() . '/lib/style.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Generate Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/themes/generate' );

$content_width = apply_filters( 'content_width', 570, 450, 880 );

/** Add image sizes */
add_image_size('featured', 610, 170, TRUE);
add_image_size('grid', 290, 130, TRUE);

/** Add Viewport meta tag for mobile browsers */
add_action( 'genesis_meta', 'generate_viewport_meta_tag' );
function generate_viewport_meta_tag() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

/** Unregister layout settings */
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

/** Unregister secondary sidebar */
unregister_sidebar( 'sidebar-alt' );

/** Add support for structural wraps */
add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );

/** Add support for custom background */
add_custom_background();

/** Reposition secondary navigation */
remove_action('genesis_after_header', 'genesis_do_subnav');
add_action('genesis_after_header', 'genesis_do_subnav', 15);

/** Reposition the post info function */
remove_action( 'genesis_before_post_content', 'genesis_post_info' );
add_action( 'genesis_before_post_title', 'genesis_post_info' );

/** Remove default post image */
remove_action( 'genesis_post_content', 'genesis_do_post_image' );

/** Add custom post image above post title */
add_action( 'genesis_before_post_content', 'generate_post_image', 5 );
function generate_post_image() {

	if ( is_page() || ! genesis_get_option( 'content_archive_thumbnail' ) )
		return;
	
	if ( $image = genesis_get_image( array( 'format' => 'url', 'size' => genesis_get_option( 'image_size' ) ) ) ) {
		printf( '<a href="%s" rel="bookmark"><img class="post-image" src="%s" alt="%s" /></a>', get_permalink(), $image, the_title_attribute( 'echo=0' ) );
	}

}

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Register widget areas */
genesis_register_sidebar( array(
	'id'			=> 'generate-box',
	'name'			=> __( 'Generate Box', 'generate' ),
	'description'	=> __( 'This is the generate box on the homepage.', 'generate' ),
) );