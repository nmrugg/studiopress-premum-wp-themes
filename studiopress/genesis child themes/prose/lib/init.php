<?php
/**
 * This file controls all parts of the Prose Child Theme Initialisation.
 *
 * @package Prose
 * @author StudioPress & Gary Jones
 */

/**
 * Add theme support for displaying menu item
 * @since 0.9.8
 */
add_theme_support('prose-design-settings');

/**
 * The key the settings are stored under in the database.
 */
define('PROSE_SETTINGS_FIELD', 'prose_settings');

/**
 * The translation domain for __() and _e().
 */
define('PROSE_DOMAIN', 'prose');

// Functions
require_once(CHILD_DIR.'/lib/functions/I18n.php');
require_once(CHILD_DIR.'/lib/functions/design-settings.php');

// Structure
require_once(CHILD_DIR.'/lib/structure/stylesheets.php');
require_once(CHILD_DIR.'/lib/structure/export.php');
require_once(CHILD_DIR.'/lib/structure/import.php');

// Settings pages
require_once(CHILD_DIR.'/lib/admin/design-settings.php');
require_once(CHILD_DIR.'/lib/admin/custom-header.php');