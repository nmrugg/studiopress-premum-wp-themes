<?php
/*
Template Name: Portfolio
*/

/** Force the full width layout on the Portfolio page */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

/** Remove the standard loop */
remove_action( 'genesis_loop', 'genesis_do_loop' );

/** Add the Portfolio widget area */
add_action( 'genesis_loop', 'balance_portfolio_widget' );
function balance_portfolio_widget() {
	dynamic_sidebar( 'portfolio' );
}

genesis();