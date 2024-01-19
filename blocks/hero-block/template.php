<?php
$title = get_field('title');
$description = get_field('description');
$button_text = get_field('button_text');
$button_url = get_field('button_url');
$search_location_field = get_field('search_location_field');
$get_logo = get_field('header_logo'); 
?>

    <section class="hero-section sub text-center flex-center bg-dark">
        <div class="container">
            <?php if ($get_logo) { ?>
                <div class="header-logo">
                    <figure>
                        <img src="<?php echo $get_logo; ?>" />
                    </figure>
                </div>
            <?php } ?>
            <?php if ($title) { ?>
                <h2 class="title"><?php echo $title; ?></h2>
            <?php } ?>
            <?php if ($description) { ?>
                <p class="desc text-white"><?php echo $description; ?></p>
            <?php } ?>
            <?php if ($button_text) { ?>
                <a href="<?php echo $button_url; ?>" class="btn btn-rounded btn-brown"><?php echo $button_text; ?></a>
            <?php } ?>

            <?php if ($search_location_field) { ?>
                <div class="search-location">
                    <form action="">
                        <div class="input-group">
                            <input type="text" name="location"/>
                            <i class="fa fa-search"></i>
                        </div>
                    </form>
                </div>
            <?php } ?>
        </div>
    </section>

<?php if (has_post_thumbnail()) : ?>
    <section class="hero-bottom-img">
        <?php the_post_thumbnail('full', array('class' => '')); ?>
    </section>
<?php endif; ?>