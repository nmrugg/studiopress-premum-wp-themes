<?php
/**
 * The Lexicon slider widget was based completely on the Genesis featured-post-widget.php from Genesis
**/

add_action('widgets_init', create_function('', "register_widget('Lexicon_Feature_Widget');"));
class Lexicon_Feature_Widget extends WP_Widget {

	function Lexicon_Feature_Widget() {
		$widget_ops = array( 'classname' => 'feature-posts', 'description' => __('Designed for the Lexicon [Home / Featured Area]', 'genesis') );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'feature-posts' );
		$this->WP_Widget( 'feature-posts', __('Lexicon - Feature Widget', 'genesis'), $widget_ops, $control_ops );
	}

	function widget($args, $instance) {
		extract($args);
		
		$instance = wp_parse_args( (array)$instance, array(
			'title' => '',
			'posts_cat' => '',
			'posts_num' => '',
			'posts_offset' => '',
			'orderby' => '',
			'order' => '',
			'show_image' => 0,
			'image_alignment' => '',
			'image_size' => '',
			'show_title' => 0,
			'show_byline' => 0,
			'show_content' => 0,
			'content_limit' => '',
			'more_text' => ''
		) );		
		
		echo $before_widget;
		
			$featured_posts = new WP_Query(array('cat' => $instance['posts_cat'], 'showposts' => $instance['posts_num'],'offset' => $instance['posts_offset'], 'orderby' => $instance['orderby'], 'order' => $instance['order']));
			if($featured_posts->have_posts()) : while($featured_posts->have_posts()) : $featured_posts->the_post();
				
				echo '<li '; post_class('feature-post'); echo '>';

				if(!empty($instance['show_image'])) :
					echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="'.esc_attr($instance['image_alignment']).' feature-image">';
					genesis_image(array('format'=>'html', 'size'=>$instance['image_size']));
					echo '</a>';
				endif;
				
				if(!empty($instance['show_title'])) :
					echo '<h2 class="title"><a href="'.get_permalink().'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h2>';
				endif;
				
				if(!empty($instance['show_byline'])) :
					echo '<p class="byline">';
					the_time('F j, Y');
					echo ' '.__('by', 'genesis').' ';
					the_author_posts_link();
					echo ' &middot; ';
					comments_popup_link(__('Leave a Comment', 'genesis'), __('1 Comment', 'genesis'), __('% Comments', 'genesis'));
					echo ' ';
					edit_post_link(__('(Edit)', 'genesis'), '', '');
					echo '</p>';
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
				
				echo '</li><!--end post_class()-->'."\n\n";

				if(!empty($instance['show_slider_nav'])) :
					$slider_nav .= '<li><a href="#"></a></li>';
				endif;				

					
			endwhile; endif;
					
		echo $after_widget;
		echo '<div class="feature-nav '.esc_attr($instance['image_alignment']).'">';
		echo '<ul>';
		echo $slider_nav;
		echo '</ul></div>';
		wp_reset_query();
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) { 
	
		$instance = wp_parse_args( (array)$instance, array(
			'title' => '',
			'posts_cat' => '',
			'posts_num' => 1,
			'posts_offset' => 0,
			'orderby' => '',
			'order' => '',
			'show_image' => 0,
			'image_alignment' => '',
			'image_size' => '',
			'show_title' => 0,
			'show_byline' => 0,
			'show_content' => 0,
			'content_limit' => '',
			'more_text' => '[Read More...]'
		) );	
	
	?>
		<p><label for="<?php echo $this->get_field_id('posts_cat'); ?>"><?php _e('Category', 'genesis'); ?>:</label>
		<?php wp_dropdown_categories(array('name' => $this->get_field_name('posts_cat'), 'selected' => $instance['posts_cat'], 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_all' => __("All Categories", 'genesis'), 'hide_empty' => '0')); ?></p>
		
		<?php $instance['posts_num'] = (!empty($instance['posts_num'])) ? $instance['posts_num'] : 1; ?>
		<p><label for="<?php echo $this->get_field_id('posts_num'); ?>"><?php _e('Number of Posts to Show', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('posts_num'); ?>" name="<?php echo $this->get_field_name('posts_num'); ?>" value="<?php echo esc_attr( $instance['posts_num'] ); ?>" size="2" /></p>
		
		<?php $instance['posts_offset'] = (!empty($instance['posts_offset'])) ? $instance['posts_offset'] : 0; ?>
		<p><label for="<?php echo $this->get_field_id('posts_offset'); ?>"><?php _e('Number of Posts to Offset', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('posts_offset'); ?>" name="<?php echo $this->get_field_name('posts_offset'); ?>" value="<?php echo esc_attr( $instance['posts_offset'] ); ?>" size="2" /></p>
		
		<p><label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Order By', 'genesis'); ?>:</label>
		<select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>">
			<option style="padding-right:10px;" value="date" <?php selected('date', $instance['orderby']); ?>><?php _e('Date', 'genesis'); ?></option>
			<option style="padding-right:10px;" value="title" <?php selected('title', $instance['orderby']); ?>><?php _e('Title', 'genesis'); ?></option>
			<option style="padding-right:10px;" value="parent" <?php selected('parent', $instance['orderby']); ?>><?php _e('Parent', 'genesis'); ?></option>
			<option style="padding-right:10px;" value="ID" <?php selected('ID', $instance['orderby']); ?>><?php _e('ID', 'genesis'); ?></option>
			<option style="padding-right:10px;" value="comment_count" <?php selected('comment_count', $instance['orderby']); ?>><?php _e('Comment Count', 'genesis'); ?></option>
			<option style="padding-right:10px;" value="rand" <?php selected('rand', $instance['orderby']); ?>><?php _e('Random', 'genesis'); ?></option>
		</select></p>
		
		<p><label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Sort Order', 'genesis'); ?>:</label>
		<select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
			<option style="padding-right:10px;" value="DESC" <?php selected('DESC', $instance['order']); ?>><?php _e('Descending (3, 2, 1)', 'genesis'); ?></option>
			<option style="padding-right:10px;" value="ASC" <?php selected('ASC', $instance['order']); ?>><?php _e('Ascending (1, 2, 3)', 'genesis'); ?></option>
		</select></p>
		
		<hr class="div" />
		
		<p><input id="<?php echo $this->get_field_id('show_image'); ?>" type="checkbox" name="<?php echo $this->get_field_name('show_image'); ?>" value="1" <?php checked(1, $instance['show_image']); ?>/> <label for="<?php echo $this->get_field_id('show_image'); ?>"><?php _e('Show Post Image', 'genesis'); ?></label></p>

		<p><label for="<?php echo $this->get_field_id('image_size'); ?>"><?php _e('Image Size', 'genesis'); ?>:</label>
		<?php $sizes = genesis_get_additional_image_sizes(); ?>
		<select id="<?php echo $this->get_field_id('image_size'); ?>" name="<?php echo $this->get_field_name('image_size'); ?>">
			<option style="padding-right:10px;" value="thumbnail">thumbnail (<?php echo get_option('thumbnail_size_w'); ?>x<?php echo get_option('thumbnail_size_h'); ?>)</option>
			<?php
			foreach((array)$sizes as $name => $size) :
			echo '<option style="padding-right: 10px;" value="'.esc_attr($name).'" '.selected($name, $instance['image_size'], FALSE).'>'.esc_html($name).' ('.$size['width'].'x'.$size['height'].')</option>';
			endforeach;
			?>
		</select></p>	
		
		<p><label for="<?php echo $this->get_field_id('image_alignment'); ?>"><?php _e('Image Alignment', 'genesis'); ?>:</label>
		<select id="<?php echo $this->get_field_id('image_alignment'); ?>" name="<?php echo $this->get_field_name('image_alignment'); ?>">
			<option style="padding-right:10px;" value="">- <?php _e('None', 'genesis'); ?> -</option>
			<option style="padding-right:10px;" value="alignleft" <?php selected('alignleft', $instance['image_alignment']); ?>><?php _e('Left', 'genesis'); ?></option>
			<option style="padding-right:10px;" value="alignright" <?php selected('alignright', $instance['image_alignment']); ?>><?php _e('Right', 'genesis'); ?></option>
		</select></p>
		
		<hr class="div" />
		
		<p><input id="<?php echo $this->get_field_id('show_title'); ?>" type="checkbox" name="<?php echo $this->get_field_name('show_title'); ?>" value="1" <?php checked(1, $instance['show_title']); ?>/> <label for="<?php echo $this->get_field_id('show_title'); ?>"><?php _e('Show Post Title', 'genesis'); ?></label></p>
		
		<p><input id="<?php echo $this->get_field_id('show_byline'); ?>" type="checkbox" name="<?php echo $this->get_field_name('show_byline'); ?>" value="1" <?php checked(1, $instance['show_byline']); ?>/> <label for="<?php echo $this->get_field_id('show_byline'); ?>"><?php _e('Show Post Byline', 'genesis'); ?></label></p>		
		
		<p>
		<label><input type="radio" name="<?php echo $this->get_field_name('show_content'); ?>" value="" <?php checked('', $instance['show_content']); ?> /> <?php _e('Hide the Content', 'genesis'); ?></label><br />
		<label><input type="radio" name="<?php echo $this->get_field_name('show_content'); ?>" value="excerpt" <?php checked('excerpt', $instance['show_content']); ?> /> <?php _e('Show the Excerpt', 'genesis')?></label><br />
		<label><input type="radio" name="<?php echo $this->get_field_name('show_content'); ?>" value="content" <?php checked('content', $instance['show_content']); ?> /> <?php _e('Show the Content', 'genesis')?></label><br />
		<label><input type="radio" name="<?php echo $this->get_field_name('show_content'); ?>" value="content-limit" <?php checked('content-limit', $instance['show_content']); ?> /> <?php _e('Content Limit', 'genesis')?></label> 
		<input type="text" name="<?php echo $this->get_field_name('content_limit'); ?>" value="<?php echo esc_attr(intval($instance['content_limit'])); ?>" size="3" /> <?php _e('characters', 'genesis'); ?>
		</p>
		
		<?php $instance['more_text'] = (isset($instance['more_text'])) ? $instance['more_text'] : '[Read More...]'; ?>
		<p><label for="<?php echo $this->get_field_id('more_text'); ?>"><?php _e('More Text (if applicable)', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('more_text'); ?>" name="<?php echo $this->get_field_name('more_text'); ?>" value="<?php echo esc_attr($instance['more_text']); ?>" /></p>
		
		<hr class="div" />
		
		<p><input id="<?php echo $this->get_field_id('show_slider_nav'); ?>" type="checkbox" name="<?php echo $this->get_field_name('show_slider_nav'); ?>" value="1" <?php checked(1, $instance['show_slider_nav']); ?>/> <label for="<?php echo $this->get_field_id('show_slider_nav'); ?>"><?php _e('Show Slider Bullet Nav', 'genesis'); ?></label></p>
		
		<hr class="div" />
			
	<?php 
	}
}
?>