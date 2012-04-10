<?php
// Force the excerpt
remove_action('genesis_post_content', 'genesis_do_post_content');
add_action('genesis_post_content', 'the_excerpt');

// Remove the archive thumbnail from the home page
remove_action('genesis_post_content', 'genesis_do_post_image');

//	Add featured image above title on teasers
add_action('genesis_before_post_title', 'expose_homepage_teaser_image');
function expose_homepage_teaser_image() {
	global $loop_counter;
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	
	printf( '<p><a href="%s">%s</a></p>', get_permalink(), genesis_get_image( array( 'format' => 'html', 'size'=> 'Featured' ) ) );

}

// Add .portfolio-posts class to every post, except first 2
add_filter('post_class', 'expose_homepage_post_class');
function expose_homepage_post_class( $classes ) {
	global $loop_counter;
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
		
	$classes[] = 'portfolio-posts';
		
	return $classes;
}

add_filter('the_excerpt', 'expose_homepage_excerpt_filter');
function expose_homepage_excerpt_filter( $text ) {
	return sprintf( '%s<p><a class="alignright" href="%s">Read More &rarr;</a></p>', $text, get_permalink() );
}

require_once(PARENT_DIR . '/index.php');