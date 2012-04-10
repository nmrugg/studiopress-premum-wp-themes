<?php
/*
 * Creativity Included EasySlider Widget
 */

/* Prevent direct access to the plugin */
if ( ! defined( 'ABSPATH' ) ) {
	wp_die( __( 'Sorry, you are not allowed to access this page directly.', 'ci-easyslider' ) );
}


add_action( 'widgets_init', create_function( '', "register_widget('Creativity_Included_EasySlider');" ) );

class Creativity_Included_EasySlider extends WP_Widget {

	/**
	 * Creates Widget.
	 *
	 * @since 1.2
	 * @author Nick Croft
	 */
	function Creativity_Included_EasySlider() {
		$widget_ops = array(
			'classname'   => 'ci-slider',
			'description' => __( 'Displays the Creativity Included EasySlider, making it simple to add a slider to your site', 'ci-easyslider' )
		);
		$control_ops = array(
			'id_base' => 'ci-slider',
			'width'   => 250,
			'height'  => 350
		);
		$this->WP_Widget( 'ci-slider', __( 'Creativity Included EasySlider', 'ci-easyslider' ), $widget_ops, $control_ops );

	}

	/**
	 * Creates Widget Output.
	 *
	 * @since 1.2
	 * @author Nick Croft
	 *
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {

		extract( $args );

		// defaults
		$instance = wp_parse_args( (array) $instance, array(
			'post_type' => 'post',
			'page_id' => '',
			'posts_term' => '',
			'exclude_terms' => '',
			'exclude_cat' => '',
			'include_exclude' => '',
			'post_id' => '',
			'posts_num' => 3,
			'posts_offset' => 0,
			'orderby' => '',
			'order' => '',
			'meta_key' => '',
			'image_field' => ''
		) );

		echo $before_widget;

		$term_args = array( );

		if ( $instance['page_id'] )
			$term_args['page_id'] = $instance['page_id'];

		if ( 'page' != $instance['post_type'] ) {


			if ( $instance['posts_term'] ) {
				$posts_term = explode( ',', $instance['posts_term'] );

				if ( 'category' == $posts_term['0'] )
					$posts_term['0'] = 'category_name';

				if ( 'post_tag' == $posts_term['0'] )
					$posts_term['0'] = 'tag';

				if ( isset( $posts_term['1'] ) )
					$term_args[$posts_term['0']] = $posts_term['1'];
			}

			if ( ! empty( $posts_term['0'] ) ) {

				if ( 'category' == $posts_term['0'] )
					$taxonomy = 'category';

				elseif ( 'post_tag' == $posts_term['0'] )
					$taxonomy = 'post_tag';

				else
					$taxonomy = $posts_term['0'];
			} else {
				$taxonomy = 'category';
			}

			if ( ! empty( $instance['exclude_terms'] ) ) {
				$exclude_terms = explode( ',', str_replace( ' ', '', $instance['exclude_terms'] ) );
				$term_args[$taxonomy . '__not_in'] = $exclude_terms;
			}
		}

		if ( ! empty( $instance['posts_offset'] ) ) {
			global $myOffset;
			$myOffset = $instance['posts_offset'];
			$term_args['offset'] = $myOffset;
		}

		if ( ! empty( $instance['post_id'] ) ) {
			$IDs = explode( ',', str_replace( ' ', '', $instance['post_id'] ) );
			if ( 'include' == $instance['include_exclude'] )
				$term_args['post__in'] = $IDs;
			else
				$term_args['post__not_in'] = $IDs;
		}

		$query_args = array_merge( $term_args, array(
			'post_type'      => $instance['post_type'],
			'posts_per_page' => $instance['posts_num'],
			'orderby'        => $instance['orderby'],
			'order'          => $instance['order'],
			'meta_key'       => $instance['meta_key']
		) );

		$query_args = apply_filters( 'familytree_query_args', $query_args, $instance );
		?>

		<div id="container">
			<div id="mySlides">

				<?php
				$controller = '';

				$slider_posts = new WP_Query( $query_args );
				while ( $slider_posts->have_posts() ) : $slider_posts->the_post();

					$controller .= '<span class="jFlowControl"></span>';
					?>

					<div class="slider-image">
						<?php echo $instance['image_field'] && genesis_get_custom_field( $instance['image_field'] ) ? '<img src="' . genesis_get_custom_field( $instance['image_field'] ) . '" alt="' . get_the_title() . '" />' : genesis_get_image( "format=html&size=slider" ); ?>
						<span><h3 class="bracket">{ <a href="<?php the_permalink() ?>"><?php the_title(); ?></a> }</h3></span>
					</div>

		<?php endwhile; ?>
			</div>

			<div id="myController">

		<?php echo $controller; ?>

			</div>

		<?php if ( $instance['posts_num'] >= 2 ) { ?>

				<span class="jFlowPrev"><div></div></span>
				<span class="jFlowNext"><div></div></span>

		<?php } ?>
		</div>
		<?php
		echo $after_widget;

		wp_reset_query();

	}

	/**
	 * Updates Widget Instance.
	 *
	 * @since 1.2
	 * @author Nick Croft
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {

		return $new_instance;

	}

	/**
	 * Creates Widget Form.
	 *
	 * @since 1.2
	 * @author Nick Croft
	 *
	 * @param array $instance Values set in widget isntance
	 */
	function form( $instance ) {

		// ensure value exists
		$instance = wp_parse_args( (array) $instance, array(
			'post_type'       => 'post',
			'page_id'         => '',
			'posts_term'      => '',
			'exclude_terms'   => '',
			'exclude_cat'     => '',
			'include_exclude' => '',
			'post_id'         => '',
			'posts_num'       => 1,
			'posts_offset'    => 0,
			'orderby'         => '',
			'order'           => '',
			'meta_key'        => '',
			'image_field'     => ''
		) );
		?>
		<div>
			<div style="background: #f1f1f1; border: 1px solid #DDD; padding: 10px 10px 0px 10px;">

				<!-- section one -->
				<strong style="font-size: 12px;">Type of Content</strong>
				<p style="font-size: 11px; font-style: bold; margin-top: 5px;"><label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php _e( 'Would you like to use posts or pages', 'ci-easyslider' ); ?>?</label>
					<select class="widget-control-save" id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>">
						<?php
						$args = array(
							'public' => true
						);
						$output = 'names';
						$operator = 'and';
						$post_types = get_post_types( $args, $output, $operator );
						$post_types = array_filter( $post_types, 'familytree_exclude_post_types' );

						foreach ( $post_types as $post_type ) {
							?>
							<option style="padding-right:10px;" value="<?php echo esc_attr( $post_type ); ?>" <?php selected( esc_attr( $post_type ), $instance['post_type'] ); ?>><?php echo esc_attr( $post_type ); ?></option><?php } ?>

					</select></p>

				<!-- section two -->
				<p style="margin-top: 10px; padding-top: 10px; border-top: double #DDD;"><strong style="font-size: 12px;">Filter Slides</strong></p>
				<!-- description -->
				<p style="<?php familytree_display_option( $instance, 'post_type', 'page' ); ?>font-size: 11px;"><strong style="display: block; font-size: 11px; margin-top: 10px;">By Taxonomy and Terms</strong><label for="<?php echo $this->get_field_id( 'posts_term' ); ?>"><?php _e( 'Choose a term to determine what slides to include', 'ci-easyslider' ); ?>.</label>

					<!-- field -->
					<select id="<?php echo $this->get_field_id( 'posts_term' ); ?>" name="<?php echo $this->get_field_name( 'posts_term' ); ?>" style="margin-top: 5px;">
						<option style="padding-right:10px;" value="" <?php selected( '', $instance['posts_term'] ); ?>><?php _e( 'All Taxonomies and Terms', 'ci-easyslider' ); ?></option>
						<?php
						$taxonomies = get_taxonomies( array( 'public' => true ), 'objects' );

						$taxonomies = array_filter( $taxonomies, 'familytree_exclude_taxonomies' );
						$test = get_taxonomies( array( 'public' => true ), 'objects' );

						foreach ( $taxonomies as $taxonomy ) {
							$query_label = '';
							if ( ! empty( $taxonomy->query_var ) )
								$query_label = $taxonomy->query_var;
							else
								$query_label = $taxonomy->name;
							?>
							<optgroup label="<?php echo esc_attr( $taxonomy->labels->name ); ?>">
								<option style="margin-left: 5px; padding-right:10px;" value="<?php echo esc_attr( $query_label ); ?>" <?php selected( esc_attr( $query_label ), $instance['posts_term'] ); ?>><?php echo $taxonomy->labels->all_items; ?></option><?php
					$terms = get_terms( $taxonomy->name, 'orderby=name&hide_empty=1' );
					foreach ( $terms as $term ) {
								?>
									<option style="margin-left: 8px; padding-right:10px;" value="<?php echo esc_attr( $query_label ) . ',' . $term->slug; ?>" <?php selected( esc_attr( $query_label ) . ',' . $term->slug, $instance['posts_term'] ); ?>><?php echo '-' . esc_attr( $term->name ); ?></option><?php } ?>
							</optgroup> <?php
						} ?>
					</select></p>

				<!-- section two b -->
				<!-- description -->
				<p style="<?php familytree_display_option( $instance, 'post_type', 'page' ); ?>font-size: 11px;"><strong style="display: block; font-size: 11px; margin-top: 10px;">Exclude by Taxonomy ID</strong><label for="<?php echo $this->get_field_id( 'exclude_terms' ); ?>"><?php printf( __( 'Use a comma separated list of category, tag or other taxonomy IDs to keep them from displaying in the slider', 'ci-easyslider' ), '<br />' ); ?>.</label>

					<!-- field -->
					<input type="text" id="<?php echo $this->get_field_id( 'exclude_terms' ); ?>" name="<?php echo $this->get_field_name( 'exclude_terms' ); ?>" value="<?php echo esc_attr( $instance['exclude_terms'] ); ?>" style="width:95%; margin-top: 5px;" /></p>

				<!-- section two c -->
				<strong style="font-size: 11px; margin-top: 10px;"><label for="<?php echo $this->get_field_id( 'include_exclude' ); ?>"><?php printf( __( 'Include or Exclude by %s ID', 'ci-easyslider' ), $instance['post_type'] ); ?></label></strong>
				<!-- description -->
				<p style="<?php familytree_display_option( $instance, 'page_id', '', false ); ?>font-size: 11px; margin-bottom: 0; padding-bottom: 0;">Choose the include or exclude slides using their post/page ID in a comma-separated list.</p>
				<!-- field -->
				<select style="margin-top: 5px;"class="widget-control-save" id="<?php echo $this->get_field_id( 'include_exclude' ); ?>" name="<?php echo $this->get_field_name( 'include_exclude' ); ?>">

					<option style="padding-right:10px;" value="" <?php selected( '', $instance['include_exclude'] ); ?>><?php _e( 'Select', 'ci-easyslider' ); ?></option>
					<option style="padding-right:10px;" value="include" <?php selected( 'include', $instance['include_exclude'] ); ?>><?php _e( 'Include', 'ci-easyslider' ); ?></option>
					<option style="padding-right:10px;" value="exclude" <?php selected( 'exclude', $instance['include_exclude'] ); ?>><?php _e( 'Exclude', 'ci-easyslider' ); ?></option>
				</select></p>

				<p style="<?php familytree_display_option( $instance, 'page_id', '', false );
		   familytree_display_option( $instance, 'include_exclude' ); ?>font-size: 11px; margin-bottom: 10px; border: 1px solid #DDD; background: #DFDFDF; padding: 5px;"><label for="<?php echo $this->get_field_id( 'post_id' ); ?>">List which <strong><?php echo $instance['post_type'] . ' ' . __( 'ID', 'ci-easyslider' ); ?>s</strong> to include/exclude.<br />Use a comma-separated list.</label>
					<input type="text" id="<?php echo $this->get_field_id( 'post_id' ); ?>" name="<?php echo $this->get_field_name( 'post_id' ); ?>" value="<?php echo esc_attr( $instance['post_id'] ); ?>" style="width:95%; margin-bottom: 10px; margin-top: 5px;" /></p>
				<!-- include by meta -->
				<strong style="font-size: 11px; margin-top: 10px;">Use Meta Key as Filter</strong>
				<!-- description -->
				<p style="<?php familytree_display_option( $instance, 'page_id', '', false ); ?>font-size: 11px;"><label for="<?php echo $this->get_field_id( 'meta_key' ); ?>"><?php _e( 'When this is selected, the slider only displays posts using the appropriate meta key', 'ci-easyslider' ); ?>.</label>
					<!-- field -->
					<input type="text" id="<?php echo $this->get_field_id( 'meta_key' ); ?>" name="<?php echo $this->get_field_name( 'meta_key' ); ?>" value="<?php echo esc_attr( $instance['meta_key'] ); ?>" style="width:95%; margin-top: 4px;" /></p>

				<!-- section three -->
				<p style="margin-top: 10px; padding-top: 10px; border-top: double #DDD; font-weight: bold; margin-bottom: 4px; padding-bottom: 0;"><label for="<?php echo $this->get_field_id( 'image_field' ); ?>"><?php _e( 'Replace featured image', 'ci-easyslider' ); ?></label>

					<!-- description --><p style="font-size: 11px;">Replace the featured image with a unique image URL using a custom field. Create any custom field with an image URL as the value, and include the field name here. This image is not resized, so make sure it is 870x580 pixels before uploading.</p>
				<!-- field -->
				<input type="text" id="<?php echo $this->get_field_id( 'image_field' ); ?>" name="<?php echo $this->get_field_name( 'image_field' ); ?>" value="<?php echo esc_attr( $instance['image_field'] ); ?>" size="2" style="width: 200px;" /></p>

				<!-- section four a -->
				<p style="<?php familytree_display_option( $instance, 'page_id', '', false ); ?>margin-top: 10px; padding-top: 10px; border-top: double #DDD; font-weight: bold; margin-bottom: 4px; padding-bottom: 0;"><label for="<?php echo $this->get_field_id( 'posts_num' ); ?>"><?php _e( 'Number of Posts to Show', 'ci-easyslider' ); ?>:</label>
					<!--field -->
					<input type="text" id="<?php echo $this->get_field_id( 'posts_num' ); ?>" name="<?php echo $this->get_field_name( 'posts_num' ); ?>" value="<?php echo esc_attr( $instance['posts_num'] ); ?>" size="2" /></p>

				<!-- section four b -->
				<p style="<?php familytree_display_option( $instance, 'page_id', '', false ); ?>font-weight: bold; margin-bottom: 4px; padding-bottom: 0;"><label for="<?php echo $this->get_field_id( 'posts_offset' ); ?>"><?php _e( 'Number of Posts to Offset', 'ci-easyslider' ); ?>:</label>
					<input type="text" id="<?php echo $this->get_field_id( 'posts_offset' ); ?>" name="<?php echo $this->get_field_name( 'posts_offset' ); ?>" value="<?php echo esc_attr( $instance['posts_offset'] ); ?>" size="2" /></p>

				<!-- section four c -->
				<p style="<?php familytree_display_option( $instance, 'page_id', '', false ); ?>font-weight: bold; margin-bottom: 4px; padding-bottom: 0;"><label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Order By', 'ci-easyslider' ); ?>:</label>
					<!-- field -->
					<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
						<option style="padding-right:10px;" value="date" <?php selected( 'date', $instance['orderby'] ); ?>><?php _e( 'Date', 'ci-easyslider' ); ?></option>
						<option style="padding-right:10px;" value="title" <?php selected( 'title', $instance['orderby'] ); ?>><?php _e( 'Title', 'ci-easyslider' ); ?></option>
						<option style="padding-right:10px;" value="parent" <?php selected( 'parent', $instance['orderby'] ); ?>><?php _e( 'Parent', 'ci-easyslider' ); ?></option>
						<option style="padding-right:10px;" value="ID" <?php selected( 'ID', $instance['orderby'] ); ?>><?php _e( 'ID', 'ci-easyslider' ); ?></option>
						<option style="padding-right:10px;" value="comment_count" <?php selected( 'comment_count', $instance['orderby'] ); ?>><?php _e( 'Comment Count', 'ci-easyslider' ); ?></option>
						<option style="padding-right:10px;" value="rand" <?php selected( 'rand', $instance['orderby'] ); ?>><?php _e( 'Random', 'ci-easyslider' ); ?></option>
						<option style="padding-right:10px;" value="meta_value" <?php selected( 'meta_value', $instance['orderby'] ); ?>><?php _e( 'Meta Value', 'ci-easyslider' ); ?></option>
						<option style="padding-right:10px;" value="meta_value_num" <?php selected( 'meta_value_num', $instance['orderby'] ); ?>><?php _e( 'Numeric Meta Value', 'ci-easyslider' ); ?></option>
					</select></p>

				<!-- section four d -->
				<p style="<?php familytree_display_option( $instance, 'page_id', '', false ); ?>font-weight: bold; margin-bottom: 4px; padding-bottom: 0;"><label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Sort Order', 'ci-easyslider' ); ?>:</label>
					<select style="margin-bottom: 15px;" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>">
						<option style="padding-right:10px;" value="DESC" <?php selected( 'DESC', $instance['order'] ); ?>><?php _e( 'Descending (3, 2, 1)', 'ci-easyslider' ); ?></option>
						<option style="padding-right:10px;" value="ASC" <?php selected( 'ASC', $instance['order'] ); ?>><?php _e( 'Ascending (1, 2, 3)', 'ci-easyslider' ); ?></option>
					</select></p>
			</div>
		</div>
		<?php
	}

}

/**
 * Used to exclude taxonomies and related terms from list of available terms/taxonomies in widget form().
 *
 * @since 1.2
 * @author Nick Croft
 *
 * @param string $taxonomy 'taxonomy' being tested
 * @return string
 */
function familytree_exclude_taxonomies( $taxonomy ) {

	$filters = array( '', 'nav_menu' );
	$filters = apply_filters( 'familytree_exclude_taxonomies', $filters );
	return( ! in_array( $taxonomy->name, $filters ) );

}

/**
 * Used to exclude post types from list of available post_types in widget form().
 *
 * @since 1.2
 * @author Nick Croft
 *
 * @param string $type 'post_type' being tested
 * @return string
 */
function familytree_exclude_post_types( $type ) {

	$filters = array( '', 'attachment' );
	$filters = apply_filters( 'familytree_exclude_post_types', $filters );
	return( ! in_array( $type, $filters ) );

}

/**
 * Outputs "display: none;" if option and value match, or of they don't match
 * with $standard is set to false.
 *
 * @since 1.2
 * @author Nick Croft
 *
 * @param array $instance Values set in widget isntance
 * @param mixed $option instance option to test
 * @param mixed $value value to test against
 * @param boolean $standard echo standard return false for oposite
 */
function familytree_display_option( $instance, $option = '', $value = '', $standard = true ) {

	$display = '';
	if ( is_array( $option ) ) {
		foreach ( $option as $key ) {
			if ( in_array( $instance[$key], $value ) )
				$display = 'display: none;';
		}
	}
	elseif ( is_array( $value ) ) {
		if ( in_array( $instance[$option], $value ) )
			$display = 'display: none;';
	}
	else {
		if ( $instance[$option] == $value )
			$display = 'display: none;';
	}
	if ( $standard == false ) {
		if ( $display == 'display: none;' )
			$display = '';
		else
			$display = 'display: none;';
	}
	echo $display;

}

if ( ! function_exists( 'gfwa_form_submit' ) ) {

	add_action( 'admin_print_footer_scripts', 'familytree_form_submit' );

	/**
	 * Loads Script Required for widget save on update.
	 *
	 * Does not load scripts if already loaded by Genesis Featured Widget Amplified plugin.
	 *
	 * @since 1.2
	 */
	function familytree_form_submit() {
		?>
		<script type="text/javascript">

			(function(a) {
				a('select.widget-control-save').live('change', function(){
					wpWidgets.save( a(this).closest('div.widget'), 0, 1, 0 );
					return false;
				});
			})(jQuery);

		</script>
		<?php

	}

}