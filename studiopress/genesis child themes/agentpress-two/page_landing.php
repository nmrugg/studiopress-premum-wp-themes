<?php
/**
 * This file adds the Landing template to the AgentPress Child Theme.
 *
 * @author StudioPress
 * @package Agentpress
 * @subpackage Customizations
 */

/*
Template Name: Landing
*/

// Add custom body class to the head
add_filter( 'body_class', 'add_body_class' );
function add_body_class( $classes ) {
   $classes[] = 'agentpress-landing';
   return $classes;
}

// Remove header, navigation, top search. breadcrumbs, footer widgets, footer and disclaimer
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_before_header', 'genesis_do_subnav' );
remove_action( 'genesis_after_header', 'agentpress_top_search' );
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs');
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
remove_action( 'genesis_after', 'agentpress_disclaimer' );

genesis();