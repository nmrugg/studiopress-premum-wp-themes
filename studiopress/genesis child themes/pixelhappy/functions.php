<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Add wp-cycle slideshow
add_action('genesis_after_header', 'pixelhappy_include_slideshow', 5);
function pixelhappy_include_slideshow() {
    if( function_exists('wp_cycle') ) wp_cycle();
}

// Load script for right-click disable
add_action('get_header', 'pixelhappy_load_scripts');
function pixelhappy_load_scripts() {
    wp_enqueue_script('rightclick', CHILD_URL.'/js/rightclick.js', array(), '1.1', TRUE);
}

// Add widgeted footer section
add_action('genesis_before_footer', 'pixelhappy_include_footer_widgets'); 
function pixelhappy_include_footer_widgets() {
    require(CHILD_DIR.'/footer-widgeted.php');
}

// Restablish the post info line
remove_action('genesis_before_post_content', 'genesis_post_info');
add_action('genesis_before_post_content', 'pixelhappy_post_info');
function pixelhappy_post_info() {
    if(is_page()) return; // don't do post-info on pages
	genesis_post_info();
}

// Restablish the post meta line
remove_action('genesis_after_post_content', 'genesis_post_meta');
add_action('genesis_after_post_content', 'pixelhappy_post_meta');
function pixelhappy_post_meta() {
	if(is_page()) return; // don't do post-meta on pages
	genesis_post_meta();
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