<?php
/** Start the engine */
require_once( get_template_directory() . '/lib/init.php' );
require_once( get_stylesheet_directory() . '/lib/style.php' );

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'AgentPress Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/themes/agentpress' );

$content_width = apply_filters( 'content_width', 600, 430, 920 );

/** Add new image sizes */
add_image_size( 'communities', 125, 80, TRUE );
add_image_size( 'featured', 100, 100, TRUE );
add_image_size( 'properties', 280, 200, TRUE );
add_image_size( 'slider', 590, 300, TRUE );

/** Add support for structural wraps */
add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'welcome', 'footer-widgets', 'footer', 'disclaimer' ) );

/** Add suport for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 125, 'textcolor' => '333' ) );

/** Reposition the secondary navigation */
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_header', 'genesis_do_subnav' );

/** Add top search after header */
add_action( 'genesis_after_header', 'agentpress_top_search' );
/**
 * Add top search widget area on Genesis after header hook
 *
 */
function agentpress_top_search() {
	if ( !is_front_page() && is_active_sidebar( 'top-search' ) ) {
		echo '<div class="top-search">';
		dynamic_sidebar( 'top-search' );
		echo '</div><!-- end .top-search -->';
	}	
}

/** Add support for 4 footer widgets */
add_theme_support( 'genesis-footer-widgets', 4 );

/** Add disclaimer below footer */
add_action( 'genesis_after', 'agentpress_disclaimer' );
/**
 * Add disclaimer widget area on Genesis after hook
 *
 */
function agentpress_disclaimer() {
	if ( is_active_sidebar( 'disclaimer' ) ) {
		echo '<div class="disclaimer">';
		genesis_structural_wrap( 'disclaimer' );
		dynamic_sidebar( 'disclaimer' );
		genesis_structural_wrap( 'disclaimer', 'close' );
		echo '</div><!-- end .disclaimer -->';
	}		
}

add_filter( 'agentpress_property_details', 'agentpress_property_details_filter' );
/**
 * Filter the property details array.
 *
 */
function agentpress_property_details_filter( $details ) {
	
	$details['col1'] = array( 
	    __( 'Price:', 'apl' ) => '_listing_price', 
	    __( 'Address:', 'apl' ) => '_listing_address', 
	    __( 'City:', 'apl' ) => '_listing_city', 
	    __( 'State:', 'apl' ) => '_listing_state', 
	    __( 'ZIP:', 'apl' ) => '_listing_zip' 
	);
	$details['col2'] = array( 
	    __( 'MLS #:', 'apl' ) => '_listing_mls', 
	    __( 'Square Feet:', 'apl' ) => '_listing_sqft', 
	    __( 'Bedrooms:', 'apl' ) => '_listing_bedrooms', 
	    __( 'Bathrooms:', 'apl' ) => '_listing_bathrooms', 
	    __( 'Basement:', 'apl' ) => '_listing_basement' 
	);
	
	return $details;
	
}

add_filter( 'agentpress_featured_listings_widget_loop', 'agentpress_featured_listings_widget_loop_filter' );
/**
 * Filter the loop output of the AgentPress Featured Listings Widget.
 *
 */
function agentpress_featured_listings_widget_loop_filter( $loop ) {
	
	$loop = ''; /** initialze the $loop variable */

	$loop .= sprintf( '<a href="%s">%s</a>', get_permalink(), genesis_get_image( array( 'size' => 'properties' ) ) );

	$loop .= sprintf( '<span class="listing-price">%s</span>', genesis_get_custom_field('_listing_price') );
	$custom_text = genesis_get_custom_field( '_listing_text' );
	if( strlen( $custom_text ) )
		$loop .= sprintf( '<span class="listing-text">%s</span>', esc_html( $custom_text ) );
	$loop .= sprintf( '<span class="listing-address">%s</span>', genesis_get_custom_field('_listing_address') );
	$loop .= sprintf( '<span class="listing-city-state-zip">%s %s, %s</span>', genesis_get_custom_field('_listing_city'), genesis_get_custom_field('_listing_state'), genesis_get_custom_field('_listing_zip') );

	$loop .= sprintf( '<a href="%s" class="more-link">%s</a>', get_permalink(), __( 'View Listing', 'apl' ) );
	
	return $loop;
	
}

/** Register widget areas */
genesis_register_sidebar( array(
	'id'			=> 'top-search',
	'name'			=> __( 'Top Search', 'agentpress' ),
	'description'	=> __( 'This is the top search section.', 'agentpress' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'slider',
	'name'			=> __( 'Slider', 'agentpress' ),
	'description'	=> __( 'This is the slider section.', 'agentpress' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'property-search',
	'name'			=> __( 'Property Search', 'agentpress' ),
	'description'	=> __( 'This is the property search section.', 'agentpress' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'welcome',
	'name'			=> __( 'Welcome', 'agentpress' ),
	'description'	=> __( 'This is the welcome section.', 'agentpress' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'properties',
	'name'			=> __( 'Properties', 'agentpress' ),
	'description'	=> __( 'This is the properties section.', 'agentpress' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'communities',
	'name'			=> __( 'Communities', 'agentpress' ),
	'description'	=> __( 'This is the communities section.', 'agentpress' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'featured-bottom-left',
	'name'			=> __( 'Featured Bottom Left', 'agentpress' ),
	'description'	=> __( 'This is the featured bottom left section.', 'agentpress' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'featured-bottom-right',
	'name'			=> __( 'Featured Bottom Right', 'agentpress' ),
	'description'	=> __( 'This is the featured bottom right section.', 'agentpress' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'disclaimer',
	'name'			=> __( 'Disclaimer', 'agentpress' ),
	'description'	=> __( 'This is the disclaimer section.', 'agentpress' ),
) );