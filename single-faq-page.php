<?php get_header(); ?>
<?php if (have_posts()): while (have_posts()) : the_post();
    $post_categories = get_the_category();
    $permalink = get_permalink();
    $title = get_the_title();
    $post_id = get_the_ID();
?>

<?php if (get_the_content()) { ?>
<section class="content-section-wrap">
  <div class="container-xl">
    <?php the_content(); ?>
  </div>
</section>
<?php } ?>

<?php endwhile; ?>

<?php else: ?>

    <!-- article -->
    <article>

        <h1><?php _e('Sorry, nothing to display.', 'kohomes'); ?></h1>

    </article>
    <!-- /article -->

<?php endif; ?>

<?php get_footer(); ?>