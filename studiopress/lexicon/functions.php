<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Child theme library
require_once(CHILD_DIR.'/lib/widgets/lexicon-slider-widget.php');
require_once(CHILD_DIR.'/lib/structure/lexicon_post.php');

// Child theme (do not remove)
define('CHILD_THEME_NAME', 'Lexicon Theme');
define('CHILD_THEME_URL', 'http://www.studiopress.com/themes/lexicon');

// Add new image sizes
add_image_size('Slideshow', 600, 300, TRUE);
add_image_size('Small Thumbnail', 70, 70, TRUE);

// Removes post info filter
remove_filter( 'genesis_post_info', array($Genesis_Simple_Edits, 'post_info_filter' ), 20 );  

// Load Required JS Files
add_action('get_header', 'lexicon_load_scripts');
function lexicon_load_scripts() {
	if ( is_active_widget(0,0, 'feature-posts') ) {
		wp_enqueue_script('cycle', $src = CHILD_URL.'/lib/js/jquery.cycle.all.min.js', array('jquery'), CHILD_THEME_VERSION, TRUE);
		wp_enqueue_script('lexicon-scripts', $src = CHILD_URL.'/lib/js/lexicon-scripts.js', array('jquery'), CHILD_THEME_VERSION, TRUE);		
	}
}

// Add Featured Posts on Homepage
add_action('genesis_before_content_sidebar_wrap', 'lexicon_add_feature');
function lexicon_add_feature() {
	if ( is_home() ) {
		require_once(CHILD_DIR.'/lib/structure/lexicon_feature.php');
	}
}

// Relocate secondary navigation
remove_action('genesis_after_header', 'genesis_do_subnav');
add_action('genesis_before_content_sidebar_wrap', 'genesis_do_subnav');

// Changing excerpt more 
add_filter('excerpt_more', 'new_excerpt_more'); 
function new_excerpt_more($more) { 
    return '&hellip;<br /><span class="more-link-wrapper"><a href="'.get_permalink().'" class="more-link">Read More</a></span>'; 
}

// Add Date before Post
add_action('genesis_before_post_title','lexicon_post_date');

// Alter Post Byline
remove_action('genesis_before_post_content','genesis_post_info');
add_action('genesis_before_post_content','lexicon_post_info');

// Remove Post Meta
remove_action('genesis_after_post_content', 'genesis_post_meta');

// Customize the footer section
add_filter('genesis_footer_creds_text', 'lexicon_footer_creds_text');
function lexicon_footer_creds_text($creds) {
	$creds = __('Copyright', 'genesis') . ' [footer_copyright] [footer_childtheme_link] '. __('on', 'lexicon') .' [footer_genesis_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]';
	return $creds;
}

// Register widget areas
genesis_register_sidebar(array(
	'name'=>'Home Featured',
	'id' => 'home-featured',
	'description' => 'This is the featured area designed for the Lexicon slider widget.',
	'before_widget' => '<ul id="%1$s" class="widget %2$s">', 'after_widget'  => '</ul>',
	'before_title'=>'<h2 class="feature-title">','after_title'=>'</h2>'
));