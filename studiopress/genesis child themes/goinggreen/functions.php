<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Add new image sizes
add_image_size('Featured Image', 590, 330, TRUE);
add_image_size('Featured Thumb', 200, 115, TRUE);

// Add rounded header
add_action('genesis_after_header', 'goinggreen_round_header_graphic'); 
function goinggreen_round_header_graphic() {
    require(CHILD_DIR.'/after-header.php');
}

// Add widgeted footer section
add_action('genesis_before_footer', 'goinggreen_include_footer_widgets'); 
function goinggreen_include_footer_widgets() {
    require(CHILD_DIR.'/footer-widgeted.php');
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