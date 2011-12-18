<?php
/** Comment the following line to remove the color select option. */
add_action( 'admin_menu', 'lifestyle_add_style_settings_box', 11 );
/**
 * Add new box to the Genesis->Theme Settings page.
 *
 */
function lifestyle_add_style_settings_box() {
	global $_genesis_theme_settings_pagehook;
	add_meta_box( 'genesis-theme-settings-style', __( 'Lifestyle Color Scheme', 'lifestyle' ), 'lifestyle_theme_settings_style_box', $_genesis_theme_settings_pagehook, 'column2' );
}

/**
 * Outputs the HTML necessary to display the extra form elements on Theme Settings
 *
 */
function lifestyle_theme_settings_style_box() {

	$color_schemes = apply_filters( 'lifestyle_colors', array(
		'lifestyle-blue'		=> __( 'Lifestyle Blue', 'lifestyle' ),
		'lifestyle-charcoal'	=> __( 'Lifestyle Charcoal', 'lifestyle' ),
		'lifestyle-gray'		=> __( 'Lifestyle Gray', 'lifestyle' ),
		'lifestyle-green'		=> __( 'Lifestyle Green', 'lifestyle' ),
		'lifestyle-pink'		=> __( 'Lifestyle Pink', 'lifestyle' ),
		'lifestyle-purple'		=> __( 'Lifestyle Purple', 'lifestyle' ),
		'lifestyle-tan'			=> __( 'Lifestyle Tan', 'lifestyle' ),
		'lifestyle-teal'		=> __( 'Lifestyle Teal', 'lifestyle' ),
		'lifestyle-yellow'		=> __( 'Lifestyle Yellow', 'lifestyle' ),
	) );
	
?>

	<p><label><?php _e( 'Color Scheme', 'lifestyle' ); ?>:
		<select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[style_selection]">
			<option value=""><?php _e( 'Lifestyle Aqua', 'lifestyle' ); ?></option>
			<?php foreach ( $color_schemes as $id => $label ) {
				printf( '<option value="%s" %s>%s</option>', $id, selected( $id, genesis_get_option( 'style_selection' ), 0 ), $label );
			} ?>
		</select>
	</label></p>
	<p><span class="description"><?php _e( 'Please select the Lifestyle color scheme from the drop down list and save your settings.', 'lifestyle' ); ?></span></p>
	
	<p><span class="description"><?php printf( __( 'You can also choose an appropriate header, or upload your own, using the <a href="%s">custom header</a> tool', 'lifestyle' ), admin_url( 'themes.php?page=custom-header' ) ); ?></span></p>

<?php
}

add_filter( 'body_class', 'lifestyle_style_body_class' );
/**
 * Filters the body classes to add the proper style-specific class.
 *
 */
function lifestyle_style_body_class( $classes ) {

	if ( $style = genesis_get_option( 'style_selection' ) ) {
		$classes[] = esc_attr( sanitize_html_class( $style ) );
	}

	return $classes;

}