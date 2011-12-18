<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Child theme (do not remove)
define('CHILD_THEME_NAME', 'Crystal Theme');
define('CHILD_THEME_URL', 'http://www.studiopress.com/themes/crystal');

// Add new image sizes
add_image_size('Home Bottom', 65, 65, TRUE);
add_image_size('Home Thumbnail', 175, 125, TRUE);
add_image_size('Portfolio Thumbnail', 200, 130, TRUE);
add_image_size('Portfolio Full', 600, 300, TRUE);

// Change avatar size
add_filter('genesis_comment_list_args', 'child_comment_list_args');
function child_comment_list_args($args) {
    $args = array(
        'type' => 'comment',
        'avatar_size' => 33,
        'callback' => 'genesis_comment_callback'
    );
    return $args;
}

// Add sidebar divs
add_action('genesis_before_sidebar_widget_area', 'child_before_sidebar_widget_area');
function child_before_sidebar_widget_area() {
    ?><div id="sidebar-top"></div><?php
}
add_action('genesis_after_sidebar_widget_area', 'child_after_sidebar_widget_area');
function child_after_sidebar_widget_area() {
    ?><div id="sidebar-bottom"></div><?php
}

// Customize the footer section
add_filter('genesis_footer_creds_text', 'crystal_footer_creds_text');
function crystal_footer_creds_text($creds) {
    return __('Copyright', 'genesis') . ' [footer_copyright] [footer_childtheme_link] ' . __('on', 'crystal') . ' [footer_genesis_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]';
}

// Add Crystal theme settings to Genesis default theme settings
add_filter('genesis_theme_settings_defaults', 'crystal_theme_settings');
function crystal_theme_settings( $defaults ) {
    $defaults['crystal_portfolio_content'] = 'excerpts';
    return $defaults;
}

// Add Portfolio Settings box to Genesis Theme Settings
add_action('admin_menu', 'crystal_add_portfolio_settings_box', 11);
function crystal_add_portfolio_settings_box() {
    global $_genesis_theme_settings_pagehook;
    
    add_meta_box('genesis-theme-settings-crystal-portfolio', __('Portfolio Page Settings', 'crystal'), 'crystal_theme_settings_portfolio',     $_genesis_theme_settings_pagehook, 'column2');
}
    
function crystal_theme_settings_portfolio() {
?>
    <p><?php _e("Display which category:", 'genesis'); ?>
    <?php wp_dropdown_categories(array('selected' => genesis_get_option('crystal_portfolio_cat'), 'name' => GENESIS_SETTINGS_FIELD.'[crystal_portfolio_cat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_all' => __("All Categories", 'genesis'), 'hide_empty' => '0' )); ?></p>
    
    <p><?php _e("Exclude the following Category IDs:", 'genesis'); ?><br />
    <input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[crystal_portfolio_cat_exclude]" value="<?php echo esc_attr( genesis_get_option('crystal_portfolio_cat_exclude') ); ?>" size="40" /><br />
    <small><strong><?php _e("Comma separated - 1,2,3 for example", 'genesis'); ?></strong></small></p>
    
    <p><?php _e('Number of Posts to Show', 'genesis'); ?>:
    <input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[crystal_portfolio_cat_num]" value="<?php echo esc_attr( genesis_option('crystal_portfolio_cat_num') ); ?>" size="2" /></p>
    
    <p><span class="description"><?php _e('<b>NOTE:</b> The Portfolio Page displays the "Portfolio Page" image size plus the excerpt or full content as selected below.', 'crystal'); ?></span></p>
    
    <p><?php _e("Select one of the following:", 'genesis'); ?>
    <select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[crystal_portfolio_content]">
        <option style="padding-right:10px;" value="full" <?php selected('full', genesis_get_option('crystal_portfolio_content')); ?>><?php _e("Display post content", 'genesis'); ?></option>
        <option style="padding-right:10px;" value="excerpts" <?php selected('excerpts', genesis_get_option('crystal_portfolio_content')); ?>><?php _e("Display post excerpts", 'genesis'); ?></option>
    </select></p>
    
    <p><label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[crystal_portfolio_content_archive_limit]"><?php _e('Limit content to', 'genesis'); ?></label> <input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[crystal_portfolio_content_archive_limit]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[crystal_portfolio_content_archive_limit]" value="<?php echo esc_attr( genesis_option('crystal_portfolio_content_archive_limit') ); ?>" size="3" /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[crystal_portfolio_content_archive_limit]"><?php _e('characters', 'genesis'); ?></label></p>
    
    <p><span class="description"><?php _e('<b>NOTE:</b> Using this option will limit the text and strip all formatting from the text displayed. To use this option, choose "Display post content" in the select box above.', 'genesis'); ?></span></p>
<?php
} 

// Register widget areas
genesis_register_sidebar(array(
    'name'=>'Home Top Left',
    'id' => 'home-top-left',
    'description' => 'This is the top left section of the homepage.'
));
genesis_register_sidebar(array(
    'name'=>'Home Top Right',
    'id' => 'home-top-right',
    'description' => 'This is the top right section of the homepage.'
));
genesis_register_sidebar(array(
    'name'=>'Home Middle',
    'id' => 'home-middle',
    'description' => 'This is the first column of the middle section of the homepage.'
));
genesis_register_sidebar(array(
    'name'=>'Home Bottom #1',
    'id' => 'home-bottom-1',
    'description' => 'This is the first column of the bottom section of the homepage.'
));
genesis_register_sidebar(array(
    'name'=>'Home Bottom #2',
    'id' => 'home-bottom-2',
    'description' => 'This is the second column of the bottom section of the homepage.'
));
genesis_register_sidebar(array(
    'name'=>'Home Bottom #3',
    'id' => 'home-bottom-3',
    'description' => 'This is the third column of the bottom section of the homepage.'
));