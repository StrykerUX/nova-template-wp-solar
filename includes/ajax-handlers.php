<?php
/**
 * AJAX Handlers
 *
 * @package Nova_Solar
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle theme mode save
 */
function nova_solar_ajax_save_theme_mode() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'nova_solar_nonce')) {
        wp_send_json_error('Invalid nonce');
    }
    
    // Get and sanitize mode
    $mode = isset($_POST['mode']) ? sanitize_text_field($_POST['mode']) : 'dark';
    
    // Validate mode
    if (!in_array($mode, array('dark', 'light'))) {
        wp_send_json_error('Invalid theme mode');
    }
    
    // Save to user meta if logged in
    if (is_user_logged_in()) {
        update_user_meta(get_current_user_id(), 'nova_preferred_theme', $mode);
    }
    
    // Return success
    wp_send_json_success(array(
        'mode' => $mode,
        'message' => __('Theme mode saved successfully', 'nova-solar'),
    ));
}
add_action('wp_ajax_nova_solar_save_theme_mode', 'nova_solar_ajax_save_theme_mode');
add_action('wp_ajax_nopriv_nova_solar_save_theme_mode', 'nova_solar_ajax_save_theme_mode');

/**
 * Handle sidebar state save
 */
function nova_solar_ajax_save_sidebar_state() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'nova_solar_nonce')) {
        wp_send_json_error('Invalid nonce');
    }
    
    // Get collapsed state
    $collapsed = isset($_POST['collapsed']) ? filter_var($_POST['collapsed'], FILTER_VALIDATE_BOOLEAN) : false;
    
    // Save to user meta if logged in
    if (is_user_logged_in()) {
        update_user_meta(get_current_user_id(), 'nova_sidebar_collapsed', $collapsed);
    }
    
    // Return success
    wp_send_json_success(array(
        'collapsed' => $collapsed,
        'message' => __('Sidebar state saved', 'nova-solar'),
    ));
}
add_action('wp_ajax_nova_solar_save_sidebar_state', 'nova_solar_ajax_save_sidebar_state');
add_action('wp_ajax_nopriv_nova_solar_save_sidebar_state', 'nova_solar_ajax_save_sidebar_state');

/**
 * Get user preferences
 */
function nova_solar_ajax_get_preferences() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'nova_solar_nonce')) {
        wp_send_json_error('Invalid nonce');
    }
    
    $preferences = array(
        'theme_mode' => 'dark',
        'sidebar_collapsed' => false,
    );
    
    // Get user preferences if logged in
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $preferences['theme_mode'] = get_user_meta($user_id, 'nova_preferred_theme', true) ?: 'dark';
        $preferences['sidebar_collapsed'] = get_user_meta($user_id, 'nova_sidebar_collapsed', true) === '1';
    }
    
    wp_send_json_success($preferences);
}
add_action('wp_ajax_nova_solar_get_preferences', 'nova_solar_ajax_get_preferences');
add_action('wp_ajax_nopriv_nova_solar_get_preferences', 'nova_solar_ajax_get_preferences');

/**
 * Update warp status (example for plugin integration)
 */
function nova_solar_ajax_update_warp() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'nova_solar_nonce')) {
        wp_send_json_error('Invalid nonce');
    }
    
    // Check if user is logged in
    if (!is_user_logged_in()) {
        wp_send_json_error('User not logged in');
    }
    
    // Get current warp data (this would typically come from a plugin or database)
    $warp_data = array(
        'available' => rand(0, 100),
        'next_recharge' => rand(1, 24),
        'unit' => __('horas', 'nova-solar'),
    );
    
    // Allow plugins to filter the data
    $warp_data = apply_filters('nova_solar_warp_data', $warp_data);
    
    wp_send_json_success($warp_data);
}
add_action('wp_ajax_nova_solar_update_warp', 'nova_solar_ajax_update_warp');
