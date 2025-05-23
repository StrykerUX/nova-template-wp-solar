<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nova_Template_WP_Solar
 */

// Check if we're on a template that should not show the dashboard
$is_default_template = is_page_template('page-templates/default.php');

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if (!$is_default_template) : ?>
    <div class="app-container">
        <!-- Floating Sidebar -->
        <aside class="sidebar" id="sidebar">
            <!-- Menu Toggle Button at Top -->
            <button class="menu-toggle-top" id="menu-toggle">
                <i class="ti ti-category"></i>
            </button>

            <!-- Logo Section -->
            <div class="sidebar-logo">
                <?php
                // Get logo settings from theme customizer
                $logo_icon = get_theme_mod('nova_logo_icon', '');
                $logo_full = get_theme_mod('nova_logo_full', '');
                
                if ($logo_icon) :
                    ?>
                    <div class="sidebar-logo-icon">
                        <img src="<?php echo esc_url($logo_icon); ?>" alt="<?php bloginfo('name'); ?> Icon">
                    </div>
                    <?php
                else :
                    ?>
                    <div class="sidebar-logo-icon">
                        <i class="ti ti-brand-react"></i>
                    </div>
                    <?php
                endif;
                
                if ($logo_full) :
                    ?>
                    <img src="<?php echo esc_url($logo_full); ?>" alt="<?php bloginfo('name'); ?>" class="sidebar-logo-text">
                    <?php
                else :
                    ?>
                    <span class="sidebar-logo-text"><?php bloginfo('name'); ?></span>
                    <?php
                endif;
                ?>
            </div>

            <!-- Navigation -->
            <nav class="sidebar-nav">
                <div class="nav-section">
                    <?php
                    // Display the sidebar menu
                    if (has_nav_menu('sidebar-desktop')) {
                        wp_nav_menu(array(
                            'theme_location' => 'sidebar-desktop',
                            'menu_class'     => 'nav-list',
                            'container'      => false,
                            'walker'         => new Nova_Sidebar_Walker(),
                            'fallback_cb'    => false,
                        ));
                    } else {
                        // Default menu items if no menu is set
                        ?>
                        <ul class="nav-list">
                            <li>
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-item">
                                    <div class="nav-item-icon">
                                        <i class="ti ti-home"></i>
                                    </div>
                                    <span class="nav-item-text"><?php _e('Inicio', 'nova-template-wp-solar'); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url(admin_url()); ?>" class="nav-item">
                                    <div class="nav-item-icon">
                                        <i class="ti ti-dashboard"></i>
                                    </div>
                                    <span class="nav-item-text"><?php _e('Dashboard', 'nova-template-wp-solar'); ?></span>
                                </a>
                            </li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </nav>

            <!-- Sidebar Footer -->
            <div class="sidebar-footer">
                <!-- Warp Disponible Card -->
                <div class="warp-card">
                    <div class="warp-header">
                        <span class="warp-title"><?php _e('Warp Disponible', 'nova-template-wp-solar'); ?></span>
                        <span class="warp-percentage">50%</span>
                    </div>
                    <div class="warp-progress">
                        <div class="warp-progress-bar" style="width: 50%"></div>
                    </div>
                    <div class="warp-info">
                        <span><?php _e('Próxima recarga', 'nova-template-wp-solar'); ?></span>
                        <span>3 <?php _e('horas', 'nova-template-wp-solar'); ?></span>
                    </div>
                </div>

                <!-- Vertical Warp Bar (shown when collapsed) -->
                <div class="warp-vertical">
                    <div class="warp-vertical-container">
                        <div class="warp-vertical-icon">
                            <i class="ti ti-bolt"></i>
                        </div>
                        <div class="warp-vertical-track">
                            <div class="warp-vertical-fill"></div>
                        </div>
                    </div>
                </div>

                <!-- User Profile -->
                <div class="user-section">
                    <div class="user-profile">
                        <div class="user-avatar">
                            <?php
                            // Get current user
                            $current_user = wp_get_current_user();
                            echo nova_template_get_user_avatar($current_user->ID);
                            ?>
                        </div>
                        <div class="user-info">
                            <div class="user-name"><?php echo esc_html($current_user->display_name); ?></div>
                            <div class="user-plan"><?php _e('Beta plan', 'nova-template-wp-solar'); ?></div>
                        </div>
                    </div>
                    <!-- Action Button -->
                    <button class="action-btn">
                        <i class="ti ti-arrow-up-right"></i>
                        <span><?php _e('Actualizar plan', 'nova-template-wp-solar'); ?></span>
                    </button>
                </div>

                <!-- Theme Toggle -->
                <div class="theme-toggle">
                    <button class="theme-option active" id="theme-dark">
                        <i class="ti ti-moon"></i>
                        <span><?php _e('Dark', 'nova-template-wp-solar'); ?></span>
                    </button>
                    <button class="theme-option" id="theme-light">
                        <i class="ti ti-sun"></i>
                        <span><?php _e('Light', 'nova-template-wp-solar'); ?></span>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Sidebar Overlay (Mobile) -->
        <div class="sidebar-overlay" id="sidebar-overlay"></div>

        <!-- Main Content -->
        <main class="<?php echo nova_template_main_content_classes(); ?>" id="main-content">
            <div class="<?php echo nova_template_content_wrapper_classes(); ?>">
<?php else : ?>
    <!-- Default template (no dashboard) -->
    <div class="default-template-wrapper">
<?php endif; ?>