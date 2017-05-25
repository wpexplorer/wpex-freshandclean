<?php
/**
 * The Template for displaying all single posts.
 *
 * @since 1.0
 */
 
get_header();

if ( have_posts() ) :

	while ( have_posts() ) : the_post(); ?>
	
		<div id="post" class="col span_8 clr">
		
			<header id="post-heading">
				<h1 id="post-title"><?php the_title(); ?></h1>
				<ul class="meta clr">
					<li><i class="fa fa-clock-o"></i><?php echo get_the_date(); ?></li>
					<li><i class="fa fa-user"></i><?php the_author_posts_link(); ?></li>
					<?php
					// First category link
					$category = get_the_category();
					if ( isset( $category[0] ) ) {
						echo '<li><i class="fa fa-folder"></i><a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a><li>';
					}
					// Display comment count + link
					if ( comments_open() ) : ?>
						<li class="comment-scroll"><i class="fa fa-comments"></i> <?php comments_popup_link(__('0 Comments', 'fresh-clean'), __('1 Comment', 'fresh-clean'), __('% Comments', 'fresh-clean'), 'comments-link' ); ?></li>
					<?php endif; ?>
				</ul>
			</header><!-- #post-title -->
			
			<?php
			// Get post format content
			get_template_part( 'content', get_post_format() ); ?>
			
			<?php
			// Before single content hook
			wpex_hook_single_content_before(); ?>

			<article class="entry clr">
			
				<?php
				// Top single content hook
				wpex_hook_single_content_top();

					// Output content
					the_content();

				// Bottom single content hook
				wpex_hook_single_content_bottom(); ?>

			</article><!-- .entry -->

			<?php
			// After single content hook
			wpex_hook_single_content_after();
			
			// Paginate pages when <!- next --> is used 
			wp_link_pages();
			
			// Get file to display related posts
			get_template_part( 'content', 'related-posts' );
			
			// Display comments and comments form
			comments_template(); ?>
			
			<div id="post-pagination" class="clr">
				<div class="post-prev"><?php next_post_link('%link', '<span class="fa fa-arrow-left"></span>' . __( 'Previous Article', 'fresh-clean' ), false ); ?></div> 
				<div class="post-next"><?php previous_post_link('%link', __( 'Next Article', 'fresh-clean' ) . '<span class="fa fa-arrow-right"></span>', false ); ?></div>
			</div><!-- #post-pagination -->
			
		</div><!-- #post -->

	<?php	
	endwhile;
endif;
get_sidebar();
get_footer();