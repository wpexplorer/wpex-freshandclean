<?php
/*
 * @ Comments.php credit to Twenty 11 WordPress theme - http://wordpress.org/extend/themes/twentyeleven
 * @ Modified by www.wpexplorer.com
 */

/* If a post password is required or no comments are given and comments/pings are closed, return. */
if ( post_password_required() || ( !have_comments() && !comments_open() && !pings_open() ) )
	return;
?>
<div id="commentsbox" class="clr">
	<div id="comments" class="comments-area">
    
        <?php // You can start editing here -- including this comment! ?>
    
        <?php if ( have_comments() ) : ?>
            <h3 class="heading-border heading"><span><?php comments_popup_link(__('Leave a comment', 'fresh-clean'), __('This article has 1 comment', 'fresh-clean'), __('This article has % comments', 'fresh-clean'), 'comments-link', __('Comments are currently closed', 'fresh-clean')); ?></span></h3>
    
            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
                <h1 class="assistive-text"><?php echo __('Comment Navigation','fresh-clean'); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( '&larr;'. __('Older Comments','fresh-clean') ); ?></div>
                <div class="nav-next"><?php next_comments_link(__('Newer Comments','fresh-clean') .'&rarr;'); ?></div>
            </nav><!-- /coment-nav-above -->
            <?php endif; ?>
    
            <ol class="commentlist">
                <?php wp_list_comments( array( 'callback' => 'wpex_comments_callback' ) ); ?>
            </ol><!-- /commentlist -->
    
            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
                <h1 class="assistive-text"><?php echo __('Comment Navigation','fresh-clean'); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( '&larr;'. __('Older Comments','fresh-clean') ); ?></div>
                <div class="nav-next"><?php next_comments_link(__('Newer Comments','fresh-clean') .'&rarr;'); ?></div>
            </nav><!-- /coment-nav-below -->
            <?php endif; ?>
    
        <?php endif; ?>
    
        <?php if (!comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
            <?php /* <p class="nocomments"><?php _e( 'Comments are closed.', 'fresh-clean' ); ?></p> */ ?>
        <?php endif; ?>
    
    	<?php
		//important variables
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		//custom fields callback
		$fields =  array(
			'author' =>  '<input id="author" name="author" type="text" placeholder="' . __('Name','fresh-clean') . '*" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />',
			'email' =>   '<input id="email" name="email" type="text" placeholder="' . __('Email','fresh-clean') . '*" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />',
			'url' =>     '<input id="url" name="url" type="text" placeholder="' . __('Website','fresh-clean'). '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />',
		);
		
		//custom comment form output
		$comments_args = array(
			'fields' => $fields,
			'title_reply'=> __('Leave a Reply','fresh-clean'),
			'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true" rows="10" placeholder=""></textarea></p>',
			'must_log_in' => '<p class="must-log-in"><a href="' . wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) . '">'.  __('Log In','fresh-clean') .'</a></p>',
			'logged_in_as' => '',
			'comment_form_top' => '',
			'comment_notes_after' => '',
			'comment_notes_before' => '',
			'cancel_reply_link' => __('Cancel Reply','fresh-clean'),
			'label_submit' => __('Submit Comment','fresh-clean')
		);
		
		//show comment form
		comment_form($comments_args); ?>
    </div><!-- /comments -->
</div><!-- /commentsbox -->