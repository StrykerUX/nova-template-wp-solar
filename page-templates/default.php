<?php
/**
 * Template Name: Por defecto
 * Description: Plantilla simple sin dashboard, solo con footer
 *
 * @package Nova_Template_WP_Solar
 */

get_header();
?>

<div class="page-content">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            </header>

            <div class="entry-content">
                <?php
                the_content();

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'nova-template-wp-solar'),
                    'after'  => '</div>',
                ));
                ?>
            </div>

            <?php if (get_edit_post_link()) : ?>
                <footer class="entry-footer">
                    <?php
                    edit_post_link(
                        sprintf(
                            wp_kses(
                                /* translators: %s: Name of current post. Only visible to screen readers */
                                __('Edit <span class="screen-reader-text">%s</span>', 'nova-template-wp-solar'),
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
                </footer>
            <?php endif; ?>
        </article>
        <?php
    endwhile;
    ?>
</div>

<style>
    .page-content {
        flex: 1;
        padding: var(--spacing-xl) var(--spacing-lg);
    }
    
    .entry-header {
        margin-bottom: var(--spacing-xl);
    }
    
    .entry-title {
        font-size: var(--font-xxl);
        font-weight: var(--font-bold);
        color: var(--text-primary);
        margin: 0;
    }
    
    .entry-content {
        font-size: var(--font-md);
        line-height: 1.6;
        color: var(--text-primary);
    }
    
    .entry-content h1,
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
    
    .entry-footer {
        margin-top: var(--spacing-xl);
        padding-top: var(--spacing-lg);
        border-top: 1px solid var(--border-primary);
    }
    
    .edit-link a {
        color: var(--text-secondary);
        text-decoration: none;
        font-size: var(--font-sm);
        transition: color var(--transition-fast);
    }
    
    .edit-link a:hover {
        color: var(--text-primary);
    }
    
    .page-links {
        margin-top: var(--spacing-lg);
        font-size: var(--font-sm);
    }
</style>

<?php
get_footer();