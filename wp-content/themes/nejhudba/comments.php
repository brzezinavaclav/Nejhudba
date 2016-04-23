<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to twentyten_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Oenology
 * @since Oenology 1.0
 */
?>

<div id="comments">
    <?php

    $fields =  array(

        'author' =>

            '<div class="col-md-4" style="padding-left: inherit; margin-right: 30px; width: 230px"><label for="author">' . __( 'Name', 'domainreference' ) .
            ( $req ? '<span class="required">*</span>' : '' ) . '</label> <p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
            '" size="30"' . $aria_req . ' />' . '</p>',

        'email' =>

            '<label for="email">' . __( 'Email', 'domainreference' ) .
            ( $req ? '<span class="required">*</span>' : '' ). '</label> <p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
            '" size="30"' . $aria_req . ' />' . '</p>' ,

        'url' =>

            '<label for="url">' . __( 'Website', 'domainreference' ) . '</label><p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
            '" size="30" />' . '</p></div>',
    );

    $args = array(
        'id_form'           => 'commentform',
        'id_submit'         => 'submit',
        'title_reply'       => __( 'Leave a Reply' ),
        'title_reply_to'    => __( 'Leave a Reply to %s' ),
        'cancel_reply_link' => __( 'Cancel Reply' ),
        'label_submit'      => __( 'Post Comment' ),

        'comment_field' =>  '<div class="row"><div class="col-md-8"><label for="comment">' . _x( 'Comment', 'noun' ) .
            '</label><p class="comment-form-comment"><textarea id="comment" name="comment" style="height: 161px" aria-required="true">' .
            '</textarea></div></div></p>',

        'must_log_in' => '<p class="must-log-in">' .
            sprintf(
                __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
                wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
            ) . '</p>',

        'logged_in_as' => '<p class="logged-in-as">' .
            sprintf(
                __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
                admin_url( 'profile.php' ),
                $user_identity,
                wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
            ) . '</p>',

        'comment_notes_before' => '',

        'comment_notes_after' => '',

        'fields' => apply_filters( 'comment_form_default_fields', $fields ),
    );




    comment_form($args);

    if ( post_password_required() ) : // don't display comments for password-protected posts ?>
    <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'oenology' ); ?></p>
</div><!-- #comments -->
<?php
/* Stop the rest of comments.php from being processed,
 * but don't kill the script entirely -- we still have
 * to fully load the template.
 */
return;
endif;
?>

<?php
// You can start editing here -- including this comment!
?>


<?php if ( have_comments() ) : ?>

    <?php
    $postrac = false; // Boolean (true/false) variable indicating if a post has Trackbacks or Pingbacks. Set to 'false' until determined to be true.
    if ($comments) { // if there are no comments, don't look for Trackbacks

        foreach ($comments as $comment) { // step through each comment
            if( get_comment_type() != "comment" ) {
                $postrac = true;  // if a comment has a comment_type other than "comment" (i.e. a Trackback or Pingback), set $postrac to 'true'
            }
        }

        if ( $postrac ) { // if the post has any trackbacks por pingbacks, display them as a list ?>
            <h3 class='trackbackheader'>Trackbacks</h3>
            <ol class='trackbacklist'>
                <?php foreach ($comments as $comment) { // step through each comment
                    if(get_comment_type() != "comment") { // if the comment is a Trackback or Pingback ?>
                        <li><?php echo comment_author_link(); // display the Comment Author Link (the Trackback/Pingback URL) ?></li>
                    <?php }
                } ?>
            </ol>
        <?php }
    }
    ?>

    <h3>Komentáře <?php if ( ! comments_open() ) { ?> <small>(Comments are closed)</small><?php } ?></h3>



    <?php $i = 0; ?>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // If the paged comments setting is enabled, and enough comments exisst to cause comments to be paged ?>
        <div class="navigation">
            <div class="nav-previous"><?php previous_comments_link( '<span class="meta-nav">&larr;</span> Starší komentáře' ); ?></div>
            <div class="nav-next"><?php next_comments_link( 'Novější komentáře <span class="meta-nav">&rarr;</span>' ); ?></div>
        </div> <!-- .navigation -->
    <?php endif; // check for comment navigation

    if ( get_comments_number() > '0' ) { ?>
        <ol class="commentlist">
            <?php	wp_list_comments( array('type' => 'comment', 'avatar_size' => 80, 'callback' => 'comment_callback')); ?>
        </ol>
    <?php }

    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
        <div class="navigation">
            <div class="nav-previous"><?php previous_comments_link( '<span class="meta-nav">&larr;</span> Starší komentáře' ); ?></div>
            <div class="nav-next"><?php next_comments_link( 'Novější komentáře <span class="meta-nav">&rarr;</span>' ); ?></div>
        </div><!-- .navigation -->
    <?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

endif; // end have_comments()

?>

</div><!-- #comments -->