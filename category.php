<?php get_header(); ?>


    <section class="hero-section sub text-center flex-center bg-dark">
        <div class="container">
            <h2 class="title">Categories</h2>
        </div>
    </section>
<?php
$terms = get_terms(array(
    'taxonomy' => 'category',
    'hide_empty' => true,
    'orderby' => 'name',
    'order' => 'ASC'
));
?>

<?php if($terms){?>
    <section class="hero-bottom bg-winter-haven">
        <div class="container">
            <ul class="hero-bottom-nav">
                <?php foreach ($terms as $term) {
                    if( $term->slug == 'uncategorized' ){
                        continue;
                    }
                    ?>
                    <li><a href="<?php echo get_term_link($term->term_id);  ?>"><?php echo $term->name; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </section>
<?php } ?>

    <section class="section image-content-section">
        <div class="container">
            <div class="posts-container">
                <?php
                if (have_posts()) : while (have_posts()) : the_post();
                    $post_categories = get_the_category();
                    ?>
                    <div class="row flex-center">
                        <div class="col-6">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('full', array('class' => 'img-fluid rounded')); ?>
                            <?php else: ?>
                                <img src="https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159.jpg"
                                     class="img-fluid rounded wp-post-image" alt="" loading="lazy"
                                     srcset="https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159.jpg 1366w, https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159-300x74.jpg 300w, https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159-1024x253.jpg 1024w, https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159-768x189.jpg 768w"
                                     sizes="(max-width: 1366px) 100vw, 1366px" width="1366" height="337">
                            <?php endif; ?>
                        </div>
                        <div class="col-6">
                            <h4 class="section-pre-title"><span><?php echo get_the_date(); ?></span> . <span class="text-blue"><?php echo $post_categories[0]->cat_name; ?></span>
                            </h4>
                            <h2 class="section-title mb-40"><?php the_title(); ?></h2>
                            <p class="mb-40">
                                <?php
                                $excerpt = get_the_content();
                                echo excerpt_str($excerpt, 80);
                                ?>
                            </p>

                            <a href="<?php the_permalink(); ?>" class="link">READ ARTICLE</a>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>


<?php get_footer(); ?>