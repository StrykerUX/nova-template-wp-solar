<?php
/**
 * The header for our theme
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

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <?php
    // Only show header if not using Canvas templates
    $template = get_page_template_slug();
    if (!in_array($template, array('templates/canvas-full.php', 'templates/canvas-ql.php'))) :
        ?>
        <header id="masthead" class="site-header">
            <div class="container">
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) :
                        the_custom_logo();
                    else :
                        ?>
                        <h1 class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                        <?php
                    endif;
                    ?>
                </div>

                <?php if (has_nav_menu('primary')) : ?>
                    <nav id="site-navigation" class="main-navigation">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_id' => 'primary-menu',
                            'container' => false,
                        ));
                        ?>
                    </nav>
                <?php endif; ?>
            </div>
        </header>
        <?php
    endif;
    ?>

    <div id="content" class="site-content">
