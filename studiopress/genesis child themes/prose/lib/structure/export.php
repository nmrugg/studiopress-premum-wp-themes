<?php
/**
 * This file deals with the export of design settings.
 *
 * @package Prose
 * @author Gary Jones
 * @since 0.9.7
 */

/**
 * Prepares the contents of the export file.
 *
 * @author Gary Jones
 * @since 0.9.6
 * @return array $output multi-dimensional array holding CSS data
 * @uses prose_get_mapping()
 * @version 1.0
 */
 function prose_prepare_export() {
    $mapping = prose_get_mapping();
     
    foreach($mapping as $selector => $declaration) {
        if (!is_array($declaration)) {
            $output[$selector] = prose_get_design_option($declaration);
        } else {
            foreach ($declaration as $property => $value) {
                if (!is_array($value)) {
                    $output[$selector][$property] = prose_get_design_option($value);
                } else {
                    foreach($value as $index => $composite_value) {
                        $val = $composite_value[0];
                        $type = $composite_value[1];
                        if ('fixed_string' == $type) {
                            $output[$selector][$property][$index]['value'] = $val;
                        } else {
                            $output[$selector][$property][$index]['value'] = prose_get_design_option($val);
                        }
                        $output[$selector][$property][$index]['type'] = $type;
                    }
                }
            }
        }
    }
    // Add in contents of custom stylesheet
    $css = file_get_contents(prose_get_custom_stylesheet_path());
    $output['custom_css'] = $css;
     
    return apply_filters('prose_prepare_export', $output);
 }
 
/**
 * Returns the generated export file as a download.
 *
 * @author Gary Jones
 * @since 0.9.6
 */
function prose_create_export() {
    
    $output = prose_prepare_export();
    $output = serialize($output);

    check_admin_referer('prose-export');
    header( 'Content-Description: File Transfer' );
    header('Cache-Control: public, must-revalidate');
    header('Pragma: hack');
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="' . prose_get_export_filename_prefix() . date("Ymd-His") . '.dat"');
    header('Content-Length: ' . strlen($output));
    echo $output;
    exit();
}

/**
 * Sets the export file to download when requested
 * 
 * @author Gary Jones
 * @since 0.9.6
 */
add_action('admin_init', 'prose_process_export');
function prose_process_export() {
    if (isset($_GET['prose'])) {
        if ('export' == $_GET['prose']) {
            prose_create_export();
        }
    }
}

function prose_get_export_filename_prefix() {
    return apply_filters('prose_get_export_filename_prefix', 'prose-settings-');
}