<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Child theme library
require_once(CHILD_DIR.'/lib/style.php');
require_once(CHILD_DIR.'/lib/widgets/delicious-slider-widget.php');

// Child theme (do not remove)
define('CHILD_THEME_NAME', 'Delicious Theme');
define('CHILD_THEME_URL', 'http://www.studiopress.com/themes/delicious');

// Add support for custom background
if ( function_exists('add_custom_background') ) {
	add_custom_background();
}

// Add new image sizes
add_image_size('Slider', 435, 235, TRUE);
add_image_size('Slider Thumbnail', 112, 60, TRUE);
add_image_size('Small Thumbnail', 60, 60, TRUE);

// Load Required JS Files
add_action('get_header', 'delicious_load_scripts');
function delicious_load_scripts() {
	if ( is_active_widget(0,0, 'slider-posts') ) {
		wp_enqueue_script('cycle', $src = CHILD_URL.'/lib/js/jquery.cycle.all.min.js', array('jquery'), CHILD_THEME_VERSION, TRUE);
		wp_enqueue_script('delicious-scripts', $src = CHILD_URL.'/lib/js/delicious-scripts.js', array('jquery'), CHILD_THEME_VERSION, TRUE);		
	}
}

// Reposition the Primary Navigation
remove_action('genesis_after_header', 'genesis_do_nav');
add_action('genesis_before_header', 'genesis_do_nav');

// Add a Div Wrap Around Subnav & Inner
add_action('genesis_after_header', 'start_subnav_inner_wrap', 5);
function start_subnav_inner_wrap() { 
	echo '<div id="subnav-inner-wrap">';
}

add_action('genesis_before_footer', 'end_subnav_inner_wrap');
function end_subnav_inner_wrap() {
	echo '</div>';
}

// Edit Post Info section
add_filter('genesis_post_info', 'post_info_filter');
function post_info_filter($post_info) {
	$post_info = '[post_date] by [post_author_posts_link] [post_comments] [post_edit]';
	return $post_info;
}

// Alter Read More links
add_filter('get_the_content_more_link', 'delicious_more_link', 10, 2);
function delicious_more_link($more_link, $more_link_text) {
	return sprintf('&hellip;<br /><span class="more-link-wrapper"><a href="%s" class="more-link">%s</a></span>', get_permalink(), $more_link_text);
}

// Customize the footer section
add_filter('genesis_footer_creds_text', 'delicious_footer_creds_text');
function delicious_footer_creds_text($creds) {
	$creds = __('Copyright', 'genesis') . ' [footer_copyright] [footer_childtheme_link] '. __('on', 'delicious') .' [footer_genesis_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]';
	return $creds;
}  

// Register widget areas
genesis_register_sidebar(array(
	'name'=>'Home Featured',
	'id' => 'home-featured',
	'description' => 'This is the featured area designed for the Delicious slider widget.',
	'before_widget' => '<ul id="%1$s" class="widget %2$s">', 'after_widget'  => '</ul>',
	'before_title'=>'<h2 class="slider-title">','after_title'=>'</h2>'
));
genesis_register_sidebar(array(
	'name'=>'Home Middle Left',
	'id' => 'home-middle-left',
	'description' => 'This is the middle left section of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Home Middle Right',
	'id' => 'home-middle-right',
	'description' => 'This is the middle right section of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Home Bottom #1',
	'id' => 'home-bottom-1',
	'description' => 'This is the first column of the middle section of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Home Bottom #2',
	'id' => 'home-bottom-2',
	'description' => 'This is the second column of the middle section of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Home Bottom #3',
	'id' => 'home-bottom-3',
	'description' => 'This is the third column of the middle section of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));