<?php
/**
 * WARNING: This file is part of the core Genesis framework. DO NOT edit
 * this file under any circumstances. Please do all modifications
 * in the form of a child theme.
 *
 * Handles the secondary sidebar structure.
 *
 * @package Genesis
 */
?><div id="sidebar-alt" class="sidebar widget-area">
<?php
	genesis_structural_wrap( 'sidebar-alt' );
	do_action( 'genesis_before_sidebar_alt_widget_area' );
	do_action( 'genesis_sidebar_alt' );
	do_action( 'genesis_after_sidebar_alt_widget_area' );
	genesis_structural_wrap( 'sidebar-alt', 'close' ); 
?>
</div>