<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Add new image sizes
add_image_size('Main Photo', 800, 533, TRUE);
add_image_size('Mini Photo', 120, 80, TRUE);

// Add footer gallery
add_action('genesis_before_footer', 'landscape_include_footer_gallery',8); 
function landscape_include_footer_gallery() {
	dynamic_sidebar('Footer Gallery');
}

// Add widgeted footer section
add_action('genesis_before_footer', 'landscape_include_footer_widgets',9); 
function landscape_include_footer_widgets() {
    require(CHILD_DIR.'/footer-widgeted.php');
}

// Add custom text for search button
add_filter('genesis_search_button_text', 'custom_search_button_text');
function custom_search_button_text($text) {
    return esc_attr('Go');
} 

// Register widget areas
genesis_register_sidebar(array(
	'name'=>'Footer Gallery',
	'id' => 'footer-gallery',
	'description' => 'This is the gallery of the footer section.',
	'before_widget' => '<div id="footer-gallery"><div class="wrap"><div id="%1$s" class="widget %2$s"><div class="widget-wrap">','after_widget' => '</div></div></div></div>',
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