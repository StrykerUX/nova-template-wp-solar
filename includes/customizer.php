<?php
/**
 * Theme Customizer
 *
 * @package Nova_Solar
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add customizer settings
 */
function nova_solar_customize_register($wp_customize) {
    // Nova Solar Panel
    $wp_customize->add_panel('nova_solar_panel', array(
        'title' => __('Nova Solar Options', 'nova-solar'),
        'priority' => 30,
    ));
    
    // Colors Section
    $wp_customize->add_section('nova_solar_colors', array(
        'title' => __('Colors', 'nova-solar'),
        'panel' => 'nova_solar_panel',
        'priority' => 10,
    ));
    
    // Primary Color
    $wp_customize->add_setting('nova_solar_primary_color', array(
        'default' => '#007bff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nova_solar_primary_color', array(
        'label' => __('Primary Color', 'nova-solar'),
        'section' => 'nova_solar_colors',
        'settings' => 'nova_solar_primary_color',
    )));
    
    // Secondary Color
    $wp_customize->add_setting('nova_solar_secondary_color', array(
        'default' => '#6c757d',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nova_solar_secondary_color', array(
        'label' => __('Secondary Color', 'nova-solar'),
        'section' => 'nova_solar_colors',
        'settings' => 'nova_solar_secondary_color',
    )));
    
    // Dashboard Section
    $wp_customize->add_section('nova_solar_dashboard', array(
        'title' => __('Dashboard Settings', 'nova-solar'),
        'panel' => 'nova_solar_panel',
        'priority' => 20,
    ));
    
    // Default Theme Mode
    $wp_customize->add_setting('nova_solar_default_theme', array(
        'default' => 'dark',
        'sanitize_callback' => 'nova_solar_sanitize_theme_mode',
    ));
    
    $wp_customize->add_control('nova_solar_default_theme', array(
        'type' => 'radio',
        'label' => __('Default Theme Mode', 'nova-solar'),
        'section' => 'nova_solar_dashboard',
        'choices' => array(
            'dark' => __('Dark', 'nova-solar'),
            'light' => __('Light', 'nova-solar'),
        ),
    ));
    
    // Sidebar Width
    $wp_customize->add_setting('nova_solar_sidebar_width', array(
        'default' => '280',
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('nova_solar_sidebar_width', array(
        'type' => 'number',
        'label' => __('Sidebar Width (px)', 'nova-solar'),
        'section' => 'nova_solar_dashboard',
        'input_attrs' => array(
            'min' => 200,
            'max' => 400,
            'step' => 10,
        ),
    ));
    
    // Dot Pattern Opacity
    $wp_customize->add_setting('nova_solar_dot_opacity', array(
        'default' => '0.15',
        'sanitize_callback' => 'nova_solar_sanitize_opacity',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('nova_solar_dot_opacity', array(
        'type' => 'range',
        'label' => __('Background Pattern Opacity', 'nova-solar'),
        'section' => 'nova_solar_dashboard',
        'input_attrs' => array(
            'min' => 0,
            'max' => 1,
            'step' => 0.05,
        ),
    ));
    
    // Typography Section
    $wp_customize->add_section('nova_solar_typography', array(
        'title' => __('Typography', 'nova-solar'),
        'panel' => 'nova_solar_panel',
        'priority' => 30,
    ));
    
    // Base Font Size
    $wp_customize->add_setting('nova_solar_base_font_size', array(
        'default' => '16',
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ));
    
    $wp_customize->add_control('nova_solar_base_font_size', array(
        'type' => 'number',
        'label' => __('Base Font Size (px)', 'nova-solar'),
        'section' => 'nova_solar_typography',
        'input_attrs' => array(
            'min' => 12,
            'max' => 20,
            'step' => 1,
        ),
    ));
}
add_action('customize_register', 'nova_solar_customize_register');

/**
 * Sanitize theme mode
 */
function nova_solar_sanitize_theme_mode($input) {
    $valid = array('dark', 'light');
    
    if (in_array($input, $valid)) {
        return $input;
    }
    
    return 'dark';
}

/**
 * Sanitize opacity
 */
function nova_solar_sanitize_opacity($input) {
    $input = (float) $input;
    
    if ($input >= 0 && $input <= 1) {
        return $input;
    }
    
    return 0.15;
}

/**
 * Customizer live preview
 */
function nova_solar_customize_preview_js() {
    wp_enqueue_script(
        'nova-solar-customizer',
        NOVA_SOLAR_URI . '/assets/js/customizer.js',
        array('customize-preview', 'jquery'),
        NOVA_SOLAR_VERSION,
        true
    );
}
add_action('customize_preview_init', 'nova_solar_customize_preview_js');

/**
 * Output customizer CSS
 */
function nova_solar_customizer_css() {
    $primary_color = get_theme_mod('nova_solar_primary_color', '#007bff');
    $secondary_color = get_theme_mod('nova_solar_secondary_color', '#6c757d');
    $sidebar_width = get_theme_mod('nova_solar_sidebar_width', '280');
    $dot_opacity = get_theme_mod('nova_solar_dot_opacity', '0.15');
    $base_font_size = get_theme_mod('nova_solar_base_font_size', '16');
    
    ?>
    <style type="text/css">
        :root {
            --nova-primary: <?php echo esc_attr($primary_color); ?>;
            --nova-secondary: <?php echo esc_attr($secondary_color); ?>;
            --nova-sidebar-width: <?php echo esc_attr($sidebar_width); ?>px;
            --nova-dot-opacity: <?php echo esc_attr($dot_opacity); ?>;
            --nova-font-size-base: <?php echo esc_attr($base_font_size); ?>px;
        }
        
        .dashboard-wrapper::before {
            opacity: <?php echo esc_attr($dot_opacity); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'nova_solar_customizer_css');
