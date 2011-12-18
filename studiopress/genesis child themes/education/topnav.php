<div id="topnav">
	<div class="topnav-left">
		<p><?php echo date(get_option('date_format')); ?></p>
	</div><!-- end .topnav-left -->
	<div class="topnav-right">
		<p>
			<a class="rss-topnav" rel="nofollow" href="<?php bloginfo('rss_url'); ?>"><?php _e("Posts", 'genesis'); ?></a>
			<a class="rss-topnav" rel="nofollow" href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e("Comments", 'genesis'); ?></a>
		</p>
	</div><!-- end .topnav-right -->
</div><!-- end #topnav -->