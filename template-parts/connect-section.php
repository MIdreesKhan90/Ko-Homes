<?php
$connect_section_style = get_sub_field('section_style');
$connect_section_pre_title = get_sub_field('pre_title');
$connect_section_title = get_sub_field('title');
$connect_section_description = get_sub_field('description');
$connect_section_form_shortcode = get_sub_field('form_shortcode');
$connect_section_form_bottom_text = get_sub_field('form_bottom_text');
?>

<section class="section bg-winter-haven connect-section">
    <div class="container">
        <div class="row">
            <div class="col-<?php echo ($connect_section_style == 'one') ? '12' : '6' ?>">
                <?php if ($connect_section_pre_title) { ?>
                    <h4 class="section-pre-title text-primary-clr <?php echo ($connect_section_style == 'one') ? 'text-center' : '' ?>"><?php echo $connect_section_pre_title; ?></h4>
                <?php } ?>
                <?php if ($connect_section_title) { ?>
                    <h2 class="section-title text-white mb-40 <?php echo ($connect_section_style == 'one') ? 'text-center' : '' ?>"><?php echo $connect_section_title; ?></h2>
                <?php } ?>
                <?php if ($connect_section_description) { ?>
                    <p><?php echo $connect_section_description; ?></p>
                <?php } ?>
            </div>
            <div class="col-<?php echo ($connect_section_style == 'one') ? '12' : '6' ?>">
                <div class="right">
                    <div class="contact-form">
                        <?php echo do_shortcode($connect_section_form_shortcode); ?>
                        <?php if ($connect_section_form_bottom_text) { ?>
                            <p class="h5 mt-30 text-center text-white"><?php echo $connect_section_form_bottom_text; ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
