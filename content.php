<?php
/**
 * This file is used for your blog and archive entries.
 *
 * @since 1.0
 */


/******************************************************
 * Single Posts
*****************************************************/
if ( is_singular() && is_main_query() ) { ?>

	<?php if ( wpex_get_option( 'blog_single_thumbnail', true ) && has_post_thumbnail() ) { ?>
		<div class="post-head-image">
			<div id="post-thumbnail"><?php the_post_thumbnail( 'wpex_post' ); ?></div>
		</div>
	<?php } ?>
	

<?php
/******************************************************
 * Entries
*****************************************************/
} else { ?>

	<article <?php post_class( 'loop-entry row clr' ); ?>>
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="loop-entry-thumbnail span_4 col">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'wpex_entry' ); ?></a>
			</div><!-- .loop-entry-thumbnail -->
		<?php } ?>
		<div class="loop-entry-content col <?php if ( has_post_thumbnail() ) { echo 'span_8'; } else echo 'span_12'; ?>">
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<div class="loop-entry-text">
				<?php the_excerpt(); ?>
			</div><!-- .loop-entry-text -->
		</div><!-- .loop-entry-content -->
	</article><!-- .loop-entry -->

<?php } ?>