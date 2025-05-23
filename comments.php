<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nova_Template_WP_Solar
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    // You can start editing here -- including this comment!
    if (have_comments()) :
        ?>
        <h2 class="comments-title">
            <?php
            $nova_template_comment_count = get_comments_number();
            if ('1' === $nova_template_comment_count) {
                printf(
                    /* translators: 1: title. */
                    esc_html__('Un comentario en &ldquo;%1$s&rdquo;', 'nova-template-wp-solar'),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            } else {
                printf( 
                    /* translators: 1: comment count number, 2: title. */
                    esc_html(_nx('%1$s comentario en &ldquo;%2$s&rdquo;', '%1$s comentarios en &ldquo;%2$s&rdquo;', $nova_template_comment_count, 'comments title', 'nova-template-wp-solar')),
                    number_format_i18n($nova_template_comment_count), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            }
            ?>
        </h2><!-- .comments-title -->

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size' => 48,
                'callback'   => 'nova_template_comment',
            ));
            ?>
        </ol><!-- .comment-list -->

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open()) :
            ?>
            <p class="no-comments"><?php esc_html_e('Los comentarios están cerrados.', 'nova-template-wp-solar'); ?></p>
            <?php
        endif;

    endif; // Check for have_comments().

    comment_form(array(
        'class_form'           => 'comment-form',
        'class_submit'         => 'btn btn-primary',
        'title_reply'          => __('Deja un comentario', 'nova-template-wp-solar'),
        'title_reply_to'       => __('Responder a %s', 'nova-template-wp-solar'),
        'cancel_reply_link'    => __('Cancelar respuesta', 'nova-template-wp-solar'),
        'label_submit'         => __('Publicar comentario', 'nova-template-wp-solar'),
        'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x('Comentario', 'noun', 'nova-template-wp-solar') . '</label> <textarea id="comment" name="comment" class="form-input" cols="45" rows="8" aria-required="true" required></textarea></p>',
        'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . __('Tu dirección de correo electrónico no será publicada.', 'nova-template-wp-solar') . '</span> ' . __('Los campos obligatorios están marcados con', 'nova-template-wp-solar') . ' <span class="required">*</span></p>',
        'fields'               => array(
            'author' => '<p class="comment-form-author"><label for="author">' . __('Nombre', 'nova-template-wp-solar') . ' <span class="required">*</span></label> <input id="author" name="author" type="text" class="form-input" value="" size="30" aria-required="true" required /></p>',
            'email'  => '<p class="comment-form-email"><label for="email">' . __('Correo electrónico', 'nova-template-wp-solar') . ' <span class="required">*</span></label> <input id="email" name="email" type="email" class="form-input" value="" size="30" aria-required="true" required /></p>',
            'url'    => '<p class="comment-form-url"><label for="url">' . __('Sitio web', 'nova-template-wp-solar') . '</label> <input id="url" name="url" type="url" class="form-input" value="" size="30" /></p>',
        ),
    ));
    ?>

</div><!-- #comments -->

<style>
    /* Comments Styles */
    .comments-area {
        margin-top: var(--spacing-xl);
    }
    
    .comments-title {
        font-size: var(--font-xl);
        font-weight: var(--font-semibold);
        color: var(--text-primary);
        margin-bottom: var(--spacing-lg);
    }
    
    .comment-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .comment {
        margin-bottom: var(--spacing-lg);
    }
    
    .comment-body {
        background-color: var(--bg-secondary);
        border: 1px solid var(--border-primary);
        border-radius: var(--radius-lg);
        padding: var(--spacing-lg);
        transition: border-color var(--transition-fast);
    }
    
    .comment-body:hover {
        border-color: var(--border-secondary);
    }
    
    .comment-meta {
        display: flex;
        align-items: center;
        gap: var(--spacing-md);
        margin-bottom: var(--spacing-md);
    }
    
    .comment-author {
        display: flex;
        align-items: center;
        gap: var(--spacing-sm);
    }
    
    .comment-author .avatar {
        border-radius: var(--radius-full);
        border: 2px solid var(--border-primary);
    }
    
    .comment-author .fn {
        font-weight: var(--font-semibold);
        color: var(--text-primary);
        text-decoration: none;
    }
    
    .comment-author .fn a {
        color: inherit;
        text-decoration: none;
    }
    
    .comment-author .says {
        display: none;
    }
    
    .comment-metadata {
        font-size: var(--font-sm);
    }
    
    .comment-metadata a {
        color: var(--text-secondary);
        text-decoration: none;
    }
    
    .comment-metadata a:hover {
        color: var(--text-primary);
    }
    
    .comment-content {
        color: var(--text-primary);
        margin-bottom: var(--spacing-sm);
    }
    
    .comment-content p {
        margin-bottom: var(--spacing-sm);
    }
    
    .comment-content p:last-child {
        margin-bottom: 0;
    }
    
    .reply {
        font-size: var(--font-sm);
    }
    
    .reply a {
        color: var(--accent-primary);
        text-decoration: none;
        font-weight: var(--font-medium);
    }
    
    .reply a:hover {
        opacity: 0.8;
    }
    
    /* Nested Comments */
    .children {
        list-style: none;
        padding: 0;
        margin-left: var(--spacing-xl);
        margin-top: var(--spacing-lg);
    }
    
    /* Comment Form */
    .comment-respond {
        margin-top: var(--spacing-xl);
        background-color: var(--bg-secondary);
        border: 1px solid var(--border-primary);
        border-radius: var(--radius-lg);
        padding: var(--spacing-xl);
    }
    
    .comment-reply-title {
        font-size: var(--font-lg);
        font-weight: var(--font-semibold);
        color: var(--text-primary);
        margin-bottom: var(--spacing-md);
    }
    
    .comment-notes {
        font-size: var(--font-sm);
        color: var(--text-secondary);
        margin-bottom: var(--spacing-md);
    }
    
    .required {
        color: var(--accent-warning);
    }
    
    .comment-form p {
        margin-bottom: var(--spacing-md);
    }
    
    .comment-form label {
        display: block;
        font-size: var(--font-sm);
        font-weight: var(--font-medium);
        color: var(--text-secondary);
        margin-bottom: var(--spacing-xs);
    }
    
    .comment-form .form-input {
        width: 100%;
    }
    
    .comment-form textarea.form-input {
        min-height: 120px;
        resize: vertical;
    }
    
    .form-submit {
        margin-bottom: 0;
    }
    
    .comment-form-cookies-consent {
        display: flex;
        align-items: center;
        gap: var(--spacing-sm);
    }
    
    .comment-form-cookies-consent input[type="checkbox"] {
        width: auto;
        margin: 0;
    }
    
    .comment-form-cookies-consent label {
        margin: 0;
        font-weight: normal;
    }
    
    /* No Comments */
    .no-comments {
        text-align: center;
        padding: var(--spacing-xl);
        color: var(--text-secondary);
        font-style: italic;
    }
    
    /* Comment Navigation */
    .comment-navigation {
        margin: var(--spacing-lg) 0;
    }
    
    .comment-navigation .nav-links {
        display: flex;
        justify-content: space-between;
        gap: var(--spacing-md);
    }
    
    .comment-navigation a {
        color: var(--accent-primary);
        text-decoration: none;
        font-weight: var(--font-medium);
    }
    
    .comment-navigation a:hover {
        opacity: 0.8;
    }
    
    /* Pingbacks and Trackbacks */
    .pingback .comment-body,
    .trackback .comment-body {
        padding: var(--spacing-md);
    }
    
    @media (max-width: 767px) {
        .children {
            margin-left: var(--spacing-md);
        }
        
        .comment-respond {
            padding: var(--spacing-lg);
        }
    }
</style>

<?php
/**
 * Custom comment template
 */
function nova_template_comment($comment, $args, $depth) {
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment-body">
            <footer class="comment-meta">
                <div class="comment-author vcard">
                    <?php echo get_avatar($comment, 48); ?>
                    <?php printf(__('%s <span class="says">dice:</span>', 'nova-template-wp-solar'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?>
                </div><!-- .comment-author -->

                <div class="comment-metadata">
                    <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
                        <time datetime="<?php comment_time('c'); ?>">
                            <?php
                            /* translators: 1: date, 2: time */
                            printf(__('%1$s a las %2$s', 'nova-template-wp-solar'), get_comment_date(), get_comment_time());
                            ?>
                        </time>
                    </a>
                    <?php edit_comment_link(__('Editar', 'nova-template-wp-solar'), '<span class="edit-link">', '</span>'); ?>
                </div><!-- .comment-metadata -->

                <?php if ('0' == $comment->comment_approved) : ?>
                    <p class="comment-awaiting-moderation"><?php _e('Tu comentario está esperando moderación.', 'nova-template-wp-solar'); ?></p>
                <?php endif; ?>
            </footer><!-- .comment-meta -->

            <div class="comment-content">
                <?php comment_text(); ?>
            </div><!-- .comment-content -->

            <div class="reply">
                <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
            </div><!-- .reply -->
        </article><!-- .comment-body -->
    <?php
}