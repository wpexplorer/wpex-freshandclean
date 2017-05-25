<?php
/**
 * This file loads the CSS and Javascript used for the theme.
 *
 * @package Fresh & Clean WordPress Theme
 * @since 1.0
 */

function wpex_load_scripts() {
	
	
	/*******
	*** CSS
	*******************/
	
	// Main CSS
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	// Font awesome
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() .'/css/font-awesome.min.css', array(), '4.4.0' );
	
	// Google Fonts
	wp_enqueue_style( 'google-font', 'http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic', 'style' );
	
	//Responsive
	wp_enqueue_style( 'wpex-responsive', get_template_directory_uri() .'/css/responsive.css' );

	/*******
	*** jQuery
	*******************/

	// Comment replies
	if ( is_single() || is_page() ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	// Initialize
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'fitvids', get_template_directory_uri() .'/js/jquery.fitvids.js', array( 'jquery' ), '1.1', true );
	wp_enqueue_script( 'uniform', get_template_directory_uri() .'/js/uniform.js', array( 'jquery' ), '1.7.5', true );
	wp_enqueue_script( 'wpex-global', get_template_directory_uri() .'/js/global.js', array( 'jquery' ), '1.0', true );
	wp_localize_script( 'wpex-global', 'navLocalize', array(
		'text' => __( 'Menu','fresh-clean' ),
	) );

	
}
add_action( 'wp_enqueue_scripts','wpex_load_scripts' );

// Browser Specific CSS
add_action( 'wp_head', 'wpex_ie_css' );
function wpex_ie_css() {
	echo '<!-- Custom CSS For IE -->';
	echo '<!--[if IE]><link rel="stylesheet" type="text/css" href="'. get_template_directory_uri() .'/css/ie.css" media="screen" /><![endif]-->';
	echo '<!--[if IE 8]><link rel="stylesheet" type="text/css" href="'. get_template_directory_uri() .'/css/ie8.css" media="screen" /><![endif]-->';
} ?>