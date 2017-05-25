<?php
// Get option name in DB
function wpex_options_db_name() {
	return apply_filters( 'wpex_options_db_name', 'options_wpex_themes' );
}

// Return option value
if ( ! function_exists( 'wpex_get_option' ) ) {
	function wpex_get_option( $name, $default = false ) {
		$option_name = '';

		// Gets option name as defined in the theme
		if ( wpex_options_db_name() ) {
			$option_name = wpex_options_db_name();
		}

		// Fallback option name
		if ( ! $option_name ) {
			$option_name = get_option( 'stylesheet' );
			$option_name = preg_replace( "/\W/", "_", strtolower( $option_name ) );
		}

		// Get option settings from database
		$options = get_option( $option_name );

		// Return specific option
		if ( isset( $options[$name] ) ) {
			return $options[$name];
		} else {
			return $default;
		}
	}
}

// Array of options
function wpex_options_array() {

	$options = array();
	
	//GENERAL
	$options['general'] = array(
		'name' => __( 'General', 'fresh-clean' ),
		'type' => 'heading' );
		
	$options['custom_logo'] = array(
		'name' => __( 'Custom Logo', 'fresh-clean' ),
		'std' => '',
		'id' => 'custom_logo',
		'type' => 'upload',
		'section' => 'general'
	);
	
	$options['header_ad'] = array(
		"name" => __( 'Header Ad', 'fresh-clean' ),
		"id" => "header_ad",
		"std" => "",
		"type" => "textarea",
		'section' => 'general'
	);
						
	$options['blog_single_thumbnail'] = array(
		"name" => __( 'Featured Images On Single Blog Posts', 'fresh-clean' ),
		"id" => "blog_single_thumbnail",
		"std" => "1",
		"type" => "checkbox",
		'section' => 'general'
	);
		
	$options['footer'] = array(
		"name" => __( 'Footer', 'fresh-clean' ),
		"id" => "footer",
		"std" => "1",
		"type" => "checkbox",
		'section' => 'general'
	);
	
	$options['copyright'] = array(
		"name" => __( 'Copyright', 'fresh-clean' ),
		"id" => "copyright",
		"std" => "1",
		"type" => "checkbox",
		'section' => 'general'
	);
		
	$options['custom_copyright'] = array(
		"name" => __( 'Custom Copyright', 'fresh-clean' ),
		"id" => "custom_copyright",
		"std" => '<a href="'. wpex_get_theme_info( 'url' ) .'" target="_blank" title="'. wpex_get_theme_info( 'name' ) .'">Fresh &amp; Clean</a> Theme by <a href="http://themeforest.net/user/wpexplorer?ref=WPExplorer" target="_blank" title="WPExplorer Themes">WPExplorer</a> Powered by <a href="https://wordpress.org/" title="WordPress" target="_blank">WordPress</a>',
		"type" => "textarea",
		'section' => 'general'
	);

	$options['scrolltop_link'] = array(
		"name" => __( 'Scroll To Top Link', 'fresh-clean' ),
		"id" => "copyright",
		"std" => "1",
		"type" => "checkbox",
		'section' => 'general'
	);
		
	//SOCIAL	
	$options['social_links'] = array(
		'name' => __( 'Social', 'fresh-clean' ),
		'type' => 'heading' );
			
	$options['social'] = array(
		'name' => __( 'Social?', 'fresh-clean' ),
		'id' => 'social',
		'std' => '1',
		'type' => 'checkbox' );

		$social_links = wpex_social_links(); // Get social links array
		
		// Loop through each social option and create a theme option
		foreach( $social_links as $social_link ) {
		$options[$social_link] = array( "name" => ucfirst($social_link),
							'desc' => ' '. __( 'Enter your ','fresh-clean' ) . $social_link . __( ' url','fresh-clean' ) .' <br />'. __( 'Include http:// at the front of the url.', 'fresh-clean' ),
							'id' => $social_link,
							'std' => '',
							'type' => 'text',
							'section' => 'social_links'
						);
		}
		
		
	//Slider
	$options['slider'] = array(
		'name' => __( 'Slides', 'fresh-clean' ),
		'type' => 'heading'
	);
			
		if ( class_exists( 'Symple_Slides_Post_Type' ) ) {
				
			$options['slides_slideshow'] = array(
				"name" => __( 'Slideshow', 'fresh-clean' ),
				"id" => "slides_slideshow",
				"std" => "true",
				"type" => "select",
				"options" => array(
					'true' => 'true',
					'false' => 'false'
				),
					'section' => 'slider'
				);
				
			$options['slides_randomize'] = array(
				"name" => __( 'Randomize', 'fresh-clean' ),
				"id" => "slides_randomize",
				"std" => "false",
				"type" => "select",
				"options" => array(
					'true' => 'true',
					'false' => 'false'
				),
					'section' => 'slider'
				);
				
			$options['slides_animation'] = array(
				"name" => __( 'Animation', 'fresh-clean' ),
				"id" => "slides_animation",
				"std" => "slide",
				"type" => "select",
				"options" => array(
					'fade' => 'fade',
					'slide' => 'slide'
				),
					'section' => 'slider'
				);
				
			$options['slides_direction'] = array(
				"name" => __( 'Direction', 'fresh-clean' ),
				"id" => "slides_direction",
				"std" => "horizontal",
				"type" => "select",
				"options" => array(
					'horizontal' => 'horizontal',
					'vertical' => 'vertical'
				),
					'section' => 'slider'
				);
				
			$options['slideshow_speed'] = array(
				"name" => __( 'SlideShow Speed', 'fresh-clean' ),
				"id" => "slideshow_speed",
				"std" => "7000",
				"type" => "text",
					'section' => 'slider'
				);
				
			$options['animation_speed'] = array(
				"name" => __( 'Animation Speed', 'fresh-clean' ),
				"id" => "animation_speed",
				"std" => "600",
				"type" => "text",
					'section' => 'slider'
				);
		}
			
		$options['slides_alt'] = array(
				"name" => __( 'Slider Alternative', 'fresh-clean' ),
				"id" => "slides_alt",
				"std" => "",
				"type" => "textarea",
					'section' => 'slider'
				);
	
	return $options;
}

// Add customizer settings
function wpex_customize_register( $wp_customize ) {
	 
	// Get options array
	$options = wpex_options_array();

	if ( ! $options ) return;

	// Add theme section
	$wp_customize->add_panel( 'wpex_theme_settings', array(
		'title'    => __( 'Theme Settings', 'fresh-clean' ),
		'priority' => 999,
	) );

	// Add all options to customizer
	foreach ( $options as $key => $val ) {

		$type        = isset( $val['type'] ) ? $val['type'] : '';
		$name        = isset( $val['name'] ) ? $val['name'] : '';
		$section     = isset( $val['section'] ) ? $val['section'] : '';
		$description = isset( $val['description'] ) ? $val['description'] : '';
		$default     = isset( $val['std'] ) ? $val['std'] : '';
		$option_id   = 'options_wpex_themes['. $key .']';
		$control_id  = 'wpex_'. $key;
		$choices     = isset( $val['options'] ) ? $val['options'] : '';

		// Add sections
		if ( 'heading' == $type ) {

			$wp_customize->add_section( 'wpex_'. $key, array(
				'title' => $name,
				'panel' => 'wpex_theme_settings',
				'description' => $description,
			) );

		}

		// Uploads
		elseif ( 'upload' == $type && $section ) {

			$wp_customize->add_setting( $option_id, array(
				'default'           => $default,
				'type'              => 'option',
				'sanitize_callback' => false,
			) );
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $control_id, array(
				'label'       => $name,
				'section'     => 'wpex_'. $section,
				'settings'    => $option_id,
				'description' => $description,
			) ) );

		}

		// Other
		elseif ( $section ) {

			$wp_customize->add_setting( $option_id, array(
				'default'           => $default,
				'type'              => 'option',
				'sanitize_callback' => false,
			) );
			$wp_customize->add_control( $control_id, array(
				'label'       => $name,
				'section'     => 'wpex_'. $section,
				'settings'    => $option_id,
				'type'        => $type,
				'choices'     => $choices,
				'description' => $description,
			) );

		}

	}

}
add_action( 'customize_register', 'wpex_customize_register' );