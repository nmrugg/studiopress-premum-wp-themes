<?php
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'lifestyle_home_loop_helper' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function lifestyle_home_loop_helper() {

	if ( is_active_sidebar( 'home' ) || is_active_sidebar( 'home-left' ) || is_active_sidebar( 'home-right' ) ) {

		dynamic_sidebar( 'home' );

		if ( is_active_sidebar( 'home-left' ) ) {
			echo '<div id="homepage-left">';
			dynamic_sidebar( 'home-left' );
			echo '</div><!-- end #homepage-left -->';
		}

		if ( is_active_sidebar( 'home-right' ) ) {
			echo '<div id="homepage-right">';
			dynamic_sidebar( 'home-right' );
			echo '</div><!-- end #homepage-right -->';
		}
		
	}
	else {
		genesis_standard_loop();
	}
	
}

genesis();