<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nova_Template_WP_Solar
 */

// Check if we're on a template that should not show the dashboard
$is_default_template = is_page_template('page-templates/default.php');

?>

<?php if (!$is_default_template) : ?>
            </div><!-- .content-wrapper -->
        </main><!-- #main-content -->

        <!-- Bottom Navigation (Mobile) -->
        <nav class="bottom-navigation mobile-only">
            <?php
            // Check if there's a mobile menu
            if (has_nav_menu('mobile-bottom')) {
                // Use custom walker for mobile menu
                wp_nav_menu(array(
                    'theme_location' => 'mobile-bottom',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'walker'         => new Nova_Mobile_Bottom_Walker(),
                    'fallback_cb'    => 'nova_mobile_bottom_fallback',
                ));
            } else {
                // Default mobile navigation
                nova_mobile_bottom_fallback();
            }
            ?>
            <button class="bottom-nav-item" id="mobile-menu-toggle">
                <div class="bottom-nav-icon">
                    <i class="ti ti-menu-2"></i>
                </div>
            </button>
        </nav>
    </div><!-- .app-container -->
<?php else : ?>
    </div><!-- .default-template-wrapper -->
    <footer class="default-footer">
        <p>
            <?php
            printf(
                __('Powered by %s', 'nova-template-wp-solar'),
                '<a href="https://novalabss.com" target="_blank" rel="noopener noreferrer">NovaLabss</a>'
            );
            ?>
        </p>
    </footer>
<?php endif; ?>

<?php wp_footer(); ?>

<style>
    /* Avatar placeholder styles */
    .avatar-placeholder {
        width: 100%;
        height: 100%;
        background: var(--accent-primary);
        color: var(--bg-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: var(--font-bold);
        font-size: var(--font-md);
        border-radius: var(--radius-md);
    }
    
    .avatar-placeholder::before {
        content: attr(data-initial);
    }
    
    /* Default template styles */
    .default-template-wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        background-color: var(--bg-pattern);
    }
    
    .default-template-wrapper > * {
        padding: var(--spacing-lg);
        max-width: 1200px;
        margin: 0 auto;
        width: 100%;
    }
    
    .default-footer {
        margin-top: auto;
        background-color: var(--bg-secondary);
        text-align: center;
        padding: var(--spacing-xl) var(--spacing-lg);
        border-top: 1px solid var(--border-primary);
    }
    
    .default-footer p {
        margin: 0;
        color: var(--text-secondary);
    }
    
    .default-footer a {
        color: var(--accent-primary);
        text-decoration: none;
        transition: opacity var(--transition-fast);
    }
    
    .default-footer a:hover {
        opacity: 0.8;
    }
    
    /* Dashboard Canvas specific styles */
    .dashboard-canvas .main-content,
    .dashboard-canvas-main {
        padding: 0 !important;
        overflow: hidden !important;
    }
    
    .dashboard-canvas .content-wrapper,
    .dashboard-canvas-content {
        padding: 0 !important;
        margin: 0 !important;
        max-width: 100% !important;
        height: 100vh !important;
        overflow: hidden !important;
    }
    
    body.dashboard-canvas {
        overflow: hidden !important;
    }
    
    /* Menu separator styles */
    .nav-separator {
        height: 1px;
        background-color: var(--border-primary);
        margin: var(--spacing-sm) 0;
        opacity: 0.5;
    }
    
    .menu-separator > a {
        display: none !important;
    }
</style>

</body>
</html>