<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nova_Template_WP_Solar
 */

get_header();
?>

<div class="page-header">
    <?php
    the_archive_title('<h1 class="page-title">', '</h1>');
    the_archive_description('<div class="page-description">', '</div>');
    ?>
</div>

<div class="grid grid-cols-1 grid-cols-md-2 grid-cols-lg-3">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="card-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    </div>
                <?php endif; ?>
                
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
                <p><?php _e('No se encontraron publicaciones en este archivo.', 'nova-template-wp-solar'); ?></p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    <i class="ti ti-arrow-left"></i>
                    <?php _e('Volver al inicio', 'nova-template-wp-solar'); ?>
                </a>
            </div>
        </div>
        <?php
    endif;
    ?>
</div>

<style>
    .card-thumbnail {
        margin: calc(-1 * var(--spacing-lg)) calc(-1 * var(--spacing-lg)) var(--spacing-md);
        overflow: hidden;
        border-radius: var(--radius-lg) var(--radius-lg) 0 0;
    }
    
    .card-thumbnail img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform var(--transition-normal);
    }
    
    .card:hover .card-thumbnail img {
        transform: scale(1.05);
    }
    
    /* Pagination Styles */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: var(--spacing-sm);
        margin-top: var(--spacing-xl);
        grid-column: 1 / -1;
    }
    
    .page-numbers {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 var(--spacing-sm);
        background-color: var(--bg-secondary);
        border: 1px solid var(--border-primary);
        border-radius: var(--radius-md);
        color: var(--text-secondary);
        text-decoration: none;
        font-size: var(--font-sm);
        font-weight: var(--font-medium);
        transition: all var(--transition-fast);
    }
    
    .page-numbers:hover {
        background-color: var(--bg-hover);
        border-color: var(--border-secondary);
        color: var(--text-primary);
    }
    
    .page-numbers.current {
        background-color: var(--accent-primary);
        border-color: var(--accent-primary);
        color: var(--bg-primary);
    }
    
    .page-numbers.dots {
        background: none;
        border: none;
        color: var(--text-tertiary);
        pointer-events: none;
    }
    
    .page-numbers .ti {
        font-size: var(--font-md);
    }
</style>

<?php
get_footer();