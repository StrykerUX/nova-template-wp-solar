<?php
/**
 * Theme Settings
 *
 * @package Nova_Solar
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add theme settings page
 */
function nova_solar_add_settings_page() {
    add_theme_page(
        __('Nova Solar Settings', 'nova-solar'),
        __('Nova Solar', 'nova-solar'),
        'manage_options',
        'nova-solar-settings',
        'nova_solar_settings_page'
    );
}
add_action('admin_menu', 'nova_solar_add_settings_page');

/**
 * Settings page content
 */
function nova_solar_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        
        <form action="options.php" method="post">
            <?php
            settings_fields('nova_solar_settings');
            do_settings_sections('nova-solar-settings');
            submit_button();
            ?>
        </form>
        
        <div class="nova-solar-info">
            <h2><?php _e('Theme Information', 'nova-solar'); ?></h2>
            <p><?php _e('Nova Solar is a professional WordPress theme with Canvas and Dashboard templates.', 'nova-solar'); ?></p>
            
            <h3><?php _e('Available Templates', 'nova-solar'); ?></h3>
            <ul>
                <li><strong>Canvas QL:</strong> <?php _e('No header, simple footer with "Powered By NovaLabss"', 'nova-solar'); ?></li>
                <li><strong>Canvas Full:</strong> <?php _e('Completely blank canvas', 'nova-solar'); ?></li>
                <li><strong>Dashboard Overflow:</strong> <?php _e('Dashboard with sidebar and Y-axis overflow allowed', 'nova-solar'); ?></li>
                <li><strong>Dashboard Full:</strong> <?php _e('Dashboard with sidebar and no overflow', 'nova-solar'); ?></li>
            </ul>
            
            <h3><?php _e('CSS Variables', 'nova-solar'); ?></h3>
            <p><?php _e('This theme uses CSS custom properties that can be accessed by plugins using the --nova- prefix.', 'nova-solar'); ?></p>
        </div>
    </div>
    <?php
}

/**
 * Register settings
 */
function nova_solar_register_settings() {
    // Register setting
    register_setting('nova_solar_settings', 'nova_solar_options', 'nova_solar_sanitize_options');
    
    // Add sections
    add_settings_section(
        'nova_solar_general',
        __('General Settings', 'nova-solar'),
        'nova_solar_general_section_callback',
        'nova-solar-settings'
    );
    
    add_settings_section(
        'nova_solar_plugin_integration',
        __('Plugin Integration', 'nova-solar'),
        'nova_solar_plugin_section_callback',
        'nova-solar-settings'
    );
    
    // Add fields
    add_settings_field(
        'override_plugin_styles',
        __('Override Plugin Styles', 'nova-solar'),
        'nova_solar_override_plugin_styles_field',
        'nova-solar-settings',
        'nova_solar_plugin_integration'
    );
    
    add_settings_field(
        'enable_smooth_scroll',
        __('Enable Smooth Scroll', 'nova-solar'),
        'nova_solar_smooth_scroll_field',
        'nova-solar-settings',
        'nova_solar_general'
    );
    
    add_settings_field(
        'enable_animations',
        __('Enable Animations', 'nova-solar'),
        'nova_solar_animations_field',
        'nova-solar-settings',
        'nova_solar_general'
    );
}
add_action('admin_init', 'nova_solar_register_settings');

/**
 * Section callbacks
 */
function nova_solar_general_section_callback() {
    echo '<p>' . __('Configure general theme settings.', 'nova-solar') . '</p>';
}

function nova_solar_plugin_section_callback() {
    echo '<p>' . __('Control how the theme interacts with plugins.', 'nova-solar') . '</p>';
}

/**
 * Field callbacks
 */
function nova_solar_override_plugin_styles_field() {
    $options = get_option('nova_solar_options');
    $checked = isset($options['override_plugin_styles']) ? $options['override_plugin_styles'] : true;
    ?>
    <label>
        <input type="checkbox" name="nova_solar_options[override_plugin_styles]" value="1" <?php checked($checked, true); ?>>
        <?php _e('Apply Nova Solar styles to plugin elements', 'nova-solar'); ?>
    </label>
    <p class="description"><?php _e('When enabled, the theme will attempt to style plugin elements to match the theme design.', 'nova-solar'); ?></p>
    <?php
}

function nova_solar_smooth_scroll_field() {
    $options = get_option('nova_solar_options');
    $checked = isset($options['enable_smooth_scroll']) ? $options['enable_smooth_scroll'] : true;
    ?>
    <label>
        <input type="checkbox" name="nova_solar_options[enable_smooth_scroll]" value="1" <?php checked($checked, true); ?>>
        <?php _e('Enable smooth scrolling behavior', 'nova-solar'); ?>
    </label>
    <?php
}

function nova_solar_animations_field() {
    $options = get_option('nova_solar_options');
    $checked = isset($options['enable_animations']) ? $options['enable_animations'] : true;
    ?>
    <label>
        <input type="checkbox" name="nova_solar_options[enable_animations]" value="1" <?php checked($checked, true); ?>>
        <?php _e('Enable theme animations and transitions', 'nova-solar'); ?>
    </label>
    <?php
}

/**
 * Sanitize options
 */
function nova_solar_sanitize_options($input) {
    $sanitized = array();
    
    // Checkboxes
    $checkboxes = array('override_plugin_styles', 'enable_smooth_scroll', 'enable_animations');
    foreach ($checkboxes as $checkbox) {
        $sanitized[$checkbox] = isset($input[$checkbox]) && $input[$checkbox] == '1' ? true : false;
    }
    
    return $sanitized;
}

/**
 * Add settings link to theme page
 */
function nova_solar_add_theme_page_settings_link($links) {
    $settings_link = '<a href="' . admin_url('themes.php?page=nova-solar-settings') . '">' . __('Settings', 'nova-solar') . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('theme_action_links_' . get_option('stylesheet'), 'nova_solar_add_theme_page_settings_link');
