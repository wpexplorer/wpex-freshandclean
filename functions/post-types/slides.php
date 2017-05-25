<?php
if ( ! class_exists( 'Symple_Slides_Post_Type' ) ) :

	class Symple_Slides_Post_Type {

		function __construct() {

			// Adds the slides post type and taxonomies
			add_action( 'init', array( $this, 'slides_init' ), 0 );

			// Thumbnail support for slides posts
			add_theme_support( 'post-thumbnails', array( 'slides' ) );

			// Adds columns in the admin view for thumbnail and taxonomies
			add_filter( 'manage_edit-slides_columns', array( $this, 'slides_edit_columns' ) );
			add_action( 'manage_posts_custom_column', array( $this, 'slides_column_display' ), 10, 2 );
			
		}
		
		function slides_init() {
			
			$args = apply_filters( 'symple_slides_args', array(
		    	'labels' => array(
					'name' => __( 'Slides', 'fresh-clean' ),
					'singular_name' => __( 'Slides Item', 'fresh-clean' ),
					'add_new' => __( 'Add New Item', 'fresh-clean' ),
					'add_new_item' => __( 'Add New Slides Item', 'fresh-clean' ),
					'edit_item' => __( 'Edit Slides Item', 'fresh-clean' ),
					'new_item' => __( 'Add New Slides Item', 'fresh-clean' ),
					'view_item' => __( 'View Item', 'fresh-clean' ),
					'search_items' => __( 'Search Slides', 'fresh-clean' ),
					'not_found' => __( 'No slides items found', 'fresh-clean' ),
					'not_found_in_trash' => __( 'No slides items found in trash', 'fresh-clean' )
				),
		    	'public' => true,
				'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
				'capability_type' => 'post',
				'rewrite' => array("slug" => "slides"),
				'has_archive' => false,
				'menu_icon' => 'dashicons-images-alt2',
			) );
			
			register_post_type( 'slides', $args );
		}

		function slides_edit_columns( $slides_columns ) {
			$slides_columns = array(
				"cb" => "<input type=\"checkbox\" />",
				"title" => __( 'Title', 'fresh-clean' ),
				"slides_thumbnail" => __( 'Thumbnail', 'fresh-clean' )
			);
			return $slides_columns;
		}

		function slides_column_display( $slides_columns, $post_id ) {

			switch ( $slides_columns ) {

				case "slides_thumbnail":

					// Display the featured image in the column view if possible
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'thumbnail' );
					} else {
						echo __( 'None', 'fresh-clean' );
					}
					break;
				
			}
		}

	}

	new Symple_Slides_Post_Type;

endif;