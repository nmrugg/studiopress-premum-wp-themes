<?php get_header(); ?>

<?php genesis_before_content_sidebar_wrap(); ?>
<div id="content-sidebar-wrap">

	<?php genesis_before_content(); ?>
	<div id="content" class="hfeed">
		
		<div id="homepage">
			<?php if (!dynamic_sidebar('Homepage')) : ?>
				<div class="widget">
					<h4><?php _e("Homepage", 'genesis'); ?></h4>
					<div class="wrap">
						<p><?php _e("This is a widgeted area which is called Homepage. It is using the Dynamic Content Gallery plugin and the Genesis - Featured Posts widget to display what you see on the Education child theme demo site. To get started, you'll need to download the plugin from the link given in the Education child theme's README file. Then log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the Dynamic Content Gallery widget and the Genesis - Featured Posts widget into the Homepage widget area on the right hand side.", 'genesis'); ?></p>
					</div><!-- end .wrap -->
				</div><!-- end .widget -->
			<?php endif; ?>
		</div><!-- end #homepage -->					

	</div><!-- end #content -->
	<?php genesis_after_content(); ?>

</div><!-- end #content-sidebar-wrap -->
<?php genesis_after_content_sidebar_wrap(); ?>

<?php get_footer(); ?>