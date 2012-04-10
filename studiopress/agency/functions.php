<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Add new image sizes
add_image_size('Slideshow', 610, 300, TRUE);
add_image_size('Homepage', 280, 125, TRUE);
add_image_size('Sidebar', 85, 85, TRUE);

// Customizes go to top text
add_filter('genesis_footer_backtotop_text', 'footer_backtotop_filter');
function footer_backtotop_filter($backtotop) {
    $backtotop = '[footer_backtotop text="Top of Page"]';
    return $backtotop;
} 

// Register widget areas
genesis_register_sidebar(array(
	'name'=>'Home Top Left',
	'id' => 'home-top-left',
	'description' => 'This is the top left section of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Home Top Right',
	'id' => 'home-top-right',
	'description' => 'This is the top right section of the homepage.',
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