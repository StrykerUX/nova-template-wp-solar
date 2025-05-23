<?php
/**
 * Template Name: Canvas QL
 * 
 * Canvas template with only footer showing "Powered By NovaLabss"
 *
 * @package Nova_Solar
 */

get_header();
?>

<main id="canvas-ql-main" class="canvas-main">
    <?php
    while (have_posts()) :
        the_post();
        the_content();
    endwhile;
    ?>
</main>

<?php
get_footer();
