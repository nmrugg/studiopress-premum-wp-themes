<?php

add_action( 'genesis_meta', 'corporate_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function corporate_home_genesis_meta() {

	if ( is_active_sidebar( 'featured' ) || is_active_sidebar( 'home-middle-1' ) || is_active_sidebar( 'home-middle-2' ) || is_active_sidebar( 'home-middle-3' ) ) {

		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'corporate_home_loop_helper' );
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	}
}

/**
 * Display widget content for "featured" and "home-middle" sections
 *
 */
function corporate_home_loop_helper() {

	echo '<div id="featured"><div class="wrap">';
	dynamic_sidebar( 'featured' );
	echo '</div></div><!-- end #featured -->';

	echo '<div id="home-middle"><div class="wrap">';

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
		
	echo '</div></div><!-- end #home-bottom -->';
}

genesis();