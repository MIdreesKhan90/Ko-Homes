<?php
/*
 * Template Name: Discover Page
 */
get_header();

$currency = get_field('currency_symbol', 'option');
?>

    <section class="hero-section sub flex-center bg-dark">
        <div class="container">
            <h2 class="title text-center">Luxury homes in top locations</h2>
            <p class="desc text-center text-white">
                Explore our collection of available homes and Kō worthy prospects.
            </p>
            <div class="search-location">
                <form action="">
                    <div class="input-group">
                        <input type="text" name="location"/>
                        <i class="fa fa-search"></i>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="section listings-section">
        <div class="container">
            <div class="listings-head mb-40">
                <h3 class="title">FEATURED MARKETS</h3>
                <?php
                $terms = get_terms(array(
                    'taxonomy' => 'locations',
                    'hide_empty' => true,
                ));
                ?>
                <ul class="locations-list">
                    <?php foreach ($terms as $term) { ?>
                        <li><a href="/" class="btn btn-rounded btn-outline-brown"><?php echo $term->name; ?></a></li>
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
                                    <h6 class="text-center text-blue">Featured <i class="fa fa-caret-down"></i></h6>
                                </div>
                                <div class="dd-inner-body ">
                                    <ul>
                                        <li><a href="#">Price: Low to High</a></li>
                                        <li><a href="#">Price: High to Low</a></li>
                                        <li><a href="#">Bedrooms: Low to High</a></li>
                                        <li><a href="#">Bedrooms: High to Low</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="dd-content">
                                <h6 class="text-blue text-center">Location</h6>
                                <div class="radio-group">
                                    <div class="radio">
                                        <input type="radio" id="one" name="location" value="one"/>
                                        <label for="one">City, State Country</label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" id="two" name="location" value="two"/>
                                        <label for="two">City, State Country</label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" id="three" name="location" value="three"/>
                                        <label for="three">City, State Country</label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" id="four" name="location" value="four"/>
                                        <label for="four">City, State Country</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dd-footer text-center">
                            <a href="#" class="btn btn-brown btn-rounded">Apply</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $args = array(
                'post_type' => 'property',
                'posts_per_page' => 6,
//                'tax_query' => array(
//                    array(
//                        'taxonomy' => 'category',
//                        'field' => 'term_id',
//                        'terms' => $category
//                    )
//                )
            );
            $query = new WP_Query($args); ?>
            <script>
                kohomes.max_page = <?php echo $query->max_num_pages; ?>;
            </script>
            <?php if ($query->have_posts()) : ?>
                <div class="listings-container">
                    <div class="row row-8">
                        <?php while ($query->have_posts()) : $query->the_post();
                            $permalink = get_post_permalink();
                            $gallery = get_field('gallery');
                            $number_of_beds = get_field('number_of_beds');
                            $number_of_baths = get_field('number_of_baths');
                            $area = get_field('area');
                            $area_unit = get_field('area_unit');
                            $location = get_field('location');
                            $total_price = get_field('total_price');
                            $shares_availability = get_field('shares_availability');
                            ?>
                            <div class="col-4">
                                <div class="property-box">
                                    <div class="gallery-container">
                                        <div class="gallery-carousel owl-carousel owl-theme">
                                            <?php foreach ($gallery as $image) { ?>
                                                <div class="item">
                                                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <ul class="property-details">
                                            <li><i class="icon icon-bed"></i><?php echo $number_of_beds; ?> Beds</li>
                                            <li><i class="icon icon-bath"></i><?php echo $number_of_baths; ?> Baths</li>
                                            <li><i class="icon icon-area"></i><?php echo $area; ?> <?php echo $area_unit; ?></li>
                                        </ul>
                                    </div>
                                    <div class="box-body">
                                        <h6>SUBURB</h6>
                                        <h3><?php echo $currency . number_format($total_price / $shares_availability); ?><span>/share</span></h3>
                                        <div class="location">
                                            <span><?php echo $location; ?></span>
                                            <span><a href="<?php echo $permalink; ?>">VIEW DETAILS</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="text-center">
                <a id="discoverLoadMore" href="#" class="btn btn-brown btn-rounded">load more</a>
            </div>
        </div>
    </section>


<?php get_template_part('template-parts/page', 'sections') ?>

<?php get_footer(); ?>

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
