<?php
add_action( 'wp_head', 'head_slideshow', 1 );
function head_slideshow() {
	
	// javascript
	wp_enqueue_script( 'tabs_script', CHILD_URL.'/widgets/tabs.js', array( 'jquery' ),'1.3.2' );
	
	// styles
	wp_register_style( 'tabs_styles', CHILD_URL.'/widgets/style.css' );
	wp_enqueue_style( 'tabs_styles' );

}

add_action( 'widgets_init', 'TabsWidgetRegister' );
function TabsWidgetRegister() {
	register_widget( 'TabsWidget' );
}

class TabsWidget extends WP_Widget {

	function TabsWidget() {
		$widget_ops = array( 'classname' => 'tabs-widget', 'description' => __('Genesis - Home Featured') );
		$control_ops = array( 'width' => 300, 'height' => 250, 'id_base' => 'tabs-widget' );
		$this->WP_Widget( 'tabs-widget', __('Genesis - Home Featured'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		echo $before_widget;
		
		?>
    
    <div class="tab_container">
        <?php
				
					$posts_list = new WP_Query(array('post_type' => 'post', 'cat' =>$instance['posts_cat'], 'showposts' => $instance['posts_num'], 'orderby' => $instance['orderby'], 'order' => $instance['order']));
					
					$i = 1;
					
					if($posts_list->have_posts()) : while($posts_list->have_posts()) : $posts_list->the_post();
				?>
        
          <div id="tab<?php echo $i; ?>" class="tab_content">
            
            <div class="image">
							<a href="#tab<?php echo $i; ?>"><?php genesis_image("format=html&size=home-featured"); ?></a>
            </div>
            
						<div class="text">
						<?php
							if ( !empty( $instance['show_byline'] ) && !empty( $instance['post_info'] ) ) :
								printf( '<p class="byline post-info">%s</p>', do_shortcode( esc_html( $instance['post_info'] ) ) );
							endif;
						
              if(!empty($instance['show_title'])) :
								printf( '<h2><a href="%s" title="%s">%s</a></h2>', get_permalink(), the_title_attribute('echo=0'), the_title_attribute('echo=0') );
							endif;
              
              if(!empty($instance['show_content'])) :
				
								if($instance['show_content'] == 'excerpt') :
									the_excerpt();
								elseif($instance['show_content'] == 'content-limit') :
									the_content_limit( (int)$instance['content_limit'], esc_html( $instance['more_text'] ) );
								else :
									the_content( esc_html( $instance['more_text'] ) );
								endif;
								
							endif;
            ?>
            </div>
            
          </div>
          
        <?php
					
					$i += 1;
				
        	endwhile; endif; 
				?>
    </div>
    
    <div class="clear"></div>
    
    <ul class="tabs">
    	<?php
				$i = 1; 
				if($posts_list->have_posts()) : while($posts_list->have_posts()) : $posts_list->the_post();
			?>
      
      <li><a href="#tab<?php echo $i; ?>"><?php genesis_image("format=html&size=home-thumbnail"); ?></a></li>
      
      <?php
      	$i += 1;
				endwhile; endif;
			?>
    </ul>
    
		<div class="clear"></div>
    <?php

		echo $after_widget;
	}


	function form( $instance ) {

		// ensure value exists
		$instance = wp_parse_args( (array)$instance, array(
			'title' => '',
			'show_title' => 0,
			'posts_cat' => '',
			'posts_num' => 0,
			'orderby' => '',
			'order' => '',
			'show_byline' => 0,
			'post_info' => '[post_date] ' . __('By', 'genesis') . ' [post_author_posts_link] [post_comments]',
			'show_content' => 'excerpt',
			'content_limit' => '',
			'more_text' => __('[Read More...]', 'genesis')
		) );
		
		?>
    
    <p>
			<label for="<?php echo $this->get_field_id( 'posts_num' ); ?>"><?php _e('Number of Posts to Show:'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'posts_num' ); ?>" name="<?php echo $this->get_field_name( 'posts_num' ); ?>" value="<?php echo $instance['posts_num']; ?>" style="width:30px;" />
		</p>
    
    <p>
      <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Order By'); ?>:</label>
      <select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>">
        <option style="padding-right:10px;" value="date" <?php selected('date', $instance['orderby']); ?>><?php _e('Date'); ?></option>
        <option style="padding-right:10px;" value="title" <?php selected('title', $instance['orderby']); ?>><?php _e('Title'); ?></option>
        <option style="padding-right:10px;" value="parent" <?php selected('parent', $instance['orderby']); ?>><?php _e('Parent'); ?></option>
        <option style="padding-right:10px;" value="ID" <?php selected('ID', $instance['orderby']); ?>><?php _e('ID'); ?></option>
        <option style="padding-right:10px;" value="comment_count" <?php selected('comment_count', $instance['orderby']); ?>><?php _e('Comment Count'); ?></option>
        <option style="padding-right:10px;" value="rand" <?php selected('rand', $instance['orderby']); ?>><?php _e('Random'); ?></option>
      </select>
    </p>
		
		<p>
      <label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Sort Order'); ?>:</label>
      <select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
        <option style="padding-right:10px;" value="DESC" <?php selected('DESC', $instance['order']); ?>><?php _e('Descending (3, 2, 1)'); ?></option>
        <option style="padding-right:10px;" value="ASC" <?php selected('ASC', $instance['order']); ?>><?php _e('Ascending (1, 2, 3)'); ?></option>
      </select>
    </p>
    
    <p>
    	<input id="<?php echo $this->get_field_id('show_title'); ?>" type="checkbox" name="<?php echo $this->get_field_name('show_title'); ?>" value="1" <?php checked(1, $instance['show_title']); ?>/> <label for="<?php echo $this->get_field_id('show_title'); ?>"><?php _e('Show Post Title', 'genesis'); ?></label>
    </p>
    
    <p>
    <input id="<?php echo $this->get_field_id('show_byline'); ?>" type="checkbox" name="<?php echo $this->get_field_name('show_byline'); ?>" value="1" <?php checked(1, $instance['show_byline']); ?>/> <label for="<?php echo $this->get_field_id('show_byline'); ?>"><?php _e('Show Post Byline'); ?></label>
      
      <input type="text" id="<?php echo $this->get_field_id('post_info'); ?>" name="<?php echo $this->get_field_name('post_info'); ?>" value="<?php echo esc_attr($instance['post_info']); ?>" style="width: 99%;" />
    </p>
    
    <p>
      <label for="<?php echo $this->get_field_id( 'posts_cat' ); ?>"><?php _e('Category:'); ?></label>
        <?php wp_dropdown_categories(array('name' => $this->get_field_name('posts_cat'), 'selected' => $instance['posts_cat'], 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_all' => __("All Categories"), 'hide_empty' => '0')); ?>
		</p>
    
    <p>
      <label for="<?php echo $this->get_field_id('show_content'); ?>"><?php _e('Content Type', 'genesis'); ?>:</label>
      <select id="<?php echo $this->get_field_id('show_content'); ?>" name="<?php echo $this->get_field_name('show_content'); ?>">
        <option value="content" <?php selected('content' , $instance['show_content'] ); ?>><?php _e('Show Content', 'genesis'); ?></option>
        <option value="excerpt" <?php selected('excerpt' , $instance['show_content'] ); ?>><?php _e('Show Excerpt', 'genesis'); ?></option>
        <option value="content-limit" <?php selected('content-limit' , $instance['show_content'] ); ?>><?php _e('Show Content Limit', 'genesis'); ?></option>
        <option value="" <?php selected('' , $instance['show_content'] ); ?>><?php _e('No Content', 'genesis'); ?></option>
      </select>
      
      <br /><label for="<?php echo $this->get_field_id('content_limit'); ?>"><?php _e('Limit content to', 'genesis'); ?></label> <input type="text" id="<?php echo $this->get_field_id('image_alignment'); ?>" name="<?php echo $this->get_field_name('content_limit'); ?>" value="<?php echo esc_attr(intval($instance['content_limit'])); ?>" size="3" /> <?php _e('characters', 'genesis'); ?>
    </p>
		
		<p>
      <label for="<?php echo $this->get_field_id('more_text'); ?>"><?php _e('More Text (if applicable)', 'genesis'); ?>:</label>
      <input type="text" id="<?php echo $this->get_field_id('more_text'); ?>" name="<?php echo $this->get_field_name('more_text'); ?>" value="<?php echo esc_attr($instance['more_text']); ?>" />
    </p>

	<?php
	}
}

?>