<?php get_header();
$google_map_api_key = get_field('google_map_api_key', 'option');
$currency = get_field('currency_symbol', 'option');
$property_details_page = get_field('property_details_page', 'option');
$marker_location = '';
$post_id = -1;
$count_posts = 3;
?>

<?php if (have_posts()): while (have_posts()) : the_post();

    $google_map_location = get_field('google_map_location');
    $map_location = get_field('map_location');
    $shares_availability = get_field('shares_availability');
    $number_of_beds = get_field('number_of_beds');
    $number_of_baths = get_field('number_of_baths');
    $area = get_field('area');
    $area_unit = get_field('area_unit');
    $location = get_field('location');
    $total_price = get_field('total_price');
    $total_annual_expenses = get_field('total_annual_expenses');
    $year_built = get_field('year_built');
    $video_link = get_field('video_link');
    $threeSixty_link = get_field('360_link');
    $property_pdf_cta = get_field('property_pdf_cta');
    $pdf_link = get_field('pdf_link');
    $sales_brouchure_link = get_field('sales_brouchure_link');
    $about_home = get_field('about_home');
    $gallery = get_field('gallery');
    $amenities = get_field('amenities_checklist');
    $destination = get_field('destination_section');
    $post_categories = get_the_terms(get_the_ID(), 'locations');
    $permalink = get_permalink();
    $marker_location = $location;
    $post_id = get_the_ID();
    ?>
    <section class="hero-single hero-property">
        <div class="left">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
            <?php endif; ?>
        </div>
        <div class="right">
            <div class="top">
                <?php
                if ($google_map_location): ?>
                    <div id="single-property-map" class="acf-map"
                         data-zoom="<?php echo esc_attr($google_map_location['zoom']); ?>"
                         data-lat="<?php echo esc_attr($google_map_location['lat']); ?>"
                         data-lng="<?php echo esc_attr($google_map_location['lng']); ?>"></div>
                <?php endif; ?>
            </div>
            <div class="bottom bg-dark">
                <ul class="breadcrumb mb-20">
                    <li><a href="<?php echo home_url(); ?>">Home</a></li>
                    <li><a href="<?php echo home_url(); ?>/discover">Listings</a></li>
                    <li><a>Destinations</a></li>
                    <li><?php echo $post_categories[0]->name; ?></li>
                </ul>
                <div class="property-location">
                    <h6 class="location-title"><?php echo $location; ?></h6>
                    <span class="badge"><i class="fa fa-exclamation"></i> <?php echo $shares_availability; ?> SHARES AVAILABLE</span>
                </div>
                <h2 class="property-title text-white mb-20"><?php the_title(); ?></h2>
                <h6 class="property-price text-secondry-clr mb-20"><?php echo $currency . number_format($total_price * 0.125) ?>
                    • 1/8 OWNERS</h6>
                <ul class="property-details text-white">
                    <li><i class="icon icon-bed"></i> <?php echo $number_of_beds; ?> Beds</li>
                    <li><i class="icon icon-bath"></i> <?php echo $number_of_baths; ?> Baths</li>
                    <li><i class="icon icon-area"></i> <?php echo $area; ?> <?php echo $area_unit; ?></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="hero-bottom bg-winter-haven">
        <div class="container">
            <div class="single-property-details">
                <div class="left">
                    <div>
                        <h6>WHOLE HOME PRICE</h6>
                        <p><?php echo $currency . number_format($total_price); ?></p>
                    </div>
                    <div>
                        <h6>YEAR BUILT</h6>
                        <p><?php echo $year_built; ?></p>
                    </div>
                    <div class="location">
                        <h6>LOCATION</h6>
                        <p><?php echo $location; ?></p>
                    </div>
                </div>
                <div class="right">
                    <div class="detail-links">
                        <a onClick="window.open('http://www.facebook.com/sharer.php?u=<?php echo esc_url($permalink); ?>', 'Facebook', 'width=600,height=300,left=' + (screen.availWidth / 2 - 300) + ',top=' + (screen.availHeight / 2 - 150) + '');
                                return false;"
                           href="http://www.facebook.com/sharer.php?u=<?php echo esc_url($permalink); ?>"
                           style="transition-delay: 0ms;">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="<?php echo esc_url("mailto:?subject=Check out this Luxury Home on Kō Homes website&body=Check out this Luxury Home on Kō Homes website: ") . esc_url($permalink); ?>"><i
                                    class="fa fa-envelope"></i></a>
                        <?php if ($video_link) { ?>
                            <a href="#propertyVideo" class="trigger-popup"><i class="icon icon-play"></i></a>
                        <?php } ?>
                        <?php if ($threeSixty_link) { ?>
                            <a href="#threeSixtyPopup" class="trigger-popup"><i class="icon icon-360"></i></a>
                        <?php } ?>
                        <a href="#" data-clipboard-text="<?php echo $permalink ?>" class="copy-to-clipboard">
                            <span class="tooltip copy">
                                <i class="icon icon-arrow-upload"></i>
                                <div class="tooltip-body">Copy to Clipboard</div>
                            </span>
                        </a>
                        <?php if ($property_pdf_cta) { ?>
                            <a href="#downloadBrochure" class="trigger-popup"><i class="icon icon-pdf"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section single-about-section">
        <div class="container">
            <ul class="breadcrumb mb-40">
                <li><a href="<?php echo home_url(); ?>">Home</a></li>
                <li><a href="<?php echo home_url(); ?>/discover">Listings</a></li>
                <li><a>Destinations</a></li>
                <li><?php echo $post_categories[0]->name; ?></li>
            </ul>
            <div class="row">
                <div class="col-6">
                    <h4 class="section-pre-title">Discover</h4>
                    <h2 class="section-title mb-40">ABOUT THIS HOME</h2>
                    <p class="m-w-442"><?php echo $about_home; ?></p>
                </div>
                <div class="col-6">
                    <div class="table-card">
                        <div class="header">
                            <h6 class="title">ESTIMATE THE MONTHLY COST TO OWN </h6>
                        </div>
                        <div class="body">
                            <div class="tr">
                                <div class="td">WHOLE HOME PRICE</div>
                                <div class="td" id="totalPrice"
                                     data-price="<?php echo $total_price; ?>"><?php echo $currency . number_format($total_price); ?></div>
                            </div>
                            <div class="tr">
                                <div class="td">
                                    OWNERSHIP
                                    <select id="selectOwnership" class="inline-select">
                                        <option value="0.125" selected>1/8</option>
                                        <option value="0.25">2/8</option>
                                        <option value="0.5">4/8</option>
                                    </select>
                                </div>
                                <div class="td">
                                    <?php echo $currency; ?><span
                                            id="calculatedOwnership"><?php echo number_format($total_price * 0.125); ?></span>
                                </div>
                            </div>
                            <div class="tr">
                                <div class="td">MONTHLY EXPENSE <br> PER SHARE</div>
                                <div class="td ">
                                    <?php echo $currency; ?><span id="expensePerShare"
                                          data-expense="<?php echo ($total_annual_expenses / 12) * 0.125 ?>"><?php echo number_format(($total_annual_expenses / 12) * 0.125); ?></span>
                                </div>
                            </div>
                            <div class="tr">
                                <div class="td">TOTAL ANNUAL <br>PROPERTY EXPENSES</div>
                                <div class="td">
                                    <?php echo $currency; ?>
                                    <span id="totalAnnualExpenses" data-annual-expense="<?php echo $total_annual_expenses; ?>"><?php echo number_format($total_annual_expenses); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <div>
                                <h3><?php echo $currency; ?><span id="pricePerMonth"><?php echo number_format(($total_annual_expenses / 12) * 0.125) ?></span>/month
                                </h3>
                                <p><span id="ownership">1/8</span> ownership • Up to <span id="upToNights">42</span> nights a year</p>
                            </div>
                            <div><a href="#enquirePopup" class="trigger-popup btn btn-rounded btn-brown">ENQUIRE</a>
                            </div>
                        </div>
                    </div>
                    <?php if ($property_pdf_cta) { ?>
                        <div class="text-center">
                            <a href="#downloadBrochure" class="link trigger-popup">DOWNLOAD SALES BROCHURE</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <section class="wide-carousel">
        <div class="gallery-carousel owl-carousel owl-theme">
            <?php foreach ($gallery as $image) { ?>
                <div class="item">
                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
                </div>
            <?php } ?>
            <?php foreach ($amenities as $item) { ?>
            <?php } ?>
        </div>
    </section>

    <?php if($amenities): ?>
    <section class="section distinct-section">
        <div class="container">
            <h4 class="section-pre-title text-center">Features</h4>
            <h2 class="section-title text-center mb-40">DISTINCT AMENITIES</h2>
            <div class="row">
                <ul class="features-list mycst">
                    <?php foreach ($amenities as $key => $item) { ?>
                        <li><?php echo $item['label']; ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </section>
    <?php endif; ?>


    <?php if ($destination['gallery']) { ?>
        <section class="section full-side-section flex-center destination-section">
            <div class="inner-content flex-center">
                <div class="left">
                </div>
                <div class="right">
                    <div class="destination-carousel owl-carousel owl-theme">
                        <?php foreach ($destination['gallery'] as $item) { ?>
                            <div class="destination-carousel__item"
                                 style="background-image:url('<?php echo $item['url']; ?>')"></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="container w-100">
                <div class="row">
                    <div class="col-6">
                        <?php if ($destination['pre_title']) { ?>
                            <h4 class="section-pre-title"><?php echo $destination['pre_title']; ?></h4>
                        <?php } ?>
                        <?php if ($destination['title']) { ?>
                            <h2 class="section-title mb-40"><?php echo $destination['title']; ?></h2>
                        <?php } ?>
                        <?php if ($destination['description']) { ?>
                            <p class="mb-40 m-w-442"><?php echo $destination['description']; ?></p>
                        <?php } ?>
                        <?php if ($destination['link_text']) { ?>
                            <a href="<?php echo $destination['link_url']; ?>"
                               class="link"><?php echo $destination['link_text']; ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>


    <section class="section">
        <div class="container">
            <h4 class="section-pre-title text-center"><?php echo $property_details_page['ibs_pre_title']; ?></h4>
            <h2 class="section-title text-center mb-115"><?php echo $property_details_page['ibs_title']; ?></h2>
            <div class="row mb-115">
                <?php foreach ($property_details_page['icon_boxes'] as $key => $icon_box) { ?>
                    <div class="col-<?php echo ($icon_box['image']['url']) ? '4' : '6' ?>">
                        <div class="icon-box">
                            <?php if ($icon_box['image']['url']) { ?>
                                <img class="icon" src="<?php echo $icon_box['image']['url']; ?>"
                                     alt="<?php echo $icon_box['image']['alt']; ?>"/>
                            <?php } ?>
                            <h2><?php if (!$icon_box['image']['url']) { ?>
                                    <span class="icon"><?php echo str_pad($key + 1, 2, '0', STR_PAD_LEFT) . '.'; ?></span>
                                <?php } ?> <?php echo $icon_box['title']; ?></h2>
                            <p><?php echo $icon_box['description']; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="text-center">
                <a href="<?php echo $property_details_page['ibs_link_url']; ?>"
                   class="link"><?php echo $property_details_page['ibs_link_text']; ?></a>
            </div>
        </div>
    </section>

    <?php if ($property_details_page['form_shortcode']) { ?>
        <section class="section bg-winter-haven connect-section">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <?php if ($property_details_page['cs_pre_title']) { ?>
                            <h4 class="section-pre-title text-primary-clr"><?php echo $property_details_page['cs_pre_title']; ?></h4>
                        <?php } ?>
                        <?php if ($property_details_page['cs_title']) { ?>
                            <h2 class="text-white section-title mb-40"><?php echo $property_details_page['cs_title']; ?></h2>
                        <?php } ?>
                        <?php if ($property_details_page['cs_description']) { ?>
                            <p><?php echo $property_details_page['cs_description']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="col-6">
                        <div class="right">
                            <div class="contact-form">
                                <?php echo do_shortcode($property_details_page['form_shortcode']); ?>
                                <?php if ($property_details_page['form_bottom_text']) { ?>
                                    <p class="h5 text-center text-white">
                                        <?php echo $property_details_page['form_bottom_text']; ?>
                                    </p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <?php
    $args = array(
        'post_type' => 'property',
        'posts_per_page' => 9,
        'post_status' => 'publish',
        'post__not_in' => array($post_id)
    );
    $query = new WP_Query($args);
    $count_posts = $query->found_posts;
    ?>
    <?php if ($query->have_posts()) : ?>
        <section class="section">
            <div class="container">
                <h3 class="section-pre-title text-center">Still Looking?</h3>
                <h2 class="section-title text-center mb-60">More Homes to Consider</h2>
                <div class="triple-item-carousel owl-carousel owl-theme">
                    <?php while ($query->have_posts()) : $query->the_post();
                        $p_permalink = get_post_permalink();

                        $p_location = get_field('location');
                        $p_categories = get_the_category();
                        $p_google_map_location = get_field('google_map_location');
                        ?>
                        <a href="<?php echo $p_permalink; ?>" class="property-box item">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="img-container">
                                    <?php the_post_thumbnail('full', array('class' => '')); ?>
                                </div>
                            <?php endif; ?>
                            <div class="box-body text-center">
                                <h6><?php echo ($p_google_map_location['name'] ?: $p_google_map_location['state']) ?: $p_location; ?></h6>
                                <h3><?php the_title(); ?></h3>
                                <h6 class="text-secondry-clr"><?php echo $currency . number_format($total_price * 0.125) ?>
                                    • 1/8 OWNERS</h6>
                            </div>
                        </a>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="section bg-side-img side-right bg-pinkest-white"
             style="--img : url('<?php echo $property_details_page['d_image']['url']; ?>')">
        <?php if ($property_details_page['d_image']) { ?>
            <img class="img-fluid mobile" src="<?php echo $property_details_page['d_image']['url']; ?>"
                 alt="<?php echo $property_details_page['d_image']['alt']; ?>">
        <?php } ?>

        <div class="container">
            <div class="row">
                <div class="col-6">
                    <?php if ($property_details_page['d_pre_title']) { ?>
                        <h4 class="section-pre-title"><?php echo $property_details_page['d_pre_title']; ?></h4>
                    <?php } ?>
                    <?php if ($property_details_page['d_title']) { ?>
                        <h2 class="section-title mb-40"><?php echo $property_details_page['d_title']; ?></h2>
                    <?php } ?>
                    <?php if ($property_details_page['d_description']) { ?>
                        <p class="mb-40"><?php echo $property_details_page['d_description']; ?></p>
                    <?php } ?>
                    <?php if ($property_details_page['d_link_text']) { ?>
                        <a href="<?php echo $property_details_page['d_link_url']; ?>"
                           class="link"><?php echo $property_details_page['d_link_text']; ?></a>
                    <?php } ?>

                </div>
            </div>
        </div>
    </section>

    <?php if ($video_link) { ?>
        <div id="propertyVideo" class="popup-modal">
            <div class="popup-modal-inner">
                <div class="popup-modal-main rounded">
                    <div class="popup-modal-header">
                        <button class="close"><i class="fa fa-times"></i></button>
                        <h6 class="title">Property Video</h6>
                    </div>
                    <div class="popup-modal-body">
                        <div class="embed-video">
                            <iframe src="<?php echo $video_link; ?>" title="YouTube video"
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if ($threeSixty_link) { ?>
        <div id="threeSixtyPopup" class="popup-modal">
            <div class="popup-modal-inner">
                <div class="popup-modal-main rounded">
                    <div class="popup-modal-header">
                        <button class="close"><i class="fa fa-times"></i></button>
                        <h6 class="title">360<sup>o</sup> Video</h6>
                    </div>
                    <div class="popup-modal-body">
                        <div class="embed-video">
                            <iframe src="<?php echo $threeSixty_link; ?>" title="YouTube video"
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div id="downloadBrochure" class="popup-modal">
        <div class="popup-modal-inner">
            <div class="popup-modal-main rounded">
                <div class="popup-modal-header">
                    <button class="close"><i class="fa fa-times"></i></button>
                    <h6 class="title">DOWNLOAD BROCHURE</h6>
                </div>
                <div class="popup-modal-body ">
                    <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/images/modal-img.jpg"
                         alt="">
                    <div class="modal-form contact-form">
                        <?php echo do_shortcode('[gravityform id="7" title="false" ajax="true"]'); ?>
                    </div>
                    <p class="text-center text-haven">
                        I give Kō permission to contact me &amp; agree to the terms. This
                        site is protected by reCAPTCHA and the Google privacy policy,
                        terms of service and mobile terms.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="enquirePopup" class="popup-modal">
        <div class="popup-modal-inner">
            <div class="popup-modal-main rounded">
                <div class="popup-modal-header">
                    <button class="close"><i class="fa fa-times"></i></button>
                    <h6 class="title">Enquire</h6>
                </div>
                <div class="popup-modal-body ">
                    <div class="modal-form contact-form">
                        <?php echo do_shortcode('[gravityform id="8" title="false" ajax="true"]'); ?>
                    </div>
                    <p class="text-center text-haven">
                        I give Kō permission to contact me &amp; agree to the terms. This
                        site is protected by reCAPTCHA and the Google privacy policy,
                        terms of service and mobile terms.
                    </p>
                </div>
            </div>
        </div>
    </div>

<?php endwhile; ?>

<?php else: ?>
    <!-- article -->
    <article>

        <h1><?php _e('Sorry, nothing to display.', 'kohomes'); ?></h1>

    </article>
    <!-- /article -->
<?php endif; ?>


<?php get_footer(); ?>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_map_api_key; ?>"></script>

<script>

    jQuery(document).ready(function ($) {
        let map;
        const mapTarget = $("#single-property-map");
        const lat = parseFloat(mapTarget.attr('data-lat'));
        const lng = parseFloat(mapTarget.data('lng'));
        const zoom = parseInt(mapTarget.data('zoom'));

        function initMap() {
            const styledMapType = new google.maps.StyledMapType(
                [
                    {
                        featureType: "administrative",
                        elementType: "labels.text.fill",
                        stylers: [{color: "#444444"}],
                    },
                    {
                        featureType: "administrative.country",
                        elementType: "all",
                        stylers: [
                            {
                                "visibility": "on"
                            }
                        ]
                    },
                    {
                        featureType: "administrative.country",
                        elementType: "geometry.stroke",
                        stylers: [
                            {
                                "weight": "0.40"
                            }
                        ]
                    },
                    {
                        featureType: "administrative.country",
                        elementType: "labels.text",
                        stylers: [
                            {
                                "visibility": "on"
                            },
                            {
                                "saturation": "-40"
                            }
                        ]
                    },
                    {
                        featureType: "administrative.country",
                        elementType: "labels.text.fill",
                        stylers: [
                            {
                                "color": "#333366"
                            }
                        ]
                    },
                    {
                        featureType: "administrative.country",
                        elementType: "labels.text.stroke",
                        stylers: [
                            {
                                "hue": "#ff0000"
                            },
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        featureType: "administrative.province",
                        elementType: "all",
                        stylers: [{visibility: "on"}],
                    },
                    {
                        featureType: "administrative.locality",
                        elementType: "all",
                        stylers: [{visibility: "on"}],
                    },
                    {
                        featureType: "administrative.neighborhood",
                        elementType: "all",
                        stylers: [{visibility: "on"}],
                    },
                    {
                        featureType: "administrative.land_parcel",
                        elementType: "all",
                        stylers: [{visibility: "on"}],
                    },
                    {
                        featureType: "landscape",
                        elementType: "all",
                        stylers: [{color: "#ffffff"}],
                    },
                    {
                        featureType: "landscape.man_made",
                        elementType: "all",
                        stylers: [{visibility: "on"}],
                    },
                    {
                        featureType: "landscape.natural",
                        elementType: "all",
                        stylers: [{visibility: "on"}],
                    },
                    {
                        featureType: "poi",
                        elementType: "all",
                        stylers: [{visibility: "off"}],
                    },
                    {
                        featureType: "road",
                        elementType: "all",
                        stylers: [{saturation: -100}, {lightness: 45}, {weight: "1.25"}, {visibility: "on"}],
                    },
                    {
                        featureType: "road.arterial",
                        elementType: "labels.icon",
                        stylers: [{visibility: "off"}],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "all",
                        stylers: [{visibility: "simplified"}],
                    },
                    {
                        featureType: "transit",
                        elementType: "all",
                        stylers: [{visibility: "off"}],
                    },
                    {
                        featureType: "transit.line",
                        elementType: "labels.text.fill",
                        stylers: [{color: "#8f7d77"}],
                    },
                    {
                        featureType: "water",
                        elementType: "all",
                        stylers: [{color: "#F2F2F2"}],
                    },
                ],
                {name: "Styled Map"}
            );

            map = new google.maps.Map(mapTarget[0], {
                center: {lat: lat, lng: lng},
                zoom: zoom || 8,
                disableDefaultUI: true,
            });

            //Associate the styled map with the MapTypeId and set it to display.
            map.mapTypes.set("styled_map", styledMapType);
            map.setMapTypeId("styled_map");

            new google.maps.Marker({
                position: {lat: lat, lng: lng},
                icon: "<?php echo get_template_directory_uri(); ?>/assets/images/icons/map-marker-gold-new.svg",
                map,
                title: "<?php echo $marker_location; ?>",
            });
        }

        window.initMap = initMap;

        initMap();

        $('#selectOwnership').on('change', function () {
            const sharePercentage = parseFloat($(this).val());
            const totalPrice = parseFloat($('#totalPrice').data('price'));
            const totalAnnualExpenses = parseFloat($('#totalAnnualExpenses').data('annual-expense'));
            const expensePerShare = (totalAnnualExpenses / 12) * sharePercentage;
            $('#expensePerShare').data('expense', Math.round(expensePerShare));
            $('#expensePerShare').text(addCommas(Math.round(expensePerShare)));
            const calculatedOwnership = sharePercentage * totalPrice;
//            const pricePerMonth = (sharePercentage * 8) * expensePerShare;
            $('#calculatedOwnership').text(addCommas(calculatedOwnership));
            $('#pricePerMonth').text(addCommas(Math.round(expensePerShare)));

            const ownership = $(this).find(':selected').text();

            $('#ownership').text(ownership);
            $('#upToNights').text(42 * parseFloat(ownership));
        });

        $(".gallery-carousel").owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            dots: false,
            items: 1,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>',
            ],
            responsive: {
                0: {
                    stagePadding: 0
                },
                600: {
                    stagePadding: 100
                },
                1000: {
                    stagePadding: 200
                }
            }
        });
        $('.destination-carousel').owlCarousel({
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
        $('.triple-item-carousel').owlCarousel({
            loop: true,
            margin: 16,
            nav: true,
            dots: false,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>',
            ],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: <?php echo $count_posts < 3 ? $count_posts : 3; ?>
                },
                1000: {
                    items: <?php echo $count_posts < 3 ? $count_posts : 3; ?>
                }
            }
        });
    });

</script>
