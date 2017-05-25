<?php
/**
 * The template for displaying date-based pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @since 1.0
 */

get_header(); ?>

<div id="post" class="col span_8 clr">

    <header id="page-heading">
        <?php /* If this is a daily archive */ if ( is_day() ) { ?>
        <h1><?php _e('Archive For','fresh-clean'); ?> <?php the_time( 'F jS, Y' ); ?></h1>
        <?php /* If this is a monthly archive */ } elseif ( is_month() ) { ?>
        <h1><?php _e('Archive For','fresh-clean'); ?> <?php the_time( 'F, Y' ); ?></h1>
        <?php /* If this is a yearly archive */ } elseif ( is_year() ) { ?>
        <h1><?php _e('Archive For','fresh-clean'); ?> <?php the_time( 'Y' ); ?></h1>
        <?php } ?>
    </header><!-- /page-heading -->

    <?php
    if ( have_posts( )) :
        while ( have_posts() ) : the_post();
			get_template_part( 'content', get_post_format() );  
        endwhile;	
    endif;
    echo '<div class="clear"></div>';
    wpex_pagination(); ?>
    
</div><!-- .span_8 -->

<?php
get_sidebar();
get_footer();