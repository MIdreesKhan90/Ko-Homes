<?php

$id = 'section-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'section content-section';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$bg_color = get_field('bg_color');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" <?php echo ($bg_color) ? 'style="background-color:' . $bg_color . '"' : '' ?>>
    <div class="container">
        <InnerBlocks />
    </div>
</section>
