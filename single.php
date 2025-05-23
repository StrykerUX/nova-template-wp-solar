<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Nova_Template_WP_Solar
 */

get_header();
?>

<div class="single-post-wrapper">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
            <header class="entry-header">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                
                <div class="entry-meta">
                    <?php
                    printf(
                        esc_html__('Publicado el %1$s por %2$s', 'nova-template-wp-solar'),
                        '<time datetime="' . get_the_date('c') . '">' . get_the_date() . '</time>',
                        '<span class="author vcard"><a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
                    );
                    ?>
                    
                    <?php
                    $categories_list = get_the_category_list(esc_html__(', ', 'nova-template-wp-solar'));
                    if ($categories_list) {
                        printf('<span class="cat-links"> en %1$s</span>', $categories_list);
                    }
                    ?>
                </div>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="entry-content">
                <?php
                the_content();

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'nova-template-wp-solar'),
                    'after'  => '</div>',
                ));
                ?>
            </div>

            <footer class="entry-footer">
                <?php
                $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'nova-template-wp-solar'));
                if ($tags_list) {
                    printf('<span class="tags-links">' . esc_html__('Etiquetas: %1$s', 'nova-template-wp-solar') . '</span>', $tags_list);
                }
                ?>
                
                <?php if (get_edit_post_link()) : ?>
                    <?php
                    edit_post_link(
                        sprintf(
                            wp_kses(
                                /* translators: %s: Name of current post. Only visible to screen readers */
                                __('Editar <span class="screen-reader-text">%s</span>', 'nova-template-wp-solar'),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            wp_kses_post(get_the_title())
                        ),
                        '<span class="edit-link">',
                        '</span>'
                    );
                    ?>
                <?php endif; ?>
            </footer>
        </article>

        <?php
        // Post navigation
        the_post_navigation(array(
            'prev_text' => '<span class="nav-subtitle">' . esc_html__('Anterior:', 'nova-template-wp-solar') . '</span> <span class="nav-title">%title</span>',
            'next_text' => '<span class="nav-subtitle">' . esc_html__('Siguiente:', 'nova-template-wp-solar') . '</span> <span class="nav-title">%title</span>',
        ));

        // If comments are open or we have at least one comment, load up the comment template
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;

    endwhile;
    ?>
</div>

<style>
    .single-post-wrapper {
        max-width: 800px;
        margin: 0 auto;
    }
    
    .single-post {
        background-color: var(--bg-secondary);
        border: 1px solid var(--border-primary);
        border-radius: var(--radius-lg);
        padding: var(--spacing-xl);
        margin-bottom: var(--spacing-xl);
    }
    
    .entry-header {
        margin-bottom: var(--spacing-xl);
    }
    
    .entry-title {
        font-size: var(--font-xxl);
        font-weight: var(--font-bold);
        color: var(--text-primary);
        margin: 0 0 var(--spacing-md) 0;
    }
    
    .entry-meta {
        font-size: var(--font-sm);
        color: var(--text-secondary);
    }
    
    .entry-meta a {
        color: var(--text-secondary);
        text-decoration: none;
        transition: color var(--transition-fast);
    }
    
    .entry-meta a:hover {
        color: var(--text-primary);
    }
    
    .post-thumbnail {
        margin: var(--spacing-lg) calc(-1 * var(--spacing-xl));
        text-align: center;
    }
    
    .post-thumbnail img {
        max-width: calc(100% + var(--spacing-xl) * 2);
        height: auto;
        border-radius: var(--radius-md);
    }
    
    .entry-content {
        font-size: var(--font-md);
        line-height: 1.8;
        color: var(--text-primary);
    }
    
    .entry-content h2,
    .entry-content h3,
    .entry-content h4,
    .entry-content h5,
    .entry-content h6 {
        margin-top: var(--spacing-xl);
        margin-bottom: var(--spacing-md);
        color: var(--text-primary);
    }
    
    .entry-content p {
        margin-bottom: var(--spacing-md);
    }
    
    .entry-content ul,
    .entry-content ol {
        margin-bottom: var(--spacing-md);
        padding-left: var(--spacing-lg);
    }
    
    .entry-content ul {
        list-style-type: disc;
    }
    
    .entry-content ol {
        list-style-type: decimal;
    }
    
    .entry-content a {
        color: var(--accent-primary);
        text-decoration: underline;
    }
    
    .entry-content a:hover {
        opacity: 0.8;
    }
    
    .entry-content img {
        max-width: 100%;
        height: auto;
        border-radius: var(--radius-md);
        margin: var(--spacing-md) 0;
    }
    
    .entry-content blockquote {
        border-left: 4px solid var(--accent-primary);
        padding-left: var(--spacing-md);
        margin: var(--spacing-lg) 0;
        font-style: italic;
        color: var(--text-secondary);
    }
    
    .entry-footer {
        margin-top: var(--spacing-xl);
        padding-top: var(--spacing-lg);
        border-top: 1px solid var(--border-primary);
        font-size: var(--font-sm);
        color: var(--text-secondary);
    }
    
    .tags-links {
        display: block;
        margin-bottom: var(--spacing-md);
    }
    
    .tags-links a {
        color: var(--text-secondary);
        text-decoration: none;
        transition: color var(--transition-fast);
    }
    
    .tags-links a:hover {
        color: var(--text-primary);
    }
    
    .edit-link {
        display: inline-block;
        margin-top: var(--spacing-sm);
    }
    
    .edit-link a {
        color: var(--text-secondary);
        text-decoration: none;
        transition: color var(--transition-fast);
    }
    
    .edit-link a:hover {
        color: var(--text-primary);
    }
    
    /* Post Navigation */
    .post-navigation {
        margin-top: var(--spacing-xl);
    }
    
    .post-navigation .nav-links {
        display: flex;
        justify-content: space-between;
        gap: var(--spacing-lg);
    }
    
    .post-navigation .nav-previous,
    .post-navigation .nav-next {
        flex: 1;
    }
    
    .post-navigation a {
        display: block;
        padding: var(--spacing-md);
        background-color: var(--bg-secondary);
        border: 1px solid var(--border-primary);
        border-radius: var(--radius-md);
        text-decoration: none;
        transition: all var(--transition-fast);
    }
    
    .post-navigation a:hover {
        border-color: var(--border-secondary);
        background-color: var(--bg-hover);
    }
    
    .nav-subtitle {
        display: block;
        font-size: var(--font-sm);
        color: var(--text-secondary);
        margin-bottom: var(--spacing-xs);
    }
    
    .nav-title {
        display: block;
        font-size: var(--font-md);
        color: var(--text-primary);
        font-weight: var(--font-medium);
    }
    
    /* Comments */
    .comments-area {
        margin-top: var(--spacing-xl);
        padding: var(--spacing-xl);
        background-color: var(--bg-secondary);
        border: 1px solid var(--border-primary);
        border-radius: var(--radius-lg);
    }
    
    @media (max-width: 767px) {
        .single-post {
            padding: var(--spacing-lg);
        }
        
        .post-thumbnail {
            margin: var(--spacing-lg) calc(-1 * var(--spacing-lg));
        }
        
        .post-navigation .nav-links {
            flex-direction: column;
        }
    }
</style>

<?php
get_footer();