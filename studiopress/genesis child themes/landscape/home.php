<?php get_header(); ?>
<?php genesis_home(); ?>

<div id="homepage">
	<?php if( function_exists('wp_cycle') ) : ?>
		<?php wp_cycle(); ?>
	<?php endif; ?>
</div>

<?php get_footer(); ?>