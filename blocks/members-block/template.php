<?php
$member_section_pre_title = get_field('pre_title');
$member_section_title = get_field('title');
$member_section_description = get_field('description');
$member_section_managers = get_field('managers');
?>

<?php if ($member_section_managers){?>
    <section class="section bg-pinkest-white">
        <div class="container">

            <?php if ($member_section_pre_title) { ?>
                <h4 class="section-pre-title text-center"><?php echo $member_section_pre_title; ?></h4>
            <?php } ?>
            <?php if ($member_section_title) { ?>
                <h2 class="section-title text-center mb-20"><?php echo $member_section_title; ?></h2>
            <?php } ?>

            <?php if ($member_section_description) { ?>
                <p class="desc text-center"><?php echo $member_section_description; ?></p>
            <?php } ?>

            <div class="row mt-115">
                <?php foreach ($member_section_managers as $member) { ?>
                    <div class="col-4">
                        <div class="team-profile">
                            <div class="avatar">
                                <img src="<?php echo $member['avatar']['url']; ?>" alt="<?php echo $member['avatar']['alt']; ?>"/>
                            </div>
                            <h4 class="title"><?php echo $member['name']; ?></h4>
                            <p class="text-limo"><?php echo $member['job_title']; ?></p>
                            <p><?php echo $member['biography']; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>
