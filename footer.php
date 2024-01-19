<?php
$footer_img = get_field('footer_logo', 'option');
$disclaimer_text = get_field('disclaimer_text', 'option');
$copyright_text = get_field('copyright_text', 'option');
$social_links = get_field('social_links', 'option');
?>

<footer class="section main-footer bg-dark">
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col">
                    <a class="logo" href="<?php echo site_url(); ?>">
                        <img src="<?php echo esc_url($footer_img['url']); ?>" alt="<?php echo esc_attr($footer_img['alt']); ?>"/>
                    </a>
                </div>
                <div class="col">
                    <?php
                    if (is_active_sidebar('footer-widget-1')) {
                        dynamic_sidebar('footer-widget-1');
                    }
                    ?>
                </div>
                <div class="col">
                    <?php
                    if (is_active_sidebar('footer-widget-2')) {
                        dynamic_sidebar('footer-widget-2');
                    }
                    ?>
                </div>
                <div class="col">
                    <div class="social-links">
                        <?php
                        foreach ($social_links as $link) {
                            ?>
                            <a href="<?php echo $link['url']; ?>"><i class="fa fa-<?php echo $link['title']; ?>"></i></a>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    if (is_active_sidebar('footer-widget-3')) {
                        dynamic_sidebar('footer-widget-3');
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div>
                <p><?php echo $disclaimer_text; ?></p>
            </div>
            <div>
                <p><?php echo $copyright_text; ?></p>
            </div>
        </div>
    </div>
</footer>

<div id="disclaimerModal" class="popup-modal">
    <div class="popup-modal-inner">
        <div class="popup-modal-main rounded">
            <div class="popup-modal-header">
                <button class="close"><i class="fa fa-times"></i></button>
                <h6 class="title">Request Legal Disclaimer</h6>
            </div>
            <div class="popup-modal-body ">
                <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/images/modal-img.jpg" alt="">
                <div class="modal-form contact-form">
                    <?php echo do_shortcode('[gravityform id="10" title="false" ajax="true"]'); ?>
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


<div id="StatementModal" class="popup-modal">
    <div class="popup-modal-inner">
        <div class="popup-modal-main rounded">
            <div class="popup-modal-header">
                <button class="close"><i class="fa fa-times"></i></button>
                <h6 class="title">Privacy Statement</h6>
            </div>
            <div class="popup-modal-body">
                <?php echo get_field('privacy_statement','option') ?>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>

<?php
if (is_page_template('templates/discover-page.php')) {
    ?>
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
    <?php
}
?>


</body>

</html>