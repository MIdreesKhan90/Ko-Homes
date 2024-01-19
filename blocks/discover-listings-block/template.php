<?php
$currency = get_field('currency_symbol', 'option');
$title = get_field('title');
$filter = get_field('filter');
?>

<section class="section listings-section">
    <div class="container">
        <div class="listings-head mb-40">
            <h3 class="title"><?php echo $title; ?></h3>
            <?php
            $terms = get_terms(array(
                'taxonomy' => 'locations',
                'hide_empty' => true,
            ));
            ?>
            <?php if($filter){?>
            <ul class="locations-list">
                <?php foreach ($terms as $term) { ?>
                    <li><a href="/" data-slug="<?php echo $term->slug; ?>" class="btn btn-rounded btn-outline-brown get-by-location"><?php echo $term->name; ?></a></li>
                <?php } ?>
            </ul>
            <div class="dropdown filter-dropdown">
                <a href="#" class="dd-btn text-right"><i class="fa fa-list"></i></a>
                <div class="dropdown-body" style="display:none;">
                    <div class="dd-head">
                        <h6 class="text-center title">Filters</h6>
                    </div>
                    <div class="dd-body">
                        <div class="dd-inner-dd bg-pinkest-white">
                            <div class="dd-inner-head">
                                Featured
                            </div>
                            <div class="dd-inner-body">
                                <ul>
                                    <li>
                                        <div class="radio custom">
                                            <input type="radio" id="priceASC" name="filterSorting" value="price_ASC"/>
                                            <label for="priceASC">Price: Low to High</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio custom">
                                            <input type="radio" id="priceDESC" name="filterSorting" value="price_DESC"/>
                                            <label for="priceDESC">Price: High to Low</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio custom">
                                            <input type="radio" id="bedsASC" name="filterSorting" value="beds_ASC"/>
                                            <label for="bedsASC">Bedrooms: Low to High</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="radio custom">
                                            <input type="radio" id="bedsDESC" name="filterSorting" value="beds_DESC"/>
                                            <label for="bedsDESC">Bedrooms: High to Low</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="dd-content">
                            <h6 class="text-blue text-center">Locations</h6>
                            <div id="filterLocations" class="radio-group">
                                <div class="radio">
                                    <input type="radio" id="one" name="filterLocations" value="one"/>
                                    <label for="one">City, State Country</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dd-footer text-center">
                        <a id="getFilteredProperties" href="#" class="btn btn-brown btn-rounded">Apply</a>
                    </div>
                </div>
            </div>
            <?php }  ?>
        </div>
        <?php
        $args = array(
            'post_type' => 'property',
            'posts_per_page' => 6,
            'post_status' => 'publish',
        );
        $query = new WP_Query($args); ?>
        <script>
            kohomes.max_page = <?php echo $query->max_num_pages; ?>;
        </script>
        <?php if ($query->have_posts()) : ?>
            <div class="listings-container">
                <div id="listingsContainer" class="row row-8">
                    <?php while ($query->have_posts()) : $query->the_post();
                        $permalink = get_post_permalink();
                        $the_id = get_the_ID();
                        $gallery = get_field('gallery',$the_id);
                        $number_of_beds = get_field('number_of_beds', $the_id);
                        $number_of_baths = get_field('number_of_baths',$the_id);
                        $area = get_field('area',$the_id);
                        $area_unit = get_field('area_unit',$the_id);
                        $location = get_field('location',$the_id);
                        $total_price = get_field('total_price',$the_id);
                        $shares_availability = get_field('shares_availability',$the_id);
                        $google_map_location = get_field('google_map_location',$the_id);
                        ?>
                        <div class="col-4">
                            <div class="property-box">
                                <div class="gallery-container">
                                    <div class="gallery-carousel owl-carousel owl-theme">
                                        <?php foreach ($gallery as $image) { ?>
                                            <div class="item">
                                                <?php echo wp_get_attachment_image($image['ID'], 'medium_large' ) ?>
<!--                                                <img src="--><?php //echo $image['url']; ?><!--" alt="--><?php //echo $image['ID']; ?><!--"/>-->
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <ul class="property-details">
                                        <li><i class="icon icon-bed"></i><?php echo $number_of_beds; ?> Beds</li>
                                        <li><i class="icon icon-bath"></i><?php echo $number_of_baths; ?> Baths</li>
                                        <li><i class="icon icon-area"></i><?php echo $area; ?> <?php echo $area_unit; ?></li>
                                    </ul>
                                </div>
                                <a class="box-body" href="<?php echo $permalink; ?>">
                                    <h6><?php the_title(); ?></h6>
                                    <h3><?php echo $currency . number_format($total_price / 8); ?><span>/share</span></h3>
                                    <div class="location">
                                        <span><?php echo ($google_map_location['name']?:$google_map_location['state'])?:$location; ?></span>
                                        <span>VIEW DETAILS</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($query->post_count() > 3) : ?>
            <div class="text-center">
                <a id="discoverLoadMore" href="#" class="btn btn-brown btn-rounded">load more</a>
            </div>
        <?php endif; ?>
    </div>
</section>


<script>
    jQuery(document).ready(function ($) {
        $(".gallery-carousel").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            items: 1,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>',
            ],
        });

    });
</script>