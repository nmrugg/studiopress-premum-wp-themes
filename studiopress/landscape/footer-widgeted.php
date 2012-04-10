<div id="footer-widgeted">
    <div class="footer-widgeted-1">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer #1') ) : ?>
            <h4><?php _e("Footer #1 Widget", 'genesis'); ?></h4>
            <p><?php _e("This is an example of a widgeted area that you can place text to describe a particular product or service. You can also use other WordPress widgets such as recent posts, recent comments, a tag cloud or more.", 'genesis'); ?></p>
	    <?php endif; ?> 
    </div><!-- end .footer-widgeted-1 -->
    <div class="footer-widgeted-2">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer #2') ) : ?>
            <h4><?php _e("Footer #2 Widget", 'genesis'); ?></h4>
            <p><?php _e("This is an example of a widgeted area that you can place text to describe a particular product or service. You can also use other WordPress widgets such as recent posts, recent comments, a tag cloud or more.", 'genesis'); ?></p>
	    <?php endif; ?> 
    </div><!-- end .footer-widgeted-2 -->
    <div class="footer-widgeted-3">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer #3') ) : ?>
            <h4><?php _e("Footer #3 Widget", 'genesis'); ?></h4>
            <p><?php _e("This is an example of a widgeted area that you can place text to describe a particular product or service. You can also use other WordPress widgets such as recent posts, recent comments, a tag cloud or more.", 'genesis'); ?></p>
	    <?php endif; ?> 
    </div><!-- end .footer-widgeted-3 -->
</div><!-- end #footer-widgeted -->