<?php
/**
 * This file controls inclusion of a Custom Header within the site.
 *
 * @package Prose
 * @author StudioPress & Gary Jones
 */

/**
 * Defines a value used by WordPress, as empty.
 */
define('HEADER_TEXTCOLOR', '');

/**
 * Defines a value used by WordPress. 940 is the default width of the layout.
 */
define('HEADER_IMAGE_WIDTH', 940);

/**
 * Defines a value used by WordPress. Set to the design setting value.
 */
define('HEADER_IMAGE_HEIGHT', prose_get_design_option('header_image_height'));
add_custom_image_header('prose_custom_header_style', 'prose_custom_header_admin_style');


/**
 * Styling included at the top of the site page for a custom header.
 * 
 * @author StudioPress
 */
function prose_custom_header_style() { 
    if ( get_header_image() ) {?>
<!-- custom-header styling --><style type="text/css">
#header{background:url(<?php header_image(); ?>) scroll no-repeat 0 0;}
<?php if ( get_theme_mod('header_textcolor') && get_theme_mod('header_textcolor') != 'blank' ){ ?>
#title-area #title a, #title-area #title a:hover{color:#<?php header_textcolor(); ?>;}
#title-area #description{color: #<?php header_textcolor(); ?>;}
<?php } ?>
</style>
<?php
    }
}

/**
 * Styling included at the top of the custom-header admin page.
 * 
 * @author StudioPress
 */
function prose_custom_header_admin_style() {
    $background_color = ( 'hex' == prose_get_design_option('header_background_color_select') ) ? prose_get_design_option('header_background_color') : prose_get_design_option('header_background_color_select');
?>
<style type="text/css">
#headimg {
    background-repeat:no-repeat;
    background-color: <?php echo $background_color; ?>;
    width: 940px;
    height: <?php echo prose_get_design_option('header_image_height'); ?>px;
}
#headimg h1 {
    font-family: Georgia, serif;
    font-size: 30px;
    font-weight: normal;
    line-height: 36px;
    margin: 0; 
    padding: <?php echo prose_get_design_option('header_top_padding'); ?>px 0 0 <?php echo prose_get_design_option('header_left_padding'); ?>px;
}
#headimg h1 a {
    color:#333333;
    text-decoration:none;
}
#headimg #desc {
    color: #999999;
    font-family: Georgia, serif;
    font-size: 15px;
    font-style: italic;
    font-weight: normal;
    margin: 0; 
    padding: <?php echo prose_get_design_option('header_tagline_top_padding'); ?>px 0 0 <?php echo prose_get_design_option('header_tagline_left_padding'); ?>px;
}
</style>
<?php
}