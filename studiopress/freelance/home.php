<?php get_header(); ?>

<?php genesis_before_content_sidebar_wrap(); ?>
<div id="content-sidebar-wrap">

	<?php genesis_before_content(); ?>
	<div id="content" class="hfeed">
		
		<div id="home-top">
			<?php if (!dynamic_sidebar('Home Top')) : ?>
				<div class="widget">
					<h4><?php _e("Home Top", 'genesis'); ?></h4>
					<div class="wrap">
						<p><?php _e("This is a widgeted area which is called Home Top. It is using the Genesis - Featured Page widget to display what you see on the Freelance child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the Genesis - Featured Page widget into the Home Top widget area on the right hand side.", 'genesis'); ?></p>
					</div><!-- end .wrap -->
				</div><!-- end .widget -->
			<?php endif; ?>
		</div><!-- end #home-top -->		
		
		<div id="home-bottom">
			<?php if (!dynamic_sidebar('Home Bottom')) : ?>
				<div class="widget">
					<h4><?php _e("Home Bottom", 'genesis'); ?></h4>
					<div class="wrap">
						<p><?php _e("This is a widgeted area which is called Home Bottom. It is using the Genesis - Featured Page widget to display what you see on the Freelance child theme demo site. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag the Genesis - Featured Page widget into the Home Top widget area on the right hand side.", 'genesis'); ?></p>
					</div><!-- end .wrap -->
				</div><!-- end .widget -->
			<?php endif; ?>
		</div><!-- end #home-bottom -->			

	</div><!-- end #content -->
	<?php genesis_after_content(); ?>

</div><!-- end #content-sidebar-wrap -->
<?php genesis_after_content_sidebar_wrap(); ?>

<?php get_footer(); ?>