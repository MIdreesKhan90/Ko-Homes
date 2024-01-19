<?php
$icon_box_section_bg_color = get_sub_field('bg_color');
$icon_box_section_pre_title = get_sub_field('pre_title');
$icon_box_section_title = get_sub_field('title');
?>

<section id="<?php echo ($icon_box_section_pre_title) ? slugify($icon_box_section_pre_title) : slugify($icon_box_section_title); ?>" class="content-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h4><?php echo $icon_box_section_pre_title ?></h4>
                <h2><?php echo $icon_box_section_title ?></h2>
                <?php the_sub_field('desc'); ?>
            </div>
        </div>
    </div>
</section>
