<?php

add_action( 'genesis_meta', 'nitrous_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function nitrous_home_genesis_meta() {

	if ( is_active_sidebar( 'featured' ) || is_active_sidebar( 'welcome' ) || is_active_sidebar( 'portfolio' ) ) {

		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'nitrous_home_loop_helper' );
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	}
}

/**
 * Display widget content for "featured", "welcome"  and "portfolio" sections.
 *
 */
function nitrous_home_loop_helper() {

		if ( is_active_sidebar( 'featured' ) ) {
			echo '<div class="featured">';
			dynamic_sidebar( 'featured' );
			echo '</div><!-- end .featured -->';
		}
		
		if ( is_active_sidebar( 'welcome' ) ) {
			echo '<div class="welcome">';
			dynamic_sidebar( 'welcome' );
			echo '</div><!-- end .welcome -->';
		}
				
		if ( is_active_sidebar( 'portfolio' ) ) {
			echo '<div class="portfolio">';
			dynamic_sidebar( 'portfolio' );
			echo '</div><!-- end .portfolio -->';
		}
		
}

genesis();