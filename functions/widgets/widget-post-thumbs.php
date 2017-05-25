<?php
/**
 * Recent Posts Widget used for regular posts and portfolio posts
 */
 
class wpex_recent_posts_thumb_widget extends WP_Widget {

	/** constructor */
	function wpex_recent_posts_thumb_widget() {
		parent::__construct(
			'wpex_recent_posts_thumb_widget',
			esc_html__( 'Recent Posts With Thumbnails', 'fresh-clean' )
	  );
	}

	/** @see WP_Widget::widget */
	function widget( $args, $instance ) {	
		extract( $args );
		$title    = apply_filters( 'widget_title', $instance['title']);
		$category = isset( $instance['category'] ) ? $instance['category'] : '';
		$number   = isset( $instance['number'] ) ? $instance['number'] : '';
		$offset   = isset( $instance['offset'] ) ? $instance['offset'] : '';
		
		echo wp_kses_post( $before_widget );
		if ( $title ) {
			echo wp_kses_post( $before_title );
			echo esc_html( $title );
			echo wp_kses_post( $after_title );
		} ?>
		<ul class="wpex-widget-recent-posts blog">
			<?php
			global $post;
			$tmp_post = $post;
			$args = array(
				'numberposts'      => $number,
				'offset'           => $offset,
				'category'         => $category,
				'no_found_rows'    => true,
				'suppress_filters' => false,
			);
			$myposts = get_posts( $args );
			foreach( $myposts as $post ) : setup_postdata( $post ); ?>
				<li class="clr">
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="title"><?php the_post_thumbnail( 'wpex-entry' ); ?></a>
					<?php endif; ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					<div class="date"><?php echo get_the_date(); ?></div>
				</li>
			<?php
			endforeach;
			$post = $tmp_post; ?>
		</ul>

		<?php echo wp_kses_post( $after_widget ); ?>

	<?php }

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance ) {				
		$instance             = $old_instance;
		$instance['title']    = strip_tags( $new_instance['title'] );
		$instance['category'] = strip_tags( $new_instance['category'] );
		$instance['number']   = strip_tags( $new_instance['number'] );
		$instance['offset']   = strip_tags( $new_instance['offset'] );
		return $instance;
	}

	/** @see WP_Widget::form */
	function form( $instance ) {	
		$instance = wp_parse_args( (array) $instance, array(
			'title'    => __( 'Featured Posts','fresh-clean' ),
			'category' => '',
			'number'   => '5',
			'offset'   => '0'
		) );
		extract( $instance ); ?>

		<p>
		  <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'fresh-clean' ); ?></label> 
		  <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title','fresh-clean' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php _e( 'Select a Category:', 'fresh-clean' ); ?></label>
			<br />
			<select class='wpex-select' name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>">
			<option value="all-cats" <?php if($category == 'all-cats' ) { ?>selected="selected"<?php } ?>><?php _e( 'All', 'fresh-clean' ); ?></option>
			<?php
			//get terms
			$cat_terms = get_terms( 'category', array( 'hide_empty' => '1' ) );
			foreach ( $cat_terms as $cat_term) { ?>
				<option value="<?php echo esc_attr( $cat_term->term_id ); ?>" id="<?php echo esc_attr( $cat_term->term_id ) ?>" <?php if($category == $cat_term->term_id) { ?>selected="selected"<?php } ?>><?php echo esc_attr( $cat_term->name ); ?></option>
			<?php } ?>
			</select>
		</p>
		
		<p>
		  <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number to Show:', 'fresh-clean' ); ?></label> 
		  <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
		</p>
		<p>
		  <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Offset (the number of posts to skip):', 'fresh-clean' ); ?></label> 
		  <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'offset' ) ); ?>" type="text" value="<?php echo esc_attr( $offset ); ?>" />
		</p>
		<?php
	}
}
add_action( 'widgets_init', create_function( '', 'return register_widget("wpex_recent_posts_thumb_widget");' ));	