<?php
/*
Template Name: Landing
*/

add_filter( 'genesis_pre_get_option_site_layout', 'lifestyle_landing_page_layout' );
/**
 * Filter the layout option to force full width.
 *
 */
function lifestyle_landing_page_layout( $opt ) {
	return 'full-width-content';
}

/** Remove navigation, breadcrumbs, footer */
remove_action('genesis_before_header', 'genesis_do_nav');
remove_action('genesis_after_header', 'genesis_do_subnav');
remove_action('genesis_before_loop', 'genesis_do_breadcrumbs');
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);
remove_action('genesis_before_footer', 'prose_include_footer_widgets');

genesis();