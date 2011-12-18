<?php
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'focus_grid_loop_helper' );
/** Add support for Genesis Grid Loop **/
function focus_grid_loop_helper() {
	if ( function_exists( 'genesis_grid_loop' ) ) {
		genesis_grid_loop( array(
			'features'				=> 2,
			'feature_image_size'	=> 0,
			'feature_image_class'	=> 'alignleft post-image',
			'feature_content_limit'	=> 0,
			'grid_image_size'		=> 'grid-thumbnail',
			'grid_image_class'		=> 'alignleft post-image',
			'grid_content_limit'	=> 0,
			'more'					=> __( '[Continue reading&hellip;]', 'genesis' ),
			'posts_per_page'		=> 6,
		) );
	} else {
		genesis_standard_loop();
	}
}

/** Remove the post meta function for front page only **/
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );

genesis();