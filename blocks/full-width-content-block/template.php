<?php
$full_wc_section_bg_color = get_field('bg_color');
$full_wc_section_pre_title = get_field('pre_title');
$full_wc_section_title = get_field('title');
$full_wc_section_desc = get_field('desc');

?>

<section id="<?php echo ($full_wc_section_pre_title) ? slugify($full_wc_section_pre_title) : slugify($full_wc_section_title); ?>" class="content-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h4><?php echo $full_wc_section_pre_title ?></h4>
                <h2><?php echo $full_wc_section_title ?></h2>
                <?php echo $full_wc_section_desc ?>
            </div>
        </div>
    </div>
</section>
