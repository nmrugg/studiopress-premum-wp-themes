<?php get_header(); ?>

<?php genesis_before_content_sidebar_wrap(); ?>
<div id="content-sidebar-wrap">

		<div id="featured-top">
			<div class="featured-top-left">
				<?php if (!dynamic_sidebar('Featured Top Left')) : ?>
					<div class="widget">
						<h4><?php _e("Featured Top Left", 'genesis'); ?></h4>
						<div class="wrap">
							<p><?php _e("This is a widgeted area which is called Featured Top Left. It is using the Genesis - Featured Posts widget to display what you see on the Rockstar child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the Genesis - Featured Posts widget into the Featured Top Left widget area on the right hand side. To get the image to display, simply upload an image through the media uploader on the edit page screen and publish your page. The Featured Posts widget will know to display the post image as long as you select that option in the widget interface.", 'genesis'); ?></p>
						</div><!-- end .wrap -->
					</div><!-- end .widget -->
				<?php endif; ?>
			</div><!-- end .featured-top-left -->
			<div class="featured-top-right">
				<?php if (!dynamic_sidebar('Featured Top Right')) : ?>
					<div class="widget">
						<h4><?php _e("Featured Top Right", 'genesis'); ?></h4>
						<div class="wrap">
							<p><?php _e("This is a widgeted area which is called Featured Top Right. It is using the Genesis - Featured Posts widget to display what you see on the Rockstar child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the Genesis - Featured Posts widget into the Featured Top Right widget area on the right hand side. To get the image to display, simply upload an image through the media uploader on the edit page screen and publish your page. The Featured Posts widget will know to display the post image as long as you select that option in the widget interface.", 'genesis'); ?></p>
						</div><!-- end .wrap -->
					</div><!-- end .widget -->
				<?php endif; ?>
			</div><!-- end .featured-top-right -->
		</div><!-- end #featured-top -->	
		
	<?php genesis_before_content(); ?>
	<div id="content" class="hfeed">
		
		<div id="featured-bottom">
			<?php if (!dynamic_sidebar('Featured Bottom')) : ?>
				<div class="widget">
					<h4><?php _e("Featured Bottom", 'genesis'); ?></h4>
					<div class="wrap">
						<p><?php _e("This is a widgeted area which is called Featured Bottom. It is using the Genesis - Featured Posts widget to display what you see on the Rockstar child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the Genesis - Featured Posts widget into the Featured Bottom widget area on the right hand side. To get the image to display, simply upload an image through the media uploader on the edit page screen and publish your page. The Featured Posts widget will know to display the post image as long as you select that option in the widget interface.", 'genesis'); ?></p>
					</div><!-- end .wrap -->
				</div><!-- end .widget -->
			<?php endif; ?>
		</div><!-- end #featured-bottom -->	
		
	</div><!-- end #content -->
	<?php genesis_after_content(); ?>

</div><!-- end #content-sidebar-wrap -->
<?php genesis_after_content_sidebar_wrap(); ?>

<?php get_footer(); ?>