<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Add topnav section
add_action('genesis_before_header', 'streamline_include_topnav'); 
function streamline_include_topnav() {
    require(CHILD_DIR.'/topnav.php');
}

// Add widgeted footer section
add_action('genesis_before_footer', 'streamline_include_footer_widgets'); 
function streamline_include_footer_widgets() {
    require(CHILD_DIR.'/footer-widgeted.php');
}

// Force layout on homepage
add_filter('genesis_pre_get_option_site_layout', 'streamline_home_layout');
function streamline_home_layout($opt) {
	if ( is_home() )
    $opt = 'content-sidebar';
	return $opt;
}  

// Add two sidebars to the main sidebar area
add_action('genesis_after_sidebar_widget_area', 'streamline_include_bottom_sidebars'); 
function streamline_include_bottom_sidebars() {
    require(CHILD_DIR.'/sidebar-bottom.php');
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