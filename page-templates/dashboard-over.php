<?php
/**
 * Template Name: Dashboard Over
 * Description: Dashboard con scroll normal y padding estándar
 *
 * @package Nova_Template_WP_Solar
 */

get_header();
?>

<div class="page-header">
    <?php the_title('<h1 class="page-title">', '</h1>'); ?>
    
    <?php
    // Show page description if it exists
    $description = get_post_meta(get_the_ID(), '_page_description', true);
    if ($description) :
        ?>
        <p class="page-description"><?php echo esc_html($description); ?></p>
        <?php
    endif;
    ?>
</div>

<div class="page-content">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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

<?php
get_footer();