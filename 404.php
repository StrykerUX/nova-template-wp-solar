<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Nova_Template_WP_Solar
 */

get_header();
?>

<div class="error-404-wrapper">
    <div class="error-404-content">
        <div class="error-404-icon">
            <i class="ti ti-error-404"></i>
        </div>
        
        <h1 class="error-404-title">404</h1>
        
        <h2 class="error-404-subtitle"><?php _e('¡Oops! Página no encontrada', 'nova-template-wp-solar'); ?></h2>
        
        <p class="error-404-description">
            <?php _e('Parece que la página que estás buscando no existe. Puede que haya sido movida o eliminada.', 'nova-template-wp-solar'); ?>
        </p>
        
        <div class="error-404-actions">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                <i class="ti ti-home"></i>
                <?php _e('Volver al inicio', 'nova-template-wp-solar'); ?>
            </a>
            
            <a href="javascript:history.back()" class="btn btn-secondary">
                <i class="ti ti-arrow-back"></i>
                <?php _e('Página anterior', 'nova-template-wp-solar'); ?>
            </a>
        </div>
        
        <div class="error-404-search">
            <h3><?php _e('¿Quizás estás buscando algo?', 'nova-template-wp-solar'); ?></h3>
            
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <div class="search-input-wrapper">
                    <input type="search" 
                           class="search-field form-input" 
                           placeholder="<?php echo esc_attr__('Buscar...', 'nova-template-wp-solar'); ?>" 
                           value="" 
                           name="s" />
                    <button type="submit" class="search-submit btn btn-primary">
                        <i class="ti ti-search"></i>
                        <?php echo esc_html__('Buscar', 'nova-template-wp-solar'); ?>
                    </button>
                </div>
            </form>
        </div>
        
        <div class="error-404-links">
            <h3><?php _e('Enlaces útiles', 'nova-template-wp-solar'); ?></h3>
            
            <div class="useful-links-grid">
                <?php if (has_nav_menu('sidebar-desktop')) : ?>
                    <div class="useful-links-section">
                        <h4><?php _e('Menú principal', 'nova-template-wp-solar'); ?></h4>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'sidebar-desktop',
                            'menu_class'     => 'useful-links-list',
                            'container'      => false,
                            'depth'          => 1,
                            'fallback_cb'    => false,
                        ));
                        ?>
                    </div>
                <?php endif; ?>
                
                <div class="useful-links-section">
                    <h4><?php _e('Páginas populares', 'nova-template-wp-solar'); ?></h4>
                    <ul class="useful-links-list">
                        <?php
                        // Get popular pages
                        $pages = get_pages(array(
                            'sort_order'  => 'DESC',
                            'sort_column' => 'menu_order',
                            'number'      => 5,
                        ));
                        
                        foreach ($pages as $page) {
                            echo '<li><a href="' . get_page_link($page->ID) . '">' . $page->post_title . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>
                
                <div class="useful-links-section">
                    <h4><?php _e('Publicaciones recientes', 'nova-template-wp-solar'); ?></h4>
                    <ul class="useful-links-list">
                        <?php
                        // Get recent posts
                        $recent_posts = wp_get_recent_posts(array(
                            'numberposts' => 5,
                            'post_status' => 'publish',
                        ));
                        
                        foreach ($recent_posts as $post) {
                            echo '<li><a href="' . get_permalink($post['ID']) . '">' . $post['post_title'] . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .error-404-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 60vh;
        text-align: center;
    }
    
    .error-404-content {
        max-width: 800px;
        padding: var(--spacing-xl);
    }
    
    .error-404-icon {
        font-size: 120px;
        color: var(--text-tertiary);
        margin-bottom: var(--spacing-md);
        opacity: 0.5;
    }
    
    .error-404-title {
        font-size: 120px;
        font-weight: var(--font-bold);
        color: var(--text-primary);
        line-height: 1;
        margin: 0 0 var(--spacing-md) 0;
        background: linear-gradient(135deg, var(--text-primary) 0%, var(--text-secondary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .error-404-subtitle {
        font-size: var(--font-xl);
        font-weight: var(--font-semibold);
        color: var(--text-primary);
        margin: 0 0 var(--spacing-md) 0;
    }
    
    .error-404-description {
        font-size: var(--font-md);
        color: var(--text-secondary);
        margin-bottom: var(--spacing-xl);
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .error-404-actions {
        display: flex;
        gap: var(--spacing-md);
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: var(--spacing-xxl);
    }
    
    .error-404-search {
        margin: var(--spacing-xxl) 0;
        padding: var(--spacing-xl);
        background-color: var(--bg-secondary);
        border: 1px solid var(--border-primary);
        border-radius: var(--radius-lg);
    }
    
    .error-404-search h3 {
        font-size: var(--font-lg);
        color: var(--text-primary);
        margin-bottom: var(--spacing-lg);
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
    
    .error-404-links {
        margin-top: var(--spacing-xxl);
        text-align: left;
    }
    
    .error-404-links h3 {
        font-size: var(--font-lg);
        color: var(--text-primary);
        margin-bottom: var(--spacing-lg);
        text-align: center;
    }
    
    .useful-links-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: var(--spacing-xl);
        margin-top: var(--spacing-lg);
    }
    
    .useful-links-section h4 {
        font-size: var(--font-md);
        font-weight: var(--font-semibold);
        color: var(--text-primary);
        margin-bottom: var(--spacing-sm);
    }
    
    .useful-links-list {
        list-style: none;
        padding: 0;
    }
    
    .useful-links-list li {
        margin-bottom: var(--spacing-xs);
    }
    
    .useful-links-list a {
        color: var(--text-secondary);
        text-decoration: none;
        font-size: var(--font-sm);
        transition: color var(--transition-fast);
        display: inline-block;
        padding: var(--spacing-xs) 0;
    }
    
    .useful-links-list a:hover {
        color: var(--text-primary);
    }
    
    /* Animations */
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }
    
    .error-404-icon {
        animation: float 3s ease-in-out infinite;
    }
    
    @media (max-width: 767px) {
        .error-404-title {
            font-size: 80px;
        }
        
        .error-404-icon {
            font-size: 80px;
        }
        
        .error-404-actions {
            flex-direction: column;
            width: 100%;
        }
        
        .error-404-actions .btn {
            width: 100%;
        }
        
        .search-input-wrapper {
            flex-direction: column;
        }
        
        .useful-links-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<?php
get_footer();