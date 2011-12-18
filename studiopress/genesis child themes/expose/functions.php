<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Child theme library
require_once(CHILD_DIR.'/lib/custom-header.php');

// Child theme (do not remove)
define('CHILD_THEME_NAME', 'Expose Theme');
define('CHILD_THEME_URL', 'http://www.studiopress.com/themes/expose');

// Add support for custom background
if ( function_exists('add_custom_background') ) {
	add_custom_background();
}

// Add new image sizes
add_image_size('Featured', 280, 150, TRUE);

// Force layout on homepage
add_filter('genesis_pre_get_option_site_layout', 'expose_home_layout');
function expose_home_layout($opt) {
	if ( is_home() )
    $opt = 'full-width-content';
	return $opt;
}  

// Reposition the Primary Navigation
remove_action('genesis_after_header', 'genesis_do_nav');
add_action('genesis_before_header', 'genesis_do_nav');

// Remove post info and post meta sections on home page
add_action('get_header', 'remove_post_info');
function remove_post_info() {
    if ( is_front_page() )
	remove_action('genesis_before_post_content', 'genesis_post_info');
}
add_action('get_header', 'remove_post_meta');
function remove_post_meta() {
    if ( is_front_page() )
	remove_action('genesis_after_post_content', 'genesis_post_meta');  
}

// Add widgeted footer section
add_action('genesis_before_footer', 'agentpress_include_footer_widgets'); 
function agentpress_include_footer_widgets() {
    require_once(CHILD_DIR . '/footer-widgeted.php');
}

// Customize the footer section
add_filter('genesis_footer_creds_text', 'expose_footer_creds_text');
function expose_footer_creds_text($creds) {
	$creds = __('Copyright', 'genesis') . ' [footer_copyright] [footer_childtheme_link] '. __('on', 'expose') .' [footer_genesis_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]';
	return $creds;
}

// Custom text to display when no comments exist on a post
add_filter('genesis_no_comments_text', 'expose_no_comments_text');
function expose_no_comments_text() {
	return '<h3>Comments</h3><div class="no-comments">There are currently no comments on this post, be the first by filling out the form below.</div>';
}

// Register widget areas
genesis_register_sidebar(array(
	'name'=>'Footer #1',
	'id' => 'footer-1',
	'description' => 'This is the first column of the footer section.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Footer #2',
	'id' => 'footer-2',
	'description' => 'This is the second column of the footer section.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Footer #3',
	'id' => 'footer-3',
	'description' => 'This is the third column of the footer section.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));