<div id="feature">
	<?php if (!dynamic_sidebar('Home Featured')) : ?>
		<ul class="feature-posts">
			<li class="feature-post">	
				<h2 class="title"><?php _e("Home Featured", 'genesis'); ?></h2>
				<p><?php _e("This is an example of a WordPress post, you could edit this to put information about yourself or your site so readers know where you are coming from. You can create as many posts like this one or sub-posts as you like and manage all of your content inside of WordPress. This is an example of a WordPress post, you could edit this to put information about yourself.", 'genesis'); ?>
			</li>
		</ul>
	<?php endif; ?>	
</div>