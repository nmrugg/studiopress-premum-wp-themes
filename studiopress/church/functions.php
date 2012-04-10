<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Child theme library
require_once(CHILD_DIR.'/lib/custom-header.php');
require(CHILD_DIR.'/lib/style.php');

// Child theme (do not remove)
define('CHILD_THEME_NAME', 'Church Theme');
define('CHILD_THEME_URL', 'http://www.studiopress.com/themes/church');

// Add support for custom background
if ( function_exists('add_custom_background') ) {
	add_custom_background();
}

// Add new image sizes
add_image_size('Mini Square', 70, 70, TRUE);
add_image_size('Square', 110, 110, TRUE);

// Force layout on homepage
add_filter('genesis_pre_get_option_site_layout', 'church_home_layout');
function church_home_layout($opt) {
	if ( is_home() )
    $opt = 'content-sidebar';
	return $opt;
}  

// Add advertising code after single post
add_action('genesis_after_post_content', 'church_include_adsense', 9); 
function church_include_adsense() {
    if ( is_single() )
    require(CHILD_DIR.'/adsense.php');
}

// Add two sidebars underneath the primary sidebar
add_action('genesis_after_sidebar_widget_area', 'church_include_bottom_sidebars'); 
function church_include_bottom_sidebars() {
    require(CHILD_DIR.'/sidebar-bottom.php');
}

// Customize the footer section
add_filter('genesis_footer_creds_text', 'church_footer_creds_text');
function church_footer_creds_text($creds) {
	$creds = __('Copyright', 'genesis') . ' [footer_copyright] [footer_childtheme_link] '. __('on', 'church') .' [footer_genesis_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]';
	return $creds;
} 

// Register widget areas
genesis_register_sidebar(array(
	'name'=>'Sidebar Bottom Left',
	'id' => 'sidebar-bottom-left',
	'description' => 'This is the bottom left column in the sidebar.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Sidebar Bottom Right',
	'id' => 'sidebar-bottom-right',
	'description' => 'This is the bottom right column in the sidebar.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Featured Top Left',
	'id' => 'featured-top-left',
	'description' => 'This is the featured top left column of the homepage.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Featured Top Right',
	'id' => 'featured-top-right',
	'description' => 'This is the featured top right column of the homepage.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Featured Bottom',
	'id' => 'featured-bottom',
	'description' => 'This is the featured bottom section of the homepage.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));