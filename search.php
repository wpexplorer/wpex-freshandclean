<?php
/**
 * Search.php is used for your search result pages
 *
 * Learn more here: http://codex.wordpress.org/Creating_a_Search_Page
 *
 * @since 1.0
 */

get_header(); ?>
  
<div id="post" class="col span_8 clr">  
    
    <header id="page-heading" class="clr">
        <h1 id="search-results-title"><?php _e('Search Results For','fresh-clean'); ?>: <?php the_search_query(); ?></h1>
    </header><!-- #page-heading -->
    
    <?php 
	// Results found
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();		
			get_template_part( 'content', get_post_format() );  
    	endwhile;
	 else :
	 // No results found
	 	echo '<p>' . __('No results found for such a query.','fresh-clean') . '</p>';
	 endif; ?>

</div><!-- #post -->
<?php
get_sidebar();
get_footer();