<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Add new image sizes
add_image_size('Slideshow', 910, 290, TRUE);
add_image_size('Homepage', 275, 100, TRUE);
add_image_size('Mini', 65, 65, TRUE);

// Add widgeted footer section
add_action('genesis_before_footer', 'outreach_include_footer_widgets'); 
function outreach_include_footer_widgets() {
    require(CHILD_DIR.'/footer-widgeted.php');
}

// Customizes footer
add_filter('genesis_footer_output', 'footer_logo');
function footer_logo($output) {
    $url = trailingslashit( get_bloginfo('url') );
    $src = trailingslashit( get_bloginfo('stylesheet_directory') ) . 'images/footer-logo.png';
    $alt = esc_attr( get_bloginfo('description') );
    $output = sprintf('<div class="logo"><a href="%s"><img src="%s" alt="%s" /></a></div><!-- end .logo -->', $url, $src, $alt) . $output;
    return $output;
}

// Customizes go to top text
add_filter('genesis_footer_backtotop_text', 'footer_backtotop_filter');
function footer_backtotop_filter($backtotop) {
    $backtotop = '[footer_backtotop text="Top of Page"]';
    return $backtotop;
} 

// Register widget areas
genesis_register_sidebar(array(
	'name'=>'Home Top',
	'id' => 'home-top',
	'description' => 'This is the top section of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Home Middle #1',
	'id' => 'home-middle-1',
	'description' => 'This is the first column of the middle section of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Home Middle #2',
	'id' => 'home-middle-2',
	'description' => 'This is the second column of the middle section of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
	'before_title'=>'<h4 class="widgettitle">','after_title'=>'</h4>'
));
genesis_register_sidebar(array(
	'name'=>'Home Middle #3',
	'id' => 'home-middle-3',
	'description' => 'This is the third column of the middle section of the homepage.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget'  => '</div>',
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