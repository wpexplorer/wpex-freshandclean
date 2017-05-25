<?php
/**
 * This file is used to display your homepage slides
 *
 * @since 1.0
 */

if ( $slides_alt = wpex_get_option( 'slides_alt' ) ) {
    echo do_shortcode( $slides_alt );
    return;
}

if ( class_exists( 'Symple_Slides_Post_Type' ) ) {

    // Query posts
	global $post;
	$slides = get_posts( array(
		'post_type'        => 'slides',
		'numberposts'      => '-1',
		'order'            => 'ASC',
        'no_found_rows'    => true,
        'suppress_filters' => false,
	) );
	if ( $slides ) {

		// Load slider scripts
		wp_enqueue_script( 'flexslider', get_template_directory_uri() .'/js/flexslider.js', false, '2.0', true);
		wp_enqueue_script( 'wpex-slider-home', get_template_directory_uri() .'/js/slider-home.js', false, '1.0', true);
		
		// Set slider options
		$flex_params = array(
			'slideshow'      => wpex_get_option( 'slides_slideshow', '0' ),
			'randomize'      => wpex_get_option( 'slides_randomize', '0' ),			
			'animation'      => wpex_get_option( 'slides_animation', 'slide' ),
			'direction'      => wpex_get_option( 'slides_direction', 'horizontal' ),
			'slideshowSpeed' => wpex_get_option( 'slideshow_speed', '7000' ),
			'animationSpeed' => wpex_get_option( 'animation_speed', '600' )
		);
		
		// Localize slider script
		wp_localize_script( 'wpex-slider-home', 'flexLocalize', $flex_params );?>
        
        <div id="home-slider-wrap" class="clr">
            <div id="home-slider" class="flexslider">
            	<div id="home-slider-loader"><i class="icon-spinner icon-spin"></i></div>
                <ul class="slides">
                    <?php foreach( $slides as $post ) :	setup_postdata( $post ); ?>
                    <?php if ( has_post_thumbnail() || get_post_meta( get_the_ID(), 'wpex_slides_video', true) ){ ?>
                        <li>
                            <div class="slide-inner fitvids">
                                <?php if ( get_post_meta( get_the_ID(), 'wpex_slides_video', true) !== '' ) {
                                    echo wp_oembed_get( get_post_meta( get_the_ID(), 'wpex_slides_video', true ) );
                                } else {
                                    if ( get_post_meta( get_the_ID(), 'wpex_slides_url', true) !== '' ) { ?>
                                    <a href="<?php echo get_post_meta( get_the_ID(), 'wpex_slides_url', true); ?>" title="<?php the_title(); ?>" target="_<?php echo get_post_meta( get_the_ID(), 'wpex_slides_url_target', true); ?>">
                                        <?php the_post_thumbnail( 'wpex_slide' ); ?>
                                    </a>
                                    <?php } else { ?>
                                    	<?php the_post_thumbnail( 'wpex_slide' ); ?>
                                <?php }
                                 }
                                 if ( $post->post_content !=='' ) { ?>
                                    <div class="flex-caption"><?php the_content(); ?></div>
                                <?php } ?>
                            </div><!--/ slide-inner -->
                        </li>
                    <?php } ?>
                    <?php endforeach; wp_reset_postdata(); ?>
                </ul><!-- /slides -->
            </div><!-- /home-slider -->
        </div><!-- /home-slider-wrap -->
	<?php } 
} ?>