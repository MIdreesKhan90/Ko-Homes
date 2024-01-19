<?php
$id = 'section-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'section connect-section';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$bg_color = get_field('bg_color');
$connect_section_style = get_field('section_style');
$connect_section_pre_title = get_field('pre_title');
$connect_section_title = get_field('title');
$connect_section_description = get_field('description');
$connect_section_form_shortcode = get_field('form_shortcode');
$connect_section_form_bottom_text = get_field('form_bottom_text');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" <?php echo ($bg_color) ? 'style="background-color:' . $bg_color . '"' : '' ?>>
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
