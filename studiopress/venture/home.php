<?php get_header(); ?>
<?php genesis_home(); ?>

<div id="home-left">
	<?php if (!dynamic_sidebar('Home Left')) : ?>
  <div class="widget">
    <h4><?php _e("Home Left", 'genesis'); ?></h4>
    <p><?php _e("This is a widgeted area which is called Home Left.", 'genesis'); ?></p>
  </div>			
  <?php endif; ?>
</div>

<div id="home-right">
	<?php if (!dynamic_sidebar('Home Right')) : ?>
  <div class="widget">
    <h4><?php _e("Home Right", 'genesis'); ?></h4>
    <p><?php _e("This is a widgeted area which is called Home Right.", 'genesis'); ?></p>
  </div>			
  <?php endif; ?>
</div>

<?php get_footer(); ?>