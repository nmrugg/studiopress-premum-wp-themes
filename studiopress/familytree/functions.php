<?php
/**
 * Customisations for Family Tree theme.
 *
 * @package FamilyTree
 * @subpackage Customisations
 * @author CreativityIncluded
 */

/**
 * Reference Genesis files (START THE ENGINE).
 *
 * Required - do not remove.
 *
 * @since 1.0
 */
require_once(TEMPLATEPATH . '/lib/init.php');

/**
 * Reference the EasySlider Widget.
 *
 * @since 1.2
 */
require_once(CHILD_DIR . '/lib/widgets/slider.php');

/**#@+
 * Add custom image sizes.
 *
 * @since 1.0
 */
add_image_size( 'slider', 875, 580, false );
add_image_size( 'home featured', 420, 278, true );
add_image_size( 'footer widget', 235, 156, true );
add_image_size( 'one column', 850, 563, true );
add_image_size( 'two column', 575, 388, true );
add_image_size( 'three column', 490, 325, true );
add_image_size( 'three column alt', 430, 285, true );
add_image_size( 'sidebar', 262, 175, true );
add_image_size( 'sidebar alt', 115, 77, true );
/**#@-*/

/**
 * Add WordPress custom background support.
 *
 * @since 1.0
 */
add_custom_background();

/**
 * Add Genesis Custom header support.
 *
 * Requires Genesis 1.6+ to work.
 *
 * @since 1.2
 */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 230, 'header_image' => CHILD_URL . '/images/header_shape.png' ) );

/**
 * Add Genesis Footer Widgets support.
 *
 * Three footer widgets. Requires Genesis 1.6+
 *
 * @since 1.2
 */
add_theme_support( 'genesis-footer-widgets', 3 );

add_action( 'get_header', 'familytree_load_scripts' );
/**
 * Enqueue slider scripts on front-end.
 *
 * @since 1.0
 */
function familytree_load_scripts() {

	if ( ! is_admin() ) {
		wp_enqueue_script( 'jflow', CHILD_URL . '/lib/js/jflow.plus.js', array( 'jquery' ), '1.2', true );
		wp_enqueue_script( 'myscripts', $src = CHILD_URL . '/lib/js/scripts.js', array( 'jquery', 'jflow' ), '1.0', true );
	}

}

add_filter( 'genesis_options', 'familytree_home_layout', 10, 2 );
/**
 * Force layout on home page.
 *
 * The following values can be used for the site layout:
 *  fullwidth
 *  content-sidebar
 *  sidebar-content
 *  content-sidebar-sidebar
 *  sidebar-sidebar-content
 *  sidebar-content-sidebar
 *
 * @since 1.0
 *
 * @param string $options
 * @param string $setting
 * @return string
 */
function familytree_home_layout( $options, $setting ) {

	if ( GENESIS_SETTINGS_FIELD == $setting && is_home() )
		$options['site_layout'] = 'fullwidth';
	return $options;

}

add_shortcode( 'copyright', 'familytree_copyright_shortcode' );
/**
 * Copyright shortcode.
 *
 * Usage: [copyright]Your content here[/copyright]
 *
 * @since 1.2
 *
 * @param array $atts
 * @param string $content
 * @return string HTML
 */
function familytree_copyright_shortcode( $atts, $content = '' ) {

	return '<p class="copyright">' . $content . '</p>';

}

function featured_image_shortcode($atts, $content='') {
	if(!function_exists('featured_image_shortcode'))
		return;
		
        if(!$atts['size'])
		$atts['size'] = 'thumbnail';
        
        return '<div class="featured-image">'.get_the_post_thumbnail(null, $atts['size']).'</div>';
}

add_shortcode( 'featured_image', 'familytree_featured_image_shortcode' );
/**
 * Featured Image shortcode.
 *
 * If no size attribute is given, then 'thumbnail' is used.
 *
 * Usage:
 *  [featured_image size="one column"]
 *  [featured_image size="two column"]
 *  [featured_image size="three column"]
 *
 * @since 1.2
 *
 * @param string $atts
 * @param string $content
 * @return type
 */
function familytree_featured_image_shortcode( $atts, $content = '' ) {

	if ( ! function_exists( 'familytree_featured_image_shortcode' ) )
		return;

	if ( ! $atts['size'] )
		$atts['size'] = 'thumbnail';

	return '<div class="featured-image">' . get_the_post_thumbnail( null, $atts['size'] ) . '</div>';

}

add_filter( 'genesis_search_text', 'familytree_search_text' );
/**
 * Amend the search placeholder text.
 *
 * &#x2026; is the hexadecimal encoding for an ellipsis ( ... )
 *
 * @since 1.0
 *
 * @param string $text
 * @return string
 */
function familytree_search_text( $text ) {

	return esc_attr( __( 'Search our site&#x2026;', 'familytree' ) );

}

add_filter( 'genesis_search_button_text', 'familytree_search_button_text' );
/**
 * Amend the search button text.
 *
 * @since 1.0
 *
 * @param string $text
 * @return string
 */
function familytree_search_button_text( $text ) {

	return esc_attr( __( 'Go', 'familytree') );

}

add_filter( 'genesis_breadcrumb_args', 'familytree_breadcrumb_args' );
/**
 * Amend breadcrumb arguments.
 *
 * @since 1.0
 * @author Gary Jones
 * @link http://dev.studiopress.com/modify-breadcrumb-display.htm
 *
 * @param array $args Default breadcrumb arguments
 * @return array Amended breadcrumb arguments
 */
function familytree_breadcrumb_args( $args ) {

	$args['sep'] = ' | ';
	$args['labels']['prefix'] = '';
	return $args;

}

add_action( 'template_redirect', 'familytree_conditional_actions' );
/**
 * Switch out default Genesis post info creation for Family Tree version.
 *
 * @since 1.0
 */
function familytree_conditional_actions() {

	if ( is_page_template( 'page_blog.php' ) || is_post_type_archive() || is_singular( 'post' ) ) {
		remove_action( 'genesis_before_post_content', 'genesis_post_info' );
		add_action( 'genesis_before_post_content', 'familytree_post_info' );
	}

}

/**
 * Create custom post info function.
 *
 * This is done to mark up the post date.
 *
 * @since 1.0
 */
function familytree_post_info() {

	?>
	<div class="post-date-wrap">
		<div class="post-date">
			<div class="month"><?php echo the_time( 'M' ); ?></div>
			<div class="day"><?php echo the_time( 'j' ); ?></div>
			<div class="year"><?php echo the_time( 'Y' ); ?></div>
		</div>
	</div>
	<div class="post-info"><?php
		echo do_shortcode( '[post_comments zero="0 Comments" one="1 Comment" more="% Comments"]' );
		edit_post_link( __( 'Edit', 'child' ), '', '' ); /* if logged in */ ?>
	</div>
	<?php

}

add_filter( 'genesis_post_comments_shortcode', 'familytree_post_comments_shortcode' );
/**
 * Modify the Comment Count Number when using the  Genesis shortcode.
 *
 * @since 1.2
 * @author Gary Jones
 * @link http://dev.studiopress.com/style-comment-number.htm
 *
 * @param string $output HTML markup
 * @return string HTML markup
 */
function familytree_post_comments_shortcode( $output ) {

	return preg_replace( '/#comments"\>(\d+)/', '#comments"><span class="comment-numbers">${1}</span>', $output );

}

add_filter( 'get_the_excerpt', 'familytree_amend_excerpt' );
/**
 * Amend end of excerpts to include a read more link.
 *
 * @since 1.0
 *
 * @param string $text Excerpt content
 * @return string Amended excerpt content
 */
function familytree_amend_excerpt( $text ) {

	return str_replace( ' [...]', '&#x2026; <a href=' . get_permalink() . '>' . __( 'read more &#xbb;', 'familytree' ) . '</a>', $text );

}

add_filter( 'genesis_footer_output', 'familytree_footer_output_filter', 10, 3 );
/**
 * Amend footer content.
 *
 * @since 1.0
 *
 * @param string $output
 * @param string $creds_text
 * @return string HTML markup
 */
function familytree_footer_output_filter( $output, $creds_text ) {

	$backtotop_text = '[footer_backtotop]';

	$creds_text_start = 'Copyright [footer_copyright] ';

	$creds_text_end = ' | <a href="http://www.studiopress.com/themes/genesis" target="_blank">Genesis Theme Framework</a> by <a href="http://www.studiopress.com/" target="_blank">StudioPress</a> | <a href="http://www.studiopress.com/themes/familytree" target="_blank">Family Tree Child Theme</a> by <a href="http://www.creativityincluded.com/" target="_blank">Creativity Included</a> | [footer_wordpress_link] | [footer_loginout]';

	$output = '<div class="wrap-inside"><div class="creds">' . $creds_text_start . $creds_text_end . '</div></div><div class="gototop">' . $backtotop_text . '</div>';
	return $output;

}

add_filter( 'genesis_comment_list_args', 'child_comment_list_args' );
/**
 * Amend avatar size for comments.
 *
 * @since 1.2
 *
 * @param array $args Existing comment list arguments
 * @return array Amended arguments
 */
function child_comment_list_args( $args ) {

	$args['avatar_size'] = 30;
	return $args;

}

add_filter( 'gallery_style', 'familytree_remove_gallery_styles' );
/**
 * Remove native gallery internal style sheets added by WordPress to the front-end.
 *
 * @since 1.0
 *
 * @param string $css HTML internal stylesheet
 * @return string Empty string
 */
function familytree_remove_gallery_styles( $css ) {

	return preg_replace("#<style type=\'text/css\'>(.*?)</style>#s", '', $css);

}

/**
 * Register Home Main sidebar.
 *
 * @since 1.2
 */
genesis_register_sidebar( array(
	'name' => 'Home Main',
	'description' => 'Use this widget to display a Featured Post or Page widget or Slider widget',
) );

/**
 * Register Home Ads sidebar.
 *
 * @since 1.0
 */
genesis_register_sidebar( array(
	'name' => 'Home Ads',
	'description' => 'Use this widget area to display advertising using the Ad-minister plug-in or text widgets',
) );