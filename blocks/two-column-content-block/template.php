<?php
$two_column_content_section_left_title = trim(get_field('left_title'));
$two_column_content_section_left_list_content = get_field('left_list_content');
$two_column_content_section_right_title = trim(get_field('right_title'));
$two_column_content_section_right_list_content = get_field('right_list_content');
?>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-<?php echo !empty($two_column_content_section_right_title) ? '6':'12'; ?>">
                <h2 class="section-title mb-40"><?php echo $two_column_content_section_left_title; ?></h2>
                <?php if ($two_column_content_section_left_list_content) { ?>
                    <ul class="ul-list <?php echo !empty($two_column_content_section_right_title) ? '':'list-flex-2-col'; ?>">
                        <?php foreach ($two_column_content_section_left_list_content as $item) { ?>
                            <li><p><?php echo $item['item']; ?></p></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>
            <div class="col-6">
                <h2 class="section-title mb-40"><?php echo $two_column_content_section_right_title; ?></h2>
                <?php if ($two_column_content_section_right_list_content) { ?>
                    <ul class="ul-list">
                        <?php foreach ($two_column_content_section_right_list_content as $item) { ?>
                            <li><p><?php echo $item['item']; ?></p></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
