<?php
/**
 * Template Functions
 *
 * @package Nova_Solar
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get theme mode
 */
function nova_solar_get_theme_mode() {
    return isset($_COOKIE['nova_theme_mode']) ? $_COOKIE['nova_theme_mode'] : 'dark';
}

/**
 * Check if current page uses dashboard template
 */
function nova_solar_is_dashboard() {
    $template = get_page_template_slug();
    return in_array($template, array('templates/dashboard-overflow.php', 'templates/dashboard-full.php'));
}

/**
 * Check if current page uses canvas template
 */
function nova_solar_is_canvas() {
    $template = get_page_template_slug();
    return in_array($template, array('templates/canvas-ql.php', 'templates/canvas-full.php'));
}

/**
 * Get dashboard menu items
 */
function nova_solar_get_dashboard_menu() {
    $menu_items = array(
        array(
            'id' => 'panel-general',
            'title' => __('Panel General', 'nova-solar'),
            'icon' => 'ti-layout-dashboard',
            'url' => '#',
            'active' => false,
        ),
        array(
            'id' => 'nova-ai',
            'title' => __('Nova AI', 'nova-solar'),
            'icon' => 'ti-robot',
            'url' => '#',
            'active' => true,
        ),
        array(
            'id' => 'quick-links',
            'title' => __('Quick Links', 'nova-solar'),
            'icon' => 'ti-link',
            'url' => '#',
            'active' => false,
        ),
    );
    
    return apply_filters('nova_solar_dashboard_menu', $menu_items);
}

/**
 * Get warp status data
 */
function nova_solar_get_warp_status() {
    $warp_data = array(
        'available' => 50,
        'next_recharge' => 3,
        'unit' => __('horas', 'nova-solar'),
    );
    
    return apply_filters('nova_solar_warp_status', $warp_data);
}

/**
 * Get user plan
 */
function nova_solar_get_user_plan() {
    $user_id = get_current_user_id();
    $plan = get_user_meta($user_id, 'nova_user_plan', true);
    
    return $plan ?: __('Free plan', 'nova-solar');
}

/**
 * Output dashboard navigation
 */
function nova_solar_dashboard_nav($location = 'sidebar') {
    $menu_items = nova_solar_get_dashboard_menu();
    
    if ($location === 'sidebar') {
        echo '<div class="nav-section">';
        foreach ($menu_items as $item) {
            $active_class = $item['active'] ? ' active' : '';
            echo '<div class="nav-item' . $active_class . '">';
            echo '<a href="' . esc_url($item['url']) . '" class="nav-link">';
            echo '<i class="ti ' . esc_attr($item['icon']) . '"></i>';
            echo '<span>' . esc_html($item['title']) . '</span>';
            echo '</a>';
            echo '</div>';
        }
        echo '</div>';
    } elseif ($location === 'mobile') {
        foreach ($menu_items as $index => $item) {
            if ($index >= 3) break; // Only show first 3 items in mobile nav
            $active_class = $item['active'] ? ' active' : '';
            echo '<a href="' . esc_url($item['url']) . '" class="nav-item' . $active_class . '">';
            echo '<i class="ti ' . esc_attr($item['icon']) . '"></i>';
            echo '</a>';
        }
    }
}

/**
 * Add custom body classes for device detection
 */
function nova_solar_device_body_class($classes) {
    // Add iOS class
    if (preg_match('/iPad|iPhone|iPod/', $_SERVER['HTTP_USER_AGENT'])) {
        $classes[] = 'ios';
    }
    
    // Add Android class
    if (preg_match('/Android/', $_SERVER['HTTP_USER_AGENT'])) {
        $classes[] = 'android';
    }
    
    return $classes;
}
add_filter('body_class', 'nova_solar_device_body_class');

/**
 * Get theme option with default
 */
function nova_solar_get_option($option, $default = '') {
    $options = get_option('nova_solar_options');
    return isset($options[$option]) ? $options[$option] : $default;
}

/**
 * Check if plugin styles should be overridden
 */
function nova_solar_override_plugin_styles() {
    return apply_filters('nova_solar_override_plugin_styles', true);
}
