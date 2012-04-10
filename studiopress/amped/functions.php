<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Add new image sizes
add_image_size('Mini Square', 90, 90, TRUE);

// Add two sidebars to the main sidebar area
add_action('genesis_after_sidebar_widget_area', 'amped_include_bottom_sidebars'); 
function amped_include_bottom_sidebars() {
    require(CHILD_DIR.'/sidebar-bottom.php');
}

// Add Google AdSense after single post
add_action('genesis_after_post_content', 'amped_include_adsense', 9); 
function amped_include_adsense() {
    if(is_single())
    require(CHILD_DIR.'/adsense.php');
}

// Add widgeted footer section
add_action('genesis_before_footer', 'amped_include_footer_widgets'); 
function amped_include_footer_widgets() {
    require(CHILD_DIR.'/footer-widgeted.php');
}

// Force layout on homepage
add_filter('genesis_pre_get_option_site_layout', 'amped_home_layout');
function amped_home_layout($opt) {
	if ( is_home() )
    $opt = 'content-sidebar';
	return $opt;
}  

// Customize excerpt
add_filter('get_the_excerpt', 'trim_excerpt');
function trim_excerpt($text) {
    return str_replace(' [...]', '... <a href="' . get_permalink() . '"> [Continue Reading]</a>', $text);
};

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