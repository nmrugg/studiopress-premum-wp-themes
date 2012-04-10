<?php

add_action( 'genesis_meta', 'associate_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function associate_home_genesis_meta() {

	if ( is_active_sidebar( 'featured' ) || is_active_sidebar( 'home-middle-1' ) || is_active_sidebar( 'home-middle-2' ) || is_active_sidebar( 'home-middle-3' ) || is_active_sidebar( 'home-bottom-1' ) || is_active_sidebar( 'home-bottom-2' ) ) {

		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'associate_home_loop_helper' );
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	}
}

function associate_home_loop_helper() {

	if ( is_active_sidebar( 'featured' ) ) {
		echo '<div class="featured">';
		dynamic_sidebar( 'featured' );
		echo '</div><!-- end .featured -->';
	}
	
	echo '<div class="home-middle">';
	
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
	
	echo '</div><!-- end .home-middle -->';
	
	echo '<div class="home-bottom">';
	
	if ( is_active_sidebar( 'home-bottom-1' ) ) {
		echo '<div class="home-bottom-1">';
		dynamic_sidebar( 'home-bottom-1' );
		echo '</div><!-- end .home-bottom-1 -->';
	}
	
	if ( is_active_sidebar( 'home-bottom-2' ) ) {
		echo '<div class="home-bottom-2">';
		dynamic_sidebar( 'home-bottom-2' );
		echo '</div><!-- end .home-bottom-2 -->';
	}
	
	echo '</div><!-- end .home-bottom -->';
	
}

genesis();