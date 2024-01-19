<?php

/*------------------------------------*\
	Functions
\*------------------------------------*/

add_theme_support('editor-styles');
add_theme_support('post-thumbnails');

function custom_logo_setup()
{

    $defaults = array(
        'height' => 41,
        'width' => 63,
        'flex-height' => true,
        'flex-width' => true,
        'header-text' => array('site-title', 'site-description'),
    );
    add_theme_support('custom-logo', $defaults);
}

function header_main_nav()
{
    wp_nav_menu(
        array(
            'theme_location' => 'header-menu',
            'container' => '',
            'menu_class' => '',
            'items_wrap' => '%3$s',
            'depth' => 2
        )
    );
}

function social_nav()
{
    wp_nav_menu(
        array(
            'theme_location' => 'social-menu',
            'container' => '',
            'menu_class' => '',
            'items_wrap' => '%3$s',
            'depth' => 1
        )
    );
}

function register_br_custom_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'kohomes'), // Main Navigation
        'social-menu' => __('Social Menu', 'kohomes'),
    ));
}


function custom_theme_styles()
{
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', false, '4.7.0', 'all');
    wp_enqueue_style('owlcarousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', false, '2.3.4', 'all');
    wp_enqueue_style('owltheme', get_template_directory_uri() . '/assets/css/owl.theme.default.min.css', false, '2.3.4', 'all');
    // wp_enqueue_style('intlTelInput', get_template_directory_uri() . '/assets/js/intel-phone-input-masking/css/intlTelInput.min.css', false, '1.0.0', 'all');
    wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css', false, time(), 'all');
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css', false, time(), 'all');
}

function custom_theme_scripts()
{
    wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery.2.1.4.min.js', array(), '2.1.4');
    wp_enqueue_script('owlcarousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), '2.3.4');
    wp_enqueue_script('clipboard', 'https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js', array(), '2.0.10');
    // wp_enqueue_script('intlTelInput', get_template_directory_uri() . '/assets/js/intel-phone-input-masking/js/intlTelInput-jquery.min.js', array(), '1.0.0');
    // wp_enqueue_script('inputMask', get_template_directory_uri() . '/assets/js/intel-phone-input-masking/js/jquery.inputmask.min.js', array(), '1.0.0');
    wp_register_script('script', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'clipboard'), time());

    wp_localize_script('script', 'kohomes', array(
        'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
        'current_page' => 1,
        'max_page' => -1,
        'selected_location' => ''
    ));

    wp_enqueue_script('script');


}

add_action('wp_enqueue_scripts', 'custom_theme_styles'); // Add Theme stylesheet
add_action('wp_enqueue_scripts', 'custom_theme_scripts'); // Add Theme Scripts

add_editor_style('assets/css/main.css');

function dashboard_icons_for_proeprty_edit_page() {
    if ( is_admin() ) {
        wp_enqueue_style('dashboard-icons', get_template_directory_uri() . '/assets/css/dashboard-icons.css', false, time(), 'all');
    }
}
add_action( 'admin_print_styles', 'dashboard_icons_for_proeprty_edit_page' );

function loadmore_ajax_handler()
{
    $currency = get_field('currency_symbol', 'option');
    $args = array(
        'post_type' => 'property',
        'posts_per_page' => 3,
        'post_status' => 'publish'
    );
    $args['paged'] = $_POST['page'] + 1;

    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $permalink = get_post_permalink();
            $gallery = get_field('gallery');
            $number_of_beds = get_field('number_of_beds');
            $number_of_baths = get_field('number_of_baths');
            $area = get_field('area');
            $area_unit = get_field('area_unit');
            $location = get_field('location');
            $total_price = get_field('total_price');
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
                        <h3><?php echo $currency . number_format($total_price); ?><span>/share</span></h3>
                        <div class="location">
                            <span><?php echo $location; ?></span>
                            <span>VIEW DETAILS</span>
                        </div>
                    </a>
                </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    endif;
    die();
}

add_action('wp_ajax_loadMoreProperties', 'loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadMoreProperties', 'loadmore_ajax_handler');

function getPropertiesData_ajax_handler()
{
    $locations = array();
    $args = array(
        'post_type' => 'property',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $location = get_field('google_map_location');
            if ($location) {
                array_push($locations, $location['country']);
            }
        endwhile;
        wp_reset_postdata();
    endif;
    wp_die(json_encode(array('locations' => array_unique($locations))));
}

add_action('wp_ajax_getPropertiesData', 'getPropertiesData_ajax_handler');
add_action('wp_ajax_nopriv_getPropertiesData', 'getPropertiesData_ajax_handler');

function getFilteredProperties_ajax_handler()
{
    $currency = get_field('currency_symbol', 'option');
    $filter_category = $_POST['filterCategory'];
    $filter_locations = $_POST['filterLocations'];
    $filter_sorting = $_POST['filterSorting'];
//    $filter_beds = $_POST['filterBeds'];

    $tax_query = array(
        'relation' => 'AND'
    );
    $meta_query = array(
        'relation' => 'AND'
    );
    $order_query = array();

    if ($filter_category) {
        array_push($tax_query, array(
            'taxonomy' => 'locations',
            'field' => 'slug',
            'terms' => $filter_category,
        ));
    }
    if ($filter_locations) {
        array_push($meta_query, array(
            'key' => 'google_map_location',
            'value' => '"' . $filter_locations . '"',
            'compare' => 'LIKE',
        ));
    }
    if ($filter_sorting) {
        $meta_query['price_query'] = array(
            'key' => 'total_price',
            'type' => 'numeric'
        );
        $meta_query['beds_query'] = array(
            'key' => 'number_of_beds',
            'type' => 'numeric'
        );
        $sort_options = explode("_",$filter_sorting);
        $order_query[$sort_options[0] . '_query'] = $sort_options[1];
    }
    $args = array(
        'post_type' => 'property',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'meta_query' => $meta_query,
        'orderby' => $order_query,
        'tax_query' => $tax_query
    );

    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
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
                    <a class="box-body" href="<?php echo $permalink; ?>">
                        <h6><?php the_title(); ?></h6>
                        <h3><?php echo $currency . number_format($total_price / $shares_availability); ?><span>/share</span></h3>
                        <div class="location">
                            <span><?php echo $location; ?></span>
                            <span>VIEW DETAILS</span>
                        </div>
                    </a>
                </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    endif;
    die();
}

add_action('wp_ajax_getFilteredProperties', 'getFilteredProperties_ajax_handler');
add_action('wp_ajax_nopriv_getFilteredProperties', 'getFilteredProperties_ajax_handler');


function posts_loadmore_ajax_handler()
{

    $args = array(
        'posts_per_page' => 3,
        'post_status' => 'publish',
    );
    $args['paged'] = $_POST['page'] + 1;
    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $post_categories = get_the_category();
            ?>
            <div class="row flex-center">
                <div class="col-6">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('full', array('class' => 'img-fluid rounded')); ?>
                    <?php else: ?>
                        <img src="https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159.jpg"
                             class="img-fluid rounded wp-post-image" alt="" loading="lazy"
                             srcset="https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159.jpg 1366w, https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159-300x74.jpg 300w, https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159-1024x253.jpg 1024w, https://ko-homes.stonedigital.dev/wp-content/uploads/2022/07/4c7cbaa7-9ae1-4ed2-8d2c-f71f220c2b44_shutterstock_2149843159-768x189.jpg 768w"
                             sizes="(max-width: 1366px) 100vw, 1366px" width="1366" height="337">
                    <?php endif; ?>
                </div>
                <div class="col-6">
                    <h4 class="section-pre-title"><span><?php echo get_the_date(); ?></span> . <span class="text-blue"><?php echo $post_categories[0]->cat_name; ?></span>
                    </h4>
                    <h2 class="section-title mb-40"><?php the_title(); ?></h2>
                    <p class="mb-40">
                        <?php
                        $excerpt = get_the_content();
                        echo excerpt_str($excerpt, 80);
                        ?>
                    </p>

                    <a href="<?php the_permalink(); ?>" class="link">READ ARTICLE</a>
                </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    endif;
    die();
}

add_action('wp_ajax_loadMorePosts', 'posts_loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadMzxorePosts', 'posts_loadmore_ajax_handler');


// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function br_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar')) {

    register_sidebar(array(
        'name' => 'Footer Widget 1',
        'id' => 'footer-widget-1',
        'description' => 'Appears in the footer area',
        'before_title' => '<h6 class="title">',
        'after_title' => '</h6>',
        'before_widget' => '<div id="%1$s" class="%2$s footer-widget">',
        'after_widget' => '</div>',
    ));
    register_sidebar(array(
        'name' => 'Footer Widget 2',
        'id' => 'footer-widget-2',
        'description' => 'Appears in the footer area',
        'before_title' => '<h6 class="title">',
        'after_title' => '</h6>',
        'before_widget' => '<div id="%1$s" class="%2$s footer-widget">',
        'after_widget' => '</div>',
    ));
    register_sidebar(array(
        'name' => 'Footer Widget 3',
        'id' => 'footer-widget-3',
        'description' => 'Appears in the footer area',
        'before_title' => '<h6 class="title">',
        'after_title' => '</h6>',
        'before_widget' => '<div id="%1$s" class="%2$s footer-widget">',
        'after_widget' => '</div>',
    ));
}

// Cut String to specific limit
function excerpt_str($str, $limit)
{
    $str = strip_tags($str);
    $finalStr = (strlen($str) > $limit) ? substr(substr($str, 0, $limit), 0, strrpos(substr($str, 0, $limit), ' ')) . ' ...' : $str;
    return $finalStr;
}

function add_br_in_excerpt($excerpt)
{
    if (is_admin()) {
        return $excerpt;
    }
    $excerpt = str_replace(array('.'), '.<br />', $excerpt);
    return $excerpt;
}

add_filter('get_the_excerpt', 'add_br_in_excerpt', 999);


function slugify($text, string $divider = '-')
{
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, $divider);

    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('after_setup_theme', 'custom_logo_setup');
add_action('init', 'register_br_custom_menu');


if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Theme Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Header',
        'menu_title' => 'Header',
        'parent_slug' => 'theme-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Footer',
        'menu_title' => 'Footer',
        'parent_slug' => 'theme-settings',
    ));
}

// Setting.
function my_acf_init()
{
    $google_map_api_key = get_field('google_map_api_key', 'option');
    acf_update_setting('google_api_key', $google_map_api_key);
}

add_action('acf/init', 'my_acf_init');


if (!function_exists('stone_digital_add_custom_upload_mimes')) {
    function stone_digital_add_custom_upload_mimes($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        $mimes['svg'] = 'image/svg';
        $mimes['otf'] = 'application/x-font-otf';
        $mimes['woff'] = 'application/x-font-woff';
        $mimes['woff2'] = 'application/x-font-woff2';
        $mimes['ttf'] = 'application/x-font-ttf';
        $mimes['eot'] = 'application/vnd.ms-fontobject';

        return $mimes;
    }

    add_filter('upload_mimes', 'stone_digital_add_custom_upload_mimes');
}
if (!function_exists('stone_digital_svg_thumb_display')) {
    function stone_digital_svg_thumb_display()
    {
        echo '<style>
    td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail { 
    width: 100% !important; 
    height: auto !important; 
    }
</style>';
    }

    add_action('admin_head', 'stone_digital_svg_thumb_display');
}
if (!function_exists('pr')) {
    function pr($data, $msg = null)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        if ($msg) {
            die($msg);
        }
    }
}

/*
Gutenberg Blocks
*/
require get_template_directory() . '/inc/gutenberg-blocks.php';

add_action('gform_pre_submission_3', 'form_3');
function form_3($form)
{
    $ip = $_POST['input_11'];
    $apiurl = 'http://ip-api.com/json/' . $ip;

    $jsondata = file_get_contents($apiurl);
    $jsondata = json_decode($jsondata);
    $country = $jsondata->country;
    $_POST['input_12'] = $country;
}

add_action('gform_pre_submission_5', 'form_5');
function form_5($form)
{
    $ip = $_POST['input_7'];
    $apiurl = 'http://ip-api.com/json/' . $ip;

    $jsondata = file_get_contents($apiurl);
    $jsondata = json_decode($jsondata);
    $country = $jsondata->country;
    $_POST['input_8'] = $country;
}

add_action('gform_pre_submission_4', 'form_4');
function form_4($form)
{
    $ip = $_POST['input_9'];
    $apiurl = 'http://ip-api.com/json/' . $ip;

    $jsondata = file_get_contents($apiurl);
    $jsondata = json_decode($jsondata);
    $country = $jsondata->country;
    $_POST['input_10'] = $country;
}

add_action('gform_pre_submission_2', 'form_2');
function form_2($form)
{
    $ip = $_POST['input_9'];
    $apiurl = 'http://ip-api.com/json/' . $ip;

    $jsondata = file_get_contents($apiurl);
    $jsondata = json_decode($jsondata);
    $country = $jsondata->country;
    $_POST['input_10'] = $country;
}

add_action('gform_pre_submission_8', 'form_8');
function form_8($form)
{
    $ip = $_POST['input_11'];
    $apiurl = 'http://ip-api.com/json/' . $ip;

    $jsondata = file_get_contents($apiurl);
    $jsondata = json_decode($jsondata);
    $country = $jsondata->country;
    $_POST['input_12'] = $country;
}

add_action('gform_pre_submission_7', 'form_7');
function form_7($form)
{
    $ip = $_POST['input_11'];
    $apiurl = 'http://ip-api.com/json/' . $ip;

    $jsondata = file_get_contents($apiurl);
    $jsondata = json_decode($jsondata);
    $country = $jsondata->country;
    $_POST['input_12'] = $country;
}

add_action('init', 'create_faq_custom_post_type');
function create_faq_custom_post_type(){
    $args = array(
        'labels' => array(
            'name' => 'FAQ',
            'singular_name' => 'FAQ',
            'add_new' => 'Add New FAQ',
            'add_new_item' => 'Add New FAQ',
            'edit_item' => 'Edit FAQ',
            'new_item' => 'New FAQ',
            'all_items' => 'All FAQs',
            'view_item' => 'View FAQ',
            'search_items' => 'Search FAQs',
            'not_found' =>  'No FAQs found',
            'not_found_in_trash' => 'No FAQ found in Trash',
            'menu_name' => 'FAQ'
        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => true,
        'menu_position' => null,
        'menu_icon'     => 'dashicons-book-alt',
        'supports' => array( 'title', 'editor', 'thumbnail', 'author' ),
        'rewrite' => array(
            'slug' => 'faq'
        )
    );
    register_post_type('faq-page', $args);
}