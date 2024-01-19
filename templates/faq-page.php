<?php
/*
 * Template Name: FAQ Page
 */
get_header();
?>
<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <?php get_template_part('template-parts/sub', 'hero-section') ?>

<?php endwhile; ?>
<?php endif; ?>

  <section class="hero-bottom bg-pinkest-white">
    <div class="container">
      <h2 class="section-title mb-15">FAQS</h2>
      <p class="mb-20">
        Have a question about Kō? We have answers. Review frequently asked
        questions on the following topics:
      </p>
      <?php

      if( have_rows('sections') ){
        ?>
        <ul class="faq-nav">
        <?php
        while( have_rows('sections') ){
          the_row();
          if (get_row_layout() == 'accordion_section') {
            $accordion_section_title = get_sub_field('title');
          ?>
          <li><a href="#<?php echo slugify($accordion_section_title); ?>"><?php echo $accordion_section_title; ?></a></li>
          <?php
          }            

          }
          ?>
        </ul>
          <?php
        }
      ?>
    </div>
  </section>

<?php get_template_part('template-parts/page', 'sections') ?>

<?php get_footer(); ?>