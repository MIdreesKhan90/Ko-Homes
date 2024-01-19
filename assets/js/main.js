function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    const rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}


jQuery(document).ready(function ($) {

    $(document).on('click', '.scroll-to', function (event) {
        if (this.hash !== "") {
            event.preventDefault();
            const hash = this.hash;
            const offset = $(hash).offset().top - 93;
            $('html, body').animate({
                scrollTop: offset
            }, 800);
        } // End if
    });

    var clipboard = new ClipboardJS('.copy-to-clipboard');

    clipboard.on('success', function (e) {
        // console.info('Action:', e.action);
        // console.info('Text:', e.text);
        // console.info('Trigger:', e.trigger);
        $(e.trigger).find('.tooltip').addClass('active').find('.tooltip-body').text('This property link has been copied to your clipboard.');
        setTimeout(function () {
            $(e.trigger).find('.tooltip').removeClass('active').find('.tooltip-body').text('Copy to Clipboard.');
        }, 1000);

        e.clearSelection();
    });

    $('.copy-to-clipboard').on('click', function (e) {
        e.preventDefault();
    });


    $(".accordion .head").on("click", function () {
        $(this).parent(".accordion").toggleClass("active");
        $(this).parent(".accordion").find(".panel").slideToggle();
    });

    $(".dropdown .dd-btn").on("click", function (e) {
        e.preventDefault();
        $('.get-by-location').removeClass('active');
        kohomes.selected_location = '';
        $(this).parent(".dropdown").toggleClass("active");
        $(this).parent(".dropdown").find(".dropdown-body").fadeToggle();
    });

    $(document).mouseup(function (e) {
        const container = $(".dropdown");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.removeClass("active");
            container.find(".dropdown-body").fadeOut();
        }
    });


    $(".trigger-popup").on("click", function (e) {
        e.preventDefault();
        const target = $(this).attr("href");
        $("body").addClass("popup-active");
        $(target).fadeIn();
    });
    $(".popup-modal .close").on("click", function () {
        $(this).parents(".popup-modal").hide();
        $("body").removeClass("popup-active");
    });

    $(".popup-modal-inner").on("click", function (event) {
        if(event.target.classList.contains("popup-modal-inner")){
            $(this).parents(".popup-modal").hide();
            $("body").removeClass("popup-active");
        }
    });

    $(".trigger-popup > a").on("click", function (e) {
        e.preventDefault();
        // const target01 = $(this).attr("href");
        $("body").addClass("popup-active");
        $('#StatementModal').fadeIn();
    });
    $(".popup-modal .close").on("click", function () {
        $('#StatementModal').hide();
        $("body").removeClass("popup-active");
    });








    $('.navbar-toggler').click(function () {
        $(this).toggleClass('transform');
        $('.mobile-navbar').toggleClass('active');
    });

    const iconBoxTarget = $('.icon-box-carousel'),

        iconBoxCarouselOptions = {
            loop: true,
            margin: 10,
            nav: false,
            dots: true,
            items: 1,
            navText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>',
            ],
        };

    if ($(window).width() < 768) {
        const iconBoxCarousel = iconBoxTarget.owlCarousel(iconBoxCarouselOptions);
    } else {
        iconBoxTarget.addClass('off');
    }

    $(window).resize(function () {
        if ($(window).width() < 768) {
            if ($('.icon-box-carousel').hasClass('off')) {
                const iconBoxCarousel = iconBoxTarget.owlCarousel(iconBoxCarouselOptions);
                iconBoxTarget.removeClass('off');
            }
        } else {
            if (!$('.icon-box-carousel').hasClass('off')) {
                iconBoxTarget.addClass('off').trigger('destroy.owl.carousel');
                iconBoxTarget.find('.owl-stage-outer').children(':eq(0)').unwrap();
            }
        }
    });
    $('.menu-item-has-children > a').on('click', function (e) {
        if ($(window).width() < 768) {
            e.preventDefault();
            $(this).parent().find('.sub-menu').slideToggle();
        }
    });

    $('.scroll-to-top').on('click', function (e) {
        e.preventDefault();
        $(window).scrollTop(0);
    });

    $('#discoverLoadMore').click(function (e) {
        e.preventDefault();
        const button = $(this),
            data = {
                'action': 'loadMoreProperties',
                'page': kohomes.current_page
            };

        $.ajax({
            url: kohomes.ajaxurl,
            dataType: "html",
            data: data,
            type: 'POST',
            beforeSend: function (xhr) {
                button.text('Loading...');
            },
            success: function (data) {
                if (data) {
                    button.text('Load More');
                    $('#listingsContainer').append(data);
                    kohomes.current_page++;
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

                    if (kohomes.current_page == kohomes.max_page)
                        button.remove();
                } else {
                    button.remove();
                }
            }
        });
    });

    $('.get-by-location').click(function (e) {
        e.preventDefault();
        const button = $(this);
        const btnText = button.text();
        let slug = button.data('slug');

        if (button.hasClass('active')) {
            button.removeClass('active');
            slug = '';
        } else {
            $('.get-by-location').removeClass('active');
            button.addClass('active');
        }
        const data = {
            'action': 'getFilteredProperties',
            'page': 1,
            'filterCategory': slug,
        };
        kohomes.selected_location = button.data('slug');
        $.ajax({
            url: kohomes.ajaxurl,
            dataType: "html",
            data: data,
            type: 'POST',
            beforeSend: function (xhr) {
                button.text('Loading...');
            },
            success: function (data) {
                if (data) {
                    button.text(btnText);
                    $('#listingsContainer').html(data);
                    // kohomes.current_page++;
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
                }
            }
        });
    });

    function getPropertiesData() {
        const data = {
            'action': 'getPropertiesData',
            'page': 1
        };
        let filterLocations = '';
        $.ajax({
            url: kohomes.ajaxurl,
            dataType: "json",
            data: data,
            type: 'POST',
            beforeSend: function (xhr) {
            },
            success: function (data) {
                if (data) {
                    $.each(data.locations, function (i, item) {
                        filterLocations += `<div class="radio">
                                        <input type="radio" id="item${i}" name="filterLocations" value="${item}"/>
                                        <label for="item${i}">${item}</label></div>`;
                    });
                    $('#filterLocations').html(filterLocations);
                }
            }
        });
    }

    getPropertiesData();

    function getFilteredProperties(e) {
        const button = $(e.target);
        const btnText = button.text();

        // let filterLocations = [];
        // $('[name="filterLocations"]:checked').each(function() {
        //     filterLocations.push($(this).val());
        // });
        const filterLocations = $('[name="filterLocations"]:checked').val();
        const filterCategory = $('[name="filterCategory"]').val();
        const filterSorting = $('[name="filterSorting"]:checked').val();
        // const filterBeds = $('[name="filterBeds"]:checked').val();
        const data = {
            'action': 'getFilteredProperties',
            'page': 1,
            'filterCategory': filterCategory,
            'filterLocations': filterLocations,
            'filterSorting': filterSorting,
            // 'filterBeds': filterBeds,
        };

        $.ajax({
            url: kohomes.ajaxurl,
            dataType: "html",
            data: data,
            type: 'POST',
            beforeSend: function (xhr) {
                button.text('Filtering...');
            },
            success: function (data) {
                button.text(btnText);
                if (data) {
                    $('#listingsContainer').html(data);
                    // kohomes.current_page++;
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
                } else {
                    $('#listingsContainer').html('<p>No Data Found</p>');
                }
            }
        });
    }

    $('#getFilteredProperties').on('click', function (e) {
        e.preventDefault();
        getFilteredProperties(e);
    });

    $('#postsLoadMore').click(function (e) {
        e.preventDefault();
        const button = $(this),
            data = {
                'action': 'loadMorePosts',
                'page': kohomes.current_page
            };

        $.ajax({
            url: kohomes.ajaxurl,
            dataType: "html",
            data: data,
            type: 'POST',
            beforeSend: function (xhr) {
                button.text('Loading...');
            },
            success: function (data) {
                if (data) {
                    button.text('Load More');
                    $('#postsContainer').append(data);
                    kohomes.current_page++;
                    if (kohomes.current_page == kohomes.max_page)
                        button.remove();
                } else {
                    button.remove();
                }
            }
        });
    });

    $('.ginput_container_phone input[type="tel"]').intlTelInput({
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.0.3/js/utils.js",
        nationalMode: true,
    });
});

const mapStyleJson = [
    {
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#f5f5f5"
            }
        ]
    },
    {
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#616161"
            }
        ]
    },
    {
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "color": "#f5f5f5"
            }
        ]
    },
    {
        "featureType": "administrative.land_parcel",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#bdbdbd"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#eeeeee"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#757575"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#e5e5e5"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#9e9e9e"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#757575"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#dadada"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#616161"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#9e9e9e"
            }
        ]
    },
    {
        "featureType": "transit.line",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#e5e5e5"
            }
        ]
    },
    {
        "featureType": "transit.station",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#eeeeee"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#c9c9c9"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#9e9e9e"
            }
        ]
    }
];

