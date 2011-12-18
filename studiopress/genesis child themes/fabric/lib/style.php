<?php
/** Comment the following line to remove the color select option. */
add_action( 'admin_menu', 'fabric_add_style_settings_box', 11 );
/**
 * Add new box to the Genesis->Theme Settings page.
 *
 */
function fabric_add_style_settings_box() {
	global $_genesis_theme_settings_pagehook;
	add_meta_box( 'genesis-theme-settings-style', __( 'Fabric Color Scheme', 'fabric' ), 'fabric_theme_settings_style_box', $_genesis_theme_settings_pagehook, 'column2' );
}

/**
 * Outputs the HTML necessary to display the extra form elements on Theme Settings
 *
 */
function fabric_theme_settings_style_box() {

	$color_schemes = apply_filters( 'fabric_colors', array(
		'fabric-blue'	=> __( 'Fabric Blue', 'fabric' ),
		'fabric-pink'	=> __( 'Fabric Pink', 'fabric' ),
	) );
	
?>

	<p><label><?php _e( 'Color Scheme', 'fabric' ); ?>:
		<select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[style_selection]">
			<option value=""><?php _e( 'Fabric Tan', 'fabric' ); ?></option>
			<?php foreach ( $color_schemes as $id => $label ) {
				printf( '<option value="%s" %s>%s</option>', $id, selected( $id, genesis_get_option( 'style_selection' ), 0 ), $label );
			} ?>
		</select>
	</label></p>
	<p><span class="description"><?php _e( 'Please select the Fabric color scheme from the drop down list and save your settings.', 'fabric' ); ?></span></p>
	
	<p><span class="description"><?php printf( __( 'You can also choose an appropriate header, or upload your own, using the <a href="%s">custom header</a> tool', 'fabric' ), admin_url( 'themes.php?page=custom-header' ) ); ?></span></p>

<?php
}

add_filter( 'body_class', 'fabric_style_body_class' );
/**
 * Filters the body classes to add the proper style-specific class.
 *
 */
function fabric_style_body_class( $classes ) {

	if ( $style = genesis_get_option( 'style_selection' ) ) {
		$classes[] = esc_attr( sanitize_html_class( $style ) );
	}

	return $classes;

}