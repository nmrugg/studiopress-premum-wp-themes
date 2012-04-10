<?php
/** Start the engine **/
require_once( TEMPLATEPATH.'/lib/init.php' );
require_once( CHILD_DIR.'/widgets/tabs.php' );

/** Child theme (do not remove) **/
define( 'CHILD_THEME_NAME', 'Midnight Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/themes/midnight' );

/** Add support for custom background **/
add_custom_background();

/** Add support for custom header **/
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 140 ) );

/** Add support for the footer widget areas **/
add_theme_support( 'genesis-footer-widgets', 3 );

/** Image sizes **/
add_image_size('home-icon', 80, 70, TRUE);
add_image_size('home-featured', 380, 280, TRUE);
add_image_size('home-thumbnail', 110, 75, TRUE);

/** Add content wrap **/
add_action('genesis_before_loop', 'child_before_loop');
add_action('genesis_after_loop', 'child_after_loop');

function child_before_loop() {
	echo '<div class="wrap">';
}

function child_after_loop() {
	echo '</div>';
}

/** Change breadcrumb location **/
remove_action('genesis_before_loop', 'genesis_do_breadcrumbs');
add_action('genesis_after_header', 'genesis_do_breadcrumbs');

/** Customize the post info function **/
add_filter('genesis_post_info', 'post_info_filter');
function post_info_filter($post_info) {
	if (!is_page()) {
		$post_info = 'Posted on [post_date] at [post_time] by [post_author_posts_link] with [post_comments] [post_edit]';
		return $post_info;
	}
}

/** Customize the post meta function **/
add_filter('genesis_post_meta', 'post_meta_filter');
function post_meta_filter($post_meta) {
	if (!is_page()) {
		$post_meta = '[post_categories sep=", " before=""] [post_tags sep="" before=""]';
		return $post_meta;
	}
}

/** Modify comment author says text **/
add_filter('comment_author_says_text', 'custom_comment_author_says_text');
function custom_comment_author_says_text() {
    return '';
}

/** Register sidebars **/
genesis_register_sidebar( array(
	'id'				=> 'home-welcome',
	'name'			=> __( 'Home Welcome', 'midnight' ),
	'description'	=> __( 'This is the welcome section of the homepage', 'midnight' ),
) );
genesis_register_sidebar( array(
	'id'				=> 'home-featured',
	'name'			=> __( 'Home Featured', 'midnight' ),
	'description'	=> __( 'This is the featured section of the homepage', 'midnight' ),
) );
genesis_register_sidebar( array(
	'id'				=> 'home-left',
	'name'			=> __( 'Home Left', 'midnight' ),
	'description'	=> __( 'This is the left section of the homepage', 'midnight' ),
) );
genesis_register_sidebar( array(
	'id'				=> 'home-middle',
	'name'			=> __( 'Home Middle', 'midnight' ),
	'description'	=> __( 'This is the middle section of the homepage', 'midnight' ),
) );
genesis_register_sidebar( array(
	'id'				=> 'home-right',
	'name'			=> __( 'Home Right', 'midnight' ),
	'description'	=> __( 'This is the right section of the homepage', 'midnight' ),
) );