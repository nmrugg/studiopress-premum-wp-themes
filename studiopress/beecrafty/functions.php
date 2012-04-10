<?php

// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Start the Custom Header engine
add_theme_support( 'genesis-custom-header', array( 'width' =>  960, 'height' => 180, 'textcolor' => 'ffffff') );

// Child theme (do not remove)
define('CHILD_THEME_NAME', 'Bee Crafty Theme');
define('CHILD_THEME_URL', 'http://www.studiopress.com/themes/beecrafty');

// Load scripts
add_action('get_header', 'beecrafty_load_scripts');
function beecrafty_load_scripts() {
    wp_enqueue_script('boxes', CHILD_URL.'/js/boxes.js', TRUE);
}

// Add support for custom background
if ( function_exists('add_custom_background') ) {
	add_custom_background();
}

// Add custom image sizes
add_image_size('Blog Excerpt', 600, 400, TRUE);
add_image_size('Home Featured Header ', 200,200, TRUE);
add_image_size('Gallery', 225,225, TRUE);
add_image_size('Sidebar Featured Main ', 280,125, TRUE);

// Un-register nav widgets
add_action('widgets_init', 'beecrafty_unregister_widgets');
function beecrafty_unregister_widgets() {
    unregister_widget('Genesis_Menu_Pages_Widget');
    unregister_widget('Genesis_Widget_Menu_Categories');
	unregister_widget('WP_Nav_Menu_Widget');
} 

// Add home icon to nav bar 
add_filter('genesis_nav_items', 'beecrafty_nav_home', 10, 2);
add_filter('wp_nav_menu_items', 'beecrafty_nav_home', 10, 2);
function beecrafty_nav_home($menu, $args) {
    $args = (array)$args;
    
    if ( $args['theme_location'] == 'primary' && is_home() )  
        $menu = '<li class="custom-home current_page_item"><a href="/"></a></li>' . $menu;
    else if ( $args['theme_location'] == 'primary' )
    	$menu = '<li class="custom-home"><a href="/"></a></li>' . $menu;
    
    return $menu;    
}

// Customize post-info
add_filter('genesis_post_info', 'post_info_filter');
function post_info_filter($post_info) {
    $post_info = 'Posted by [post_author_posts_link] on [post_date] [post_comments]';
    return $post_info;
}  

// Customize post-meta
add_filter('genesis_post_meta', 'post_meta_filter');
function post_meta_filter($post_meta) {
    $post_meta = '[post_categories] | Tagged: [post_tags]';
    return $post_meta;
}  

// Customize search
add_filter('genesis_search_text', 'beecrafty_search_text');
function beecrafty_search_text($text) {
    return esc_attr('Search our site...');
}  

add_filter('genesis_search_button_text', 'beecrafty_search_button_text');
function beecrafty_search_button_text($text) {
    return esc_attr('Go');
}

// Customize footer text
add_filter('genesis_footer_output', 'footer_output_filter', 10, 3);
function footer_output_filter($output, $creds_text) {
	
    $creds_text_start = 'Copyright [footer_copyright] ';
    
    $bloginfo = get_bloginfo( $show );
    
    $creds_text_end = ' | <a href="http://www.studiopress.com/themes/beecrafty">Bee Crafty Child Theme</a> on <a href="http://www.studiopress.com/themes/genesis">Genesis Theme Framework</a> | [footer_wordpress_link] | [footer_loginout]';
    
    $output = '<div class="creds">'. $creds_text_start . $bloginfo . $creds_text_end . '</div>';
    return $output;
} 

// Force layout on homepage
add_filter('genesis_pre_get_option_site_layout', 'beecrafty_home_layout');
function beecrafty_home_layout($opt) {
	if ( is_home() )
    $opt = 'full-width-content';
	return $opt;
} 

// Customize the footer section
add_filter('genesis_footer_creds_text', 'beecrafty_footer_creds_text');
function beecrafty_footer_creds_text($creds) {
	$creds = __('Copyright', 'genesis') . ' [footer_copyright] [footer_childtheme_link] '. __('on', 'expose') .' [footer_genesis_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]';
	return $creds;
}

// Home Page Gallery Control
add_action('admin_menu', 'beecrafty_add_gallery_settings_box', 11);

function beecrafty_add_gallery_settings_box() {
    global $_genesis_theme_settings_pagehook;
    
    add_meta_box('genesis-theme-settings-home-gallery', __('Home Page Gallery     Settings', 'beecrafty'), 'beecrafty_theme_settings_home_gallery',     $_genesis_theme_settings_pagehook, 'column2');
    }
function beecrafty_theme_settings_home_gallery() { ?>

<p><label><?php _e('Category', 'family_tree'); ?>: <?php wp_dropdown_categories(array('name' => GENESIS_SETTINGS_FIELD.'[gallery_cat]', 'selected' => genesis_get_option('gallery_cat'), 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_all' => __("All Categories", 'beecrafty'), 'hide_empty' => '0')); ?></label></p>

<p style="clear:both;">
<label>Number of images in the home page gallery:</label>
    
    <div style="float: left; display: inline; margin-right: 15px; padding-bottom: 15px;">
    <input type=radio name="<?php echo GENESIS_SETTINGS_FIELD; ?>[number_images]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[number_images]" value="3" <?php checked(3, genesis_get_option('number_images')); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[number_images]"><?php _e('3', 'beecrafty'); ?></label>
    </div>
    
    <div style="float: left; display: inline; margin-right: 15px; padding-bottom: 15px;">
    <input type=radio name="<?php echo GENESIS_SETTINGS_FIELD; ?>[number_images]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[number_images]" value="6" <?php checked(6, genesis_get_option('number_images')); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[number_images]"><?php _e('6', 'beecrafty'); ?></label>
    </div>
    
    <div style="float: left; display: inline; margin-right: 15px; padding-bottom: 15px;">
    <input type=radio name="<?php echo GENESIS_SETTINGS_FIELD; ?>[number_images]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[number_images]" value="9" <?php checked(9, genesis_get_option('number_images')); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[number_images]"><?php _e('9', 'beecrafty'); ?></label>
    </div>
    
    <div style="float: left; display: inline; margin-right: 15px; padding-bottom: 15px;">
    <input type=radio name="<?php echo GENESIS_SETTINGS_FIELD; ?>[number_images]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[number_images]" value="12" <?php checked(12, genesis_get_option('number_images')); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[number_images]"><?php _e('12', 'beecrafty'); ?></label>
    </div> 
</p>

<?php
}