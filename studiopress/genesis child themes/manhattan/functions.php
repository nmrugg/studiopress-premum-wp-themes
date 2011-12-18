<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Child theme (do not remove)
define('CHILD_THEME_NAME', 'Manhattan Theme');
define('CHILD_THEME_URL', 'http://www.studiopress.com/themes/manhattan');

// Add new image sizes
add_image_size('Homepage', 210, 90, TRUE);

// Add footer note section
add_action('genesis_before_footer', 'manhattan_include_footer_note'); 
function manhattan_include_footer_note() {
	if ( !is_front_page() && is_active_sidebar('footer-note') ) {
		echo '<div id="footer-note"><div class="wrap">';
		dynamic_sidebar('footer-note');
		echo '</div></div>';
	}
}

// Add widgeted footer section
add_action('genesis_before_footer', 'manhattan_include_footer_widgets'); 
function manhattan_include_footer_widgets() {
	if (!is_home() && !is_front_page()) 
		require(CHILD_DIR.'/footer-widgets.php');
}

// Relocate breadcrumbs
remove_action('genesis_before_loop', 'genesis_do_breadcrumbs'); 
add_action('genesis_after_header', 'genesis_do_breadcrumbs');

// Modify the size of the Gravatar in the author box
add_filter('genesis_author_box_gravatar_size', 'author_box_gravatar_size');
function author_box_gravatar_size($size) {
    return 75;
}

// Customizes go to top text
add_filter('genesis_footer_backtotop_text', 'footer_backtotop_filter');
function footer_backtotop_filter($backtotop) {
    return '[footer_backtotop text="Top of Page"]';
}

// Customize the footer section
add_filter('genesis_footer_creds_text', 'manhattan_footer_creds_text');
function manhattan_footer_creds_text($creds) {
    return __('Copyright', 'genesis') . ' [footer_copyright] [footer_childtheme_link] ' . __('on', 'manhattan') . ' [footer_genesis_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]';
}  

// Register widget areas
genesis_register_sidebar(array(
	'name'=>'Home Top',
	'id' => 'home-top',
	'description' => 'This is the top section of the homepage.',
));
genesis_register_sidebar(array(
	'name'=>'Home Note',
	'id' => 'home-note',
	'description' => 'This is the home note section of the homepage.',
));
genesis_register_sidebar(array(
	'name'=>'Home Featured',
	'id' => 'home-featured',
	'description' => 'This is the featured images section on the homepage.',
));
genesis_register_sidebar(array(
	'name'=>'Home Bottom Left',
	'id' => 'home-bottom-left',
	'description' => 'This is the bottom left section of the homepage.',
));
genesis_register_sidebar(array(
	'name'=>'Home Bottom Right',
	'id' => 'home-bottom-right',
	'description' => 'This is the bottom right section of the homepage.',
));
genesis_register_sidebar(array(
	'name'=>'Footer Note',
	'id' => 'footer-note',
	'description' => 'This is the note section above the footer.',
));
genesis_register_sidebar(array(
	'name'=>'Footer #1',
   	'id' => 'footer-1',
	'description' => 'This is the first column of the footer section.',
));
genesis_register_sidebar(array(
	'name'=>'Footer #2',
   	'id' => 'footer-2',
	'description' => 'This is the second column of the footer section.',
));
genesis_register_sidebar(array(
	'name'=>'Footer #3',
   	'id' => 'footer-3',
	'description' => 'This is the third column of the footer section.',
));