<?php
/**
 * WooCommerce Compatibility File
 * 
 * @package Nova_Template_WP_Solar
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * WooCommerce Setup
 */
function nova_woocommerce_setup() {
    add_theme_support('woocommerce', array(
        'thumbnail_image_width' => 400,
        'single_image_width'    => 800,
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 1,
            'max_rows'        => 6,
            'default_columns' => 3,
            'min_columns'     => 1,
            'max_columns'     => 4,
        ),
    ));
    
    // Gallery features
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'nova_woocommerce_setup');

/**
 * Disable default WooCommerce styles
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Enqueue custom WooCommerce styles
 */
function nova_woocommerce_scripts() {
    wp_enqueue_style('nova-woocommerce', get_template_directory_uri() . '/css/woocommerce-nova.css', array('nova-template-main'), '1.0.0');
    wp_enqueue_script('nova-woocommerce-js', get_template_directory_uri() . '/js/woocommerce-nova.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'nova_woocommerce_scripts');

/**
 * Remove default WooCommerce wrappers
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
 * Add custom WooCommerce wrappers
 */
function nova_woocommerce_wrapper_before() {
    echo '<div class="nova-woo-container">';
    echo '<div class="nova-woo-wrapper">';
}
add_action('woocommerce_before_main_content', 'nova_woocommerce_wrapper_before', 10);

function nova_woocommerce_wrapper_after() {
    echo '</div>';
    echo '</div>';
}
add_action('woocommerce_after_main_content', 'nova_woocommerce_wrapper_after', 10);

/**
 * Change number of products per row
 */
add_filter('loop_shop_columns', function() {
    return 3;
});

/**
 * Products per page
 */
add_filter('loop_shop_per_page', function() {
    return 12;
});

/**
 * Update cart count via AJAX
 */
function nova_woocommerce_cart_count_fragments($fragments) {
    $fragments['span.nova-cart-count'] = '<span class="nova-cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'nova_woocommerce_cart_count_fragments');

/**
 * Custom breadcrumb
 */
add_filter('woocommerce_breadcrumb_defaults', function($args) {
    $args['delimiter'] = '<i class="ti ti-chevron-right"></i>';
    $args['wrap_before'] = '<nav class="nova-breadcrumb"><div class="nova-breadcrumb-inner">';
    $args['wrap_after'] = '</div></nav>';
    $args['before'] = '<span class="nova-breadcrumb-item">';
    $args['after'] = '</span>';
    return $args;
});

/**
 * Add custom product badges
 */
function nova_product_badges() {
    global $product;
    
    echo '<div class="nova-product-badges">';
    
    if ($product->is_on_sale()) {
        $percentage = '';
        if ($product->is_type('variable')) {
            $percentages = array();
            foreach ($product->get_children() as $child_id) {
                $variation = wc_get_product($child_id);
                $regular_price = (float) $variation->get_regular_price();
                $sale_price = (float) $variation->get_sale_price();
                if ($regular_price > 0 && $sale_price > 0) {
                    $percentages[] = round(100 - ($sale_price / $regular_price * 100));
                }
            }
            if (!empty($percentages)) {
                $percentage = max($percentages) . '%';
            }
        } else {
            $regular_price = (float) $product->get_regular_price();
            $sale_price = (float) $product->get_sale_price();
            if ($regular_price > 0 && $sale_price > 0) {
                $percentage = round(100 - ($sale_price / $regular_price * 100)) . '%';
            }
        }
        
        if ($percentage) {
            echo '<span class="nova-badge nova-badge-sale">-' . $percentage . '</span>';
        }
    }
    
    if ($product->is_featured()) {
        echo '<span class="nova-badge nova-badge-featured"><i class="ti ti-star-filled"></i></span>';
    }
    
    $newness_days = 30;
    $created = strtotime($product->get_date_created());
    if ((time() - (60 * 60 * 24 * $newness_days)) < $created) {
        echo '<span class="nova-badge nova-badge-new">' . __('New', 'nova-template-wp-solar') . '</span>';
    }
    
    echo '</div>';
}

/**
 * Modify add to cart button text
 */
add_filter('woocommerce_product_add_to_cart_text', function($text, $product) {
    if ($product->is_type('simple')) {
        return '<i class="ti ti-shopping-cart-plus"></i><span>' . $text . '</span>';
    }
    return '<i class="ti ti-eye"></i><span>' . $text . '</span>';
}, 10, 2);

/**
 * Custom product loop item classes
 */
add_filter('woocommerce_post_class', function($classes, $product) {
    if (is_shop() || is_product_category() || is_product_tag()) {
        $classes[] = 'nova-product-card';
    }
    return $classes;
}, 10, 2);

/**
 * Add menu item for cart with count
 */
function nova_add_cart_menu_item($items, $args) {
    if ($args->theme_location == 'sidebar-desktop') {
        $cart_count = WC()->cart->get_cart_contents_count();
        $cart_item = '<li class="nova-cart-menu-item">';
        $cart_item .= '<a href="' . wc_get_cart_url() . '" class="nav-item">';
        $cart_item .= '<div class="nav-item-icon">';
        $cart_item .= '<i class="ti ti-shopping-cart"></i>';
        if ($cart_count > 0) {
            $cart_item .= '<span class="nova-cart-count">' . $cart_count . '</span>';
        }
        $cart_item .= '</div>';
        $cart_item .= '<span class="nav-item-text">' . __('Cart', 'nova-template-wp-solar') . '</span>';
        $cart_item .= '</a>';
        $cart_item .= '</li>';
        
        $items = $items . $cart_item;
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'nova_add_cart_menu_item', 10, 2);

/**
 * Custom checkout fields
 */
add_filter('woocommerce_checkout_fields', function($fields) {
    // Add custom classes to fields
    foreach ($fields as $fieldset_key => $fieldset) {
        foreach ($fieldset as $field_key => $field) {
            $fields[$fieldset_key][$field_key]['class'][] = 'nova-form-field';
            $fields[$fieldset_key][$field_key]['input_class'][] = 'nova-input';
            $fields[$fieldset_key][$field_key]['label_class'][] = 'nova-label';
        }
    }
    return $fields;
});

/**
 * Product gallery thumbnail columns
 */
add_filter('woocommerce_product_thumbnails_columns', function() {
    return 5;
});

/**
 * Related products
 */
add_filter('woocommerce_output_related_products_args', function($args) {
    $args['posts_per_page'] = 4;
    $args['columns'] = 4;
    return $args;
});
