<?php
/**
 * This file adds the Landing template to the Prose Child Theme.
 *
 * @author StudioPress
 * @package Prose
 * @subpackage Customisations
 */

/*
Template Name: Landing
*/

// Remove header, navigation, breadcrumbs
remove_action('genesis_header', 'genesis_header_markup_open', 5);
remove_action('genesis_header', 'genesis_do_header');
remove_action('genesis_header', 'genesis_header_markup_close', 15);
remove_action('genesis_before_header', 'genesis_do_nav');
remove_action('genesis_after_header', 'genesis_do_subnav');
remove_action('genesis_before_loop', 'genesis_do_breadcrumbs');
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);
remove_action('genesis_before_footer', 'prose_include_footer_widgets'); 

// Use the Genesis page.php template
require_once(PARENT_DIR . '/page.php');
?>