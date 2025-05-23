<?php
/**
 * The template for displaying the footer
 *
 * @package Nova_Solar
 */
?>

    </div><!-- #content -->

    <?php
    // Show appropriate footer based on template
    $template = get_page_template_slug();
    
    if ($template === 'templates/canvas-ql.php') :
        // Canvas QL footer - simple "Powered By NovaLabss"
        ?>
        <footer id="colophon" class="site-footer canvas-ql-footer">
            <div class="container">
                <p class="powered-by">Powered By NovaLabss</p>
            </div>
        </footer>
        <?php
    elseif ($template !== 'templates/canvas-full.php') :
        // Default footer (not shown in Canvas Full)
        ?>
        <footer id="colophon" class="site-footer">
            <div class="container">
                <div class="site-info">
                    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
                </div>
            </div>
        </footer>
        <?php
    endif;
    ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
