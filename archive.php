<?php
/**
 * The template for displaying Archive pages.
 *
 * @since 1.0
 */

get_header(); ?>

<div id="post" class="col span_8 clr">

	<header id="page-heading" class="clr">
		<h1><?php echo single_term_title(); ?></h1>
		<?php if ( term_description() ) : ?>
			<div id="archive-description" class="clr"><?php echo term_description(); ?></div>
		<?php endif; ?>
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