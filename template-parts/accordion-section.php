<?php
$accordion_section_bg_color = get_sub_field('bg_color');
$accordion_section_title = get_sub_field('title');
$accordion_section_faqs = get_sub_field('accordions');
$accordion_section_button_text = get_sub_field('button_text');
$accordion_section_button_url = get_sub_field('button_url');
?>

<section class="section accordion-section" <?php echo ($accordion_section_bg_color) ? 'style="background-color:' . $accordion_section_bg_color . '"' : '' ?> id="<?php echo slugify($accordion_section_title); ?>">
    <div class="container">
        <?php if ($accordion_section_title) { ?>
            <h2 class="section-title mb-40 text-center"><?php echo $accordion_section_title ?></h2>
        <?php } ?>
        <div class="accordion-main">
            <?php foreach ($accordion_section_faqs as $faq) { ?>
                <div class="accordion">
                    <div class="head">
                        <?php echo $faq['question']; ?>
                        <i class="icon icon-arrow-down"></i>
                    </div>
                    <div class="panel">
                        <?php echo $faq['answer']; ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php if ($accordion_section_button_text) { ?>
            <div class="text-center">
                <a href="<?php echo $accordion_section_button_url; ?>" class="btn btn-rounded btn-brown"><?php echo $accordion_section_button_text; ?></a>
            </div>
        <?php } ?>
    </div>
</section>
