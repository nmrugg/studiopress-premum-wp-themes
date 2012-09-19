<?php

add_action( 'genesis_meta', 'balance_home_genesis_meta' );
/**
 * Add widget support for homepage.
 *
 */
function balance_home_genesis_meta() {

	if ( is_active_sidebar( 'home-featured-left' ) || is_active_sidebar( 'home-featured-right' ) ) {
	
		add_action( 'genesis_after_header', 'balance_home_loop_helper' );

	}
}

/**
 * Display widget content for home featured sections.
 *
 */
function balance_home_loop_helper() {

	if ( is_active_sidebar( 'home-featured-left' ) || is_active_sidebar( 'home-featured-right' ) ) {

			echo '<div id="home-featured"><div class="wrap clearfix">';

			echo '<div class="home-featured-left">';
			dynamic_sidebar( 'home-featured-left' );
			echo '</div><!-- end .home-featured-left -->';	

			echo '<div class="home-featured-right">';
			dynamic_sidebar( 'home-featured-right' );
			echo '</div><!-- end .home-featured-right -->';

			echo '</div><!-- end .wrap --></div><!-- end #home-featured -->';	

		}

}

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'child_grid_loop_helper' );
/** Add support for Genesis Grid Loop **/
function child_grid_loop_helper() {

	if ( function_exists( 'genesis_grid_loop' ) ) {
	
		genesis_grid_loop( array(
			'features' => 1,
			'feature_image_size' => 0,
			'feature_image_class' => 'align none post-image',
			'feature_content_limit' => 0,
			'grid_image_size' => 'grid',
			'grid_image_class' => 'align none post-image',
			'grid_content_limit' => 0,
			'more' => __( 'Continue reading...', 'genesis' ),
			'posts_per_page' => 5,
		) );

	}

	else {
		genesis_standard_loop();
	}

}

genesis();