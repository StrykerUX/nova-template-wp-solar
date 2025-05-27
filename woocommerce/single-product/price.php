<?php
/**
 * Single Product Price
 *
 * @package Nova_Template_WP_Solar
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $product;
?>
<div class="nova-price-wrapper">
    <p class="<?php echo esc_attr(apply_filters('woocommerce_product_price_class', 'price')); ?>">
        <?php echo $product->get_price_html(); ?>
    </p>
    
    <?php if ($product->is_on_sale() && $product->is_type('variable')) : ?>
        <div class="nova-savings">
            <i class="ti ti-discount-2"></i>
            <span><?php echo esc_html__('Save up to', 'nova-template-wp-solar'); ?> 
                <?php
                $max_percentage = 0;
                foreach ($product->get_children() as $child_id) {
                    $variation = wc_get_product($child_id);
                    $regular = (float) $variation->get_regular_price();
                    $sale = (float) $variation->get_sale_price();
                    
                    if ($regular > 0 && $sale > 0) {
                        $percentage = round(100 - ($sale / $regular * 100));
                        if ($percentage > $max_percentage) {
                            $max_percentage = $percentage;
                        }
                    }
                }
                echo $max_percentage . '%';
                ?>
            </span>
        </div>
    <?php endif; ?>
</div>