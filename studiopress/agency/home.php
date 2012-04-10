<?php get_header(); ?>
<?php genesis_home(); ?>

<div id="home-top-bg">
	<div id="home-top">
	
		<div class="home-top-left">
			<?php if (!dynamic_sidebar('Home Top Left')) : ?>
			<div class="widget">
				<?php if( function_exists('wp_cycle') ) : ?>
					<?php wp_cycle(); ?>
				<?php endif; ?>
			</div><!-- end .widget -->
			<?php endif; ?>
		</div><!-- end .home-top-left -->
		
		<div class="home-top-right">
		
			<?php if (!dynamic_sidebar('Home Top Right')) : ?>
			<div class="widget">
				<h4><?php _e("Home Top Right", 'genesis'); ?></h4>
				<p><?php _e("This is a widgeted area which is called Home Top Right. It is using the Genesis - Featured Page widget to display what you see on the Agency child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the Genesis - Featured Page widget into the Home Top widget area on the right hand side.", 'genesis'); ?></p>
			</div><!-- end .widget -->
			<?php endif; ?>
		</div><!-- end .home-top-right -->
				
	</div><!-- end #home-top -->
</div><!-- end #home-top-bg -->

<div id="home-bottom-bg">
	<div id="home-bottom">
		
		<div class="home-bottom-1">
			<?php if (!dynamic_sidebar('Home Bottom #1')) : ?>
			<div class="widget">
				<h4><?php _e("Home Bottom #1 Widget", 'genesis'); ?></h4>
				<p><?php _e("This is a widgeted area which is called Home Bottom #1. It is using the Genesis - Featured Page widget to display what you see on the Agency child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the widget into the Home Bottom #1 widget area on the right hand side.", 'genesis'); ?></p>
			</div><!-- end .widget -->
			<?php endif; ?>
		</div><!-- end .home-bottom-1 -->
		
		<div class="home-bottom-2">
			<?php if (!dynamic_sidebar('Home Bottom #2')) : ?>
			<div class="widget">
				<h4><?php _e("Home Bottom #2 Widget", 'genesis'); ?></h4>
				<p><?php _e("This is a widgeted area which is called Home Bottom #2. It is using the Genesis - Featured Page widget to display what you see on the Agency child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the widget into the Home Bottom #2 widget area on the right hand side.", 'genesis'); ?></p>
			</div><!-- end .widget -->
			<?php endif; ?>
		</div><!-- end .home-bottom-2 -->
		
		<div class="home-bottom-3">
			<?php if (!dynamic_sidebar('Home Bottom #3')) : ?>
			<div class="widget">
				<h4><?php _e("Home Bottom #3 Widget", 'genesis'); ?></h4>
				<p><?php _e("This is a widgeted area which is called Home Bottom #3. It is using the Genesis - Featured Page widget to display what you see on the Agency child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the widget into the Home Bottom #3 widget area on the right hand side.", 'genesis'); ?></p>
			</div><!-- end .widget -->
			<?php endif; ?>
		</div><!-- end .home-bottom-3 -->

    </div><!-- end #home-bottom -->
</div><!-- end #home-bottom-bg -->

<?php get_footer(); ?>