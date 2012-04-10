<?php
get_header();
genesis_before_loop();
?>
<div class="homepage">
	<div id="main-content">
	<?php if ( ! dynamic_sidebar( 'Home Main' ) ) { ?>
		<div class="widget">
			<h4 class="widgettitle"><?php _e( 'Home Main', 'familytree' ); ?></h4>
			<div class="wrap">
				<p><?php _e( 'This is a widgeted area which is called Home Main. You can use the Genesis - Featured Posts, Genesis - Featured Page or Family Tree - Slider (Page or Post) widgets in this section. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag your selected widget into the Homepage Main widget area on the right hand side.', 'familytree' ); ?></p>
			</div><!-- end .wrap -->
		</div><!-- end .widget -->
	<?php } ?>
    </div>

    <div id="ad-block">
    <?php if ( ! dynamic_sidebar( 'Home Ads' ) ) { ?>
		<div class="widget">
			<h4 class="widgettitle"><?php _e( 'Home Ads', 'familytree' ); ?></h4>
			<div class="wrap">
				<p><?php _e( 'This is a widgeted area which is called Home Ads. You can use the Ad-minister plug-in or text widgets to insert up to 5 ads. To get started, log into your WordPress dashboard, and then go to the Appearance > Widgets screen. There you can drag your selected widget into the Homepage Ads widget area on the right hand side.', 'familytree' ); ?></p>
			</div><!-- end .wrap -->
		</div><!-- end .widget -->
		<?php } ?>
    </div>
</div>
<?php get_footer(); ?>