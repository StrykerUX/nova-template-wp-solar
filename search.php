<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Nova_Template_WP_Solar
 */

get_header();
?>

<div class="page-header">
    <h1 class="page-title">
        <?php
        /* translators: %s: search query. */
        printf(esc_html__('Resultados de búsqueda para: %s', 'nova-template-wp-solar'), '<span class="search-query">' . get_search_query() . '</span>');
        ?>
    </h1>
    <p class="page-description">
        <?php
        global $wp_query;
        if ($wp_query->found_posts > 0) {
            printf(
                esc_html(_n('Se encontró %d resultado', 'Se encontraron %d resultados', $wp_query->found_posts, 'nova-template-wp-solar')),
                $wp_query->found_posts
            );
        }
        ?>
    </p>
</div>

<div class="search-results">
    <?php
    if (have_posts()) :
        ?>
        <div class="results-list">
            <?php
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('search-result card'); ?>>
                    <div class="card-header">
                        <div class="result-type">
                            <?php
                            $post_type = get_post_type();
                            switch ($post_type) {
                                case 'post':
                                    echo '<i class="ti ti-article"></i> ' . __('Entrada', 'nova-template-wp-solar');
                                    break;
                                case 'page':
                                    echo '<i class="ti ti-file-text"></i> ' . __('Página', 'nova-template-wp-solar');
                                    break;
                                default:
                                    echo '<i class="ti ti-file"></i> ' . get_post_type_object($post_type)->labels->singular_name;
                                    break;
                            }
                            ?>
                        </div>
                        <h2 class="card-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="card-subtitle">
                            <?php
                            printf(
                                esc_html__('Publicado el %s', 'nova-template-wp-solar'),
                                '<time datetime="' . get_the_date('c') . '">' . get_the_date() . '</time>'
                            );
                            ?>
                        </div>
                    </div>
                    <div class="card-content">
                        <?php
                        // Highlight search terms in excerpt
                        $excerpt = get_the_excerpt();
                        $keys = explode(' ', get_search_query());
                        foreach ($keys as $key) {
                            $excerpt = preg_replace('/(' . preg_quote($key, '/') . ')/iu', '<mark>$1</mark>', $excerpt);
                        }
                        echo $excerpt;
                        ?>
                        <a href="<?php the_permalink(); ?>" class="read-more">
                            <?php _e('Ver más', 'nova-template-wp-solar'); ?>
                            <i class="ti ti-arrow-right"></i>
                        </a>
                    </div>
                </article>
                <?php
            endwhile;
            ?>
        </div>
        
        <?php
        // Pagination
        the_posts_pagination(array(
            'mid_size'  => 2,
            'prev_text' => '<i class="ti ti-chevron-left"></i>',
            'next_text' => '<i class="ti ti-chevron-right"></i>',
        ));
        
    else :
        ?>
        <div class="no-results card">
            <div class="card-content">
                <div class="no-results-icon">
                    <i class="ti ti-search-off"></i>
                </div>
                <h2><?php _e('No se encontraron resultados', 'nova-template-wp-solar'); ?></h2>
                <p><?php _e('Lo sentimos, pero no se encontró nada que coincida con tus términos de búsqueda. Por favor, intenta de nuevo con otras palabras clave.', 'nova-template-wp-solar'); ?></p>
                
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="search-input-wrapper">
                        <input type="search" 
                               class="search-field form-input" 
                               placeholder="<?php echo esc_attr__('Buscar...', 'nova-template-wp-solar'); ?>" 
                               value="<?php echo get_search_query(); ?>" 
                               name="s" />
                        <button type="submit" class="search-submit btn btn-primary">
                            <i class="ti ti-search"></i>
                            <?php echo esc_html__('Buscar', 'nova-template-wp-solar'); ?>
                        </button>
                    </div>
                </form>
                
                <div class="suggestions">
                    <h3><?php _e('Sugerencias:', 'nova-template-wp-solar'); ?></h3>
                    <ul>
                        <li><?php _e('Asegúrate de que todas las palabras estén escritas correctamente.', 'nova-template-wp-solar'); ?></li>
                        <li><?php _e('Prueba con palabras clave diferentes.', 'nova-template-wp-solar'); ?></li>
                        <li><?php _e('Prueba con palabras clave más generales.', 'nova-template-wp-solar'); ?></li>
                        <li><?php _e('Prueba con menos palabras clave.', 'nova-template-wp-solar'); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
    endif;
    ?>
</div>

<style>
    .search-query {
        color: var(--accent-primary);
        font-weight: var(--font-semibold);
    }
    
    .search-results {
        margin-top: var(--spacing-xl);
    }
    
    .results-list {
        display: flex;
        flex-direction: column;
        gap: var(--spacing-lg);
    }
    
    .search-result {
        width: 100%;
    }
    
    .result-type {
        font-size: var(--font-sm);
        color: var(--text-secondary);
        margin-bottom: var(--spacing-xs);
        display: flex;
        align-items: center;
        gap: var(--spacing-xs);
    }
    
    .result-type .ti {
        font-size: var(--font-md);
    }
    
    .card-content mark {
        background-color: var(--accent-warning);
        color: var(--text-primary);
        padding: 2px 4px;
        border-radius: var(--radius-sm);
    }
    
    .read-more {
        display: inline-flex;
        align-items: center;
        gap: var(--spacing-xs);
        margin-top: var(--spacing-sm);
        color: var(--accent-primary);
        text-decoration: none;
        font-size: var(--font-sm);
        font-weight: var(--font-medium);
        transition: opacity var(--transition-fast);
    }
    
    .read-more:hover {
        opacity: 0.8;
    }
    
    .read-more .ti {
        font-size: var(--font-sm);
    }
    
    /* No Results Styles */
    .no-results {
        text-align: center;
        padding: var(--spacing-xxl);
    }
    
    .no-results-icon {
        font-size: 72px;
        color: var(--text-tertiary);
        margin-bottom: var(--spacing-lg);
    }
    
    .no-results h2 {
        font-size: var(--font-xl);
        color: var(--text-primary);
        margin-bottom: var(--spacing-md);
    }
    
    .no-results p {
        color: var(--text-secondary);
        margin-bottom: var(--spacing-xl);
    }
    
    .search-form {
        margin: var(--spacing-xl) 0;
    }
    
    .search-input-wrapper {
        display: flex;
        gap: var(--spacing-sm);
        max-width: 500px;
        margin: 0 auto;
    }
    
    .search-field {
        flex: 1;
    }
    
    .search-submit {
        white-space: nowrap;
    }
    
    .suggestions {
        margin-top: var(--spacing-xl);
        text-align: left;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .suggestions h3 {
        font-size: var(--font-md);
        color: var(--text-primary);
        margin-bottom: var(--spacing-sm);
    }
    
    .suggestions ul {
        list-style-type: disc;
        padding-left: var(--spacing-lg);
        color: var(--text-secondary);
    }
    
    .suggestions li {
        margin-bottom: var(--spacing-xs);
    }
    
    /* Pagination Styles */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: var(--spacing-sm);
        margin-top: var(--spacing-xl);
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
    
    @media (max-width: 767px) {
        .search-input-wrapper {
            flex-direction: column;
        }
        
        .no-results {
            padding: var(--spacing-lg);
        }
    }
</style>

<?php
get_footer();