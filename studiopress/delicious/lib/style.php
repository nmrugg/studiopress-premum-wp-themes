<?php
//
// Delicious Color Scheme Settings
//

add_action('admin_menu', 'delicious_color_scheme_box', 11);
function delicious_color_scheme_box() {
	global $_genesis_theme_settings_pagehook;
	add_meta_box('genesis-theme-settings-slider', __('Delicious Color Schemes', 'genesis'), 'delicious_color_schemes', $_genesis_theme_settings_pagehook, 'column2');
}

function delicious_color_schemes() {
	// set the default selection (if empty)
	$style = genesis_get_option('style_selection') ? genesis_get_option('style_selection') : 'style.css';
?>
	<p><label><?php _e('Colour Scheme', 'genesis'); ?>: 
		<select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[style_selection]">
			<?php
			foreach ( glob(CHILD_DIR . "/*.css") as $file ) :
				$file = basename($file);
			  if(!genesis_style_check($file, 'genesis')){
        	continue;
        }
      ?>
      <option style="padding-right:10px;" value="<?php echo esc_attr( $file ); ?>" <?php selected($file, $style); ?>><?php echo esc_html( $file ); ?></option>
      <?php 
      endforeach; ?>
    </select>
	</label></p>
  <p><span class="description">Please select the Delicious color style from the drop down list and save your settings. Only stylesheets found in the child theme directory will be included in this list.</span></p>
<?php
}

// Checks if the style sheet is a Genesis style sheet
function genesis_style_check($fileText, $char_list) {
	$fh = fopen(CHILD_DIR . '/' . $fileText, 'r');
  $theData = fread($fh, 500);
  fclose($fh);
    
  $search = strpos($theData, $char_list);
  if($search === false){
		return false;
  }
  return true;
}

// Changes the style sheet per the selection in the theme settings and loads style.css if selected style sheet 
// is not available
add_filter('stylesheet_uri', 'child_stylesheet_uri', 10, 2);
function child_stylesheet_uri($stylesheet, $dir) {
	$style = genesis_get_option('style_selection');
  if ( !$style ) return $stylesheet;
  if (!file_exists(CHILD_DIR . '/' . $style)) return $stylesheet;
    
  return $dir . '/' . $style;
}

?>
