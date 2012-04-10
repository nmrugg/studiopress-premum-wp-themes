<?php get_header(); ?>
	<div class="homepage">
		<!-- start sliding boxes -->
		<div class="homepage-gallery">
			<?php $recent = new WP_Query(array('cat' => genesis_get_option('gallery_cat'), 'showposts' => genesis_get_option('number_images'))); while($recent->have_posts()) : $recent->the_post();?>
				<div class="polaroid-bg">
					<div class="boxgrid slidedown">
						<a href="<?php the_permalink() ?>" rel="bookmark"><?php genesis_image(array('format' => 'html', 'size' => 'Gallery', 'attr' => array('class' => 'cover'))); ?></a>
						<h3><a href="<?php the_permalink() ?>" rel="bookmark"><?php $title = the_title('','',FALSE); echo substr($title, 0, 20); ?></a></h3>
						<!-- comment this line out remove the author -->
						<p>by <?php the_author(); ?></p>
					 <!-- uncomment this line to use an excerpt instead -->
						<!--?php the_content_limit('30',' more &raquo'); ?-->
					</div>
				</div>
			<?php endwhile; ?>
		</div>	 
	</div>
<?php get_footer(); ?>