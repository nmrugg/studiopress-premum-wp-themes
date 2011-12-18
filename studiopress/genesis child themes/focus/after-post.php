<?php if ( is_active_sidebar( 'after-post-left' ) || is_active_sidebar( 'after-post-right' ) ) : ?>
	<div class="after-post">
		<h3><?php _e( 'Additional Resources', 'focus' ); ?></h3>
		<div class="after-post-left">
			<?php dynamic_sidebar( 'after-post-left' ); ?>
		</div><!-- end .after-post-left -->
		<div class="after-post-right">
			<?php dynamic_sidebar( 'after-post-right' ); ?>
		</div><!-- end .after-post-right -->
	</div><!-- end #after-post -->
<?php endif; ?>