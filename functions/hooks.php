<?php
/**
 * This file adds some basic hooks to the theme
 *
 * @since 1.0
 */


// Header
function wpex_hook_header_before() {
	do_action( 'wpex_hook_header_before' );
}

function wpex_hook_header_after() {
	do_action( 'wpex_hook_header_after' );
}

function wpex_hook_header_top() {
	do_action( 'wpex_hook_header_top' );
}

function wpex_hook_header_bottom() {
	do_action( 'wpex_hook_header_bottom' ); // Default = Header Image
}


// Posts
function wpex_hook_single_content_before() {
	do_action( 'wpex_hook_single_content_before' );
}

function wpex_hook_single_content_after() {
	do_action( 'wpex_hook_single_content_after' );
}

function wpex_hook_single_content_top() {
	do_action( 'wpex_hook_single_content_top' );
}
function wpex_hook_single_content_bottom() {
	do_action( 'wpex_hook_single_content_bottom' );
}



// Sidebar
function wpex_hook_sidebars_before() {
	do_action( 'wpex_hook_sidebars_before' );
}

function wpex_hook_sidebars_after() {
	do_action( 'wpex_hook_sidebars_after' );
}

function wpex_hook_sidebar_top() {
	do_action( 'wpex_hook_sidebar_top' );
}

function wpex_hook_sidebar_bottom() {
	do_action( 'wpex_hook_sidebar_bottom' );
}


// Footer
function wpex_hook_footer_before() {
	do_action( 'wpex_hook_footer_before' );
}

function wpex_hook_footer_after() {
	do_action( 'wpex_hook_footer_after' );
}

function wpex_hook_footer_top() {
	do_action( 'wpex_hook_footer_top' );
}

function wpex_hook_footer_bottom() {
	do_action( 'wpex_hook_footer_bottom' );
}