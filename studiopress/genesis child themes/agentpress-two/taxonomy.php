<?php
/**
 * The taxonomy archive template
 */

/** Force full width layout */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

/**
 * Remove the standard loop
 */
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', 'agentpress_listing_archive_loop' );
/**
 * Custom loop for listing archive page
 */
function agentpress_listing_archive_loop() {
	
	$toggle = '';
	
	if ( have_posts() ) : while ( have_posts() ) : the_post();
	
		$loop = ''; // init
			
		$loop .= sprintf( '<a href="%s">%s</a>', get_permalink(), genesis_get_image( array( 'size' => 'properties' ) ) );
		
		$loop .= sprintf( '<span class="listing-price">%s</span>', genesis_get_custom_field( '_listing_price' ) );
		$loop .= sprintf( '<span class="listing-text">%s</span>', genesis_get_custom_field( '_listing_text' ) );
		$loop .= sprintf( '<span class="listing-address">%s</span>', genesis_get_custom_field( '_listing_address' ) );
		$loop .= sprintf( '<span class="listing-city-state-zip">%s, %s %s</span>', genesis_get_custom_field( '_listing_city' ), genesis_get_custom_field( '_listing_state' ), genesis_get_custom_field('_listing_zip' ) );

		$loop .= sprintf( '<a href="%s" class="more-link">%s</a>', get_permalink(), __( 'View Listing', 'agentpress' ) );

		$toggle = $toggle == 'left' ? 'right' : 'left';
	
		/** wrap in post class div, and output **/
		printf( '<div class="%s"><div class="widget-wrap"><div class="listing-wrap">%s</div></div></div>', join( ' ', get_post_class( $toggle ) ), $loop );
		
	endwhile; endif;
	
}

genesis();