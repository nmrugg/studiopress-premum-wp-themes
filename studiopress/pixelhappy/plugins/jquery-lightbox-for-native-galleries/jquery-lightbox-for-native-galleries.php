<?php /*

**************************************************************************

Plugin Name:  jQuery Lightbox For Native Galleries
Plugin URI:   http://www.viper007bond.com/wordpress-plugins/jquery-lightbox-for-native-galleries/
Description:  Makes the native WordPress galleries use a lightbox script called <a href="http://colorpowered.com/colorbox/">ColorBox</a> to display the fullsize images.
Version:      3.1.4
Author:       Viper007Bond
Author URI:   http://www.viper007bond.com/

**************************************************************************/

class jQueryLightboxForNativeGalleries {
	var $themes = array();
	var $settings = array();
	var $defaultsettings = array();

	// Plugin initialization
	function jQueryLightboxForNativeGalleries() {
		if ( !function_exists('plugins_url') )
			return;

		load_plugin_textdomain( 'viper-jquery-lightbox', false, '/jquery-lightbox-for-native-galleries/localization' );

		add_action( 'wp_head',         array(&$this, 'wp_head') );
		add_filter( 'attachment_link', array(&$this, 'attachment_link'), 10, 2 );

		add_action( 'admin_menu',      array(&$this, 'register_settings_page') );
		add_action( 'admin_init',      array(&$this, 'register_setting') );

		if ( !is_admin() ) {
			wp_enqueue_script( 'colorbox', plugins_url( 'colorbox/jquery.colorbox-min.js', __FILE__ ), array( 'jquery' ), '1.3.6' );

			wp_register_style( 'colorbox-theme1', plugins_url( 'colorbox/theme1/colorbox.css', __FILE__ ), array(), '1.3.6', 'screen' );
			wp_register_style( 'colorbox-theme2', plugins_url( 'colorbox/theme2/colorbox.css', __FILE__ ), array(), '1.3.6', 'screen' );
			wp_register_style( 'colorbox-theme3', plugins_url( 'colorbox/theme3/colorbox.css', __FILE__ ), array(), '1.3.6', 'screen' );
			wp_register_style( 'colorbox-theme4', plugins_url( 'colorbox/theme4/colorbox.css', __FILE__ ), array(), '1.3.6', 'screen' );
			wp_register_style( 'colorbox-theme5', plugins_url( 'colorbox/theme5/colorbox.css', __FILE__ ), array(), '1.3.6', 'screen' );
		}

		// Create list of themes and their human readable names
		$this->themes = (array) apply_filters( 'viper-jquery-lightbox_themes', array(
			'theme1' => __( 'Theme #1', 'viper-jquery-lightbox' ),
			'theme2' => __( 'Theme #2', 'viper-jquery-lightbox' ),
			'theme3' => __( 'Theme #3', 'viper-jquery-lightbox' ),
			'theme4' => __( 'Theme #4', 'viper-jquery-lightbox' ),
			'theme5' => __( 'Theme #5', 'viper-jquery-lightbox' ),
		) );

		// Create array of default settings (you can use the filter to modify these)
		$defaulttheme = key( $this->themes );
		$this->defaultsettings = (array) apply_filters( 'viper-jquery-lightbox_defaultsettings', array(
			'theme' => $defaulttheme,
		) );

		// Create the settings array by merging the user's settings and the defaults
		$usersettings = (array) get_option('viper-jquery-lightbox_settings');
		$this->settings = wp_parse_args( $usersettings, $this->defaultsettings );

		// Enqueue the theme
		if ( empty($this->themes[$this->settings['theme']]) )
			$this->settings['theme'] = $this->defaultsettings['theme'];
		wp_enqueue_style( 'colorbox-' . $this->settings['theme'] );
	}


	// Register the settings page
	function register_settings_page() {
		add_options_page( __('jQuery Lightbox For Native Galleries', 'viper-jquery-lightbox'), __('jQuery Lightbox', 'viper-jquery-lightbox'), 'manage_options', 'viper-jquery-lightbox', array(&$this, 'settings_page') );
	}


	// Register the plugin's setting
	function register_setting() {
		register_setting( 'viper-jquery-lightbox_settings', 'viper-jquery-lightbox_settings', array(&$this, 'validate_settings') );
	}


	// Output the Javascript to create the Lightbox
	function wp_head() { ?>
<!-- jQuery Lightbox For Native Galleries v3.1.3 | http://www.viper007bond.com/wordpress-plugins/jquery-lightbox-for-native-galleries/ -->
<script type="text/javascript">
// <![CDATA[
	jQuery(document).ready(function($){
		$(".gallery").each(function(index, obj){
			var galleryid = Math.floor(Math.random()*10000);
			$(obj).find("a").colorbox({rel:galleryid, maxWidth:"95%", maxHeight:"95%"});
		});
	});
// ]]>
</script>
<?php
	}


	// Make the thumbnails link to the fullsize image rather than a Page with the medium sized image
	function attachment_link( $link, $id ) {
		// The lightbox doesn't function inside feeds obviously, so don't modify anything
		if ( is_feed() || is_admin() )
			return $link;

		$post = get_post( $id );

		if ( 'image/' == substr( $post->post_mime_type, 0, 6 ) )
			return wp_get_attachment_url( $id );
		else
			return $link;
	}


	// Settings page
	function settings_page() { ?>

<div class="wrap">
<?php screen_icon(); ?>
	<h2><?php _e( 'jQuery Lightbox For Native Galleries Settings', 'viper-jquery-lightbox' ); ?></h2>

	<form method="post" action="options.php">

	<?php settings_fields('viper-jquery-lightbox_settings'); ?>


	<p><?php _e( 'Sorry if you were expecting more, but this is all there is at the moment. Nothing else to configure really anyway. :)', 'viper-jquery-lightbox' ); ?></p>

	<table class="form-table">
		<tr valign="top">
			<th scope="row"><label for="viper-jquery-lightbox-theme"><?php _e('Theme', 'viper-jquery-lightbox'); ?></label></th>
			<td>
				<select name="viper-jquery-lightbox_settings[theme]" id="viper-jquery-lightbox-theme" class="postform">
<?php
					foreach ( $this->themes as $theme => $name ) {
						echo '					<option value="' . esc_attr($theme) . '"';
						selected( $this->settings['theme'], $theme );
						echo '>' . htmlspecialchars($name) . "</option>\n";
					}
?>
				</select>
			</td>
		</tr>
	</table>

	<p class="submit">
		<input type="submit" name="viper-jquery-lightbox-submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</p>

	</form>
</div>

<?php
	}


	// Validate the settings sent from the settings page
	function validate_settings( $settings ) {
		if ( empty($settings['theme']) || empty($this->themes[$settings['theme']]) )
			$settings['theme'] = $this->defaultsettings['theme'];

		return $settings;
	}
}

// Start the plugin up
add_action( 'init', 'jQueryLightboxForNativeGalleries', 7 );
function jQueryLightboxForNativeGalleries() {
	global $jQueryLightboxForNativeGalleries;
	$jQueryLightboxForNativeGalleries = new jQueryLightboxForNativeGalleries();
}

?>