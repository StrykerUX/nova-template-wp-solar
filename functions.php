<?php
/**
 * Nova Solar Theme Functions
 *
 * @package Nova_Solar
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define theme constants
define('NOVA_SOLAR_VERSION', '1.0.0');
define('NOVA_SOLAR_DIR', get_template_directory());
define('NOVA_SOLAR_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function nova_solar_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-logo');
    add_theme_support('customize-selective-refresh-widgets');
    
    // Register menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'nova-solar'),
        'dashboard' => __('Dashboard Menu', 'nova-solar'),
    ));
}
add_action('after_setup_theme', 'nova_solar_setup');

/**
 * Enqueue scripts and styles
 */
function nova_solar_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style(
        'nova-solar-main',
        NOVA_SOLAR_URI . '/assets/css/main.css',
        array(),
        NOVA_SOLAR_VERSION
    );
    
    // Enqueue Tabler Icons
    wp_enqueue_style(
        'tabler-icons',
        'https://unpkg.com/@tabler/icons@latest/iconfont/tabler-icons.min.css',
        array(),
        '2.0.0'
    );
    
    // Enqueue theme JavaScript
    wp_enqueue_script(
        'nova-solar-main',
        NOVA_SOLAR_URI . '/assets/js/main.js',
        array('jquery'),
        NOVA_SOLAR_VERSION,
        true
    );
    
    // Localize script for AJAX and theme settings
    wp_localize_script('nova-solar-main', 'novaSolar', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('nova_solar_nonce'),
        'themeUrl' => NOVA_SOLAR_URI,
    ));
}
add_action('wp_enqueue_scripts', 'nova_solar_scripts');

/**
 * Include required files
 */
require_once NOVA_SOLAR_DIR . '/includes/template-functions.php';
require_once NOVA_SOLAR_DIR . '/includes/customizer.php';
require_once NOVA_SOLAR_DIR . '/includes/ajax-handlers.php';
require_once NOVA_SOLAR_DIR . '/includes/theme-settings.php';

/**
 * Add body classes
 */
function nova_solar_body_class($classes) {
    // Add template class
    $template = get_page_template_slug();
    if ($template) {
        $template_name = str_replace('.php', '', basename($template));
        $classes[] = 'template-' . $template_name;
    }
    
    // Add theme mode class
    $theme_mode = isset($_COOKIE['nova_theme_mode']) ? $_COOKIE['nova_theme_mode'] : 'dark';
    $classes[] = 'theme-' . $theme_mode;
    
    return $classes;
}
add_filter('body_class', 'nova_solar_body_class');

/**
 * Custom CSS Variables
 */
function nova_solar_custom_css_variables() {
    $custom_css = ':root {
        --nova-primary: #007bff;
        --nova-secondary: #6c757d;
        --nova-success: #28a745;
        --nova-danger: #dc3545;
        --nova-warning: #ffc107;
        --nova-info: #17a2b8;
    }';
    
    wp_add_inline_style('nova-solar-main', $custom_css);
}
add_action('wp_enqueue_scripts', 'nova_solar_custom_css_variables', 20);

/**
 * Ajax handler for theme mode
 */
function nova_solar_save_theme_mode() {
    check_ajax_referer('nova_solar_nonce', 'nonce');
    
    $mode = isset($_POST['mode']) ? sanitize_text_field($_POST['mode']) : 'dark';
    setcookie('nova_theme_mode', $mode, time() + (86400 * 30), '/');
    
    wp_send_json_success(array('mode' => $mode));
}
add_action('wp_ajax_nova_save_theme_mode', 'nova_solar_save_theme_mode');
add_action('wp_ajax_nopriv_nova_save_theme_mode', 'nova_solar_save_theme_mode');
