<?php
$bg_image = get_field('bg_image');
$title = get_field('title');
$description = get_field('description');
$button_text = get_field('button_text');
$button_url = get_field('button_url');
?>

<section class="section hero-section main text-center flex-center bg-img bg-overlay bg-overlay-dark" style="--img: url('<?php echo $bg_image; ?>')">
    <div class="container">
        <h1 class="title text-blue"><?php echo $title; ?></h1>
        <p class="desc text-white"><?php echo $description; ?></p>
        <a href="<?php echo $button_url; ?>" class="btn btn-rounded btn-brown"><?php echo $button_text; ?></a>
    </div>
</section>
