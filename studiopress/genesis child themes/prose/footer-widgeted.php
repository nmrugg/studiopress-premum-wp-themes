<?php
/**
 * This file adds footer widgets to the Prose Child Theme.
 *
 * @author StudioPress
 * @package Prose
 * @subpackage Customisations
 */

if ( is_active_sidebar(3) || is_active_sidebar(4) || is_active_sidebar(5) ) : ?>
<div id="footer-widgeted">
	<div class="wrap">
    	<div class="footer-widgeted-1">
        	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer #1') ) : ?>
	    	<?php endif; ?> 
   		</div><!-- end .footer-widgeted-1 -->
    	<div class="footer-widgeted-2">
        	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer #2') ) : ?>
   	    	<?php endif; ?> 
    	</div><!-- end .footer-widgeted-2 -->
    	<div class="footer-widgeted-3">
        	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer #3') ) : ?>
	    	<?php endif; ?> 
    	</div><!-- end .footer-widgeted-3 -->
	</div><!-- end .wrap -->
</div><!-- end #footer-widgeted -->
<?php endif; ?>