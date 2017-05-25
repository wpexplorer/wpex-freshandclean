<?php
/**
 * This file is used to display related posts on your single posts
 *
 * @since 1.0
 */

if ( 'post' !== get_post_type() ) {
	$category = get_the_category();
	$category = $wpex_related_category[0]->cat_ID;
}

$related_posts = get_posts( array(
	'post_type'        => get_post_type(),
	'numberposts'      => 3,
	'orderby'          => 'rand',
	'category'         => $category,
	'exclude'          => get_the_ID(),
	'offset'           => null,
	'no_found_rows'    => true,
	'suppress_filters' => false,
) );

if ( $related_posts ) : ?>
	
	<section id="related-posts" class="row clr">
		<h4><span><?php _e( 'Related Articles', 'fresh-clean' ); ?>:</span></h4>
		<?php foreach( $related_posts as $post ) : setup_postdata( $post ); ?>
		<article class="related-post row">
			<?php if ( has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="related-post-thumbnail"><?php the_post_thumbnail( 'wpex_post' ); ?></a>
			<?php endif; ?>
			<div class="related-post-details">
				<h5 class="related-post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
				<p class="related-post-excerpt"><?php echo wp_trim_words( strip_shortcodes( get_the_content() ), 25, '&hellip;' ); ?><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="readmore"><?php _e('read more','fresh-clean'); ?> &rarr;</a></p>
			</div><!-- .related-post-description -->
		</article><!-- .related-post -->
		<?php
		endforeach;
		wp_reset_postdata(); ?>

	</section> <!-- #related-posts -->

<?php endif; ?>