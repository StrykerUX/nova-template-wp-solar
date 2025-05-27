<?php
/**
 * Single Product tabs
 *
 * @package Nova_Template_WP_Solar
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 */
$product_tabs = apply_filters('woocommerce_product_tabs', array());

if (!empty($product_tabs)) : ?>

    <div class="woocommerce-tabs wc-tabs-wrapper nova-tabs">
        <ul class="tabs wc-tabs" role="tablist">
            <?php foreach ($product_tabs as $key => $product_tab) : ?>
                <li class="<?php echo esc_attr($key); ?>_tab" id="tab-title-<?php echo esc_attr($key); ?>" role="tab" aria-controls="tab-<?php echo esc_attr($key); ?>">
                    <a href="#tab-<?php echo esc_attr($key); ?>">
                        <?php
                        // Add icons based on tab type
                        if ($key === 'description') {
                            echo '<i class="ti ti-file-text"></i>';
                        } elseif ($key === 'additional_information') {
                            echo '<i class="ti ti-info-circle"></i>';
                        } elseif ($key === 'reviews') {
                            echo '<i class="ti ti-star"></i>';
                        }
                        ?>
                        <span><?php echo wp_kses_post(apply_filters('woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key)); ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        
        <div class="nova-tabs-content">
            <?php foreach ($product_tabs as $key => $product_tab) : ?>
                <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr($key); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr($key); ?>">
                    <?php
                    if (isset($product_tab['callback'])) {
                        call_user_func($product_tab['callback'], $key, $product_tab);
                    }
                    ?>
                </div>
            <?php endforeach; ?>
        </div>

        <?php do_action('woocommerce_product_after_tabs'); ?>
    </div>

<?php endif; ?>