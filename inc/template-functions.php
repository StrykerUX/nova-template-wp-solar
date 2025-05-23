<?php
/**
 * Template Functions
 *
 * @package Nova_Template_WP_Solar
 */

/**
 * Check if current page uses dashboard layout
 */
function nova_template_has_dashboard() {
    return !is_page_template('page-templates/default.php');
}

/**
 * Get theme default settings
 */
function nova_template_get_defaults() {
    return array(
        'theme' => get_theme_mod('nova_default_theme', 'dark'),
        'sidebar_state' => get_theme_mod('nova_sidebar_default', 'open'),
    );
}

/**
 * Output inline script for theme initialization
 */
function nova_template_inline_scripts() {
    $defaults = nova_template_get_defaults();
    ?>
    <script>
        // Set default theme if not already set
        if (!localStorage.getItem('theme')) {
            localStorage.setItem('theme', '<?php echo esc_js($defaults['theme']); ?>');
        }
        
        // Set default sidebar state if not already set
        if (!localStorage.getItem('sidebarOpen')) {
            localStorage.setItem('sidebarOpen', '<?php echo esc_js($defaults['sidebar_state'] === 'open' ? 'true' : 'false'); ?>');
        }
        
        // Apply theme immediately to prevent flash
        document.documentElement.setAttribute('data-theme', localStorage.getItem('theme') || '<?php echo esc_js($defaults['theme']); ?>');
    </script>
    <?php
}
add_action('wp_head', 'nova_template_inline_scripts', 5);

/**
 * Add custom CSS for specific page templates
 */
function nova_template_custom_styles() {
    if (is_page_template('page-templates/dashboard-canvas.php')) {
        ?>
        <style>
            /* Dashboard Canvas specific overrides */
            .main-content {
                padding: 0 !important;
                overflow: hidden !important;
            }
            
            .content-wrapper {
                padding: 0 !important;
                margin: 0 !important;
                max-width: 100% !important;
                height: 100vh !important;
                display: flex;
                flex-direction: column;
            }
            
            body {
                overflow: hidden !important;
            }
            
            /* Ensure iframe or embedded content fills the space */
            .content-wrapper > * {
                flex: 1;
                width: 100%;
                height: 100%;
            }
            
            .content-wrapper iframe {
                border: none;
                width: 100%;
                height: 100%;
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'nova_template_custom_styles', 100);

/**
 * Helper function to check if user is logged in for dashboard access
 */
function nova_template_can_access_dashboard() {
    // You can modify this logic based on your requirements
    // For now, allow everyone to see the dashboard
    return true;
    
    // Example: Only logged-in users
    // return is_user_logged_in();
    
    // Example: Only certain user roles
    // return current_user_can('edit_posts');
}

/**
 * Redirect non-authorized users from dashboard pages
 */
function nova_template_restrict_dashboard() {
    if (!nova_template_can_access_dashboard() && nova_template_has_dashboard() && !is_page_template('page-templates/default.php')) {
        wp_redirect(home_url());
        exit;
    }
}
add_action('template_redirect', 'nova_template_restrict_dashboard');

/**
 * Add body class for logged-in status
 */
function nova_template_logged_in_body_class($classes) {
    if (is_user_logged_in()) {
        $classes[] = 'logged-in-user';
    } else {
        $classes[] = 'logged-out-user';
    }
    
    return $classes;
}
add_filter('body_class', 'nova_template_logged_in_body_class');

/**
 * Enqueue additional scripts for specific templates
 */
function nova_template_conditional_scripts() {
    if (is_page_template('page-templates/dashboard-canvas.php')) {
        // Add any specific scripts for canvas template
        wp_add_inline_script('nova-template-main-js', '
            // Disable scrolling for canvas template
            document.addEventListener("DOMContentLoaded", function() {
                document.body.style.overflow = "hidden";
                document.documentElement.style.overflow = "hidden";
            });
        ');
    }
}
add_action('wp_enqueue_scripts', 'nova_template_conditional_scripts', 20);

/**
 * Filter the page title for dashboard pages
 */
function nova_template_dashboard_title($title) {
    if (nova_template_has_dashboard()) {
        return get_bloginfo('name') . ' | ' . $title;
    }
    
    return $title;
}
add_filter('wp_title', 'nova_template_dashboard_title', 10, 1);

/**
 * Helper function to get current template name
 */
function nova_template_get_current_template() {
    if (is_page_template('page-templates/dashboard-canvas.php')) {
        return 'dashboard-canvas';
    } elseif (is_page_template('page-templates/dashboard-over.php')) {
        return 'dashboard-over';
    } elseif (is_page_template('page-templates/default.php')) {
        return 'default';
    }
    
    return 'dashboard-over'; // Default to dashboard-over
}