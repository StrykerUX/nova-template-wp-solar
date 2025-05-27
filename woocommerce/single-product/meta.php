<?php
/**
 * Single Product Meta
 *
 * @package Nova_Template_WP_Solar
 */

if (!defined('ABSPATH')) {
    exit;
}

global $product;
?>
<div class="product_meta">

    <?php do_action('woocommerce_product_meta_start'); ?>

    <?php if (wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable'))) : ?>
        <span class="sku_wrapper">
            <i class="ti ti-barcode"></i>
            <?php esc_html_e('SKU:', 'nova-template-wp-solar'); ?> 
            <span class="sku"><?php echo ($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'nova-template-wp-solar'); ?></span>
        </span>
    <?php endif; ?>

    <?php echo wc_get_product_category_list($product->get_id(), ', ', '<span class="posted_in"><i class="ti ti-folder"></i> ' . _n('Category:', 'Categories:', count($product->get_category_ids()), 'nova-template-wp-solar') . ' ', '</span>'); ?>

    <?php echo wc_get_product_tag_list($product->get_id(), ', ', '<span class="tagged_as"><i class="ti ti-tag"></i> ' . _n('Tag:', 'Tags:', count($product->get_tag_ids()), 'nova-template-wp-solar') . ' ', '</span>'); ?>

    <?php do_action('woocommerce_product_meta_end'); ?>

</div>