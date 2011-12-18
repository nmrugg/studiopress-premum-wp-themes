<?php
/** Add home top widget area */
add_action( 'genesis_before_loop', 'blissful_home_top' );
function blissful_home_top() {
	dynamic_sidebar( 'home-top' );
}

genesis();