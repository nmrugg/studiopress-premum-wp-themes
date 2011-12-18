<?php
/** Start the engine */
require_once( TEMPLATEPATH . '/lib/init.php' );
require_once( CHILD_DIR . '/lib/style.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Lifestyle Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/themes/lifestyle' );

/** Add new image sizes */
add_image_size( 'featured', 590, 250, TRUE );
add_image_size( 'homepage', 120, 120, TRUE );
add_image_size( 'mini', 80, 80, TRUE );
add_image_size( 'portfolio', 202, 140, TRUE );

/** Add suport for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 920, 'height' => 150, 'textcolor' => 'ffffff', 'admin_header_callback' => 'lifestyle_admin_style' ) );

/**
 * Register a custom admin callback to display the custom header preview with the
 * same style as is shown on the front end.
 *
 */
function lifestyle_admin_style() {

	$headimg = sprintf( '.appearance_page_custom-header #headimg { background: url(%s) no-repeat; font-family: Georgia, Times, serif; min-height: %spx; text-align: center; text-shadow: #666 1px 1px; }', get_header_image(), HEADER_IMAGE_HEIGHT );
	$h1 = sprintf( '#headimg h1, #headimg h1 a { color: #%s; font-size: 48px; font-variant: small-caps; font-weight: normal; line-height: 48px; margin: 35px 0 0; text-decoration: none; }', esc_html( get_header_textcolor() ) );
	$desc = sprintf( '#headimg #desc { color: #%s; font-size: 20px; font-style: italic; line-height: 1; margin: 0; }', esc_html( get_header_textcolor() ) );

	printf( '<style type="text/css">%1$s %2$s %3$s</style>', $headimg, $h1, $desc );

}

/** Register default header options */
register_default_headers( array(
	'default' => array(
		'url'			=> CHILD_URL . '/images/header.png',
		'thumbnail_url'	=> CHILD_URL . '/images/thumbs/header-thumb.png'
	),
	'blue' => array(
		'url'			=> CHILD_URL . '/images/header-blue.png',
		'thumbnail_url'	=> CHILD_URL . '/images/thumbs/header-blue-thumb.png'
	),
	'charcoal' => array(
		'url' 			=> CHILD_URL . '/images/header-charcoal.png',
		'thumbnail_url'	=> CHILD_URL . '/images/thumbs/header-charcoal-thumb.png'
	),
	'gray' => array(
		'url'			=> CHILD_URL . '/images/header-gray.png',
		'thumbnail_url'	=> CHILD_URL . '/images/thumbs/header-gray-thumb.png'
	),
	'green' => array(
		'url'			=> CHILD_URL . '/images/header-green.png',
		'thumbnail_url'	=> CHILD_URL . '/images/thumbs/header-green-thumb.png'
	),
	'pink' => array(
		'url'			=> CHILD_URL . '/images/header-pink.png',
		'thumbnail_url'	=> CHILD_URL . '/images/thumbs/header-pink-thumb.png'
	),
	'purple' => array(
		'url'			=> CHILD_URL . '/images/header-purple.png',
		'thumbnail_url'	=> CHILD_URL . '/images/thumbs/header-purple-thumb.png'
	),
	'tan' => array(
		'url'			=> CHILD_URL . '/images/header-tan.png',
		'thumbnail_url'	=> CHILD_URL . '/images/thumbs/header-tan-thumb.png'
	),
	'teal' => array(
		'url'			=> CHILD_URL . '/images/header-teal.png',
		'thumbnail_url'	=> CHILD_URL . '/images/thumbs/header-teal-thumb.png'
	),
	'yellow' => array(
		'url'			=> CHILD_URL . '/images/header-yellow.png',
		'thumbnail_url'	=> CHILD_URL . '/images/thumbs/header-yellow-thumb.png'
	)
) );

/** Add support for post formats */
//add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
//add_theme_support( 'genesis-post-format-images' );

/** Remove elements for post formats */
add_action( 'genesis_before_post', 'lifestyle_remove_elements' );
function lifestyle_remove_elements() {
	
	if ( ! current_theme_supports( 'post-formats' ) )
		return;

	// Remove if post has format
	if ( get_post_format() ) {
		remove_action( 'genesis_post_title', 'genesis_do_post_title' );
		remove_action( 'genesis_before_post_content', 'genesis_post_info' );
		remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
	}

	// Add back, as post has no format
	else {
		add_action( 'genesis_post_title', 'genesis_do_post_title' );
		add_action( 'genesis_before_post_content', 'genesis_post_info' );
		add_action( 'genesis_after_post_content', 'genesis_post_meta' );
	}

}

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Reposition the primary navigation */
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_header', 'genesis_do_nav' );

/** Change breadcrumb location */
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs' );

/** Add two sidebars underneath the primary sidebar */
add_action( 'genesis_after_sidebar_widget_area', 'lifestyle_bottom_sidebars' );
function lifestyle_bottom_sidebars() {
	foreach ( array( 'sidebar-bottom-left', 'sidebar-bottom-right' ) as $area ) {
		echo '<div class="' . $area . '">';
		dynamic_sidebar( $area );
		echo '</div><!-- end #' . $area . '-->';
	}
}

/** Register widget areas **/
genesis_register_sidebar( array(
	'id'			=> 'sidebar-bottom-left',
	'name'			=> __( 'Sidebar Bottom Left', 'lifestyle' ),
	'description'	=> __( 'This is the bottom left sidebar.', 'lifestyle' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'sidebar-bottom-right',
	'name'			=> __( 'Sidebar Bottom Right', 'lifestyle' ),
	'description'	=> __( 'This is the bottom right sidebar.', 'lifestyle' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home',
	'name'			=> __( 'Home', 'lifestyle' ),
	'description'	=> __( 'This is the homepage section.', 'lifestyle' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-left',
	'name'			=> __( 'Home Left', 'lifestyle' ),
	'description'	=> __( 'This is the homepage left section.', 'lifestyle' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-right',
	'name'			=> __( 'Home Right', 'lifestyle' ),
	'description'	=> __( 'This is the homepage right section.', 'lifestyle' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'portfolio',
	'name'			=> __( 'Portfolio', 'lifestyle' ),
	'description'	=> __( 'This is the portfolio page template', 'lifestyle' ),
) );