<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Child theme library
require(CHILD_DIR.'/lib/style.php');

// Child theme (do not remove)
define('CHILD_THEME_NAME', 'Sleek Theme');
define('CHILD_THEME_URL', 'http://www.studiopress.com/themes/sleek');

// Add support for custom background
if ( function_exists('add_custom_background') ) {
	add_custom_background();
}

// Add new image sizes
add_image_size('Home Top Left', 600, 314, TRUE);
add_image_size('Home Top Right', 75, 75, TRUE);
add_image_size('Home Bottom', 280, 150, TRUE);

// Add topnav section
add_action('genesis_before_header', 'sleek_include_topnav'); 
function sleek_include_topnav() {
    require(CHILD_DIR.'/topnav.php');
}

// Add Google AdSense after single post
add_action('genesis_after_post_content', 'sleek_include_adsense', 9); 
function sleek_include_adsense() {
    if(is_single())
    require(CHILD_DIR.'/adsense.php');
}

// Customize the footer section
add_filter('genesis_footer_creds_text', 'sleek_footer_creds_text');
function sleek_footer_creds_text($creds) {
	$creds = __('Copyright', 'genesis') . ' [footer_copyright] [footer_childtheme_link] '. __('on', 'sleek') .' [footer_genesis_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]';
	return $creds;
}  

// Register widget areas
genesis_register_sidebar(array(
	'name'=>'Home Top Left',
	'id' => 'home-top-left',
	'description' => 'This is the home top left section of the homepage.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Home Top Right',
	'id' => 'home-top-right',
	'description' => 'This is the home top right section of the homepage.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Home Bottom #1',
	'id' => 'home-bottom-1',
	'description' => 'This is the first column of the bottom section of the homepage.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Home Bottom #2',
	'id' => 'home-bottom-2',
	'description' => 'This is the second column of the bottom section of the homepage.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Home Bottom #3',
	'id' => 'home-bottom-3',
	'description' => 'This is the third column of the bottom section of the homepage.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));