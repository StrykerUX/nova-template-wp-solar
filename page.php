<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nova_Template_WP_Solar
 */

get_header();
?>

<div class="page-header">
    <?php the_title('<h1 class="page-title">', '</h1>'); ?>
</div>

<div class="page-content">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
            <div class="card-content">
                <?php
                the_content();

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'nova-template-wp-solar'),
                    'after'  => '</div>',
                ));
                ?>
            </div>

            <?php if (get_edit_post_link()) : ?>
                <footer class="card-footer">
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

<?php
get_footer();