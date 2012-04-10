<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Child theme (do not remove)
define('CHILD_THEME_NAME', 'Education Theme');
define('CHILD_THEME_URL', 'http://www.studiopress.com/themes/education');

// Add new image sizes
add_image_size('Homepage', 110, 110, TRUE);

// Add topnav section
add_action('genesis_before_header', 'education_include_topnav'); 
function education_include_topnav() {
    require(CHILD_DIR.'/topnav.php');
}

// Force layout on homepage
add_filter('genesis_pre_get_option_site_layout', 'education_home_layout');
function education_home_layout($opt) {
	if ( is_home() )
    $opt = 'content-sidebar-sidebar';
	return $opt;
}

// Add inner wrap divs for full width background image
add_action('genesis_before_content_sidebar_wrap', 'edu_csw_wrap_div');
add_action('genesis_after_content_sidebar_wrap', 'edu_csw_wrap_div');
function edu_csw_wrap_div() {
	echo current_filter() == 'genesis_before_content_sidebar_wrap' ? '<div class="wrap">' . "\n" : '</div><!-- end .wrap -->';
}

// Customize the footer section
add_filter('genesis_footer_creds_text', 'education_footer_creds_text');
function education_footer_creds_text($creds) {
	$creds = __('Copyright', 'genesis') . ' [footer_copyright] [footer_childtheme_link] '. __('on', 'education') .' [footer_genesis_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]';
	return $creds;
}

// Register widget areas
genesis_register_sidebar(array(
	'name'=>'Homepage',
	'id' => 'homepage',
	'description' => 'This is the featured column of the homepage.'
));