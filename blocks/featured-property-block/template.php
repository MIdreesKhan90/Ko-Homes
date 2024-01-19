<?php
$featured_property_section_title = get_field('title');
$featured_property_section_featured_property = get_field('featured_property');
$featured_property_section_image = wp_get_attachment_image_src(get_post_thumbnail_id($featured_property_section_featured_property->ID), 'single-post-thumbnail');
$number_of_beds = get_field('number_of_beds', $featured_property_section_featured_property->ID);
$number_of_baths = get_field('number_of_baths', $featured_property_section_featured_property->ID);
$area = get_field('area', $featured_property_section_featured_property->ID);
$area_unit = get_field('area_unit', $featured_property_section_featured_property->ID);
$location = get_field('location', $featured_property_section_featured_property->ID);
$about_home = get_field('about_home', $featured_property_section_featured_property->ID);
$total_price = get_field('total_price', $featured_property_section_featured_property->ID);

$currency = get_field('currency_symbol', 'option');
?>

<section class="section full-side-section bg-pinkest-white">
    <div class="inner-content flex-center">
        <div class="left">
        </div>
        <div class="right">
            <a href="<?php echo get_permalink($featured_property_section_featured_property->ID); ?>" class="decoration-none">
                <img src="<?php echo $featured_property_section_image[0]; ?>" alt="Featured Image">
            </a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h2 class="section-title mb-40 text-blue"><?php echo $featured_property_section_title ?></h2>
                <h6 class="location-title mb-40"><?php echo $location; ?></h6>
                <a class="decoration-none" href="<?php echo get_permalink($featured_property_section_featured_property->ID); ?>"><h2 class="property-title mb-20 text-limo"><?php echo $featured_property_section_featured_property->post_title; ?></h2></a>
                <h4 class="property-price mb-20 text-limo">
                    <?php echo $currency . number_format($total_price * 0.125) ?> <span class="text-primary-clr">•</span> 1/8 OWNERS
                </h4>
                <ul class="property-details mb-40">
                    <li><i class="icon icon-bed"></i><?php echo $number_of_beds; ?> Beds</li>
                    <li><i class="icon icon-bath"></i><?php echo $number_of_baths; ?> Baths</li>
                    <li><i class="icon icon-area"></i><?php echo $area; ?> <?php echo $area_unit; ?></li>
                </ul>
                <p class="mb-40 m-w-442">
                    <?php echo $about_home; ?>
                </p>
                <a href="<?php echo get_permalink($featured_property_section_featured_property->ID); ?>" class="link">Details</a>
            </div>
            <div class="col-6">

            </div>
        </div>
    </div>
</section>
