<?php
$bg_side_image_section_bg_image = get_field('bg_image');
$bg_side_image_section_title = get_field('title');
$bg_side_image_section_description = get_field('description');
$bg_side_image_section_numbered_list = get_field('numbered_list');
$bg_side_image_section_link_text = get_field('link_text');
$bg_side_image_section_link_url = get_field('link_url');
?>

<section class="section full-side-section bg-pinkest-white">
    <?php if ($bg_side_image_section_bg_image){ ?>
        <div class="inner-content flex-center">
            <div class="left">
            </div>
            <div class="right">
                <img src="<?php echo $bg_side_image_section_bg_image; ?>" alt="Image">
            </div>
        </div>
    <?php } ?>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <?php if ($bg_side_image_section_title){?>
                    <h2 class="section-title mb-40"><?php echo $bg_side_image_section_title; ?></h2>
                <?php } ?>
                <?php if ($bg_side_image_section_description){?>
                    <?php echo $bg_side_image_section_description; ?>
                <?php } ?>
                <?php if ($bg_side_image_section_numbered_list) { ?>
                    <ul class="ol-list">
                        <?php foreach ($bg_side_image_section_numbered_list as $key => $item) { ?>
                            <li>
                                <p><span><?php echo str_pad($key + 1, 2, '0', STR_PAD_LEFT) . '.'; ?></span><?php echo $item['item']; ?></p>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
                <?php if ($bg_side_image_section_link_text) { ?>
                    <a href="<?php echo $bg_side_image_section_link_url ?>" class="link mt-40"><?php echo $bg_side_image_section_link_text ?></a>
                <?php } ?>
            </div>
            <div class="col-6">

            </div>
        </div>
    </div>
</section>
