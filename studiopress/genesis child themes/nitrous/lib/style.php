<?php
add_action( 'genesis_settings_sanitizer_init', 'nitrous_sanitization' ); 
/** 
* Add style switcher setting to Genesis sanitization 
* 
*/ 
function nitrous_sanitization( $pagehook ) { 
	genesis_add_option_filter( 'no_html', GENESIS_SETTINGS_FIELD, 'style_selection' ); 
} 

add_action( 'genesis_theme_settings_metaboxes', 'nitrous_settings_metaboxes' );
/**
 * Add metaboxes to the Genesis settings page
 *
 */
function nitrous_settings_metaboxes( $pagehook ) {
	add_meta_box( 'genesis-theme-settings-style', __( 'Nitrous Color Scheme', 'nitrous' ), 'nitrous_theme_settings_style_box', $pagehook, 'main', 'high' );
}

/**
 * Outputs the HTML necessary to display the extra form elements on Theme Settings
 *
 */
function nitrous_theme_settings_style_box() {

	$color_schemes = apply_filters( 'nitrous_colors', array(
		'nitrous-brown'		=> __( 'Nitrous Brown', 'nitrous' ),
		'nitrous-green'		=> __( 'Nitrous Green', 'nitrous' ),
		'nitrous-olive'	=> __( 'Nitrous Olive', 'nitrous' ),
		'nitrous-orange'	=> __( 'Nitrous Orange', 'nitrous' ),
		'nitrous-pink'	=> __( 'Nitrous Pink', 'nitrous' ),
		'nitrous-purple'	=> __( 'Nitrous Purple', 'nitrous' ),
		'nitrous-red'		=> __( 'Nitrous Red', 'nitrous' ),
		'nitrous-silver'		=> __( 'Nitrous Silver', 'nitrous' ),
		'nitrous-teal'		=> __( 'Nitrous Teal', 'nitrous' ),
	) );
	
?>

	<p><label><?php _e( 'Color Scheme', 'nitrous' ); ?>:
		<select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[style_selection]">
			<option value=""><?php _e( 'Nitrous Blue', 'nitrous' ); ?></option>
			<?php foreach ( $color_schemes as $id => $label ) {
				printf( '<option value="%s" %s>%s</option>', $id, selected( $id, genesis_get_option( 'style_selection' ), 0 ), $label );
			} ?>
		</select>
	</label></p>
	<p><span class="description"><?php _e( 'Please select the Nitrous color scheme from the drop down list and save your settings.', 'nitrous' ); ?></span></p>
	
	<p><span class="description"><?php printf( __( 'You can also choose an appropriate header, or upload your own, using the <a href="%s">custom header</a> tool', 'nitrous' ), admin_url( 'themes.php?page=custom-header' ) ); ?></span></p>

<?php
}

add_filter( 'body_class', 'nitrous_style_body_class' );
/**
 * Filters the body classes to add the proper style-specific class.
 *
 */
function nitrous_style_body_class( $classes ) {

	if ( $style = genesis_get_option( 'style_selection' ) ) {
		$classes[] = esc_attr( sanitize_html_class( $style ) );
	}

	return $classes;

}