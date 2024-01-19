<?php
$title = get_field('title');
$description = get_field('description');
$nav_items = get_field('nav_items');
?>

<?php if ($nav_items) { ?>
    <section class="hero-bottom faq-nav-hero bg-pinkest-white">
        <div class="container">
            <?php if ($title) { ?>
                <h2 class="section-title"><?php echo $title; ?></h2>
            <?php } ?>
            <?php if ($description) { ?>
                <p class="mb-20">
                    <?php echo $description; ?>
                </p>
            <?php } ?>
            <ul class="faq-nav">
                <?php foreach ($nav_items as $item) { ?>
                    <li><a class="scroll-to" href="#<?php echo slugify($item['title']); ?>"><?php echo $item['title']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </section>
<?php } ?>
