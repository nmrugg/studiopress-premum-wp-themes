<?php
/**
 * This file deals with the importing of design settings.
 *
 * @package Prose
 * @author Gary Jones
 * @since 0.9.7
 */
    
/**
 * If a file has been uploaded to import options, it parses the file, formats into a nice array
 * via the $mapping, then updates the setting in the DB.
 *
 * @author Gary Jones
 * @since 0.9.6
 * @uses prose_get_mapping
 */
function prose_process_import() {
    if ( isset($_POST['prose'])) {
        if ('import' == $_POST['prose']) {
            check_admin_referer('prose-import', '_wpnonce-prose-import');
            if (strpos($_FILES['file']['name'], prose_get_export_filename_prefix()) === false) {
		wp_redirect(admin_url('admin.php?page=design-settings&prose=wrongfile'));
            } elseif ($_FILES['file']['error'] > 0) {
		wp_redirect(admin_url('admin.php?page=design-settings&prose=file'));
            } else {
		$raw_options = file_get_contents($_FILES['file']['tmp_name']);
		$options = unserialize($raw_options);
											
		$mapping = prose_get_mapping();
				
		foreach ($options as $selector => $declaration) {
		    if (!is_array($declaration)) {
		        // custom_css or minify_css
                        if ('custom_css' == $selector) {
                            prose_create_custom_stylesheet($declaration);
                        } else {
                            $opt = $selector;
                            $newvalue = $declaration;
                            $newarray[$opt] = $newvalue;
                        }
		    } else {
		        foreach ($declaration as $property => $value) {
		            if (!is_array($value)) {
		                // color, font-style, text-decoration etc
		                $opt = $mapping[$selector][$property];
		                $newvalue = $value;
		                $newarray[$opt] = $newvalue;
                            } else {
                                // multi-value properties: margin, padding, etc
			        foreach($value as $index => $composite_value) {
                                    $type = $mapping[$selector][$property][$index][1];
			            if ('fixed_string' != $type) {
                                        $opt = $mapping[$selector][$property][$index][0];
    			                $newvalue = $composite_value['value'];
    			                $newarray[$opt] = $newvalue;
			            }
			        }
			    }
			}
                    }
		}
		update_option(PROSE_SETTINGS_FIELD, $newarray);
                wp_redirect(admin_url('admin.php?page=design-settings&prose=import'));
            }
        }
    }
}
add_action('admin_init', 'prose_process_import');

