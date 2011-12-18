<?php
/** Add new box to the Genesis -> Theme Settings page **/
/** Comment the following line to remove the color select option **/
add_action( 'admin_menu', 'focus_add_style_settings_box', 11 );
function focus_add_style_settings_box() {
	global $_genesis_theme_settings_pagehook;
	add_meta_box( 'genesis-theme-settings-style', __( 'Focus Color Style', 'pretty' ), 'focus_theme_settings_style_box', $_genesis_theme_settings_pagehook, 'column2' );
}

/** Used by focus_add_style_settings_box() **/
function focus_theme_settings_style_box() { ?>

	<p><label><?php _e( 'Stylesheet', 'focus' ); ?>:
		<select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[style_selection]">
			<option style="padding-right:10px;" value=""><?php _e( 'Default', 'focus' ); ?></option>
			<option style="padding-right:10px;" value="focus-blue" <?php selected( 'focus-blue', genesis_get_option( 'style_selection' ) ); ?>><?php _e( 'Focus Blue', 'focus' ); ?></option>
			<option style="padding-right:10px;" value="focus-black" <?php selected( 'focus-black', genesis_get_option( 'style_selection' ) ); ?>><?php _e( 'Focus Black', 'focus' ); ?></option>
		</select>
	</label></p>
	<p><span class="description">Please select the Focus color style from the drop down list and save your settings.</span></p>

<?php
}

/** Add Style Selection to body tag classes. **/
add_filter( 'body_class', 'focus_style_body_class' );
function focus_style_body_class( $classes ) {

	if ( $style = genesis_get_option( 'style_selection' ) ) {
		$classes[] = $style;
	}

	return $classes;

}