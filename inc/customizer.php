<?php
/**
 * Nova Template WP Solar Theme Customizer
 *
 * @package Nova_Template_WP_Solar
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function nova_template_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    
    // Add Logo Section
    $wp_customize->add_section('nova_logo_section', array(
        'title'       => __('Logo Settings', 'nova-template-wp-solar'),
        'priority'    => 30,
        'description' => __('Upload your logo icon and full logo. The icon is always visible, while the full logo is shown when the sidebar is expanded.', 'nova-template-wp-solar'),
    ));
    
    // Logo Icon Setting
    $wp_customize->add_setting('nova_logo_icon', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'nova_logo_icon', array(
        'label'       => __('Logo Icon', 'nova-template-wp-solar'),
        'section'     => 'nova_logo_section',
        'settings'    => 'nova_logo_icon',
        'description' => __('This icon is always visible in the sidebar. Recommended size: 40x40px', 'nova-template-wp-solar'),
    )));
    
    // Full Logo Setting
    $wp_customize->add_setting('nova_logo_full', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'nova_logo_full', array(
        'label'       => __('Full Logo', 'nova-template-wp-solar'),
        'section'     => 'nova_logo_section',
        'settings'    => 'nova_logo_full',
        'description' => __('This logo is shown when the sidebar is expanded. Recommended width: 150px', 'nova-template-wp-solar'),
    )));
    
    // Add Theme Options Section
    $wp_customize->add_section('nova_theme_options', array(
        'title'       => __('Theme Options', 'nova-template-wp-solar'),
        'priority'    => 40,
        'description' => __('Customize various theme options.', 'nova-template-wp-solar'),
    ));
    
    // Default Theme Setting
    $wp_customize->add_setting('nova_default_theme', array(
        'default'           => 'dark',
        'sanitize_callback' => 'nova_sanitize_theme_choice',
    ));
    
    $wp_customize->add_control('nova_default_theme', array(
        'label'    => __('Default Theme', 'nova-template-wp-solar'),
        'section'  => 'nova_theme_options',
        'settings' => 'nova_default_theme',
        'type'     => 'select',
        'choices'  => array(
            'dark'  => __('Dark', 'nova-template-wp-solar'),
            'light' => __('Light', 'nova-template-wp-solar'),
        ),
    ));
    
    // Sidebar Default State
    $wp_customize->add_setting('nova_sidebar_default', array(
        'default'           => 'open',
        'sanitize_callback' => 'nova_sanitize_sidebar_state',
    ));
    
    $wp_customize->add_control('nova_sidebar_default', array(
        'label'    => __('Default Sidebar State (Desktop)', 'nova-template-wp-solar'),
        'section'  => 'nova_theme_options',
        'settings' => 'nova_sidebar_default',
        'type'     => 'select',
        'choices'  => array(
            'open'   => __('Open', 'nova-template-wp-solar'),
            'closed' => __('Closed', 'nova-template-wp-solar'),
        ),
    ));
}
add_action('customize_register', 'nova_template_customize_register');

/**
 * Sanitize theme choice
 */
function nova_sanitize_theme_choice($input) {
    $valid = array('dark', 'light');
    
    if (in_array($input, $valid, true)) {
        return $input;
    }
    
    return 'dark';
}

/**
 * Sanitize sidebar state
 */
function nova_sanitize_sidebar_state($input) {
    $valid = array('open', 'closed');
    
    if (in_array($input, $valid, true)) {
        return $input;
    }
    
    return 'open';
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function nova_template_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function nova_template_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function nova_template_customize_preview_js() {
    wp_enqueue_script('nova-template-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '1.0.0', true);
}
add_action('customize_preview_init', 'nova_template_customize_preview_js');