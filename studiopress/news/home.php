<?php

add_action( 'genesis_meta', 'news_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function news_home_genesis_meta() {

	if ( is_active_sidebar( 'home-top' ) || is_active_sidebar( 'home-middle-left' ) || is_active_sidebar( 'home-middle-right' ) || is_active_sidebar( 'home-bottom' ) ) {
	
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'news_home_loop_helper' );
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
		add_filter( 'body_class', 'add_body_class' );
			function add_body_class( $classes ) {
   			$classes[] = 'news';
  			 return $classes;
		}

	}
}

function news_home_loop_helper() {

	if ( is_active_sidebar( 'home-top' ) ) {
	
		echo '<div id="home-top"><div class="border wrap">';
		dynamic_sidebar( 'home-top' );
		echo '</div><!-- end .border wrap --></div><!-- end #home-top -->';
		
	}
	
	if ( is_active_sidebar( 'home-middle-left' ) || is_active_sidebar( 'home-middle-right' ) ) {
	
		echo '<div id="home-middle"><div class="border wrap">';

			echo '<div class="home-middle-left">';
			dynamic_sidebar( 'home-middle-left' );
			echo '</div><!-- end .home-middle-left -->';

			echo '<div class="home-middle-right">';
			dynamic_sidebar( 'home-middle-right' );
			echo '</div><!-- end .home-middle-right -->';
		
		echo '</div><!-- end .border wrap --></div><!-- end #home-middle -->';
		
	}
	
	if ( is_active_sidebar( 'home-bottom' ) ) {
	
		echo '<div id="home-bottom"><div class="border wrap">';
		dynamic_sidebar( 'home-bottom' );
		echo '</div><!-- end .border wrap --></div><!-- end #home-bottom -->';
		
	}

}

genesis();