<?php
/**
 * Template Name: Dashboard Canvas
 * Description: Dashboard sin scroll, contenido ocupa 100% del área disponible
 *
 * @package Nova_Template_WP_Solar
 */

get_header();
?>

<?php
while (have_posts()) :
    the_post();
    the_content();
endwhile;
?>

<?php
get_footer();