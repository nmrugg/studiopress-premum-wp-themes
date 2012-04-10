<?php get_header(); ?>
<?php genesis_home(); ?>

	<div id="home-top">
		<div id="slider">
			<?php if (!dynamic_sidebar('Home Featured')) : ?>
				<div class="wrap">
					<ul class="slider-posts">
						<li class="slider-post">
							<h2 class="slider-title"><?php _e("Home Featured", 'genesis'); ?></h2>
							<p><?php _e("This is a widgeted area which is called Home / Featured Area. This area works best with the Delicious - Slider Widget to display what you see on the Delicious child theme demo site. Go to Appearance > Widgets and add an available widget to the Home Featured.", 'genesis'); ?></p>
						</li>
					</ul>
				</div><!-- end .wrap -->
			<?php endif; ?>	
		</div><!-- end #slider -->
	</div><!-- end #home-top -->
	
	<div id="home-middle">
		<div class="home-middle-1">
			<?php if (!dynamic_sidebar('Home Middle Left')) : ?>
			<div class="widget">
				<h4><?php _e("Home Middle Left", 'genesis'); ?></h4>
				<p><?php _e("This is a widgeted area which is called Home Middle Left. It is using the Genesis - Featured Page widget to display what you see on the Agency child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the widget into the Home Middle Left widget area on the right hand side.", 'genesis'); ?></p>
			</div><!-- end .widget -->
			<?php endif; ?>		
		</div><!-- end .home-middle-1 -->
		<div class="home-middle-2">
			<?php if (!dynamic_sidebar('Home Middle Right')) : ?>
			<div class="widget">
				<h4><?php _e("Home Middle Right", 'genesis'); ?></h4>
				<p><?php _e("This is a widgeted area which is called Home Middle Right. It is using the Genesis - Featured Page widget to display what you see on the Agency child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the widget into the Home Middle Right widget area on the right hand side.", 'genesis'); ?></p>
			</div><!-- end .widget -->
			<?php endif; ?>		
		</div><!-- end .home-middle-2 -->
	</div><!-- end #home-middle -->		
	
	<div id="home-bottom">
		<div class="home-bottom-1">
			<?php if (!dynamic_sidebar('Home Bottom #1')) : ?>
			<div class="widget">
				<h4><?php _e("Home Bottom #1", 'genesis'); ?></h4>
				<p><?php _e("This is a widgeted area which is called Home Bottom #1. It is using the Genesis - Featured Page widget to display what you see on the Agency child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the widget into the Home Bottom #1 widget area on the right hand side.", 'genesis'); ?></p>
			</div><!-- end .widget -->
			<?php endif; ?>
		</div><!-- end .home-bottom-1 -->
		
		<div class="home-bottom-2">
			<?php if (!dynamic_sidebar('Home Bottom #2')) : ?>
			<div class="widget">
				<h4><?php _e("Home Bottom #2", 'genesis'); ?></h4>
				<p><?php _e("This is a widgeted area which is called Home Bottom #2. It is using the Genesis - Featured Page widget to display what you see on the Agency child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the widget into the Home Bottom #2 widget area on the right hand side.", 'genesis'); ?></p>
			</div><!-- end .widget -->
			<?php endif; ?>
		</div><!-- end .home-bottom-2 -->
		
		<div class="home-bottom-3">
			<?php if (!dynamic_sidebar('Home Bottom #3')) : ?>
			<div class="widget">
				<h4><?php _e("Home Bottom 3", 'genesis'); ?></h4>
				<p><?php _e("This is a widgeted area which is called Home Bottom #3. It is using the Genesis - Featured Page widget to display what you see on the Agency child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the widget into the Home Bottom #3 widget area on the right hand side.", 'genesis'); ?></p>
			</div><!-- end .widget -->
			<?php endif; ?>
		</div><!-- end .home-bottom-3 -->
	</div><!-- end #home-bottom -->
	
<?php get_footer(); ?>