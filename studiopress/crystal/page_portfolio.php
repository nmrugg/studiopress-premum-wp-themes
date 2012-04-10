<?php

// Template Name: Portfolio

// Force layout to full-width-content
add_filter('genesis_pre_get_option_site_layout', 'crystal_home_layout');
function crystal_home_layout($layout) {
    $layout = 'full-width-content';
    return $layout;
}

// Add .teaser class to every post, except first 2
add_filter('post_class', 'portfolio_post_class');
function portfolio_post_class( $classes ) {
    $classes[] = 'portfolio';
    return $classes;
}

// Modify length of post excerpts
add_filter('excerpt_length', 'custom_excerpt_length');
function custom_excerpt_length($length) {
    return 15; // pull first 15 words
}

// Add "View project" link
add_filter('the_excerpt', 'child_homepage_excerpt_filter');
function child_homepage_excerpt_filter( $text ) {
    return sprintf( '%s<a href="%s" class="more-link">%s</a>', $text, get_permalink(), __('View Project', 'crystal') );
}

// Remove post info and meta info
remove_action('genesis_after_post_content', 'genesis_post_meta');
remove_action('genesis_before_post_content', 'genesis_post_info');

// Move title above post image
remove_action('genesis_post_title', 'genesis_do_post_title');
add_action('genesis_post_content', 'genesis_do_post_title', 9);

// Remove default content for this Page Template
remove_action('genesis_post_content', 'genesis_do_post_image');
remove_action('genesis_post_content', 'genesis_do_post_content');

// Add Featured Image for the Portfolio posts in this Page Template
add_action('genesis_post_content', 'crystal_portfolio_do_post_image');
function crystal_portfolio_do_post_image() {
    $img = genesis_get_image( array( 'format' => 'html', 'size' => 'Portfolio Thumbnail', 'attr' => array( 'class' => 'alignnone post-image' ) ) );
    printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute('echo=0'), $img );
}

// Add Content for the Portfolio posts in this Page Template
add_action('genesis_post_content', 'crystal_portfolio_do_post_content');
function crystal_portfolio_do_post_content() {
    
    if ( genesis_get_option('crystal_portfolio_content') == 'excerpts' ) {
        the_excerpt();
    
    } else {
        if ( genesis_get_option('crystal_portfolio_content_archive_limit') )
            the_content_limit( (int)genesis_get_option('crystal_portfolio_content_archive_limit'), __('View Project', 'crystal') );
        else
            the_content(__('View Project', 'crystal'));
    }
} 

// Clear float using genesis_custom_loop() $loop_counter variable
// Outputs clearing div after every 4 posts
// $loop_counter is incremented after this function is run
add_action('genesis_after_post', 'portfolio_after_post');
function portfolio_after_post() {
    global $loop_counter;
    
    if ( $loop_counter == 3 ) {
        $loop_counter = -1;
        echo '<div class="clear"></div>';
    }
}

// Remove standard loop
remove_action('genesis_loop', 'genesis_do_loop');

// Add custom loop
add_action('genesis_loop', 'portfolio_loop');
function portfolio_loop() {
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    
    $include = genesis_get_option('crystal_portfolio_cat');
    $exclude = genesis_get_option('crystal_portfolio_cat_exclude') ? explode(',', str_replace(' ', '', genesis_get_option('crystal_portfolio_cat_exclude'))) : '';
        
    $cf = genesis_get_custom_field('query_args'); // Easter Egg
    $args = array('cat' => $include, 'category__not_in' => $exclude, 'showposts' => genesis_get_option('crystal_portfolio_cat_num'), 'paged' => $paged);
    $query_args = wp_parse_args($cf, $args);
    
    genesis_custom_loop( $query_args );
}

genesis();