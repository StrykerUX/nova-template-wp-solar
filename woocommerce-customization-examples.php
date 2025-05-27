<?php
/**
 * Example: Custom WooCommerce Template Override
 * 
 * This file demonstrates how to create custom templates
 * for specific WooCommerce functionality in your Nova theme
 * 
 * @package Nova_Template_WP_Solar
 */

// Example 1: Custom Product Loop with Quick View
function nova_custom_product_loop() {
    ?>
    <div class="nova-products-grid">
        <?php
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 12,
            'orderby' => 'date',
            'order' => 'DESC'
        );
        
        $products = new WP_Query($args);
        
        if ($products->have_posts()) :
            while ($products->have_posts()) : $products->the_post();
                global $product;
                ?>
                <div class="nova-product-item">
                    <div class="nova-product-inner">
                        <?php nova_product_badges(); ?>
                        
                        <div class="nova-product-image">
                            <?php echo woocommerce_get_product_thumbnail(); ?>
                            <button class="nova-quick-view" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
                                <i class="ti ti-eye"></i>
                            </button>
                        </div>
                        
                        <div class="nova-product-info">
                            <h3><?php the_title(); ?></h3>
                            <?php echo $product->get_price_html(); ?>
                            <?php woocommerce_template_loop_add_to_cart(); ?>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
    <?php
}

// Example 2: Custom Mini Cart Widget
function nova_mini_cart_widget() {
    ?>
    <div class="nova-mini-cart-widget">
        <button class="nova-cart-trigger">
            <i class="ti ti-shopping-cart"></i>
            <span class="nova-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
        </button>
        
        <div class="nova-mini-cart-dropdown">
            <div class="nova-mini-cart-header">
                <h4><?php esc_html_e('Shopping Cart', 'nova-template-wp-solar'); ?></h4>
                <button class="nova-mini-cart-close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            
            <div class="nova-mini-cart-content">
                <?php woocommerce_mini_cart(); ?>
            </div>
        </div>
    </div>
    <?php
}

// Example 3: Custom Product Categories Grid
function nova_product_categories_grid() {
    $categories = get_terms(array(
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
        'parent' => 0
    ));
    
    if (!empty($categories) && !is_wp_error($categories)) : ?>
        <div class="nova-categories-grid">
            <?php foreach ($categories as $category) : 
                $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                $image = wp_get_attachment_url($thumbnail_id);
                ?>
                <a href="<?php echo esc_url(get_term_link($category)); ?>" class="nova-category-card">
                    <div class="nova-category-image">
                        <?php if ($image) : ?>
                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($category->name); ?>">
                        <?php else : ?>
                            <div class="nova-category-placeholder">
                                <i class="ti ti-package"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="nova-category-info">
                        <h3><?php echo esc_html($category->name); ?></h3>
                        <span class="nova-category-count">
                            <?php echo sprintf(_n('%s Product', '%s Products', $category->count, 'nova-template-wp-solar'), $category->count); ?>
                        </span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif;
}

// Example 4: Custom Product Filter Sidebar
function nova_product_filter_sidebar() {
    ?>
    <div class="nova-filter-sidebar">
        <div class="nova-filter-header">
            <h3><?php esc_html_e('Filter Products', 'nova-template-wp-solar'); ?></h3>
            <button class="nova-filter-reset">
                <i class="ti ti-refresh"></i>
                <?php esc_html_e('Reset', 'nova-template-wp-solar'); ?>
            </button>
        </div>
        
        <!-- Price Filter -->
        <div class="nova-filter-section">
            <h4><?php esc_html_e('Price Range', 'nova-template-wp-solar'); ?></h4>
            <div class="nova-price-slider">
                <div class="nova-price-slider-track"></div>
                <input type="range" class="nova-price-min" min="0" max="1000" value="0">
                <input type="range" class="nova-price-max" min="0" max="1000" value="1000">
            </div>
            <div class="nova-price-display">
                <span class="nova-price-from">$0</span>
                <span class="nova-price-to">$1000</span>
            </div>
        </div>
        
        <!-- Categories -->
        <div class="nova-filter-section">
            <h4><?php esc_html_e('Categories', 'nova-template-wp-solar'); ?></h4>
            <?php
            $categories = get_terms('product_cat');
            foreach ($categories as $category) : ?>
                <label class="nova-filter-checkbox">
                    <input type="checkbox" value="<?php echo esc_attr($category->term_id); ?>">
                    <span><?php echo esc_html($category->name); ?></span>
                    <span class="nova-filter-count">(<?php echo $category->count; ?>)</span>
                </label>
            <?php endforeach; ?>
        </div>
        
        <!-- Attributes -->
        <?php
        $attributes = wc_get_attribute_taxonomies();
        foreach ($attributes as $attribute) :
            $attribute_name = wc_attribute_taxonomy_name($attribute->attribute_name);
            $terms = get_terms($attribute_name);
            if (!empty($terms) && !is_wp_error($terms)) : ?>
                <div class="nova-filter-section">
                    <h4><?php echo esc_html($attribute->attribute_label); ?></h4>
                    <?php foreach ($terms as $term) : ?>
                        <label class="nova-filter-checkbox">
                            <input type="checkbox" value="<?php echo esc_attr($term->term_id); ?>">
                            <span><?php echo esc_html($term->name); ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endif;
        endforeach; ?>
    </div>
    <?php
}

// Example 5: Enhanced Product Gallery
function nova_enhanced_product_gallery() {
    global $product;
    $gallery_ids = $product->get_gallery_image_ids();
    
    if (!empty($gallery_ids)) : ?>
        <div class="nova-enhanced-gallery">
            <div class="nova-gallery-main">
                <?php echo woocommerce_get_product_thumbnail('full'); ?>
                <div class="nova-gallery-nav">
                    <button class="nova-gallery-prev"><i class="ti ti-chevron-left"></i></button>
                    <button class="nova-gallery-next"><i class="ti ti-chevron-right"></i></button>
                </div>
            </div>
            <div class="nova-gallery-thumbs">
                <div class="nova-thumb active">
                    <?php echo woocommerce_get_product_thumbnail('thumbnail'); ?>
                </div>
                <?php foreach ($gallery_ids as $gallery_id) : ?>
                    <div class="nova-thumb">
                        <?php echo wp_get_attachment_image($gallery_id, 'thumbnail'); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif;
}

// Example 6: Custom Checkout Steps
function nova_checkout_steps() {
    ?>
    <div class="nova-checkout-progress">
        <div class="nova-checkout-step completed">
            <div class="nova-checkout-step-indicator">
                <i class="ti ti-check"></i>
            </div>
            <span class="nova-checkout-step-label"><?php esc_html_e('Cart', 'nova-template-wp-solar'); ?></span>
        </div>
        
        <div class="nova-checkout-step active">
            <div class="nova-checkout-step-indicator">2</div>
            <span class="nova-checkout-step-label"><?php esc_html_e('Details', 'nova-template-wp-solar'); ?></span>
        </div>
        
        <div class="nova-checkout-step">
            <div class="nova-checkout-step-indicator">3</div>
            <span class="nova-checkout-step-label"><?php esc_html_e('Payment', 'nova-template-wp-solar'); ?></span>
        </div>
        
        <div class="nova-checkout-step">
            <div class="nova-checkout-step-indicator">4</div>
            <span class="nova-checkout-step-label"><?php esc_html_e('Complete', 'nova-template-wp-solar'); ?></span>
        </div>
    </div>
    <?php
}
add_action('woocommerce_before_checkout_form', 'nova_checkout_steps', 5);

// Example 7: AJAX Add to Cart Enhancement
add_action('wp_footer', 'nova_ajax_add_to_cart_script');
function nova_ajax_add_to_cart_script() {
    ?>
    <script>
    jQuery(document).ready(function($) {
        // Enhanced add to cart with loading state
        $(document).on('click', '.nova-product-card .button', function(e) {
            e.preventDefault();
            
            var $button = $(this);
            var $card = $button.closest('.nova-product-card');
            
            $button.addClass('loading');
            $card.addClass('adding-to-cart');
            
            // Add product to cart via AJAX
            var data = {
                action: 'woocommerce_add_to_cart',
                product_id: $button.data('product_id'),
                quantity: 1
            };
            
            $.post(wc_add_to_cart_params.ajax_url, data, function(response) {
                if (response.error) {
                    console.error('Add to cart error:', response.error);
                } else {
                    // Update cart count
                    $('.nova-cart-count').text(response.cart_count);
                    
                    // Show success animation
                    $card.addClass('added-to-cart');
                    
                    setTimeout(function() {
                        $card.removeClass('adding-to-cart added-to-cart');
                        $button.removeClass('loading');
                    }, 1000);
                }
            });
        });
    });
    </script>
    <?php
}

// Example 8: Custom Product Badges Hook
add_action('init', 'nova_register_product_badges');
function nova_register_product_badges() {
    // Add custom product badges based on conditions
    add_action('woocommerce_before_shop_loop_item_title', 'nova_product_badges', 15);
}
