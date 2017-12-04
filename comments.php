<?php
/**
 * @package WordPress
 * @subpackage Theme_Compat
 * @deprecated 3.0.0
 *
 * This file is here for backward compatibility with old themes and will be removed in a future version
 *
 */
_deprecated_file(
        /* translators: %s: template name */
        sprintf(__('Theme without %s'), basename(__FILE__)), '3.0.0', null,
        /* translators: %s: template name */ sprintf(__('Please include a %s template in your theme.'), basename(__FILE__))
);

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die('Please do not load this page directly. Thanks!');

if (post_password_required()) {
    ?>
    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.'); ?></p>
    <?php
    return;
}
?>

<!-- You can start editing here. -->

<?php if (have_comments()) : ?>
    <h3 id="comments">
        <?php
        if (1 == get_comments_number()) {
            /* translators: %s: post title */
            printf(__('One response to %s'), '&#8220;' . get_the_title() . '&#8221;');
        } else {
            /* translators: 1: number of comments, 2: post title */
            printf(_n('%1$s response to %2$s', '%1$s responses to %2$s', get_comments_number()), number_format_i18n(get_comments_number()), '&#8220;' . get_the_title() . '&#8221;');
        }
        ?>
    </h3>

    <div class="navigation">
        <div class="alignleft"><?php previous_comments_link() ?></div>
        <div class="alignright"><?php next_comments_link() ?></div>
    </div>

    <ol class="commentlist">
        <?php wp_list_comments(); ?>
    </ol>

    <div class="navigation">
        <div class="alignleft"><?php previous_comments_link() ?></div>
        <div class="alignright"><?php next_comments_link() ?></div>
    </div>
<?php else : // this is displayed if there are no comments so far  ?>

    <?php if (comments_open()) : ?>
        <!-- If comments are open, but there are no comments. -->

    <?php else : // comments are closed ?>
        <!-- If comments are closed. -->
        <p class="nocomments"><?php _e('Comments are closed.'); ?></p>

    <?php endif; ?>
<?php endif; ?>



<?php
$req = get_option('require_name_email');
$aria_req = ( $req ? " aria-required='true'" : '' );
$html_req = ( $req ? " required='required'" : '' );
$html5 = true;
$comments_args = array(
    'fields' => apply_filters('comment_form_default_fields', array(
        'author' => '<p class="comment-form-author">' . '<label for="author">' . __('Name') . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
        '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></p>',
        'email' => '<p class="comment-form-email"><label for="email">' . __('Email') . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
        '<input id="email" class="form-control" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req . ' /></p>',
        'url' => '<p class="comment-form-url"><label for="url">' . __('Website') . '</label> ' .
        '<input id="url" class="form-control" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr($commenter['comment_author_url']) . '" size="30" maxlength="200" /></p>',
    )),
    'comment_field' => '<p>' .
    '<textarea id="comment" name="comment" class="form-control" rows="8" aria-required="true"></textarea>' .
    '</p>',
    'comment_notes_after' => '',
     'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="btn btn-primary btn-block" value="%4$s" />',
);

comment_form($comments_args);
?>
