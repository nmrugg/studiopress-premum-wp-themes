<?php
/**
 * Creates the Theme Settings page.
 *
 * @package Genesis
 * @todo document the functions in theme-settings.php
 */

/**
 * This function registers the default values for Genesis theme settings
 */
function genesis_theme_settings_defaults() {
	$defaults = array( // define our defaults
		'update' => 1,
		'blog_title' => 'text',
		'header_right' => 0,
		'site_layout' => genesis_get_default_layout(),
		'nav' => 1,
		'nav_superfish' => 1,
		'nav_extras_enable' => 0,
		'nav_extras' => 'date',
		'nav_extras_twitter_id' => '',
		'nav_extras_twitter_text' => 'Follow me on Twitter',
		'subnav' => 0,
		'subnav_superfish' => 1,
		'feed_uri' => '',
		'comments_feed_uri' => '',
		'redirect_feeds' => 0,
		'comments_pages' => 0,
		'comments_posts' => 1,
		'trackbacks_pages' => 0,
		'trackbacks_posts' => 1,
		'breadcrumb_home' => 0,
		'breadcrumb_single' => 0,
		'breadcrumb_page' => 0,
		'breadcrumb_archive' => 0,
		'breadcrumb_404' => 0,
		'content_archive' => 'full',
		'content_archive_thumbnail' => 0,
		'posts_nav' => 'older-newer',
		'blog_cat' => '',
		'blog_cat_exclude' => '',
		'blog_cat_num' => 10,
		'header_scripts' => '',
		'footer_scripts' => '',
		'theme_version' => PARENT_THEME_VERSION
	);

	return apply_filters('genesis_theme_settings_defaults', $defaults);
}

add_action('admin_init', 'genesis_register_theme_settings', 5);
/**
 * This registers the settings field and adds defaults to the options table.
 * It also handles settings resets by pushing in the defaults.
 */
function genesis_register_theme_settings() {
	register_setting( GENESIS_SETTINGS_FIELD, GENESIS_SETTINGS_FIELD );
	add_option( GENESIS_SETTINGS_FIELD, genesis_theme_settings_defaults() );

	if ( ! isset($_REQUEST['page']) || $_REQUEST['page'] != 'genesis' )
		return;

	if ( genesis_get_option('reset') ) {
		update_option(GENESIS_SETTINGS_FIELD, genesis_theme_settings_defaults());

		genesis_admin_redirect( 'genesis', array( 'reset' => 'true' ) );
		exit;
	}

}

/**
 * Registers an option sanitization filter
 * NOTE: If the option is an "array" option type with "suboptions", you have to use the third param to specify the
 * suboption or suboptions you want the filter to apply to. DO NOT call this without the third parameter on an option
 * that is an array option, because in that case it will apply that filter to the array(), not each member.
 * NOTE: Use the 'genesis_settings_sanitizer_init' action to be notified when this function is safe to use
 * @param string $filter The filter to call (see  Genesis_Settings_Sanitizer::$available_filters for options)
 * @param string $option The WordPress option name
 * @param string|array $suboption (OPTIONAL) the suboption or suboptions you want to filter.
 */
function genesis_add_option_filter( $filter, $option, $suboption = null ) {
	return Genesis_Settings_Sanitizer::$instance->add_filter( $filter, $option, $suboption );
}

function genesis_settings_sanitizer_init() {
	// Instantiate the Sanitizer
	new Genesis_Settings_Sanitizer;
}

/**
 * Registers Genesis core option sanitization filters
 * @since 1.7.0
 */
function genesis_register_core_sanitization_filters() {
	genesis_add_option_filter( 'one_zero', GENESIS_SEO_SETTINGS_FIELD,
		array(
			'append_description_home',
			'append_site_title',
			'home_noindex',
			'home_nofollow',
			'home_noarchive',
			'head_index_rel_link',
			'head_parent_post_rel_link',
			'head_start_post_rel_link',
			'head_adjacent_posts_rel_link',
			'head_wlwmanifest_link',
			'head_shortlink',
			'noindex_cat_archive',
			'noindex_tag_archive',
			'noindex_author_archive',
			'noindex_date_archive',
			'noindex_search_archive',
			'noarchive',
			'noarchive_cat_archive',
			'noarchive_tag_archive',
			'noarchive_author_archive',
			'noarchive_date_archive',
			'noarchive_search_archive',
			'noodp',
			'noydir',
			'canonical_archives',
		) );
	genesis_add_option_filter( 'no_html', GENESIS_SEO_SETTINGS_FIELD,
		array(
			'home_doctitle',
			'home_description',
			'home_keywords',
			'doctitle_sep',
		) );
	genesis_add_option_filter( 'one_zero', GENESIS_SETTINGS_FIELD,
		array(
			'show_info',
			'update',
			'update_email',
			'redirect_feed',
			'redirect_comments_feed',
			'nav',
			'nav_superfish',
			'nav_extras_enable',
			'subnav',
			'subnav_superfish',
			'breadcrumb_home',
			'breadcrumb_single',
			'breadcrumb_page',
			'breadcrumb_archive',
			'breadcrumb_404',
			'comments_posts',
			'comments_pages',
			'trackbacks_posts',
			'trackbacks_pages',
			'content_archive_thumbnail',
		) );
	genesis_add_option_filter( 'requires_unfiltered_html', GENESIS_SETTINGS_FIELD,
		array(
			'header_scripts',
			'footer_scripts',
		) );
}

// Set a good example, and use the correct Genesis hook for determining when sanitization is available for use
add_action( 'genesis_settings_sanitizer_init', 'genesis_register_core_sanitization_filters' );

add_action( 'init', 'genesis_settings_sanitizer_init' );
add_action('admin_notices', 'genesis_theme_settings_notice');
/**
 * This is the notice that displays when you successfully save or reset
 * the theme settings.
 */
function genesis_theme_settings_notice() {

	if ( ! isset( $_REQUEST['page'] ) || $_REQUEST['page'] != 'genesis' )
		return;

	if ( isset( $_REQUEST['reset'] ) && 'true' == $_REQUEST['reset'] )
		echo '<div id="message" class="updated"><p><strong>' . __( 'Settings reset.', 'genesis' ) . '</strong></p></div>';
	elseif ( isset( $_REQUEST['settings-updated'] ) && $_REQUEST['settings-updated'] == 'true' )
		echo '<div id="message" class="updated"><p><strong>' . __( 'Settings saved.' ) . '</strong></p></div>';

}

add_action('admin_menu', 'genesis_theme_settings_init');
/**
 * This is a necessary go-between to get our scripts and boxes loaded
 * on the theme settings page only, and not the rest of the admin
 */
function genesis_theme_settings_init() {
	global $_genesis_theme_settings_pagehook;

	add_action('load-'.$_genesis_theme_settings_pagehook, 'genesis_theme_settings_scripts');
	add_action('load-'.$_genesis_theme_settings_pagehook, 'genesis_theme_settings_boxes');
}

function genesis_theme_settings_scripts() {
	wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
}

function genesis_theme_settings_boxes() {
	global $_genesis_theme_settings_pagehook;

	add_meta_box('genesis-theme-settings-version', __('Information', 'genesis'), 'genesis_theme_settings_info_box', $_genesis_theme_settings_pagehook, 'main', 'high');
	add_meta_box('genesis-theme-settings-feeds', __('Custom Feeds', 'genesis'), 'genesis_theme_settings_feeds_box', $_genesis_theme_settings_pagehook, 'main');
	add_meta_box('genesis-theme-settings-layout', __('Default Layout', 'genesis'), 'genesis_theme_settings_layout_box', $_genesis_theme_settings_pagehook, 'main');
	if ( ! current_theme_supports( 'genesis-custom-header' ) ) :
	add_meta_box('genesis-theme-settings-header', __('Header Settings', 'genesis'), 'genesis_theme_settings_header_box', $_genesis_theme_settings_pagehook, 'main');
	endif;
	add_meta_box('genesis-theme-settings-nav', __('Navigation Settings', 'genesis'), 'genesis_theme_settings_nav_box', $_genesis_theme_settings_pagehook, 'main');
	add_meta_box('genesis-theme-settings-breadcrumb', __('Breadcrumbs', 'genesis'), 'genesis_theme_settings_breadcrumb_box', $_genesis_theme_settings_pagehook, 'main');
	add_meta_box('genesis-theme-settings-comments', __('Comments and Trackbacks', 'genesis'), 'genesis_theme_settings_comments_box', $_genesis_theme_settings_pagehook, 'main');
	add_meta_box('genesis-theme-settings-posts', __('Content Archives', 'genesis'), 'genesis_theme_settings_post_archives_box', $_genesis_theme_settings_pagehook, 'main');
	add_meta_box('genesis-theme-settings-blogpage', __('Blog Page', 'genesis'), 'genesis_theme_settings_blogpage_box', $_genesis_theme_settings_pagehook, 'main');
	// These settings require the unfiltered_html capability
	if ( current_user_can( 'unfiltered_html' ) )
		add_meta_box('genesis-theme-settings-scripts', __('Header and Footer Scripts', 'genesis'), 'genesis_theme_settings_scripts_box', $_genesis_theme_settings_pagehook, 'main');

	do_action( 'genesis_theme_settings_metaboxes', $_genesis_theme_settings_pagehook );
}

add_filter('screen_layout_columns', 'genesis_theme_settings_layout_columns', 10, 2);
/**
 * Tell WordPress that we want only 2 columns available for our meta-boxes
 */
function genesis_theme_settings_layout_columns($columns, $screen) {
	global $_genesis_theme_settings_pagehook;
	if ($screen == $_genesis_theme_settings_pagehook) {
		// This page should only have 1 column option
		$columns[$_genesis_theme_settings_pagehook] = 1;
	}
	return $columns;
}

/**
 * This function is what actually gets output to the page. It handles the markup,
 * builds the form, outputs necessary JS stuff, and fires <code>do_meta_boxes()</code>
 */
function genesis_theme_settings_admin() {
	global $_genesis_theme_settings_pagehook, $wp_meta_boxes;

?>
	<div id="genesis-theme-settings" class="wrap genesis-metaboxes">
	<form method="post" action="options.php">

		<?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false ); ?>
		<?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false ); ?>
		<?php settings_fields(GENESIS_SETTINGS_FIELD); // important! ?>
		<input type="hidden" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[theme_version]>" value="<?php echo esc_attr(genesis_option('theme_version')); ?>" />
		<input type="hidden" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[db_version]>" value="<?php echo esc_attr(genesis_option('db_version')); ?>" />

		<?php screen_icon('options-general'); ?>
		<h2>
			<?php _e('Genesis - Theme Settings', 'genesis'); ?>
			<input type="submit" class="button-primary genesis-h2-button" value="<?php _e('Save Settings', 'genesis') ?>" />
			<input type="submit" class="button-highlighted genesis-h2-button" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[reset]" value="<?php _e('Reset Settings', 'genesis'); ?>" onclick="return genesis_confirm('<?php echo esc_js( __('Are you sure you want to reset?', 'genesis') ); ?>');" />
		</h2>

		<div class="metabox-holder">
			<div class="postbox-container" style="width: 99%;">
				<?php
				do_meta_boxes($_genesis_theme_settings_pagehook, 'main', null);

				/** For Backward Compatiblility */
				if ( isset( $wp_meta_boxes[$_genesis_theme_settings_pagehook]['column2'] ) )
				do_meta_boxes($_genesis_theme_settings_pagehook, 'column2', null);
				?>
			</div>
		</div>

		<div class="bottom-buttons">
			<input type="submit" class="button-primary" value="<?php _e('Save Settings', 'genesis') ?>" />
			<input type="submit" class="button-highlighted" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[reset]" value="<?php _e('Reset Settings', 'genesis'); ?>" />
		</div>
	</form>
	</div>
	<script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready( function($) {
			// close postboxes that should be closed
			$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
			// postboxes setup
			postboxes.add_postbox_toggles('<?php echo $_genesis_theme_settings_pagehook; ?>');
		});
		//]]>
	</script>

<?php
}

/**
 * This next section defines functions that contain the content of the "boxes" that will be
 * output by default on the "Theme Settings" page. There's a bunch of them.
 *
 * FWIW, you can copy this syntax and load your own boxes on the theme settings page too.
 */
function genesis_theme_settings_info_box() { ?>
	<p><strong><?php _e('Version:', 'genesis'); ?></strong> <?php genesis_option('theme_version'); ?> <?php echo g_ent('&middot;'); ?> <strong><?php _e('Released:', 'genesis'); ?></strong> <?php echo PARENT_THEME_RELEASE_DATE; ?></p>

	<p><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[show_info]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[show_info]" value="1" <?php checked(1, genesis_get_option('show_info')); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[show_info]"><?php _e('Display Theme Information in your document source', 'genesis'); ?></label></p>

	<p><span class="description"><?php sprintf( __( 'This can be helpful for diagnosing problems with your theme when seeking assistance in the <a href="%s" target="_blank">support forums</a>.', 'genesis' ), 'http://www.studiopress.com/support/' ); ?></span></p>

	<p><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[update]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[update]" value="1" <?php checked(1, genesis_get_option('update')); ?> <?php disabled( 0, is_super_admin() ); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[update]"><?php _e('Enable Automatic Updates', 'genesis'); ?></label></p>

	<div id="genesis_update_notification_setting">
		<p><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[update_email]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[update_email]" value="1" <?php checked(1, genesis_get_option('update_email')); ?> <?php disabled( 0, is_super_admin() ); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[update_email]"><?php _e('Notify', 'genesis'); ?></label> <input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[update_email_address]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[update_email_address]" value="<?php echo esc_attr( genesis_option('update_email_address') ); ?>" size="30" <?php disabled( 0, is_super_admin() ); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[update_email_address]"><?php _e('when updates are available', 'genesis'); ?></label></p>

		<p><span class="description"><?php _e('If you provide an email address above, your blog can email you when a new version of Genesis is available.', 'genesis'); ?></span></p>
	</div>
<?php
}

function genesis_theme_settings_layout_box() { ?>

	<p class="genesis-layout-selector">
	<?php
	genesis_layout_selector( array( 'name' => GENESIS_SETTINGS_FIELD . '[site_layout]', 'selected' => genesis_get_option( 'site_layout' ) ) );
	?>
	</p>

	<br class="clear" />

<?php
}

function genesis_theme_settings_header_box() { ?>

	<p><?php _e("Use for blog title/logo:", 'genesis'); ?>
	<select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[blog_title]">
		<option value="text" <?php selected('text', genesis_get_option('blog_title')); ?>><?php _e("Dynamic text", 'genesis'); ?></option>
		<option value="image" <?php selected('image', genesis_get_option('blog_title')); ?>><?php _e("Image logo", 'genesis'); ?></option>
	</select></p>

<?php
}

function genesis_theme_settings_nav_box() { ?>

	<h4><?php _e( 'Primary Navigation', 'genesis' ); ?></h4>

	<p><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[nav]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[nav]" value="1" <?php checked(1, genesis_get_option('nav')); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[nav]"><?php _e("Include Primary Navigation Menu?", 'genesis'); ?></label>
	</p>

	<div id="genesis_nav_settings">
		<p><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[nav_superfish]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[nav_superfish]" value="1" <?php checked(1, genesis_get_option('nav_superfish')); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[nav_superfish]"><?php _e("Enable Fancy Dropdowns?", 'genesis'); ?></label>
		</p>

		<p><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[nav_extras_enable]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[nav_extras_enable]" value="1" <?php checked(1, genesis_get_option('nav_extras_enable')); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[nav_extras_enable]"><?php _e('Enable Extras on Right Side?', 'genesis'); ?></label></p>

		<div id="genesis_nav_extras_settings">
			<p><?php _e("Display the following:", 'genesis'); ?>
			<select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[nav_extras]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[nav_extras]">
				<option value="date" <?php selected('date', genesis_get_option('nav_extras')); ?>><?php _e("Today's date", 'genesis'); ?></option>
				<option value="rss" <?php selected('rss', genesis_get_option('nav_extras')); ?>><?php _e("RSS feed links", 'genesis'); ?></option>
				<option value="search" <?php selected('search', genesis_get_option('nav_extras')); ?>><?php _e("Search form", 'genesis'); ?></option>
				<option value="twitter" <?php selected('twitter', genesis_get_option('nav_extras')); ?>><?php _e("Twitter link", 'genesis'); ?></option>
			</select></p>
			<div id="genesis_nav_extras_twitter">
				<p><?php _e("Enter Twitter ID:", 'genesis'); ?>
				<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[nav_extras_twitter_id]" value="<?php echo esc_attr( genesis_get_option('nav_extras_twitter_id') ); ?>" size="27" /></p>
				<p><?php _e("Twitter Link Text:", 'genesis'); ?>
				<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[nav_extras_twitter_text]" value="<?php echo esc_attr( genesis_get_option('nav_extras_twitter_text') ); ?>" size="27" /></p>
			</div>
		</div>
	</div>

	<hr class="div" />

	<h4><?php _e( 'Secondary Navigation', 'genesis' ); ?></h4>

	<p><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[subnav]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[subnav]" value="1" <?php checked(1, genesis_get_option('subnav')); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[subnav]"><?php _e("Include Secondary Navigation Menu?", 'genesis'); ?></label>
	</p>

	<div id="genesis_subnav_settings">
		<p><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[subnav_superfish]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[subnav_superfish]" value="1" <?php checked(1, genesis_get_option('subnav_superfish')); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[subnav_superfish]"><?php _e("Enable Fancy Dropdowns?", 'genesis'); ?></label>
		</p>
	</div>

	<hr class="div" />

	<p><span class="description"><?php printf( __('In order to use the navigation menus, you must build a <a href="%s">custom menu</a>, then assign it to the proper Menu Location.', 'genesis'), admin_url('nav-menus.php') ); ?></span></p>

<?php
}

function genesis_theme_settings_feeds_box() { ?>

	<p><?php _e('Enter your custom feed URI:', 'genesis'); ?><br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[feed_uri]" value="<?php echo esc_attr( genesis_get_option('feed_uri') ); ?>" size="50" /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[redirect_feed]"><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[redirect_feed]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[redirect_feed]" value="1" <?php checked(1, genesis_get_option('redirect_feed')); ?> /> <?php _e("Redirect Feed?", 'genesis'); ?></label></p>

	<p><?php _e('Enter your custom comments feed URI:', 'genesis'); ?><br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[comments_feed_uri]" value="<?php echo esc_attr( genesis_get_option('comments_feed_uri') ); ?>" size="50" /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[redirect_comments_feed]"><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[redirect_comments_feed]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[redirect_comments_feed]" value="1" <?php checked(1, genesis_get_option('redirect_comments__feed')); ?> /> <?php _e("Redirect Feed?", 'genesis'); ?></label></p>

	<p><span class="description"><?php printf( __('If your custom feed(s) are not handled by Feedburner, we do not recommend that you use the redirect options.', 'genesis') ); ?></span></p>

<?php
}

function genesis_theme_settings_comments_box() { ?>
	<p><label><?php _e('Enable Comments', 'genesis'); ?></label>
	<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[comments_posts]"><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[comments_posts]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[comments_posts]" value="1" <?php checked(1, genesis_get_option('comments_posts')); ?> /> <?php _e("on posts?", 'genesis'); ?></label>

	<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[comments_pages]"><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[comments_pages]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[comments_pages]" value="1" <?php checked(1, genesis_get_option('comments_pages')); ?> /> <?php _e("on pages?", 'genesis'); ?></label>
	</p>

	<p><label><?php _e('Enable Trackbacks', 'genesis'); ?></label>
	<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trackbacks_posts]"><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trackbacks_posts]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trackbacks_posts]" value="1" <?php checked(1, genesis_get_option('trackbacks_posts')); ?> /> <?php _e("on posts?", 'genesis'); ?></label>

	<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trackbacks_pages]"><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trackbacks_pages]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trackbacks_pages]" value="1" <?php checked(1, genesis_get_option('trackbacks_pages')); ?> /> <?php _e("on pages?", 'genesis'); ?></label>
	</p>

	<p><span class="description"><?php _e("Comments and Trackbacks can also be disabled on a per post/page basis when creating/editing posts/pages.", 'genesis'); ?></span></p>

<?php
}

function genesis_theme_settings_breadcrumb_box() { ?>

	<h4><?php _e( 'Enable on:', 'genesis' ); ?></h4>

	<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[breadcrumb_home]"><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[breadcrumb_home]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[breadcrumb_home]" value="1" <?php checked(1, genesis_get_option('breadcrumb_home')); ?> /> <?php _e("Front Page", 'genesis'); ?></label>

	<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[breadcrumb_single]"><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[breadcrumb_single]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[breadcrumb_single]" value="1" <?php checked(1, genesis_get_option('breadcrumb_single')); ?> /> <?php _e("Posts", 'genesis'); ?></label>

	<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[breadcrumb_page]"><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[breadcrumb_page]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[breadcrumb_page]" value="1" <?php checked(1, genesis_get_option('breadcrumb_page')); ?> /> <?php _e("Pages", 'genesis'); ?></label>

	<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[breadcrumb_archive]"><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[breadcrumb_archive]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[breadcrumb_archive]" value="1" <?php checked(1, genesis_get_option('breadcrumb_archive')); ?> /> <?php _e("Archives", 'genesis'); ?></label>

	<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[breadcrumb_404]"><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[breadcrumb_404]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[breadcrumb_404]" value="1" <?php checked(1, genesis_get_option('breadcrumb_404')); ?> /> <?php _e("404 Page", 'genesis'); ?></label>
	</p>

	<p><span class="description"><?php _e('Breadcrumbs are a great way of letting your visitors find out where they are on your site with just a glance. You can enable/disable them on certain areas of your site.', 'genesis'); ?></span></p>
<?php
}

function genesis_theme_settings_post_archives_box() { ?>
	<p><?php _e("Select one of the following:", 'genesis'); ?>
	<select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[content_archive]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[content_archive]">
		<option value="full" <?php selected('full', genesis_get_option('content_archive')); ?>><?php _e("Display post content", 'genesis'); ?></option>
		<option value="excerpts" <?php selected('excerpts', genesis_get_option('content_archive')); ?>><?php _e("Display post excerpts", 'genesis'); ?></option>
	</select></p>

	<div id="genesis_content_limit_setting">
		<p><label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[content_archive_limit]"><?php _e('Limit content to', 'genesis'); ?></label> <input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[content_archive_limit]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[content_archive_limit]" value="<?php echo esc_attr( genesis_option('content_archive_limit') ); ?>" size="3" /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[content_archive_limit]"><?php _e('characters', 'genesis'); ?></label></p>

		<p><span class="description"><?php _e('Using this option will limit the text and strip all formatting from the text displayed. To use this option, choose "Display post content" in the select box above.', 'genesis'); ?></span></p>
	</div>

	<p><input type="checkbox" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[content_archive_thumbnail]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[content_archive_thumbnail]" value="1" <?php checked(1, genesis_get_option('content_archive_thumbnail')); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[content_archive_thumbnail]"><?php _e("Include the Featured Image?", 'genesis'); ?></label>
	</p>

	<p id="genesis_image_size"><?php _e('Image Size', 'genesis'); ?>:
	<?php $sizes = genesis_get_image_sizes(); ?>
	<select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[image_size]">
		<?php
		foreach( (array) $sizes as $name => $size ) :
		echo '<option value="'.$name.'" '.selected($name, genesis_get_option('image_size'), FALSE).'>'.$name.' ('.$size['width'].'x'.$size['height'].')</option>';
		endforeach;
		?>
	</select></p>

	<p><?php _e("Select Post Navigation Technique:", 'genesis'); ?>
	<select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[posts_nav]">
		<option value="older-newer" <?php selected('older-newer', genesis_get_option('posts_nav')); ?>><?php _e("Older / Newer", 'genesis'); ?></option>
		<option value="prev-next" <?php selected('prev-next', genesis_get_option('posts_nav')); ?>><?php _e("Previous / Next", 'genesis'); ?></option>
		<option value="numeric" <?php selected('numeric', genesis_get_option('posts_nav')); ?>><?php _e("Numeric", 'genesis'); ?></option>
	</select></p>

	<p><span class="description"><?php _e("These options will affect any blog listings page, including archive, author, blog, category, search, and tag pages.", 'genesis'); ?></span></p>
<?php
}

function genesis_theme_settings_blogpage_box() { ?>
	<p><?php _e("Display which category:", 'genesis'); ?>
	<?php wp_dropdown_categories(array('selected' => genesis_get_option('blog_cat'), 'name' => GENESIS_SETTINGS_FIELD.'[blog_cat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_all' => __("All Categories", 'genesis'), 'hide_empty' => '0' )); ?></p>

	<p><?php _e("Exclude the following Category IDs:", 'genesis'); ?><br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[blog_cat_exclude]" value="<?php echo esc_attr( genesis_get_option('blog_cat_exclude') ); ?>" size="40" /><br />
	<small><strong><?php _e("Comma separated - 1,2,3 for example", 'genesis'); ?></strong></small></p>

	<p><?php _e('Number of Posts to Show', 'genesis'); ?>:
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[blog_cat_num]" value="<?php echo esc_attr( genesis_option('blog_cat_num') ); ?>" size="2" /></p>
<?php
}

function genesis_theme_settings_scripts_box() { ?>
	<p><?php _e("Enter scripts/code you would like output to <code>wp_head()</code>:", 'genesis'); ?></p>

	<textarea name="<?php echo GENESIS_SETTINGS_FIELD; ?>[header_scripts]" cols="78" rows="8"><?php echo esc_textarea( genesis_get_option('header_scripts') ); ?></textarea>

	<p><span class="description"><?php _e('The <code>wp_head()</code> hook executes immediately before the closing <code>&lt;/head&gt;</code> tag in the document source.', 'genesis'); ?></span></p>

	<hr class="div" />

	<p><?php _e("Enter scripts/code you would like output to <code>wp_footer()</code>:", 'genesis'); ?></p>

	<textarea name="<?php echo GENESIS_SETTINGS_FIELD; ?>[footer_scripts]" cols="78" rows="8"><?php echo esc_textarea( genesis_get_option('footer_scripts') ); ?></textarea>

	<p><span class="description"><?php _e('The <code>wp_footer()</code> hook executes immediately before the closing <code>&lt;/body&gt;</code> tag in the document source.', 'genesis'); ?></span></p>
<?php
}