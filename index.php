<?php get_header(); ?>



<main class="page-wrapper">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <?php if (get_the_content()) { ?>
        <section class="content-section-wrap">
          <div class="container-xl">
            <?php the_content(); ?>
          </div>
        </section>
      <?php } ?>
    <?php endwhile; ?>
  <?php endif; ?>

  <?php //get_template_part('template-parts/page', 'sections') 
  ?>
</main>

<?php get_footer(); ?>