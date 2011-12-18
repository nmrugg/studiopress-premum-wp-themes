<?php
add_action( 'genesis_settings_sanitizer_init', 'agentpress_sanitization' ); 
/** 
* Add style switcher setting to Genesis sanitization 
* 
*/ 
function agentpress_sanitization( $pagehook ) { 
	genesis_add_option_filter( 'no_html', GENESIS_SETTINGS_FIELD, 'style_selection' ); 
} 

add_action( 'genesis_theme_settings_metaboxes', 'agentpress_settings_metaboxes' );
/**
 * Add metaboxes to the Genesis settings page
 *
 */
function agentpress_settings_metaboxes( $pagehook ) {
	add_meta_box( 'genesis-theme-settings-style', __( 'AgentPress Color Scheme', 'agentpress' ), 'agentpress_theme_settings_style_box', $pagehook, 'main', 'high' );
}

/**
 * Outputs the HTML necessary to display the extra form elements on Theme Settings
 *
 */
function agentpress_theme_settings_style_box() {

	$color_schemes = apply_filters( 'agentpress_colors', array(
		'agentpress-gray'		=> __( 'AgentPress Gray', 'agentpress' ),
		'agentpress-green'		=> __( 'AgentPress Green', 'agentpress' ),
		'agentpress-red'		=> __( 'AgentPress Red', 'agentpress' ),
		'agentpress-tan'		=> __( 'AgentPress Tan', 'agentpress' ),
	) );
	
?>

	<p><label><?php _e( 'Color Scheme', 'agentpress' ); ?>:
		<select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[style_selection]">
			<option value=""><?php _e( 'AgentPress Blue', 'agentpress' ); ?></option>
			<?php foreach ( $color_schemes as $id => $label ) {
				printf( '<option value="%s" %s>%s</option>', $id, selected( $id, genesis_get_option( 'style_selection' ), 0 ), $label );
			} ?>
		</select>
	</label></p>
	<p><span class="description"><?php _e( 'Please select the AgentPress color scheme from the drop down list and save your settings.', 'agentpress' ); ?></span></p>
	
	<p><span class="description"><?php printf( __( 'You can also choose an appropriate header, or upload your own, using the <a href="%s">custom header</a> tool', 'agentpress' ), admin_url( 'themes.php?page=custom-header' ) ); ?></span></p>

<?php
}

add_filter( 'body_class', 'agentpress_style_body_class' );
/**
 * Filters the body classes to add the proper style-specific class.
 *
 */
function agentpress_style_body_class( $classes ) {

	if ( $style = genesis_get_option( 'style_selection' ) ) {
		$classes[] = esc_attr( sanitize_html_class( $style ) );
	}

	return $classes;

}