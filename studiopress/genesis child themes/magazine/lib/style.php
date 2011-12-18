<?php
add_action( 'genesis_settings_sanitizer_init', 'magazine_sanitization' ); 
/** 
* Add style switcher setting to Genesis sanitization 
* 
*/ 
function magazine_sanitization( $pagehook ) { 
	genesis_add_option_filter( 'no_html', GENESIS_SETTINGS_FIELD, 'style_selection' ); 
} 

add_action( 'genesis_theme_settings_metaboxes', 'magazine_settings_metaboxes' );
/**
 * Add metaboxes to the Genesis settings page
 *
 */
function magazine_settings_metaboxes( $pagehook ) {
	add_meta_box( 'genesis-theme-settings-style', __( 'Magazine Color Scheme', 'magazine' ), 'magazine_theme_settings_style_box', $pagehook, 'main', 'high' );
}

/**
 * Outputs the HTML necessary to display the extra form elements on Theme Settings
 *
 */
function magazine_theme_settings_style_box() {

	$color_schemes = apply_filters( 'magazine_colors', array(
		'magazine-blue'		=> __( 'Magazine Blue', 'magazine' ),
		'magazine-green'		=> __( 'Magazine Green', 'magazine' ),
		'magazine-orange'		=> __( 'Magazine Orange', 'magazine' ),
		'magazine-purple'		=> __( 'Magazine Purple', 'magazine' ),
		'magazine-red'		=> __( 'Magazine Red', 'magazine' ),
		'magazine-teal'		=> __( 'Magazine Teal', 'magazine' ),
	) );
	
?>

	<p><label><?php _e( 'Color Scheme', 'magazine' ); ?>:
		<select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[style_selection]">
			<option value=""><?php _e( 'Magazine Pink', 'magazine' ); ?></option>
			<?php foreach ( $color_schemes as $id => $label ) {
				printf( '<option value="%s" %s>%s</option>', $id, selected( $id, genesis_get_option( 'style_selection' ), 0 ), $label );
			} ?>
		</select>
	</label></p>
	<p><span class="description"><?php _e( 'Please select the Magazine color scheme from the drop down list and save your settings.', 'magazine' ); ?></span></p>
	
	<p><span class="description"><?php printf( __( 'You can also choose an appropriate header, or upload your own, using the <a href="%s">custom header</a> tool', 'magazine' ), admin_url( 'themes.php?page=custom-header' ) ); ?></span></p>

<?php
}

add_filter( 'body_class', 'magazine_style_body_class' );
/**
 * Filters the body classes to add the proper style-specific class.
 *
 */
function magazine_style_body_class( $classes ) {

	if ( $style = genesis_get_option( 'style_selection' ) ) {
		$classes[] = esc_attr( sanitize_html_class( $style ) );
	}

	return $classes;

}