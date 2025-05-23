<?php
/**
 * Logo Functions
 *
 * @package Nova_Template_WP_Solar
 */

/**
 * Get logo icon URL with fallback
 */
function nova_template_get_logo_icon() {
    $logo_icon = get_theme_mod('nova_logo_icon', '');
    
    if ($logo_icon) {
        return $logo_icon;
    }
    
    // Return false if no logo is set (will use default icon)
    return false;
}

/**
 * Get full logo URL with fallback
 */
function nova_template_get_logo_full() {
    $logo_full = get_theme_mod('nova_logo_full', '');
    
    if ($logo_full) {
        return $logo_full;
    }
    
    // Return false if no logo is set (will use site name)
    return false;
}

/**
 * Display logo icon
 */
function nova_template_logo_icon() {
    $logo_icon = nova_template_get_logo_icon();
    
    if ($logo_icon) {
        echo '<img src="' . esc_url($logo_icon) . '" alt="' . esc_attr(get_bloginfo('name')) . ' Icon">';
    } else {
        echo '<i class="ti ti-brand-react"></i>';
    }
}

/**
 * Display full logo
 */
function nova_template_logo_full() {
    $logo_full = nova_template_get_logo_full();
    
    if ($logo_full) {
        echo '<img src="' . esc_url($logo_full) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="sidebar-logo-text">';
    } else {
        echo '<span class="sidebar-logo-text">' . esc_html(get_bloginfo('name')) . '</span>';
    }
}

/**
 * Add custom logo support
 */
function nova_template_logo_setup() {
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('site-title', 'site-description'),
    ));
}
add_action('after_setup_theme', 'nova_template_logo_setup');

/**
 * Add inline styles for logo sizing
 */
function nova_template_logo_styles() {
    ?>
    <style>
        .sidebar-logo-icon img {
            width: 24px;
            height: 24px;
            object-fit: contain;
        }
        
        .sidebar-logo-text {
            max-width: 150px;
            height: auto;
            object-fit: contain;
        }
        
        img.sidebar-logo-text {
            display: block;
            max-height: 30px;
        }
        
        /* Ensure logos are visible in both themes */
        [data-theme="light"] .sidebar-logo-icon img,
        [data-theme="light"] .sidebar-logo-text {
            filter: none;
        }
        
        /* Add subtle drop shadow for light theme if needed */
        [data-theme="light"] .sidebar-logo-icon img {
            filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.1));
        }
    </style>
    <?php
}
add_action('wp_head', 'nova_template_logo_styles', 20);

/**
 * AJAX handler for updating logo dynamically
 */
function nova_template_update_logo() {
    check_ajax_referer('nova_ajax_nonce', 'nonce');
    
    $type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
    
    if ($type === 'icon') {
        nova_template_logo_icon();
    } elseif ($type === 'full') {
        nova_template_logo_full();
    }
    
    wp_die();
}
add_action('wp_ajax_nova_update_logo', 'nova_template_update_logo');
add_action('wp_ajax_nopriv_nova_update_logo', 'nova_template_update_logo');