<?php
/**
 * The Header for our theme.
 *
 * @since 1.0.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script><![endif]-->
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrap" class="container row">
	
	<div id="box-wrap" class="row">

		<?php
		// Before header hook
		wpex_hook_header_before(); ?>

		<div id="header-wrap">

			<?php
			// Top header hook
			wpex_hook_header_top(); ?>

			<div id="header" class="row">

				<div id="header-top" class="row">
				
					<div id="logo" class="col span_4">
						<?php
						// Show custom image logo if defined in the admin
						if ( $logo = wpex_get_option( 'custom_logo' ) ) { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home"><img src="<?php echo esc_url( $logo ); ?>" alt="<?php esc_attr( get_bloginfo( 'name' ) ); ?>" /></a>
						<?php }
						// No custom img logo - show text
						else { ?>
							<h2 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>/" title="<?php esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home"><?php echo esc_attr( get_bloginfo( 'name' ) ); ?></a></h2>
							<?php if ( get_bloginfo( 'description' ) ) {
								echo '<p id="site-description">'. esc_html( get_bloginfo( 'description' ) ) .'</p>';
							} ?>
						<?php } ?>
					</div><!-- /logo -->
					
					<?php
					// Show header ad as defined in the admin panel
					if ( wpex_get_option( 'header_ad' ) ) {
						echo '<div id="header-ad" class="col span_8">'. do_shortcode( wpex_get_option('header_ad') ).'</div>';
					} ?>
					
				</div><!-- #header-top -->
				
				<nav id="navigation" class="clr">
				
					<?php
					// Main navigation location
					wp_nav_menu( array(
						'theme_location' => 'main_menu',
						'menu_class'     => 'dropdown-menu',
						'fallback_cb'    => false,
						'walker'         => new WPEX_Dropdown_Walker_Nav_Menu()
					) ); ?>
					
					<?php
					// Show social icons - see functions/social.php
					if ( wpex_get_option( 'social', true ) && function_exists( 'wpex_display_social' ) ) {
						wpex_display_social();
					} ?>
					
				</nav><!-- /navigation -->
				
			</div><!-- /header -->

			<?php
			// Bottom header hook
			wpex_hook_header_bottom(); ?>

		</div><!-- /header-wrap -->

		<?php
		// After header hook
		wpex_hook_header_after(); ?>
		
		<?php
		// Get homepage slides
		if ( class_exists( 'Symple_Slides_Post_Type' ) && is_front_page() && ! is_paged() ) {
			get_template_part( 'content', 'slides' );
		} ?>
		
		<?php
		// Display featured Image on pages
		if ( is_singular( 'page' ) && has_post_thumbnail() ) : ?>

			<div id="page-featured-img" class="clr">
				<?php the_post_thumbnail( 'full' ); ?>
			</div><!-- #page-featured-img -->

		<?php endif; ?>
		
		<div id="main-content" class="row span_12 clr">