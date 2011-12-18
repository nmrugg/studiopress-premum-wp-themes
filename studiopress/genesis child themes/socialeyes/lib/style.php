<?php
// Add new box to the Genesis -> Theme Settings page
// Comment the following line to remove the color select option
add_action('admin_menu', 'socialeyes_add_style_settings_box', 11);
function socialeyes_add_style_settings_box() {
	global $_genesis_theme_settings_pagehook;
	add_meta_box('genesis-theme-settings-style', __('Social Eyes Color Style', 'genesis'), 'socialeyes_theme_settings_style_box', $_genesis_theme_settings_pagehook, 'column2');
}

function socialeyes_theme_settings_style_box() { ?>

	<p><label><?php _e('Stylesheet', 'genesis'); ?>: 
		<select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[style_selection]">
			<option style="padding-right:10px;" value=""><?php _e('Blue'); ?></option>		
			<option style="padding-right:10px;" value="social-pink" <?php selected('social-pink', genesis_get_option('style_selection')); ?>><?php _e('Pink'); ?></option>
		</select>
	</label></p>
	<p><span class="description">Please select the Social Eyes color style from the drop down list and save your settings.</span></p>

<?php
}

add_filter( 'body_class', 'socialeyes_style_body_class' );
function socialeyes_style_body_class( $classes ) {
	
	if ( $style = genesis_get_option( 'style_selection' ) ) {
		$classes[] = $style;
	}
	
	return $classes;
	
}