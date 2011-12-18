<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Add new image sizes
add_image_size('Sidebar #1', 270, 150, TRUE);
add_image_size('Sidebar #2', 90, 90, TRUE);

// Add widgeted footer section
add_action('genesis_before_footer', 'platinum_include_footer_widgets'); 
function platinum_include_footer_widgets() {
    require(CHILD_DIR.'/footer-widgeted.php');
}

// Force layout on homepage
add_filter('genesis_pre_get_option_site_layout', 'platinum_home_layout');
function platinum_home_layout($opt) {
	if ( is_home() )
    $opt = 'content-sidebar';
	return $opt;
}  

// Register widget areas
genesis_register_sidebar(array(
	'name'=>'Homepage',
	'id' => 'homepage',
	'description' => 'This is the featured column of the homepage.',
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
genesis_register_sidebar(array(
	'name'=>'Footer #4',
	'id' => 'footer-4',
	'description' => 'This is the fourth column of the footer section.',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));