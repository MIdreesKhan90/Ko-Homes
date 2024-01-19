<?php
$press_release_section_title = get_sub_field('title');
$press_release_section_blog_posts = get_sub_field('blog_posts');
?>

<section class="section bg-pinkest-white">
    <div class="container">
        <?php if ($press_release_section_title) { ?>
            <h2 class="section-title text-center mb-60"><?php echo $press_release_section_title; ?></h2>
        <?php } ?>

        <?php foreach ($press_release_section_blog_posts as $post) {
            $press_release_section_blog_post_category = get_the_category($post->ID);
            ?>
            <a href="<?php echo get_permalink($post->ID); ?>" class="blog-links">
                <div class="left">
                    <h6><?php echo $press_release_section_blog_post_category[0]->cat_name ?></h6>
                    <p><?php echo $post->post_title; ?></p>
                </div>
                <div class="right">
                    <p><?php echo date('d/m/Y', strtotime($post->post_date)); ?><i class="fa fa-angle-right"></i></p>
                </div>
            </a>
        <?php } ?>
    </div>
</section>
