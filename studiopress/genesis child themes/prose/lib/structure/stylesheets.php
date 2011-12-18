<?php
/**
 * This file controls the creation and references to stylesheets.
 *
 * @package Prose
 * @author StudioPress & Gary Jones
 * @since 0.9.7
 */

/**
 * Get the correct stylesheet location for URL or path, and for multisite or not.
 * 
 * Takes account of multisite usage, and domain mapping.
 * @author Gary Jones
 * @param string $type Either 'url' or anything else e.g. 'path'
 * @return string 
 * @since 0.9.7
 * @version 0.9.7.3
 */
function prose_get_stylesheet_location($type) {      
    $dir = ('url' == $type) ? CHILD_URL : CHILD_DIR;
    $location = $dir . '/css/';
    return apply_filters('prose_get_stylesheet_location', $location);
}

/**
 * Takes a stylesheet filename prefix, and appends '-X.css' where X is the 
 * $blog_id if the $blog_id is greater than 1. Else adds '.css'.
 * 
 * @author Ron Rennick & Gary Jones
 * @global int $blog_id
 * @param string $slug Filename prefix of the stylesheet, before '-X.css'
 * @return string
 */
function prose_get_stylesheet_name($slug='stylesheet') {
    global $blog_id;
    $id = '';
    if ( $blog_id > 1 ) {
        $id = '-' . $blog_id;
    }
    return apply_filters( 'prose_get_stylesheet_name', $slug . $id . '.css');
}

/**
 * Get the name of the generated combined minified stylesheet.
 * 
 * Default filename is minified.css, although this is filterable via prose_get_minified_stylesheet_name.
 * @author Gary Jones
 * @return string
 * @since 0.9.7
 */
function prose_get_minified_stylesheet_name() {
    return apply_filters('prose_get_minified_stylesheet_name', prose_get_stylesheet_name('minified'));
}

/**
 * Get the name of the generated settings stylesheet.
 * 
 * Default filename is settings.css, although this is filterable via prose_get_settings_stylesheet_name.
 * @author Gary Jones
 * @return string
 * @since 0.9.7
 */
function prose_get_settings_stylesheet_name() {
    return apply_filters('prose_get_settings_stylesheet_name', prose_get_stylesheet_name('settings'));
}

/**
 * Get the name of the custom stylesheet.
 * 
 * Default filename is custom-style.css, although this is filterable via prose_get_custom_stylesheet_name.
 * @author Gary Jones
 * @return string
 * @since 1.0
 */
function prose_get_custom_stylesheet_name() {
    return apply_filters('prose_get_custom_stylesheet_name', prose_get_stylesheet_name('custom'));
}


/**
 * Get the file path of the minified stylesheet.
 * 
 * @author Gary Jones
 * @return string
 * @since 0.9.7
 */
function prose_get_minified_stylesheet_path() {
    return apply_filters('prose_get_minified_stylesheet_path', prose_get_stylesheet_location('path') . prose_get_minified_stylesheet_name());
}

/**
 * Get the file path of the settings stylesheet.
 * 
 * @author Gary Jones
 * @return string
 * @since 0.9.7
 */
function prose_get_settings_stylesheet_path() {
    return apply_filters('prose_get_settings_stylesheet_path', prose_get_stylesheet_location('path') . prose_get_settings_stylesheet_name());
}

/**
 * Get the file path reference of the custom stylesheet.
 * 
 * @author Gary Jones
 * @return string
 * @since 0.9.7
 * @version 1.0
 */
function prose_get_custom_stylesheet_path() {
    return apply_filters('prose_get_custom_stylesheet_path', prose_get_stylesheet_location('path') . prose_get_custom_stylesheet_name());
}

/**
 * Get the URL reference of the minified stylesheet.
 * 
 * @author Gary Jones
 * @return string
 * @since 0.9.7
 */
function prose_get_minified_stylesheet_url() {
    return apply_filters('prose_get_minified_stylesheet_url', prose_get_stylesheet_location('url') . prose_get_minified_stylesheet_name());
}

/**
 * Get the URL reference of the settings stylesheet.
 * 
 * @author Gary Jones
 * @return string
 * @since 0.9.7
 */
function prose_get_settings_stylesheet_url() {
    return apply_filters('prose_get_settings_stylesheet_url', prose_get_stylesheet_location('url') . prose_get_settings_stylesheet_name());
}


/**
 * Get the URL reference of the custom stylesheet.
 * 
 * @author Gary Jones
 * @return string
 * @since 0.9.7
 * @version 1.0
 */
function prose_get_custom_stylesheet_url() {
    return apply_filters('prose_get_custom_stylesheet_url', prose_get_stylesheet_location('url') . prose_get_custom_stylesheet_name());
}

/**
 * Checks if custom stylesheet for this site has any content or not.
 * 
 * @author Gary Jones
 * @link http://core.trac.wordpress.org/ticket/15025
 * @return boolean 
 * @since 1.0
 */
function prose_is_custom_stylesheet_used() {
    if ( file_exists(prose_get_custom_stylesheet_path())) {
        $css = file_get_contents(prose_get_custom_stylesheet_path());
        if ( strlen($css) > 1 ) {
            // 1, not 0, as to create custom stylsheet, we have enter at least 1
            // (space) character, else get a PHP Notice if WP_DEBUG is true.
            return true;
        }
    }
    return false;    
}

/**
 * Get the custom stylesheet querystring for the theme editor link.
 * 
 * @author Gary Jones
 * @global string $theme
 * @return string
 * @since 1.0 
 */
function prose_get_custom_stylesheet_editor_querystring() {
    global $theme;
    if ( empty($theme) )
        $theme = get_current_theme();
    return 'file=' . _get_template_edit_filename(prose_get_custom_stylesheet_path(), dirname(prose_get_stylesheet_location('path'))) . '&amp;theme=' . urlencode($theme) . '&amp;dir=style';
}

/**
 * Conditionally enqueue stylesheet references, if they exist, with WordPress.
 *
 * @author Gary Jones
 * @since 0.9.6
 * @uses is_minified()
 * @version 1.0
 */
function prose_add_stylesheets() {
    // If debugging (not minified), then add settings stylesheet and custom stylesheet (leaving style.css in place)
    if ( !prose_is_minified() && file_exists(prose_get_settings_stylesheet_path()) ) {
        wp_enqueue_style('prose_settings_stylesheet', prose_get_settings_stylesheet_url(), false, filemtime(prose_get_settings_stylesheet_path()));
        if ( prose_is_custom_stylesheet_used() ) {
            wp_enqueue_style('prose_custom_stylesheet', prose_get_custom_stylesheet_url(), false, filemtime(prose_get_custom_stylesheet_path()));
        }
    }
    // Otherwise, if minified, then add reference to minified stylesheet, and remove style.css reference
    elseif ( prose_is_minified() && file_exists(prose_get_minified_stylesheet_path()) ) {
        wp_enqueue_style('prose_minified_stylesheet', prose_get_minified_stylesheet_url(), false, filemtime(prose_get_minified_stylesheet_path()));
        remove_action('genesis_meta', 'genesis_load_stylesheet');
    }
}
add_action('template_redirect', 'prose_add_stylesheets');


/**
 * Loops through the mapping to prepare the CSS output.
 *
 * @author Gary Jones
 * @since 0.9.6
 * @return string $output Beautified CSS
 * @uses prose_get_mapping()
 * @version 1.0
 */
function prose_prepare_settings_stylesheet() {
    
    $mapping = prose_get_mapping();
    
    $output = '';
    foreach ($mapping as $selector => $declaration) {
        if ('custom_css' != $selector && 'minify_css' != $selector) {
            $output .= $selector . ' {'."\n";
            foreach ($declaration as $property => $value) {
                if (strpos($property, '_select')) {
                     if (prose_get_fresh_design_option($value) == 'hex') {
                         continue;
                     } else {
                         $property = substr($property, 0, strlen($property)-7);
                     }
                }
                $output .= "\t" . $property . ':';
                if ( is_array($value) ) {
                    foreach ($value as $composite_value) {
                        $output .= ' ';
                        $val = $composite_value[0];
                        $type = $composite_value[1];
                        if ('fixed_string' == $type) {
                            $output .= $val;
                        } elseif ('string' == $type) {
                            $output .=  prose_get_fresh_design_option($val);
                        } else {
                            $cache_val = prose_get_fresh_design_option($val);
                            $output .= $cache_val;
                            $output .= ((int)$cache_val > 0) ? $type : null;
                        }
                    }
                } elseif ('#nav_width_calc' == $value) {
                        $output .= prose_calculate_nav_width('primary');
                } elseif ('#nav_ul_width_calc' == $value) {
                        $output .= prose_calculate_nav_width('primary', true);
                } elseif ('#subnav_width_calc' == $value) {
                        $output .= prose_calculate_nav_width('secondary');
                } elseif ('#subnav_ul_width_calc' == $value) {
                        $output .= prose_calculate_nav_width('secondary', true);
                } else {
                    $output .= ' ' . prose_get_fresh_design_option($value);
                }
                $output .= ';' . "\n";
            }
            $output .= '}' . "\n";
        } elseif ('custom_css' == $selector) {
            $output .= prose_get_fresh_design_option($declaration);
        }
    }
    return apply_filters('prose_prepare_stylesheet', $output);
}

/**
 * Calculates the width of the primary or secondary nav elements, or the child
 * UL elements, based on the border settings choices.
 * 
 * @author Gary Jones
 * @param string $nav 'primary' or 'secondary'
 * @param boolean $ul True for getting width of child UL, false (default) for the (grand)parent element.
 * @return string 
 * @since 1.0
 */
function prose_calculate_nav_width($nav, $ul = false) {
    $border = prose_get_fresh_design_option($nav . '_nav_border');
    $border_style = prose_get_fresh_design_option($nav . '_nav_border_style');
    if ( 'none' == $border_style )
        $border = 0;
    $width = 940 - 2 * $border;
    if ($ul) {
        $border = prose_get_fresh_design_option($nav . '_nav_inner_border');
        $border_style = prose_get_fresh_design_option($nav . '_nav_inner_border_style');
        if ( 'none' == $border_style )
            $border = 0;
        $width = $width - 2 * $border;
    }
    return ' ' . $width .'px';
}


/**
 * Try and make stylesheet directory writable. May not work if safe-mode or
 * other server configurations are enabled.
 * 
 * @author Gary Jones
 * @since 1.0
 */
function prose_make_stylesheet_path_writable() {
    if ( !is_writable(prose_get_stylesheet_location('path')) ) {
        @chmod(prose_get_stylesheet_location('path'), 0777);
    }
    if ( !is_writable(prose_get_stylesheet_location('path')) ) {
        return true;
    }
    return false;
}

/**
 * Uses the mapping output to write the beautified CSS to a file.
 *
 * @author Gary Jones
 * @since 0.9.6
 * @version 1.0
 */
function prose_create_settings_stylesheet() {
    prose_make_stylesheet_path_writable();
    
    $css = '/* ' . __('This file is auto-generated from the settings page. Any direct edits here will be lost if the settings page is saved', PROSE_DOMAIN) . ' */'."\n";
    $css .= prose_prepare_settings_stylesheet();
    $handle = @fopen(prose_get_settings_stylesheet_path(), 'w');
    @fwrite($handle, $css);
    @fclose($handle);
}

/**
 * Try to create custom stylesheet at the right place.
 * 
 * @author Gary Jones
 * @param string $css Optional string of CSS to populate the custom stylesheet.
 * @since 1.0
 */
function prose_create_custom_stylesheet($css = ' ') {
    prose_make_stylesheet_path_writable();
    
    if ( !file_exists(prose_get_custom_stylesheet_path()) ||  ' ' != $css ) {
        $handle = @fopen(prose_get_custom_stylesheet_path(), 'w+');
        @fwrite($handle, $css);
        @fclose($handle);
        @chmod(prose_get_custom_stylesheet_path(), 0666);
    }
}

/**
 * Merges style.css, settings stylesheet and custom.css, then minifies it into
 * one minified.css file. Also creates individual beautified settings stylesheet
 * so they are in sync, and attempts to create custom stylesheet if it doesn't 
 * exist.
 * 
 * @author Gary Jones
 * @since 0.9.7
 * @version 1.0
 */
function prose_create_stylesheets() {
    prose_make_stylesheet_path_writable();
    
    $css_prefix = '/* ' . __('This file is auto-generated from the style.css, the settings page and custom.css. Any direct edits here will be lost if the settings page is saved', PROSE_DOMAIN) .' */'."\n";
    $css = file_get_contents(CHILD_DIR . '/style.css');  
    $css .= prose_prepare_settings_stylesheet();
//    if ( file_exists(prose_get_custom_stylesheet_path()) ) {
    if ( prose_is_custom_stylesheet_used() ) {
        $css .= file_get_contents(prose_get_custom_stylesheet_path());
    }

    $css = $css_prefix . prose_minify_css($css);

    $handle = @fopen(prose_get_minified_stylesheet_path(), 'w');
    @fwrite($handle, $css);
    @fclose($handle);

    prose_create_settings_stylesheet();
    prose_create_custom_stylesheet();
}
add_action('update_option_' . PROSE_SETTINGS_FIELD, 'prose_create_stylesheets');

/**
 * Attempts to create all stylesheets when the Prose theme is activated.
 * 
 * @author Gary Jones
 * @since 1.0
 */
function prose_do_create_stylesheets() {
    global $pagenow;
    if ( is_admin() && (
            // Theme activation
            ( isset($_GET['activated'] ) && $pagenow == "themes.php" ) || 
            // When custom stylesheet is updated via Theme Editor
            ( isset($_GET['a'] ) && $pagenow == "theme-editor.php" && isset($_GET['file']) && strstr($_GET['file'], prose_get_custom_stylesheet_name()) )
        )
        ) {
        prose_create_stylesheets();
    }
}
add_action('admin_init', 'prose_do_create_stylesheets');


/**
 * Ensure Custom stylesheet for this site is editable in Theme Editor.
 * 
 * @author Ron Rennick
 * @global array $wp_themes
 * @global string $theme
 * @since 1.0
 */
function prose_add_custom_stylesheet_to_theme_editor() {
    global $parent_file;
    if ( 'themes.php' == $parent_file && current_user_can('edit_themes')) {
        global $wp_themes, $theme;
        if ( empty($wp_themes) )
            $wp_themes = get_themes();
        if ( empty($theme) )
            $theme = get_current_theme();
        $wp_themes[$theme]['Stylesheet Files'][] = prose_get_custom_stylesheet_path();
    }
}
add_action('admin_init', 'prose_add_custom_stylesheet_to_theme_editor');


/**
 * Quick and dirty way to mostly minify CSS.
 * 
 * @author Gary Jones
 * @param string $css String of CSS to minify.
 * @return string
 * @since 0.9.7
 */
function prose_minify_css($css) {
    // Normalize whitespace
    $css = preg_replace('/\s+/', ' ', $css);
    // Remove comment blocks, everything between /* and */, unless
    // preserved with /*! ... */
    $css = preg_replace('/\/\*[^\!](.*?)\*\//', '', $css);
    // Remove space after , : ; { }
    $css = preg_replace('/(,|:|;|\{|}) /', '$1', $css);
    // Remove space before , ; { }
    $css = preg_replace('/ (,|;|\{|})/', '$1', $css);
    // Strips leading 0 on decimal values (converts 0.5px into .5px)
    $css = preg_replace('/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css);
    // Strips units if value is 0 (converts 0px to 0)
    $css = preg_replace('/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css);
    // Converts all zeros value into short-hand
    $css = preg_replace('/0 0 0 0/', '0', $css);
    // Ensures image path is correct, if we're serving .css file from subfolder
    $css = preg_replace('/url\(([\'"]?)images\//', 'url(${1}' . CHILD_URL . '/images/', $css);
    return apply_filters('prose_minify_css', $css);
}