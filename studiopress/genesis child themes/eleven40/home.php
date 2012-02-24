<?php

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'eleven40_grid_loop_helper' );
/** Add support for Genesis Grid Loop */
function eleven40_grid_loop_helper() {

	if ( function_exists( 'genesis_grid_loop' ) ) {
		genesis_grid_loop( array(
			'features' => 1,
			'feature_image_size' => 0,
			'feature_image_class' => 'alignleft post-image',
			'feature_content_limit' => 0,
			'grid_image_size'		=> 'grid-thumbnail',
			'grid_image_class'		=> 'alignnone',
			'grid_content_limit' => 250,
			'more' => __( '[Continue reading]', 'genesis' ),
			'posts_per_page' => 5,
		) );
	} else {
		genesis_standard_loop();
	}

}

genesis();