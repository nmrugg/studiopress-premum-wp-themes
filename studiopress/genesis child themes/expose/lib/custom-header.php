<?php
if(genesis_get_option('header_custom') == 1) {

define('HEADER_TEXTCOLOR', '');
define('HEADER_IMAGE', CHILD_URL . '/images/header.png');
define('HEADER_IMAGE_WIDTH', 960);
define('HEADER_IMAGE_HEIGHT', genesis_get_option('header_height'));

add_custom_image_header('header_style', 'admin_header_style');

// Gets included in the site header
function header_style() { ?>
	<style type="text/css">
        #header {
            background: url(<?php header_image(); ?>) scroll no-repeat 0 0;
			height: <?php echo genesis_get_option('header_height') ?>px;
        }
		.header-image #title-area, .header-image #title-area #title, .header-image #title-area #title a {
            height: <?php echo genesis_get_option('header_height') ?>px;
		}
	<?php if ( get_theme_mod('header_textcolor') && get_theme_mod('header_textcolor') != 'blank' ){ ?>
		#title-area #title a, #title-area #title a:hover {color: #<?php header_textcolor(); ?>}
		#title-area #description {color: #<?php header_textcolor(); ?>}
	<?php } ?>
    </style>
<?php }
// Gets included in the admin header
function admin_header_style() { ?>
	<style type="text/css">
        #headimg {
			background-repeat:no-repeat;
            width: 960px;
            height: <?php echo genesis_get_option('header_height') ?>px;
        }
		#headimg h1 {
			color:#FFFFFF;
			font-family:Georgia,Times New Roman,Trebuchet MS;
			font-size:30px;
			font-weight:normal;
			line-height:36px;
			margin:0;
			padding:0 0 0 20px;
			text-decoration:none;
		}
		#headimg h1 a {
			color:#FFFFFF;
			text-decoration:none;
		}
		#headimg #desc {
			color:#FFFFFF;
			font-size:14px;
			font-style:italic;
			font-weight:normal;
			margin:0;
			padding:0 0 0 20px;
		}
    </style>
<?php }}

// Add new box to the Genesis -> Theme Settings page
add_action('admin_menu', 'lifestyle_add_settings_boxes', 11);
function lifestyle_add_settings_boxes() {
	global $_genesis_theme_settings_pagehook;
	
	add_meta_box('genesis-theme-settings-header', __('Header Image Settings', 'lifestyle'), 'lifestyle_theme_settings_header_box', $_genesis_theme_settings_pagehook, 'column2');
}

function lifestyle_theme_settings_header_box() { ?>
	<p><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[header_custom]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[header_custom]" value="1" <?php checked(1, genesis_get_option('header_custom')); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[header_custom]"><?php _e("Enable Custom Header?", 'genesis'); ?></label>
	</select></p>
	<p><label><?php _e('Header Image Height', 'lifestyle'); ?>: <input style="margin:0 5px 0 0;text-align:center;" type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[header_height]" value="<?php genesis_option('header_height'); ?>" size="2" />px</label></p>
<?php
}

// Add new default values for the Custom Header
add_filter('genesis_theme_settings_defaults', 'lifestyle_header_defaults');
function lifestyle_header_defaults($defaults) {

	$defaults['header_height'] = 100;
	$defaults['header_custom'] = 0;
 
	return $defaults;
}
?>