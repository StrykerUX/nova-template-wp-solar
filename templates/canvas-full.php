<?php
/**
 * Template Name: Canvas Full
 * 
 * Completely blank canvas template
 *
 * @package Nova_Solar
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class('canvas-full'); ?>>
<?php wp_body_open(); ?>

<?php
while (have_posts()) :
    the_post();
    the_content();
endwhile;
?>

<?php wp_footer(); ?>
</body>
</html>
