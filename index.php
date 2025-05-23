<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nova_Template_WP_Solar
 */

get_header();
?>

<div class="page-header">
    <h1 class="page-title"><?php _e('Blog', 'nova-template-wp-solar'); ?></h1>
    <p class="page-description"><?php _e('Las últimas publicaciones y noticias', 'nova-template-wp-solar'); ?></p>
</div>

<div class="grid grid-cols-1 grid-cols-md-2 grid-cols-lg-3">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
                <div class="card-header">
                    <h2 class="card-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div class="card-subtitle">
                        <?php
                        printf(
                            esc_html__('Por %1$s el %2$s', 'nova-template-wp-solar'),
                            '<span class="author">' . get_the_author() . '</span>',
                            '<time datetime="' . get_the_date('c') . '">' . get_the_date() . '</time>'
                        );
                        ?>
                    </div>
                </div>
                <div class="card-content">
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink(); ?>" class="btn btn-secondary">
                        <?php _e('Leer más', 'nova-template-wp-solar'); ?>
                        <i class="ti ti-arrow-right"></i>
                    </a>
                </div>
            </article>
            <?php
        endwhile;
        
        // Pagination
        the_posts_pagination(array(
            'mid_size'  => 2,
            'prev_text' => '<i class="ti ti-chevron-left"></i>',
            'next_text' => '<i class="ti ti-chevron-right"></i>',
        ));
        
    else :
        ?>
        <div class="card">
            <div class="card-content">
                <p><?php _e('No se encontraron publicaciones.', 'nova-template-wp-solar'); ?></p>
            </div>
        </div>
        <?php
    endif;
    ?>
</div>

<?php
get_footer();