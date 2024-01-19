<?php
$table_content_section_pre_title = get_field('pre_title');
$table_content_section_title = get_field('title');
$table_content_section_description = get_field('description');
$table_content_section_link_text = get_field('link_text');
$table_content_section_link_url = get_field('link_url');
$table_content_section_table_data = get_field('table_data');
?>

<section class="section bg-pinkest-white">
    <div class="container">
        <div class="row flex-center">
            <div class="col-6">
                <?php if ($table_content_section_pre_title) { ?>
                    <h4 class="section-pre-title mb-0"><?php echo $table_content_section_pre_title; ?></h4>
                <?php } ?>
                <?php if ($table_content_section_title) { ?>
                    <h2 class="section-title mb-40"><?php echo $table_content_section_title; ?></h2>
                <?php } ?>
                <?php if ($table_content_section_description) { ?>
                    <p class="mb-40"><?php echo $table_content_section_description; ?></p>
                <?php } ?>
                <?php if ($table_content_section_link_text) { ?>
                    <a href="<?php echo $table_content_section_link_url ?>" class="link"><?php echo $table_content_section_link_text; ?></a>
                <?php } ?>
            </div>
            <div class="col-6">
                <div class="table-container">
                    <table class="table">
                        <thead>
                        <?php foreach ($table_content_section_table_data

                        as $key => $item) { ?>
                        <?php if ($key == 0) { ?>
                        <tr>
                            <th><?php echo $item['column_1_data'] ?></th>
                            <th><?php echo $item['column_2_data'] ?></th>
                            <th><?php echo $item['column_3_data'] ?></th>
                            <th><?php echo $item['column_4_data'] ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php } else { ?>
                            <tr>
                                <th><?php echo $item['column_1_data'] ?>
                                    <?php if ($item['column_1_tooltip']) { ?>
                                        <span class="tooltip"><i class="fa fa-info-circle"></i>
                                                        <div class="tooltip-body"><?php echo $item['column_1_tooltip'] ?></div>
                                                    </span>
                                    <?php } ?>

                                </th>
                                <td><?php echo $item['column_2_data'] ?></td>
                                <td><?php echo $item['column_3_data'] ?></td>
                                <td><?php echo $item['column_4_data'] ?></td>
                            </tr>
                        <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
