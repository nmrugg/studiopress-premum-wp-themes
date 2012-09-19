<?php
/** Start the engine */
require_once( get_template_directory() . '/lib/init.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Balance Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/themes/balance' );

/** Create additional color style options */
add_theme_support( 'genesis-style-selector', array( 'balance-blue' => 'Blue', 'balance-green' => 'Green', 'balance-turquoise' => 'Turquoise', 'balance-pink' => 'Pink' ) );

/** Add support for structural wraps */
add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );

/** Add new image sizes */
add_image_size( 'grid', 295, 100, TRUE );
add_image_size( 'portfolio', 300, 200, TRUE );

/** Add Viewport meta tag for mobile browsers */
add_action( 'genesis_meta', 'balance_viewport_meta_tag' );
function balance_viewport_meta_tag() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

/** Unregister layout settings */
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

/** Add support for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 135 ) );

/** Reposition post info */
remove_action( 'genesis_before_post_content', 'genesis_post_info' );
add_action( 'genesis_before_post_title', 'genesis_post_info' );

/** Customize the post info function */
add_filter( 'genesis_post_info', 'post_info_filter' );
function post_info_filter($post_info) {
	if (!is_page()) {
		$post_info = '[post_author_posts_link] [post_date]';
		return $post_info;
	}
}

/** Customize the post meta function */
add_filter( 'genesis_post_meta', 'post_meta_filter' );
function post_meta_filter($post_meta) {
	if (!is_page()) {
		$post_meta = '[post_categories] [post_edit] [post_tags] [post_comments]';
		return $post_meta;
	}
}

/** Customize 'Read More' text */
add_filter( 'get_the_content_more_link', 'balance_read_more_link' );
add_filter( 'the_content_more_link', 'balance_read_more_link' );
function balance_read_more_link() {
	return '<a class="more-link" href="' . get_permalink() . '" rel="nofollow">' . __( 'Continue Reading' ) . '</a>';
}

/** Customize search button text */
add_filter( 'genesis_search_button_text', 'custom_search_button_text' );
function custom_search_button_text($text) {
	return esc_attr('');
}

/** Reposition the breadcrumbs */
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs' );

/** Customize breadcrumbs display */
add_filter( 'genesis_breadcrumb_args', 'balance_breadcrumb_args' );
function balance_breadcrumb_args( $args ) {
	$args['home'] = 'Home';
	$args['sep'] = ' ';
	$args['list_sep'] = ', '; // Genesis 1.5 and later
	$args['prefix'] = '<div class="breadcrumb"><div class="wrap">';
	$args['suffix'] = '</div></div>';
	$args['labels']['prefix'] = '<span class="home">You are here:</span>';
	return $args;
}

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Register widget areas */
genesis_register_sidebar( array(
	'id'				=> 'home-featured-left',
	'name'			=> __( 'Home Featured Left', 'balance' ),
	'description'	=> __( 'This is the featured left area on the homepage.', 'balance' ),
) );

genesis_register_sidebar( array(
	'id'				=> 'home-featured-right',
	'name'			=> __( 'Home Featured Right', 'balance' ),
	'description'	=> __( 'This is the featured right area on the homepage.', 'balance' ),
) );

genesis_register_sidebar( array(
	'id'				=> 'portfolio',
	'name'			=> __( 'Portfolio', 'balance' ),
	'description'	=> __( 'This is the portfolio page.', 'balance' ),
) );