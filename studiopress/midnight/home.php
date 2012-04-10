<?php

// Force the full width layout layout on the homepage
add_filter('genesis_pre_get_option_site_layout', 'midnight_home_layout');
function midnight_home_layout($opt) {
    if ( is_home() )
    $opt = 'full-width-content';
    return $opt;
}

// Homepage home welcome widget area
add_action('genesis_after_header', 'midnight_home_welcome');
function midnight_home_welcome() {
	?>
	<div id="home-welcome">
    	<div class="wrap">
      		<?php dynamic_sidebar('home-welcome'); ?>
    	</div><!-- end .wrap-->
	</div><!-- end #home-welcome -->
	<?php
}

// Homepage featured widget area
add_action('genesis_before_content', 'midnight_home_featured');
function midnight_home_featured() {
	?>
 	<div id="home-featured">
    	<div class="wrap">
		<?php if (!dynamic_sidebar('home-featured')) : ?>
			<div class="widget">
				<h4><?php _e("Home Featured", 'genesis'); ?></h4>
				<p><?php _e("This is a widgeted area which is called Home Featured.", 'midnight'); ?></p>
			</div><!-- end .widget -->
		<?php endif; ?>
		</div><!-- end .wrap-->
  	</div><!-- end #home-featured -->
  <?php
}

// Remove standard loop if home widgets are active
remove_action('genesis_loop', 'genesis_do_loop');

// Homepage bottom widget areas
add_action('genesis_loop', 'midnight_home_widgets');
function midnight_home_widgets() {
	?>
	<div id="home-widget-areas">
		<div class="home-left">
			<div class="wrap">
			<?php if (!dynamic_sidebar('home-left')) : ?>
				<div class="widget">
					<h4><?php _e("Home Left", 'genesis'); ?></h4>
					<p><?php _e("This is a widgeted area which is called Home Left.", 'midnight'); ?></p>
				</div><!-- end .widget -->
			<?php endif; ?>
			</div><!-- end .wrap-->
		</div><!-- end .home-left -->
			
		<div class="home-middle">
			<div class="wrap">
				<?php if (!dynamic_sidebar('home-middle')) : ?>
				<div class="widget">
					<h4><?php _e("Home Middle", 'genesis'); ?></h4>
					<p><?php _e("This is a widgeted area which is called Home Middle.", 'midnight'); ?></p>
				</div><!-- end .widget -->
				<?php endif; ?>
			</div><!-- end .wrap-->
		</div><!-- end .home-middle -->
			
		<div class="home-right">
			<div class="wrap">
				<?php if (!dynamic_sidebar('home-right')) : ?>
				<div class="widget">
					<h4><?php _e("Home Right", 'genesis'); ?></h4>
					<p><?php _e("This is a widgeted area which is called Home Right.", 'midnight'); ?></p>
				</div><!-- end .widget -->
				<?php endif; ?>
			</div><!-- end .wrap-->
		</div><!-- end .home-right -->
	</div><!-- end #home-widget-areas -->
	<?php
}

genesis();