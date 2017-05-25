<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @since 1.0
 */

get_header();

if ( have_posts() ) :

	while ( have_posts() ) : the_post(); ?>

	<div id="post" class="col span_8 clr">
        
        <div id="page-heading">
            <h1><?php the_title(); ?></h1>
        </div><!-- #page-heading -->
        
        <article id="post" class="clearfix">
            <div class="entry clearfix">	
                <?php the_content(); ?>
            </div><!-- .entry -->
        </article><!-- #post -->
	
    </div><!-- #post --> 
     
	<?php
	endwhile;
endif;
get_sidebar();
get_footer();