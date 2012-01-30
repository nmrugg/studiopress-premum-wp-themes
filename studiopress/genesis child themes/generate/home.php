<?php

/** Add Generate Box after header **/
add_action( 'genesis_after_header', 'generate_box', 10 );
function generate_box() {

	if ( is_active_sidebar( 'generate-box' ) ) {
		echo '<div id="generate-box"><div class="wrap">';
		dynamic_sidebar( 'generate-box' );
		echo '</div><!-- end .wrap --></div><!-- end #generate-box -->';
	}

}

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'child_grid_loop_helper' );
/** Add support for Genesis Grid Loop **/
function child_grid_loop_helper() {

	if ( function_exists( 'genesis_grid_loop' ) ) {
		remove_action( 'genesis_before_post_content', 'generate_post_image', 5 );
		genesis_grid_loop( array(
			'features' => 2,
			'feature_image_size' => 'featured',
			'feature_image_class' => 'alignleft post-image',
			'feature_content_limit' => 0,
			'grid_image_size' => 'grid',
			'grid_image_class' => 'alignleft post-image',
			'grid_content_limit' => 0,
			'more' => __( 'Continue reading...', 'genesis' ),
			'posts_per_page' => 6,
		) );
	} else {
		genesis_standard_loop();
	}

}

genesis();