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
		$widget_ops = array( 'classname' => 'tabs-widget', 'description' => __('Displays featured tabs on homepage') );
		$control_ops = array( 'width' => 400, 'height' => 250, 'id_base' => 'tabs-widget' );
		$this->WP_Widget( 'tabs-widget', __('Featured Tabs'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		echo $before_widget;
		
		?>
    
    <div class="tab_container">
        <?php
        	$tabs_total = 4; // number of tabs
					
					for($i = 1; $i <= $tabs_total; $i++)
					{
				?>
				<div id="tab<?php echo $i; ?>" class="tab_content">
         
					<?php
          $current_tab = 'tab'.$i.'_hide';
					
					if(!$instance[$current_tab]) {
						
						$feature_page = new WP_Query( array( 'page_id' => $instance['tab'.$i.'_page'] ));
						
						if($feature_page->have_posts()) : while($feature_page->have_posts()) : $feature_page->the_post();
						
						echo '<a href="'. get_permalink() ,'">';
						genesis_image("format=html&size=Featured");
						echo '</a>';
						
						echo '<h2><a href="'.get_permalink().'">';
						the_title();
						echo '</a></h2>';
						
						the_content();
						
						endwhile; endif;
					}
					?>
          
          <!--Content-->
        </div>
        <?php
        	} 
				?>
    </div>
    
    <div class="clear"></div>
    
    <ul class="tabs">
      <?php if(!$instance['tab1_hide']) { ?><li><a href="#tab1"><?php echo $instance['tab1']; ?></a></li><?php } ?>
      <?php if(!$instance['tab2_hide']) { ?><li><a href="#tab2"><?php echo $instance['tab2']; ?></a></li><?php } ?>
      <?php if(!$instance['tab3_hide']) { ?><li><a href="#tab3"><?php echo $instance['tab3']; ?></a></li><?php } ?>
      <?php if(!$instance['tab4_hide']) { ?><li><a href="#tab4"><?php echo $instance['tab4']; ?></a></li><?php } ?>
    </ul>
    
		<div class="clear"></div>
    <?php

		echo $after_widget;
	}


	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance ); ?>
    
    <h3>Tab #1</h3>
    <p>
			<label for="<?php echo $this->get_field_id( 'tab1' ); ?>"><?php _e('Tab Label:'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'tab1' ); ?>" name="<?php echo $this->get_field_name( 'tab1' ); ?>" value="<?php echo $instance['tab1']; ?>" style="width:150px;" />
		</p>
    <p>
			<label for="<?php echo $this->get_field_id( 'tab1_page' ); ?>"><?php _e('Page:'); ?></label>
			<?php wp_dropdown_pages( array('name' => $this->get_field_name('tab1_page'), 'selected' => $instance['tab1_page'] )); ?>
		</p>
    <p>
      <input id="<?php echo $this->get_field_id( 'tab1_hide' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'tab1_hide' ); ?>" value="1" <?php checked(1, $instance[ 'tab1_hide' ]); ?>/>
      <label for="<?php echo $this->get_field_id( 'tab1_hide' ); ?>"><?php _e('Hide Tab'); ?></label>
    </p>
    
    <hr class="div" />
    
    <h3>Tab #2</h3>
    <p>
			<label for="<?php echo $this->get_field_id( 'tab2' ); ?>"><?php _e('Tab Label:'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'tab2' ); ?>" name="<?php echo $this->get_field_name( 'tab2' ); ?>" value="<?php echo $instance['tab2']; ?>" style="width:150px;" />
		</p>
    <p>
			<label for="<?php echo $this->get_field_id( 'tab2_page' ); ?>"><?php _e('Page:'); ?></label>
			<?php wp_dropdown_pages( array('name' => $this->get_field_name('tab2_page'), 'selected' => $instance['tab2_page'] )); ?>
		</p>
    <p>
      <input id="<?php echo $this->get_field_id( 'tab2_hide' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'tab2_hide' ); ?>" value="1" <?php checked(1, $instance[ 'tab1_hide' ]); ?>/>
      <label for="<?php echo $this->get_field_id( 'tab2_hide' ); ?>"><?php _e('Hide Tab'); ?></label>
    </p>
    
    <hr class="div" />
    
    <h3>Tab #3</h3>
    <p>
			<label for="<?php echo $this->get_field_id( 'tab3' ); ?>"><?php _e('Tab Label:'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'tab3' ); ?>" name="<?php echo $this->get_field_name( 'tab3' ); ?>" value="<?php echo $instance['tab3']; ?>" style="width:150px;" />
		</p>
    <p>
			<label for="<?php echo $this->get_field_id( 'tab3_page' ); ?>"><?php _e('Page:'); ?></label>
			<?php wp_dropdown_pages( array('name' => $this->get_field_name('tab3_page'), 'selected' => $instance['tab3_page'] )); ?>
		</p>
    <p>
      <input id="<?php echo $this->get_field_id( 'tab3_hide' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'tab3_hide' ); ?>" value="1" <?php checked(1, $instance[ 'tab1_hide' ]); ?>/>
      <label for="<?php echo $this->get_field_id( 'tab3_hide' ); ?>"><?php _e('Hide Tab'); ?></label>
    </p>
    
    <hr class="div" />
    
    <h3>Tab #4</h3>
    <p>
			<label for="<?php echo $this->get_field_id( 'tab4' ); ?>"><?php _e('Tab Label:'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'tab4' ); ?>" name="<?php echo $this->get_field_name( 'tab4' ); ?>" value="<?php echo $instance['tab4']; ?>" style="width:150px;" />
		</p>
    <p>
			<label for="<?php echo $this->get_field_id( 'tab4_page' ); ?>"><?php _e('Page:'); ?></label>
			<?php wp_dropdown_pages( array('name' => $this->get_field_name('tab4_page'), 'selected' => $instance['tab4_page'] )); ?>
		</p>
    <p>
      <input id="<?php echo $this->get_field_id( 'tab4_hide' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'tab4_hide' ); ?>" value="1" <?php checked(1, $instance[ 'tab1_hide' ]); ?>/>
      <label for="<?php echo $this->get_field_id( 'tab4_hide' ); ?>"><?php _e('Hide Tab'); ?></label>
    </p>
    
    <hr class="div" />
    

	<?php
	}
}

?>