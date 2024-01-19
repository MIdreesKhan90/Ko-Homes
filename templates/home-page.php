<?php
/*
 * Template Name: Home Page
 */
get_header();
?>
<?php
$hero = get_field('hero_section');

if ($hero) {
    ?>

    <section class="section hero-section main text-center flex-center bg-img bg-overlay bg-overlay-dark" style="--img: url('<?php echo $hero["bg_image"]; ?>')">
        <div class="container">
            <h1 class="title text-blue"><?php echo $hero["title"]; ?></h1>
            <p class="desc text-white"><?php echo $hero["description"]; ?></p>
            <a href="<?php echo $hero["button_url"]; ?>" class="btn btn-rounded btn-brown"><?php echo $hero["button_text"]; ?></a>
        </div>
    </section>
<?php } ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail'); ?>


<?php endwhile; ?>
<?php endif; ?>
<?php get_template_part('template-parts/page', 'sections') ?>

<?php get_footer(); ?>