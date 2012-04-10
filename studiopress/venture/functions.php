<?php
// Start the engine
require_once(TEMPLATEPATH.'/lib/init.php');

// Child theme (do not remove)
define('CHILD_THEME_NAME', 'Venture Theme');
define('CHILD_THEME_URL', 'http://www.studiopress.com/themes/venture');

// Add new image sizes
add_image_size('Mini', 90, 90, TRUE);
add_image_size('Featured', 400, 300, TRUE);

// Load tabs widget
require_once(CHILD_DIR.'/widgets/tabs.php');

// Change navigation position
remove_action('genesis_after_header', 'genesis_do_nav');
add_action('genesis_header', 'genesis_do_nav');

// Featured Tabs
add_action('genesis_header', 'child_header_tabs', 10);
function child_header_tabs() {
	if(is_home()) {
		if (!dynamic_sidebar('Featured Tabs')) : ?>
		<div class="widget">
			<h4><?php _e("Featured Tabs", 'genesis'); ?></h4>
			<p><?php _e("This is a widgeted area which is called Featured Tabs.", 'genesis'); ?></p>
		</div>			
		<?php endif;
	}
}

// Footer sections
add_action('genesis_footer', 'child_footer_widget_areas', 9);
function child_footer_widget_areas() {
	?>
  
		<div id="footer-widget-areas">
			<div id="footer-left">
				<?php if (!dynamic_sidebar('Footer Left')) : ?>
        <div class="widget">
          <h4><?php _e("Footer Left", 'genesis'); ?></h4>
          <p><?php _e("This is a widgeted area which is called Footer Left.", 'genesis'); ?></p>
        </div>			
        <?php endif; ?>
			</div>
			<div id="footer-right">
      	<?php if (!dynamic_sidebar('Footer Right')) : ?>
        <div class="widget">
          <h4><?php _e("Footer Right", 'genesis'); ?></h4>
          <p><?php _e("This is a widgeted area which is called Footer Right.", 'genesis'); ?></p>
        </div>			
        <?php endif; ?>
      </div>
      <div class="clear"></div>
		</div>
	
	<?php
}

// Customize the footer section
add_filter('genesis_footer_creds_text', 'venture_footer_creds_text');
function venture_footer_creds_text($creds) {
	$creds = __('Copyright', 'genesis') . ' [footer_copyright] [footer_childtheme_link] '. __('on', 'venture') .' [footer_genesis_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]';
	return $creds;
}  

// Register widget areas
genesis_register_sidebar(array(
	'name'=>'Featured Tabs',
    'id'=> 'featured-tabs', 
	'description' => 'This is the featured tabbed section of the homepage.',
));
genesis_register_sidebar(array(
	'name'=>'Home Left',
    'id'=> 'home-left', 
	'description' => 'This is the left section of the homepage.',
));
genesis_register_sidebar(array(
	'name'=>'Home Right',
    'id'=> 'home-right', 
	'description' => 'This is the right section of the homepage.',
));
genesis_register_sidebar(array(
	'name'=>'Footer Left',
    'id'=> 'footer-left', 
	'description' => 'This is the left section of the footer.',
));
genesis_register_sidebar(array(
	'name'=>'Footer Right',
    'id'=> 'footer-right', 
	'description' => 'This is the right section of the footer.',
));