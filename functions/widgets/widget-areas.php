<?php
/**
 * Define sidebars for use in this theme
 *
 * @since 1.0.0
 */

function wpex_register_sidebars() {

	// Sidebar
	register_sidebar( array(
		'name' => __( 'Sidebar','fresh-clean'),
		'id' => 'sidebar',
		'description' => __( 'Widgets in this area are used on the main sidebar region.','fresh-clean' ),
		'before_widget' => '<div class="sidebar-box %2$s clr">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );

	// Footer Widgets
	if ( wpex_get_option( 'footer', '1' ) ) {

		// Footer 1
		register_sidebar( array(
			'name' => __( 'Footer 1','fresh-clean'),
			'id' => 'footer-one',
			'description' => __( 'Widgets in this area are used in the footer region.','fresh-clean' ),
			'before_widget' => '<div class="footer-widget %2$s clr">',
			'after_widget' => '</div>',
			'before_title' => '<h6>',
			'after_title' => '</h6>',
		) );
		
		// Footer 2
		register_sidebar( array(
			'name' => __( 'Footer 2','fresh-clean'),
			'id' => 'footer-two',
			'description' => __( 'Widgets in this area are used in the footer region.','fresh-clean' ),
			'before_widget' => '<div class="footer-widget %2$s clr">',
			'after_widget' => '</div>',
			'before_title' => '<h6>',
			'after_title' => '</h6>',
		) );
		
		// Footer 3
		register_sidebar( array(
			'name' => __( 'Footer 3','fresh-clean'),
			'id' => 'footer-three',
			'description' => __( 'Widgets in this area are used in the footer region.','fresh-clean' ),
			'before_widget' => '<div class="footer-widget %2$s clr">',
			'after_widget' => '</div>',
			'before_title' => '<h6>',
			'after_title' => '</h6>',
		) );
	}
}
add_action( 'widgets_init', 'wpex_register_sidebars' );