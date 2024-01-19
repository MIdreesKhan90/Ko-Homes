<?php
$icon_box_section_bg_color = get_sub_field('bg_color');
$icon_box_section_pre_title = get_sub_field('pre_title');
$icon_box_section_title = get_sub_field('title');
$icon_box_section_icon_boxes = get_sub_field('icon_boxes');
$icon_box_section_link_text = get_sub_field('link_text');
$icon_box_section_link_url = get_sub_field('link_url');
$count_icon = count($icon_box_section_icon_boxes);

?>

<section id="<?php echo ($icon_box_section_pre_title) ? slugify($icon_box_section_pre_title) : slugify($icon_box_section_title); ?>" class="section">
    <div class="container">
        <h4 class="section-pre-title text-center"><?php echo $icon_box_section_pre_title ?></h4>
        <h2 class="section-title text-center mb-115"><?php echo $icon_box_section_title ?></h2>
        <div class="row icon-box-carousel owl-carousel owl-theme">
            <?php foreach ($icon_box_section_icon_boxes as $key => $icon_box) { ?>
                <?php
                $col_cls = '4';
                if( $count_icon == '2' ){
                    $col_cls = '6';
                } else{
                    if( $icon_box['image']['url'] ){
                        $col_cls = '4';
                    } else{
                        $col_cls = '6';
                    }
                    // $col_cls = $icon_box['image']['url'] ? '4' : '6';
                }
                ?>
                <?php /* ?><div class="col-<?php echo ($icon_box['image']['url']) ? '4' : '6' ?>"><?php */?>
                <div class="col-<?php echo $col_cls; ?>">
                    <div class="icon-box">
                        <?php if ($icon_box['image']['url']) { ?>
                            <img class="icon" src="<?php echo $icon_box['image']['url']; ?>" alt="<?php echo $icon_box['image']['alt']; ?>"/>
                        <?php } ?>
                        <h2><?php if (!$icon_box['image']['url']) { ?>
                                <span class="icon"><?php echo str_pad($key + 1, 2, '0', STR_PAD_LEFT) . '.'; ?></span>
                            <?php } ?> <?php echo $icon_box['title']; ?></h2>
                        <p><?php echo $icon_box['description']; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php if ($icon_box_section_link_text) { ?>
            <div class="text-center mt-115">
                <a href="<?php echo $icon_box_section_link_url; ?>" class="link"><?php echo $icon_box_section_link_text; ?></a>
            </div>
        <?php } ?>
    </div>
</section>
