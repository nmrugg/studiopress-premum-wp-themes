<?php get_header(); ?>
<?php genesis_home(); ?>

<div id="home-top">
	
	<div class="home-top-shadow"></div>
  
	<div class="home-top-left">
    	<div class="wrap">
			<?php if (!dynamic_sidebar('Home Top Left')) : ?>
      			<div class="widget">
        			<h4><?php _e("Home Top Left", 'genesis'); ?></h4>
        			<p><?php _e("This is a widgeted area which is called Home Top Left. It is using the Genesis - Featured Page widget to display what you see on the Crystal child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the Genesis - Featured Page widget into the Home Top widget area on the right hand side.", 'genesis'); ?></p>
      			</div><!-- end .widget -->	
    		<?php endif; ?>
		</div><!-- end .wrap -->	
	</div><!-- end .home-top-left -->
  
	<div class="home-top-right">
  		<div class="wrap">
			<?php if (!dynamic_sidebar('Home Top Right')) : ?>
      			<div class="widget">
        			<?php if( function_exists('wp_cycle') ) : ?>
          				<?php wp_cycle(); ?>
        			<?php endif; ?>
      			</div><!-- end .widget -->	
    		<?php endif; ?>
		</div><!-- end .wrap -->	
	</div><!-- end .home-top-right -->
  
	<div class="clear"></div>
  
</div><!-- end #home-top -->

<div id="home-middle">
	<div class="home-middle-top"></div>
  		<div class="wrap">
			<?php if (!dynamic_sidebar('Home Middle')) : ?>
    			<div class="widget">
      				<h4><?php _e("Home Middle Widget", 'genesis'); ?></h4>
      				<p><?php _e("This is a widgeted area which is called Home Middle. It is using the Genesis - Featured Post widget to display what you see on the Crystal child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the Genesis - Featured Post widget into the Home Middle widget area on the right hand side. To get the image to display, simply upload an image through the media uploader on the edit post screen and publish your page. The Featured Post widget will know to display the post image as long as you select that option in the widget interface.", 'genesis'); ?></p>
    			</div><!-- end .widget -->	
    		<?php endif; ?>
    		<div class="clear"></div>
		</div><!-- end .wrap -->	
	<div class="home-middle-bottom"></div>
  
	<div class="clear"></div>
  
</div><!-- end #home-middle -->

<div id="home-bottom">
  
	<div class="home-bottom-1">
    	<div class="wrap">
			<?php if (!dynamic_sidebar('Home Bottom #1')) : ?>
    			<div class="widget">
      				<h4><?php _e("Home Bottom #1 Widget", 'genesis'); ?></h4>
      				<p><?php _e("This is a widgeted area which is called Home Bottom #1. It is using the Genesis - Featured Page widget to display what you see on the Crystal child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the Genesis - Featured Page widget into the Home Bottom #1 widget area on the right hand side. To get the image to display, simply upload an image through the media uploader on the edit post screen and publish your post. The Featured Page widget will know to display the post image as long as you select that option in the widget interface.", 'genesis'); ?></p>
    			</div><!-- end .widget -->		
    		<?php endif; ?>
    	</div><!-- end .wrap -->	
	</div><!-- end .home-bottom-1 -->
  
	<div class="home-bottom-2">
    	<div class="wrap">
			<?php if (!dynamic_sidebar('Home Bottom #2')) : ?>
    			<div class="widget">
      				<h4><?php _e("Home Bottom #2 Widget", 'genesis'); ?></h4>
      				<p><?php _e("This is a widgeted area which is called Home Bottom #2. It is using the Genesis - Featured Page widget to display what you see on the Crystal child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the Genesis - Featured Page widget into the Home Bottom #2 widget area on the right hand side. To get the image to display, simply upload an image through the media uploader on the edit post screen and publish your post. The Featured Page widget will know to display the post image as long as you select that option in the widget interface.", 'genesis'); ?></p>
    			</div><!-- end .widget -->	
    		<?php endif; ?>
    	</div><!-- end .wrap -->	
	</div><!-- end .home-bottom-2 -->
  
	<div class="home-bottom-3">
    	<div class="wrap">
			<?php if (!dynamic_sidebar('Home Bottom #3')) : ?>
    			<div class="widget">
      				<h4><?php _e("Home Bottom #3 Widget", 'genesis'); ?></h4>
      				<p><?php _e("This is a widgeted area which is called Home Bottom #3. It is using the Genesis - Featured Page widget to display what you see on the Crystal child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the Genesis - Featured Page widget into the Home Bottom #3 widget area on the right hand side. To get the image to display, simply upload an image through the media uploader on the edit post screen and publish your post. The Featured Page widget will know to display the post image as long as you select that option in the widget interface.", 'genesis'); ?></p>
    			</div><!-- end .widget -->	
    		<?php endif; ?>
    	</div><!-- end .wrap -->	
	</div><!-- end .home-bottom-3 -->

</div><!-- end #home-bottom -->

<?php get_footer(); ?>