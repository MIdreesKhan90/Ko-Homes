<?php
/*
 * Template Name: Generic Page
 */
get_header();
?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <?php get_template_part('template-parts/sub', 'hero-section') ?>

    <?php if (get_the_content()) { ?>
        <section class="section">
            <div class="container">
                <?php the_content(); ?>
            </div>
        </section>
        <?php } ?>


<?php endwhile; ?>
<?php endif; ?>

<?php get_template_part('template-parts/page', 'sections') ?>

<?php get_footer(); ?>