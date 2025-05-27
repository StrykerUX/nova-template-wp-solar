<?php
/**
 * Nova Template WP Solar functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Nova_Template_WP_Solar
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function nova_template_setup() {
    /*
     * Make theme available for translation.
     */
    load_theme_textdomain('nova-template-wp-solar', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     */
    add_theme_support('post-thumbnails');

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Set up the WordPress core custom background feature.
    add_theme_support('custom-background', apply_filters('nova_template_custom_background_args', array(
        'default-color' => '1a1a1a',
        'default-image' => '',
    )));

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     */
    add_theme_support('custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // Register navigation menus
    register_nav_menus(array(
        'sidebar-desktop' => esc_html__('SideBar Desktop', 'nova-template-wp-solar'),
        'mobile-bottom'   => esc_html__('Mobile Bottom Navigation', 'nova-template-wp-solar'),
    ));
}
add_action('after_setup_theme', 'nova_template_setup');

/**
 * Enqueue scripts and styles.
 */
function nova_template_scripts() {
    // Theme main stylesheet
    wp_enqueue_style('nova-template-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Main CSS file
    wp_enqueue_style('nova-template-main', get_template_directory_uri() . '/css/main.css', array(), '1.0.0');
    
    // Tabler Icons
    wp_enqueue_style('tabler-icons', 'https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.30.0/tabler-icons.min.css', array(), '2.30.0');
    
    // Main JavaScript
    wp_enqueue_script('nova-template-main-js', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);
    
    // Mobile JavaScript
    wp_enqueue_script('nova-template-mobile-js', get_template_directory_uri() . '/js/mobile.js', array(), '1.0.0', true);
    
    // Localize script for AJAX and other data
    wp_localize_script('nova-template-main-js', 'nova_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('nova_ajax_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'nova_template_scripts');

/**
 * Include custom functions
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/menu-walker.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/logo-functions.php';

/**
 * WooCommerce support
 */
if (class_exists('WooCommerce')) {
    require get_template_directory() . '/inc/woocommerce-functions.php';
}

/**
 * Add custom classes to body
 */
function nova_template_body_classes($classes) {
    // Add page template class
    if (is_page_template('page-templates/dashboard-canvas.php')) {
        $classes[] = 'dashboard-canvas';
    } elseif (is_page_template('page-templates/dashboard-over.php')) {
        $classes[] = 'dashboard-over';
    }
    
    return $classes;
}
add_filter('body_class', 'nova_template_body_classes');

/**
 * Add support for menu item icons
 */
function nova_template_nav_menu_item_custom_fields($item_id, $item, $depth, $args) {
    ?>
    <p class="field-custom-icon description description-wide">
        <label for="edit-menu-item-icon-<?php echo $item_id; ?>">
            <?php _e('Icon HTML (e.g., &lt;i class="ti ti-list-details"&gt;&lt;/i&gt;)', 'nova-template-wp-solar'); ?><br />
            <input type="text" id="edit-menu-item-icon-<?php echo $item_id; ?>" class="widefat code edit-menu-item-icon" name="menu-item-icon[<?php echo $item_id; ?>]" value="<?php echo esc_attr(get_post_meta($item_id, '_menu_item_icon', true)); ?>" />
        </label>
    </p>
    <?php
}
add_action('wp_nav_menu_item_custom_fields', 'nova_template_nav_menu_item_custom_fields', 10, 4);

/**
 * Save menu item icon
 */
function nova_template_save_nav_menu_item_icon($menu_id, $menu_item_db_id, $args) {
    if (isset($_REQUEST['menu-item-icon'][$menu_item_db_id])) {
        $icon_value = $_REQUEST['menu-item-icon'][$menu_item_db_id];
        update_post_meta($menu_item_db_id, '_menu_item_icon', $icon_value);
    }
}
add_action('wp_update_nav_menu_item', 'nova_template_save_nav_menu_item_icon', 10, 3);

/**
 * Add menu separator support
 */
function nova_template_nav_menu_css_class($classes, $item, $args, $depth) {
    if ($item->title == '--separator--') {
        $classes[] = 'menu-separator';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'nova_template_nav_menu_css_class', 10, 4);

/**
 * Filter menu item display for separators
 */
function nova_template_walker_nav_menu_start_el($item_output, $item, $depth, $args) {
    if ($item->title == '--separator--') {
        $item_output = '<div class="nav-separator"></div>';
    }
    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'nova_template_walker_nav_menu_start_el', 10, 4);

/**
 * Get user avatar with fallback
 */
function nova_template_get_user_avatar($user_id = null, $size = 36) {
    if (!$user_id) {
        $user_id = get_current_user_id();
    }
    
    $avatar_url = get_avatar_url($user_id, array('size' => $size * 2)); // 2x for retina
    
    if (!$avatar_url) {
        // Generate a placeholder with user initial
        $user = get_userdata($user_id);
        $initial = strtoupper(substr($user->display_name, 0, 1));
        
        // Return placeholder HTML
        return '<div class="avatar-placeholder" data-initial="' . esc_attr($initial) . '"></div>';
    }
    
    return '<img src="' . esc_url($avatar_url) . '" alt="' . esc_attr(get_the_author_meta('display_name', $user_id)) . '">';
}

/**
 * Custom CSS for admin menu
 */
function nova_template_admin_menu_css() {
    ?>
    <style>
        .menu-separator {
            height: 1px;
            background: #ccc;
            margin: 10px 0;
            pointer-events: none;
        }
        
        .field-custom-icon {
            margin: 10px 0;
        }
    </style>
    <?php
}
add_action('admin_head-nav-menus.php', 'nova_template_admin_menu_css');

/**
 * Add theme templates option to page attributes
 */
function nova_template_add_page_templates($templates) {
    $templates['page-templates/default.php'] = __('Por defecto', 'nova-template-wp-solar');
    $templates['page-templates/dashboard-canvas.php'] = __('Dashboard Canvas', 'nova-template-wp-solar');
    $templates['page-templates/dashboard-over.php'] = __('Dashboard Over', 'nova-template-wp-solar');
    
    return $templates;
}
add_filter('theme_page_templates', 'nova_template_add_page_templates');

/**
 * Override content wrapper classes based on page template
 */
function nova_template_content_wrapper_classes() {
    $classes = 'content-wrapper';
    
    if (is_page_template('page-templates/dashboard-canvas.php')) {
        $classes .= ' dashboard-canvas-content';
    }
    
    return $classes;
}

/**
 * Override main content classes based on page template
 */
function nova_template_main_content_classes() {
    $classes = 'main-content';
    
    if (is_page_template('page-templates/dashboard-canvas.php')) {
        $classes .= ' dashboard-canvas-main';
    }
    
    return $classes;
}