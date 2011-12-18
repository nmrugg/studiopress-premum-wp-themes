<?php get_header(); ?>

	<div id="home">
						
		<div id="home-top">
			<div class="home-top-left">
				<?php if (!dynamic_sidebar('Home Top Left')) : ?>
					<div class="widget">
						<h4><?php _e("Home Top Left", 'genesis'); ?></h4>
						<div class="wrap">
							<p><?php _e("This is a widgeted area which is called Home Top Left. It is using the Genesis - Featured Posts widget to display what you see on the Sleek child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the Genesis - Featured Posts widget into the Home Top Left widget area on the right hand side. To get the image to display, simply upload an image through the media uploader on the edit page screen and publish your page. The Featured Posts widget will know to display the post image as long as you select that option in the widget interface.", 'genesis'); ?></p>
						</div><!-- end .wrap -->
					</div><!-- end .widget -->
				<?php endif; ?>
			</div><!-- end .home-top-left -->
			<div class="home-top-right">
				<?php if (!dynamic_sidebar('Home Top Right')) : ?>
					<div class="widget">
						<h4><?php _e("Home Top Right", 'genesis'); ?></h4>
						<div class="wrap">
							<p><?php _e("This is a widgeted area which is called Featured Bottom Right. It is using the Genesis - Featured Posts widget to display what you see on the Sleek child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the Genesis - Featured Posts widget into the Home Top Right widget area on the right hand side. To get the image to display, simply upload an image through the media uploader on the edit page screen and publish your page. The Featured Posts widget will know to display the post image as long as you select that option in the widget interface.", 'genesis'); ?></p>
						</div><!-- end .wrap -->
					</div><!-- end .widget -->
				<?php endif; ?>
			</div><!-- end .home-top-right -->
		</div><!-- end #home-top -->	
		
		<div id="home-bottom">
			<div class="wrap">
    			<div class="home-bottom-1">
        			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Bottom #1') ) : ?>
						<div class="widget">
							<div class="widget-wrap">
            					<h4><?php _e("Home Bottom #1 Widget", 'genesis'); ?></h4>
            					<p><?php _e("This is an example of a widgeted area that you can place text to describe a particular product or service. You can also use other WordPress widgets such as recent posts, recent comments, a tag cloud or more.", 'genesis'); ?></p>
            				</div>
            			</div>
	    			<?php endif; ?> 
   				</div><!-- end .home-bottom-1 -->
    			<div class="home-bottom-2">
        			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Bottom #2') ) : ?>
						<div class="widget">
							<div class="widget-wrap">
            					<h4><?php _e("Home Bottom #2 Widget", 'genesis'); ?></h4>
            					<p><?php _e("This is an example of a widgeted area that you can place text to describe a particular product or service. You can also use other WordPress widgets such as recent posts, recent comments, a tag cloud or more.", 'genesis'); ?></p>
            				</div>
            			</div>
	    			<?php endif; ?> 
    			</div><!-- end .home-bottom-2 -->
    			<div class="home-bottom-3">
        			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Bottom #3') ) : ?>
						<div class="widget">
							<div class="widget-wrap">
            					<h4><?php _e("Home Bottom #3 Widget", 'genesis'); ?></h4>
            					<p><?php _e("This is an example of a widgeted area that you can place text to describe a particular product or service. You can also use other WordPress widgets such as recent posts, recent comments, a tag cloud or more.", 'genesis'); ?></p>
            				</div>
            			</div>
	    			<?php endif; ?> 
    			</div><!-- end .home-bottom-3 -->
			</div><!-- end .wrap -->
		</div><!-- end #home-bottom -->
		
	</div><!-- end #home -->

<?php get_footer(); ?>