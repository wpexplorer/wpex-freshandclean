<?php
/**
 * Index.php is the default template. This file is used when a more specific template can not be found to display your posts.
 *
 * @since 1.0
 */

get_header(); ?>
    
<div id="post" class="col span_8 clr">
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