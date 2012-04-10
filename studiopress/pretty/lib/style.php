<?php
/** Add new box to the Genesis -> Theme Settings page **/
/** Comment the following line to remove the color select option **/
add_action( 'admin_menu', 'pretty_add_style_settings_box', 11 );
function pretty_add_style_settings_box() {
	global $_genesis_theme_settings_pagehook;
	add_meta_box( 'genesis-theme-settings-style', __( 'Pretty Young Thing Color Style', 'pretty' ), 'pretty_theme_settings_style_box', $_genesis_theme_settings_pagehook, 'column2' );
}

/** Used by pretty_add_style_settings_box() **/
function pretty_theme_settings_style_box() { ?>

	<p><label><?php _e( 'Stylesheet', 'pretty' ); ?>:
		<select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[style_selection]">
			<option style="padding-right:10px;" value=""><?php _e( 'Default', 'pretty' ); ?></option>
			<option style="padding-right:10px;" value="pretty-pink" <?php selected( 'pretty-pink', genesis_get_option( 'style_selection' ) ); ?>><?php _e( 'Pretty Pink', 'pretty' ); ?></option>
			<option style="padding-right:10px;" value="pretty-yellow" <?php selected( 'pretty-yellow', genesis_get_option( 'style_selection' ) ); ?>><?php _e( 'Pretty Yellow', 'pretty' ); ?></option>
		</select>
	</label></p>
	<p><span class="description">Please select the Pretty Young Thing color style from the drop down list and save your settings.</span></p>

<?php
}

/** Add Style Selection to body tag classes. **/
add_filter( 'body_class', 'pretty_style_body_class' );
function pretty_style_body_class( $classes ) {

	if ( $style = genesis_get_option( 'style_selection' ) ) {
		$classes[] = $style;
	}

	return $classes;

}