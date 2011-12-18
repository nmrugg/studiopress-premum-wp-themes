<?php if ( is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') ) : ?>
<div id="footer-widgets">
	<div class="wrap">
    	<div class="footer-widgets-1">
    		<?php dynamic_sidebar('Footer #1') ; ?> 
   		</div><!-- end .footer-widgets-1 -->
    	<div class="footer-widgets-2">
    		<?php dynamic_sidebar('Footer #2') ; ?> 
    	</div><!-- end .footer-widgets-2 -->
    	<div class="footer-widgets-3">
    		<?php dynamic_sidebar('Footer #3') ; ?> 
    	</div><!-- end .footer-widgets-3 -->
	</div><!-- end .wrap -->
</div><!-- end #footer-widgets -->
<?php endif; ?>