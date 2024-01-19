<?php
/*
 * Template Name: Discover Page excl. Search
 */
get_header();

$currency = get_field('currency_symbol', 'option');

?>
<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <?php get_template_part('template-parts/sub', 'hero-section') ?>

<?php endwhile; ?>
<?php endif; ?>

    <section class="section listings-section">
        <div class="container">
            <div class="listings-head mb-40">
                <h3 class="title">FEATURED Properties</h3>
                <?php
                $terms = get_terms(array(
                    'taxonomy' => 'locations',
                    'hide_empty' => true,
                ));
                ?>
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
                                    <select name="filterCategory">
                                        <option value="">Featured</option>
                                        <?php foreach ($terms as $term) { ?>
                                            <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="dd-inner-body">
                                    <ul>
                                        <li>
                                            <div class="radio custom">
                                                <input type="radio" id="priceASC" name="filterPrice" value="ASC"/>
                                                <label for="priceASC">Price: Low to High</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio custom">
                                                <input type="radio" id="priceDESC" name="filterPrice" value="DESC"/>
                                                <label for="priceDESC">Price: High to Low</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio custom">
                                                <input type="radio" id="bedsASC" name="filterBeds" value="ASC"/>
                                                <label for="bedsASC">Bedrooms: Low to High</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="radio custom">
                                                <input type="radio" id="bedsDESC" name="filterBeds" value="DESC"/>
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
                            $gallery = get_field('gallery');
                            $number_of_beds = get_field('number_of_beds');
                            $number_of_baths = get_field('number_of_baths');
                            $area = get_field('area');
                            $area_unit = get_field('area_unit');
                            $location = get_field('location');
                            $total_price = get_field('total_price');
                            $shares_availability = get_field('shares_availability');
                            $google_map_location = get_field('google_map_location');
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
                                    <a class="box-body" href="<?php echo $permalink; ?>">
                                        <h6><?php the_title(); ?></h6>
                                        <h3><?php echo $currency . number_format($total_price / $shares_availability); ?><span>/share</span></h3>
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
