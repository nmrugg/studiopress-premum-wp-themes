<?php

add_action( 'genesis_meta', 'scribble_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function scribble_home_genesis_meta() {

	if ( is_active_sidebar( 'welcome' ) || is_active_sidebar( 'about' ) || is_active_sidebar( 'blog' ) || is_active_sidebar( 'photos' ) || is_active_sidebar( 'services' )  || is_active_sidebar( 'contact' ) ) {

		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'scribble_home_loop_helper' );
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	}
}

function scribble_home_loop_helper() {

	if ( is_active_sidebar( 'welcome' ) ) {
		echo '<div id="welcome"><div class="wrap">';
		dynamic_sidebar( 'welcome' );
		echo '</div><!-- end .wrap --></div><!-- end .welcome -->';
	}

	if ( is_active_sidebar( 'about' ) ) {
		echo '<div id="about"><div class="wrap">';
		dynamic_sidebar( 'about' );
		echo '<div class="clear top"><p><a href="#wrap">To the Top</a></p></div><!-- end .clear .top --></div><!-- end .wrap --></div><!-- end .about -->';
	}

	if ( is_active_sidebar( 'blog' ) ) {
		echo '<div id="blog"><div class="wrap">';
		dynamic_sidebar( 'blog' );
		echo '<div class="clear top"><p><a href="#wrap">To the Top</a></p></div><!-- end .clear .top --></div><!-- end .wrap --></div><!-- end .blog -->';
	}

	if ( is_active_sidebar( 'photos' ) ) {
		echo '<div id="photos"><div class="wrap">';
		dynamic_sidebar( 'photos' );
		echo '<div class="clear top"><p><a href="#wrap">To the Top</a></p></div><!-- end .clear .top --></div><!-- end .wrap --></div><!-- end .photos -->';
	}

	if ( is_active_sidebar( 'services' ) ) {
		echo '<div id="services"><div class="wrap">';
		dynamic_sidebar( 'services' );
		echo '<div class="clear top"><p><a href="#wrap">To the Top</a></p></div><!-- end .clear .top --></div><!-- end .wrap --></div><!-- end .services -->';
	}

	if ( is_active_sidebar( 'contact' ) ) {
		echo '<div id="contact"><div class="wrap">';
		dynamic_sidebar( 'contact' );
		echo '<div class="clear top"><p><a href="#wrap">To the Top</a></p></div><!-- end .clear .top --></div><!-- end .wrap --></div><!-- end .contact -->';
	}

}

genesis();