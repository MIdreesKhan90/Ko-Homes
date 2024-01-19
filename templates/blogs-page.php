<?php
/*
 * Template Name: Blogs Page
 */
get_header();

$sticky = get_option('sticky_posts');
$sticky_args = array(
    'posts_per_page' => 1,
    'post__in' => $sticky,
    'ignore_sticky_posts' => 1
);
$sticky_query = new WP_Query($sticky_args);
if (isset($sticky[0])) { ?>
    <?php
    if ($sticky_query->have_posts()): ?>
        <?php while ($sticky_query->have_posts()) : $sticky_query->the_post();
            $s_post_categories = get_the_category();
            ?>
            <section class="hero-single blog">
                <div class="left bg-dark">
                    <a href="<?php the_permalink(); ?>" class="decoration-none">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
                        <?php else: ?>
                            <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/images/blog-header-image-01.jpg"
                                 alt="post thumbnail"/>
                        <?php endif; ?>
                    </a>
                </div>
                <div class="right bg-dark">
                    <div class="top bg-dark">
                        <h4>Featured Article</h4>
                    </div>
                    <div class="bottom bg-dark">
                        <a href="<?php the_permalink(); ?>" class="decoration-none">
                            <h1 class="text-white mb-15"><?php the_title(); ?></h1>
                        </a>
                        <h6 class="text-secondry-clr mb-20"><?php echo get_the_date(); ?> • <span class="text-blue"><?php echo $s_post_categories[0]->cat_name; ?></span></h6>
                        <a href="<?php the_permalink(); ?>" class="link">READ ARTICLE</a>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>

<?php } ?>

<?php
$terms = get_terms(array(
    'taxonomy' => 'category',
    'hide_empty' => true,
    'orderby' => 'name',
    'order' => 'ASC',
));
?>

<?php if ($terms) { ?>
    <!-- <section class="hero-bottom bg-winter-haven">
        <div class="container">
            <ul class="hero-bottom-nav">
                <?php foreach ($terms as $term) {
                    if ($term->slug == 'uncategorized') {
                        continue;
                    }
                    ?>
                    <li><a href="<?php echo get_term_link($term->term_id); ?>"><?php echo $term->name; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </section> -->
<?php } ?>


    <section class="section image-content-section">
        <div class="container">

            <?php
            $query_blog = new WP_Query(array(
                'posts_per_page' => 3,
                'post_status' => 'publish',
                'post__not_in' => $sticky,
            )); ?>
            <script>
                kohomes.max_page = <?php echo $query_blog->max_num_pages; ?>;
            </script>
            <div id="postsContainer" class="posts-container">
                <?php
                if ($query_blog->have_posts()): ?>
                    <?php while ($query_blog->have_posts()) : $query_blog->the_post();
                        $post_categories = get_the_category();
                        ?>
                        <div class="row flex-center">
                            <div class="col-6">
                                <a href="<?php the_permalink(); ?>" class="decoration-none">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('full', array('class' => 'img-fluid rounded')); ?>
                                    <?php else: ?>
                                        <img src="https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159.jpg"
                                             class="img-fluid rounded wp-post-image" alt="" loading="lazy"
                                             srcset="https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159.jpg 1366w, https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159-300x74.jpg 300w, https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159-1024x253.jpg 1024w, https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159-768x189.jpg 768w"
                                             sizes="(max-width: 1366px) 100vw, 1366px" width="1366" height="337">
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="col-6">
                                <h5 class="section-pre-title">
                                    <span><?php echo get_the_date(); ?></span> . <span class="font-size-6 text-blue"><?php echo $post_categories[0]->cat_name; ?>
                                    </span>
                                </h5>
                                <a href="<?php the_permalink(); ?>" class="decoration-none">
                                    <h2 class="section-title mb-40"><?php the_title(); ?></h2>
                                </a>
                                <p>
                                    <?php
                                    if(get_the_excerpt()){
                                        echo get_the_excerpt();
                                    } else {
                                        $excerpt = get_the_content();
                                        echo excerpt_str($excerpt, 200);    
                                    }
                                    ?>
                                </p>

                                <a href="<?php the_permalink(); ?>" class="link">READ ARTICLE</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>

            <div class="text-center mt-80">
                <a id="postsLoadMore" href="#" class="btn btn-rounded btn-brown">LOAD MORE</a>
            </div>
        </div>
    </section>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <?php if (get_the_content()) { ?>
        <?php the_content(); ?>
    <?php } ?>
<?php endwhile; ?>
<?php endif; ?>

<?php get_template_part('template-parts/page', 'sections') ?>

<?php get_footer(); ?>