<?php
/**
 * Sidebar.php is used to show your sidebar widgets on pages/posts
 * 
 * Learn more here: http://codex.wordpress.org/Customizing_Your_Sidebar
 *
 * @since 1.0
 */


// Before sidebar hook
wpex_hook_header_before(); ?>

<aside id="sidebar" class="col span_4 clr">

	<?php
	// Top sidebar hook
	wpex_hook_header_top(); 

	// Display sidebar widgets
	dynamic_sidebar('sidebar');

	// Bototm sidebar hook
	wpex_hook_header_bottom(); ?>

</aside><!-- /sidebar -->

<?php
// After sidebar hook
wpex_hook_header_after(); ?>