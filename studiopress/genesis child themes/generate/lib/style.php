<?php
add_action( 'genesis_settings_sanitizer_init', 'generate_sanitization' ); 
/** 
* Add style switcher setting to Genesis sanitization 
* 
*/ 
function generate_sanitization( $pagehook ) { 
	genesis_add_option_filter( 'no_html', GENESIS_SETTINGS_FIELD, 'style_selection' ); 
} 

add_action( 'genesis_theme_settings_metaboxes', 'generate_settings_metaboxes' );
/**
 * Add metaboxes to the Genesis settings page
 *
 */
function generate_settings_metaboxes( $pagehook ) {
	add_meta_box( 'genesis-theme-settings-style', __( 'Generate Theme Color Scheme', 'generate' ), 'generate_theme_settings_style_box', $pagehook, 'main', 'high' );
}

/**
 * Outputs the HTML necessary to display the extra form elements on Theme Settings
 *
 */
function generate_theme_settings_style_box() {

	$color_schemes = apply_filters( 'generate_colors', array(
		'generate-blue'		=> __( 'Generate Blue', 'generate' ),
		'generate-green'		=> __( 'Generate Green', 'generate' ),
		'generate-orange'		=> __( 'Generate Orange', 'generate' ),
	) );
	
?>

	<p><label><?php _e( 'Color Scheme', 'generate' ); ?>:
		<select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[style_selection]">
			<option value=""><?php _e( 'Generate Red', 'generate' ); ?></option>
			<?php foreach ( $color_schemes as $id => $label ) {
				printf( '<option value="%s" %s>%s</option>', $id, selected( $id, genesis_get_option( 'style_selection' ), 0 ), $label );
			} ?>
		</select>
	</label></p>
	<p><span class="description"><?php _e( 'Please select the generate theme color scheme from the drop down list and save your settings.', 'generate' ); ?></span></p>

<?php
}

add_filter( 'body_class', 'generate_style_body_class' );
/**
 * Filters the body classes to add the proper style-specific class.
 *
 */
function generate_style_body_class( $classes ) {

	if ( $style = genesis_get_option( 'style_selection' ) ) {
		$classes[] = esc_attr( sanitize_html_class( $style ) );
	}

	return $classes;

}