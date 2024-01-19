<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-MN9ZNNK');</script>
    <!-- End Google Tag Manager -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title(''); ?><?php if (wp_title('', false)) {
            echo ' : ';
        } ?><?php bloginfo('name'); ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>"/>

    <?php
    if (is_front_page()) { ?>
        <meta name="facebook-domain-verification" content="4qxptuhi7tjdbhhxv7rywmftmona6w"/>
    <?php } ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MN9ZNNK"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<header class="main-header">
    <div class="container">
        <nav class="main-nav">
            <?php the_custom_logo() ?>
            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
            <div class="navbar-toggler hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="mobile-navbar">
                <ul class="navbar">
                    <?php header_main_nav(); ?>
                </ul>

                <div class="social-links text-center">
                    <?php
                    $social_links = get_field('social_links', 'option');
                    foreach ($social_links as $link) { ?>
                        <a href="<?php echo $link['url']; ?>"><i class="fa fa-<?php echo $link['title']; ?>"></i></a>
                    <?php } ?>
                </div>
            </div>

        </nav>
    </div>
</header>
