<?php
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'magazine_home_loop_helper' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function magazine_home_loop_helper() {

	if ( is_active_sidebar( 'home-top' ) || is_active_sidebar( 'home-left' ) || is_active_sidebar( 'home-right' ) || is_active_sidebar( 'home-bottom' ) ) {

		if ( is_active_sidebar( 'home-top' ) ) {
			echo '<div class="home-top">';
			dynamic_sidebar( 'home-top' );
			echo '</div><!-- end .home-top -->';
		}

		if ( is_active_sidebar( 'home-left' ) || is_active_sidebar( 'home-right' ) ) {

			echo '<div class="home-middle">';

			if ( is_active_sidebar( 'home-left' ) ) {
				echo '<div class="home-left">';
				dynamic_sidebar( 'home-left' );
				echo '</div><!-- end .home-left -->';
			}

			if ( is_active_sidebar( 'home-right' ) ) {
				echo '<div class="home-right">';
				dynamic_sidebar( 'home-right' );
				echo '</div><!-- end .home-right -->';
			}
		
			echo '</div><!-- end .home-middle -->';
		
		}
		
		if ( is_active_sidebar( 'home-bottom' ) ) {
			echo '<div class="home-bottom">';
			dynamic_sidebar( 'home-bottom' );
			echo '</div><!-- end .home-bottom -->';
		}
		
	}
	
	else {
		genesis_standard_loop();
	}
	
}

genesis();