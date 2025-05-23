<?php
/**
 * Template Name: Dashboard Overflow
 * 
 * Dashboard template with sidebar navigation and overflow allowed
 *
 * @package Nova_Solar
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class('dashboard-template dashboard-overflow'); ?>>
<?php wp_body_open(); ?>

<div class="dashboard-wrapper">
    <!-- Sidebar Navigation -->
    <aside class="dashboard-sidebar" id="dashboardSidebar">
        <div class="sidebar-header">
            <div class="sidebar-brand">
                <span class="brand-icon"><i class="ti ti-solar-panel-2"></i></span>
                <span class="brand-text">NovaLabss</span>
            </div>
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="ti ti-menu-2"></i>
            </button>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="ti ti-layout-dashboard"></i>
                        <span>Panel General</span>
                    </a>
                </div>
                <div class="nav-item active">
                    <a href="#" class="nav-link">
                        <i class="ti ti-robot"></i>
                        <span>Nova AI</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="ti ti-link"></i>
                        <span>Quick Links</span>
                    </a>
                </div>
            </div>
        </nav>

        <div class="sidebar-footer">
            <!-- Warp Disponible -->
            <div class="warp-status">
                <div class="warp-header">
                    <span>Warp Disponible</span>
                    <span class="warp-percentage">50%</span>
                </div>
                <div class="warp-progress">
                    <div class="warp-progress-bar" style="width: 50%"></div>
                </div>
                <div class="warp-info">
                    <span>Próxima recarga</span>
                    <span>3 horas</span>
                </div>
            </div>

            <!-- User Profile -->
            <div class="user-profile">
                <div class="user-avatar">
                    <?php echo get_avatar(get_current_user_id(), 40); ?>
                </div>
                <div class="user-info">
                    <div class="user-name">
                        <?php 
                        $current_user = wp_get_current_user();
                        echo esc_html($current_user->display_name ?: 'User'); 
                        ?>
                    </div>
                    <div class="user-plan">Free plan</div>
                </div>
                <button class="upgrade-btn">
                    <i class="ti ti-arrow-up"></i>
                    <span>Actualizar plan</span>
                </button>
            </div>

            <!-- Theme Switcher -->
            <div class="theme-switcher">
                <button class="theme-btn" data-theme="dark">
                    <i class="ti ti-moon"></i>
                    <span>Dark</span>
                </button>
                <button class="theme-btn" data-theme="light">
                    <i class="ti ti-sun"></i>
                    <span>Light</span>
                </button>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="dashboard-main">
        <div class="dashboard-content">
            <?php
            while (have_posts()) :
                the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </main>

    <!-- Mobile Bottom Navigation -->
    <nav class="mobile-bottom-nav">
        <a href="#" class="nav-item">
            <i class="ti ti-layout-dashboard"></i>
        </a>
        <a href="#" class="nav-item active">
            <i class="ti ti-robot"></i>
        </a>
        <a href="#" class="nav-item">
            <i class="ti ti-link"></i>
        </a>
        <button class="nav-item" id="mobileMenuToggle">
            <i class="ti ti-menu-2"></i>
        </button>
    </nav>
</div>

<?php wp_footer(); ?>
</body>
</html>
