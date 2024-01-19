<?php get_header();

$post_id = -1;
?>


<?php if (have_posts()): while (have_posts()) : the_post();

$post_categories = get_the_category();
    $permalink = get_permalink();
    $title = get_the_title();
    $post_id = get_the_ID();
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-details-section'); ?>>
        <section class="hero-section sub text-center flex-center bg-dark">
            <div class="container">
                <h2 class="title"><?php echo $title; ?></h2>
                <p class="desc text-white mb-40"><?php the_time('F j, Y'); ?> • <span class="text-blue"><?php echo $post_categories[0]->cat_name; ?></span></p>
                <div class="social-links">
                    <label>SHARE THIS POST:</label>
                    <a onClick="window.open('http://www.facebook.com/sharer.php?u=<?php echo esc_url($permalink); ?>', 'Facebook', 'width=600,height=300,left=' + (screen.availWidth / 2 - 300) + ',top=' + (screen.availHeight / 2 - 150) + '');
                            return false;" href="http://www.facebook.com/sharer.php?u=<?php echo esc_url($permalink); ?>" style="transition-delay: 0ms;">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a onClick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url($permalink); ?>', 'Linkedin', 'width=863,height=500,left=' + (screen.availWidth / 2 - 431) + ',top=' + (screen.availHeight / 2 - 250) + '');
                            return false;" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url($permalink); ?>">
                        <i class="fa fa-linkedin-square"></i>
                    </a>
<!--                    <a href="#"><i class="fa fa-instagram"></i></a>-->
                </div>
            </div>
        </section>
        <?php if (has_post_thumbnail()) : ?>
        <section class="hero-bottom-img">
            <?php the_post_thumbnail('full', array('class' => '')); ?>
        </section>
        <?php endif; ?>
        <section class="section blog-content">
            <div class="container">
                <div class="blog-content-inner">
                    <?php the_content(); // Dynamic Content ?>
                </div>
                <div class="text-center mt-100">
                    <a href="#" class="btn btn-rounded btn-brown scroll-to-top">BACK TO TOP</a>
                </div>
            </div>
        </section>

        <section class="section bg-pinkest-white">
            <div class="container">
                <h2 class="section-title text-center mb-60">You Might Also Be Interested In</h2>
                <div class="double-item-carousel owl-carousel owl-theme">
                    <?php
                    $query_blog = new WP_Query(array(
                        'posts_per_page' => 3,
                        'post_status' => 'publish',
                        'post__not_in' => array($post_id)
                    ));
                    $blog_index = 0;
                    if ($query_blog->have_posts()): ?>
                        <?php while ($query_blog->have_posts()) : $query_blog->the_post();
                            $blog_index++;
                            $post_categories = get_the_category();
                            ?>

<a class="blograndom" href="<?php echo get_permalink(); ?>">
                            <div class="property-box item">
                                <div class="img-container">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
                                    <?php else: ?>
                                        <img src="https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159.jpg" class="img-fluid wp-post-image" alt="" loading="lazy" srcset="https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159.jpg 1366w, https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159-300x74.jpg 300w, https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159-1024x253.jpg 1024w, https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159-768x189.jpg 768w" sizes="(max-width: 1366px) 100vw, 1366px" width="1366" height="337">
                                    <?php endif; ?>
                                </div>
                                <div class="box-body bg-white text-center">
                                    <h6><?php echo get_the_date(); ?></h6>
                                    <h3><?php echo the_title(); ?></h3>
                                    <h6 class="text-blue"><?php echo $post_categories[0]->cat_name; ?></h6>
                                </div>
                            </div>
                            </a>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>


        <section class="section bg-winter-haven">
            <div class="container">
                <h4 class="section-pre-title text-primary-clr text-center">
                    Stay Updated
                </h4>
                <h2 class="section-title text-white text-center mb-40">
                    DON'T MISS OUT ON THE LATEST LISTINGS
                </h2>
                <div class="contact-form subscribe-form">
                    <?php echo do_shortcode('[gravityform id="2" title="false" ajax="true"]'); ?>
                    <p class="h5 text-center text-white">
                        I give Kō permission to contact me & agree to the terms. This site
                        is protected by reCAPTCHA and the Google privacy policy, terms of
                        service and mobile terms.
                    </p>
                </div>
            </div>
        </section>

    </article>

    <!--                                    <p class="title-top">Newsroom: <span>--><?php //the_author(); ?><!--</span></p>-->
    <!--                            <p class="blog-excerpt">--><?php //customwp_excerpt(200, 'blog_excerpt'); ?><!--</p>-->
    <!-- post details -->
    <!--			<span class="date">--><?php //the_time('F j, Y'); ?><!-- --><?php //the_time('g:i a'); ?><!--</span>-->
    <!--			<span class="author">--><?php //_e( 'Published by', 'kohomes' ); ?><!-- --><?php //the_author_posts_link(); ?><!--</span>-->
    <!--			<span class="comments">--><?php //if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'kohomes' ), __( '1 Comment', 'kohomes' ), __( '% Comments', 'kohomes' )); ?><!--</span>-->
    <!-- /post details -->


    <!--			--><?php //the_tags( __( 'Tags: ', 'kohomes' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>

    <!--			<p>--><?php //_e( 'Categorised in: ', 'kohomes' ); the_category(', '); // Separated by commas ?><!--</p>-->

    <!--			<p>--><?php //_e( 'This post was written by ', 'kohomes' ); the_author(); ?><!--</p>-->

    <?php edit_post_link(); // Always handy to have Edit Post Links available ?>

    <?php //comments_template(); ?>

<?php endwhile; ?>

<?php else: ?>

    <!-- article -->
    <article>

        <h1><?php _e('Sorry, nothing to display.', 'kohomes'); ?></h1>

    </article>
    <!-- /article -->

<?php endif; ?>


<?php //get_sidebar(); ?>

<?php get_footer(); ?>

<script>
    jQuery(document).ready(function ($) {
        $('.double-item-carousel').owlCarousel({
            loop: true,
            margin: 92,
            nav: true,
            dots: false,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>',
            ],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 2
                }
            }
        });
    });
</script>
