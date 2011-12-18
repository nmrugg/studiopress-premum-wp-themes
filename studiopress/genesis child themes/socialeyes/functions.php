<?php
/** Start the engine */
require_once(TEMPLATEPATH.'/lib/init.php');
require_once(CHILD_DIR.'/lib/style.php');

/** Child theme (do not remove) */
define('CHILD_THEME_NAME', 'Social Eyes Theme');
define('CHILD_THEME_URL', 'http://www.studiopress.com/themes/socialeyes');

/** Add support for custom background */
add_custom_background();

/** Add new image sizes */
add_image_size('Homepage Featured', 600, 300, TRUE);
add_image_size('Homepage Thumbnail', 110, 110, TRUE);

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 150, 'textcolor' => '333333' ) );

/** Customize the post info function */
add_filter('genesis_post_info', 'post_info_filter');
function post_info_filter($post_info) {
	if (!is_page()) {
    	$post_info = '[post_date] by [post_author_posts_link] [post_comments] [post_edit]';
    	return $post_info;
	}
}

/** Customize the post meta function */
add_filter('genesis_post_meta', 'post_meta_filter');
function post_meta_filter($post_meta) {
	if (!is_page()) {
    	$post_meta = '[post_categories] &middot; [post_tags]';
    	return $post_meta;
	}
}

/** Add after post ad widget area on single post */
add_action('genesis_after_post_content', 'socialeyes_after_post_ad', 9); 
function socialeyes_after_post_ad() {
    if ( is_single() ) {
        echo '<div class="after-post-ad">';
        dynamic_sidebar('after-post-ad');
        echo '</div>';
    }
}

/** Customize the footer section */
add_filter('genesis_footer_creds_text', 'socialeyes_footer_creds_text');
function socialeyes_footer_creds_text($creds) {
    return __('Copyright', 'genesis') . ' [footer_copyright] [footer_childtheme_link] ' . __('on', 'socialeyes') . ' [footer_genesis_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]';
}

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Register widget areas */
genesis_register_sidebar( array(
	'name'=>'Homepage',
	'id' => 'homepage',
	'description' => 'This is the content section of the homepage.'
) );
genesis_register_sidebar( array(
	'name'=>'After Post Ad',
	'id' => 'after-post-ad',
	'description' => 'This is the section after a post for an ad.'
) );