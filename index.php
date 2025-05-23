<?php
/**
 * The main template file
 *
 * @package Nova_Solar
 */

get_header();
?>

<main id="main" class="site-main">
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php
            endwhile;
        else :
            ?>
            <p><?php _e('No content found.', 'nova-solar'); ?></p>
            <?php
        endif;
        ?>
    </div>
</main>

<?php
get_footer();
