<?php
/**
 * This file handles the output on the homepage.
 */

add_action( 'genesis_after_header', 'enterprise_home_top_helper' );
/**
 * Conditionally add Home Top #1 (home-top-1) sidebar and WP-Cycle.
 */
function enterprise_home_top_helper() {

	echo '<div id="home-top-bg"><div id="home-top"><div class ="wrap">';

	if ( is_active_sidebar( 'home-top-1' ) ) {
		echo '<div class="home-top-1">';
		dynamic_sidebar( 'home-top-1' );
		echo '</div><!-- end .home-top-1 -->';
	}
	echo '<div class="home-top-2">';
	if ( function_exists( 'wp_cycle' ) )
		wp_cycle();
	echo '</div><!-- end .home-top-2 -->';
	echo '</div><!-- end .wrap --></div><!-- end #home-top --></div><!-- end #home-top-bg -->';

}

add_action( 'genesis_meta', 'enterprise_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function enterprise_home_genesis_meta() {

	if ( is_active_sidebar( 'home-middle-1' ) || is_active_sidebar( 'home-middle-2' ) || is_active_sidebar( 'home-middle-3' ) ) {

		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'enterprise_home_loop_helper' );
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	}
}

function enterprise_home_loop_helper() {

	echo '<div id="home-middle">';

	if ( is_active_sidebar( 'home-middle-1' ) ) {
		echo '<div class="home-middle-1">';
		dynamic_sidebar( 'home-middle-1' );
		echo '</div><!-- end .home-middle-1 -->';
	}

	if ( is_active_sidebar( 'home-middle-2' ) ) {
		echo '<div class="home-middle-2">';
		dynamic_sidebar( 'home-middle-2' );
		echo '</div><!-- end .home-middle-2 -->';
	}

	if ( is_active_sidebar( 'home-middle-3' ) ) {
		echo '<div class="home-middle-3">';
		dynamic_sidebar( 'home-middle-3' );
		echo '</div><!-- end .home-middle-3 -->';
	}

	echo '</div><!-- end #home-middle -->';

}

genesis();