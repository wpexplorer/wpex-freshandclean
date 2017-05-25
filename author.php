<?php
/**
 * This file is used to display your author based archives
 *
 * Learn more here: http://codex.wordpress.org/Author_Templates
 *
 * @since 1.0
 */

get_header();
if ( have_posts() ) : the_post(); ?>
    
    <div id="post" class="col span_8 clr">  
        <header id="page-heading">
            
            <div id="author-page-avatar">
            	<?php echo get_avatar( get_the_author_meta('ID'), 45,'',get_the_author_meta('display_name') ); ?>
            </div><!-- #author-page-avatar -->
            <h1><?php _e('Posts by','fresh-clean'); ?>: <?php echo get_the_author() ?></h1>
        </header><!-- #page-heading -->
		<?php
        rewind_posts();
        while ( have_posts() ) : the_post();
			get_template_part( 'content', get_post_format() );  
        endwhile;	
        echo '<div class="clear"></div>';
        wpex_pagination(); ?>
	</div><!--#post -->

<?php
endif;
get_sidebar();
get_footer();