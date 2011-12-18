<?php get_header(); ?>
<?php genesis_home(); ?>

	<div id="home-top">
		<?php if (!dynamic_sidebar('Home Top')) : ?>
			<div class="widget">
				<?php if( function_exists('wp_cycle') ) : ?>
					<?php wp_cycle(); ?>
				<?php endif; ?>
			</div><!-- end .widget -->
		<?php endif; ?>				
	</div><!-- end #home-top -->
	
	<?php if ( is_active_sidebar('home-note') ) : ?>
	<div id="home-note">
		<div class="wrap">
			<?php dynamic_sidebar('Home Note') ; ?> 
		</div><!-- end .wrap -->
	</div><!-- end #home-note -->
	<?php endif; ?>
	
	<?php if ( is_active_sidebar('home-featured') ) : ?>
	<div id="home-featured">
		<div class="wrap">
			<?php dynamic_sidebar('Home Featured') ; ?> 
		</div><!-- end .wrap -->
	</div><!-- end #home-featured -->
	<?php endif; ?>
	
	<div id="home-bottom">
		<div class="wrap">
		<div class="home-bottom-left">
			<?php if (!dynamic_sidebar('Home Bottom Left')) : ?>
			<div class="widget">
				<h4><?php _e("Home Bottom Left", 'genesis'); ?></h4>
				<p><?php _e("This is a widgeted area which is called Home Bottom Left.", 'genesis'); ?></p>
			</div><!-- end .widget -->
			<?php endif; ?>
		</div><!-- end .home-bottom-left -->
		<div class="home-bottom-right">
			<?php if (!dynamic_sidebar('Home Bottom Right')) : ?>
			<div class="widget">
				<h4><?php _e("Home Bottom Right", 'genesis'); ?></h4>
				<p><?php _e("This is a widgeted area which is called Home Bottom Right.", 'genesis'); ?></p>
			</div><!-- end .widget -->
			<?php endif; ?>
		</div><!-- end .home-bottom-right -->
		</div><!-- end .wrap -->
	</div><!-- end #home-bottom -->

<?php get_footer(); ?>