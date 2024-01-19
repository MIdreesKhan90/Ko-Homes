<?php
$image_content_section_bg_color = get_sub_field('bg_color');
$image_content_section_image = get_sub_field('image');
$image_content_section_image_direction = get_sub_field('image_direction');
$image_content_section_pre_title = get_sub_field('pre_title');
$image_content_section_title = get_sub_field('title');
$image_content_section_description = get_sub_field('description');
$image_content_section_link_text = get_sub_field('link_text');
$image_content_section_link_url = get_sub_field('link_url');
?>

<section class="section image-content-section" <?php echo ($image_content_section_bg_color) ? 'style="background-color:' . $image_content_section_bg_color . '"' : '' ?>>
    <div class="container">
        <div class="row <?php echo ($image_content_section_image_direction == 'right') ? 'img-left' : 'img-right' ?>">
            <div class="col-6">
                <img class="img-fluid rounded" src="<?php echo $image_content_section_image['url']; ?>" alt="<?php echo $image_content_section_image['alt']; ?>"/>
            </div>
            <div class="col-6">
                <h4 class="section-pre-title mb-0"><?php echo $image_content_section_pre_title ?></h4>
                <h2 class="section-title mb-40"><?php echo $image_content_section_title ?></h2>
                <p class="mb-40">
                    <?php echo $image_content_section_description ?>
                </p>
                <a href="<?php echo $image_content_section_link_url ?>" class="link"><?php echo $image_content_section_link_text ?></a>
            </div>
        </div>
    </div>
</section>
