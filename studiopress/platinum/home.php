<?php get_header(); ?>

<?php genesis_before_content_sidebar_wrap(); ?>
<div id="content-sidebar-wrap">

	<?php genesis_before_content(); ?>
	<div id="content" class="hfeed">
	
    	<?php // checks to see if the Dynamic Content Gallery plguin is enabled - if it isn't, nothing will diplay ?>
		<?php if (function_exists('dynamic_content_gallery')) : ?>
		<div id="dynamic-content-gallery">
			<div class="widget">
				<h4><?php _e("Featured Stories", 'genesis'); ?></h4>
				<div class="wrap">
					<?php dynamic_content_gallery(); ?>
				</div><!-- end .wrap -->
			</div><!-- end .widget -->
		</div><!-- end #dynamic-content-gallery -->
		<?php endif; ?>
		
		<div id="featured-home">
			<?php if (!dynamic_sidebar('Homepage')) : ?>
				<div class="widget">
					<h4><?php _e("Homepage", 'genesis'); ?></h4>
					<div class="wrap">
						<p><?php _e("This is a widgeted area which is called Homepage. It is using the Genesis - Featured Posts widget to display what you see on the Platinum child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the Genesis - Featured Posts widget into the Homepage widget area on the right hand side. To get the image to display, simply upload an image through the media uploader on the edit page screen and publish your page. The Featured Posts widget will know to display the post image as long as you select that option in the widget interface.", 'genesis'); ?></p>
					</div><!-- end .wrap -->
				</div><!-- end .widget -->
			<?php endif; ?>
		</div><!-- end #featured-home -->					

	</div><!-- end #content -->
	<?php genesis_after_content(); ?>

</div><!-- end #content-sidebar-wrap -->
<?php genesis_after_content_sidebar_wrap(); ?>

<?php get_footer(); ?>