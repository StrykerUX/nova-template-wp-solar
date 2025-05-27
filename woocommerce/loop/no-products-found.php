<?php
/**
 * Displayed when no products are found matching the current query
 *
 * @package Nova_Template_WP_Solar
 */

defined('ABSPATH') || exit;

?>
<div class="woocommerce-no-products-found">
    <div class="nova-empty-state">
        <div class="nova-empty-icon">
            <i class="ti ti-package-off"></i>
        </div>
        <h2 class="nova-empty-title"><?php esc_html_e('No products found', 'nova-template-wp-solar'); ?></h2>
        <p class="nova-empty-message">
            <?php esc_html_e('Sorry, but no products matched your search criteria. Please try again with different keywords.', 'nova-template-wp-solar'); ?>
        </p>
        <div class="nova-empty-actions">
            <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="button nova-button-primary">
                <i class="ti ti-arrow-left"></i>
                <?php esc_html_e('Return to shop', 'nova-template-wp-solar'); ?>
            </a>
        </div>
    </div>
</div>