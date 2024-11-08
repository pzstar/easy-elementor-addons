odometerOptions = {auto: false};

(function ($, elementor) {
    'use strict';
    var EEA = {

        init: function () {

            var widgets = {
                'eead-accordion.default': EEA.accordionBlock,
                'eead-advanced-map.default': EEA.advancedMap,
                'eead-animated-heading.default': EEA.animatedHeading,
                'eead-business-hour.default': EEA.businessHours,
                'eead-circular-progressbar.default': EEA.circularProgressBar,
                'eead-countdown.default': EEA.countdown,
                'eead-counter.default': EEA.counterBlock,
                'eead-filterable-gallery.default': EEA.filterableGallery,
                'eead-horizontal-timeline.default': EEA.horizontalTimelineCarousel,
                'eead-hotspot.default': EEA.hotspotBlock,
                'eead-image-comparison.default': EEA.imageComparison,
                'eead-image-accordion.default': EEA.imageAccordion,
                'eead-image-gallery.default': EEA.imageGallery,
                'eead-pie-chart.default': EEA.pieChart,
                'eead-one-page-nav.default': EEA.onePageNav,
                'eead-lottie.default': EEA.Lottie,
                'eead-scroll-image.default': EEA.scrollImage,
                'eead-logo-carousel.default': EEA.logoCarousel,
                'eead-popup-modal.default': EEA.popupModal,
                'eead-progressbar.default': EEA.progressBar,
                'eead-toggle.default': EEA.toggleBlock,
                'eead-switcher.default': EEA.switcherBlock,
                'eead-popup-video.default': EEA.popupVideo,
                'eead-horizontal-tab.default': EEA.horizontalTabsBlock,
                'eead-vertical-tab.default': EEA.verticalTabsBlock,
                'eead-sticky-video.default': EEA.stickyVideo,
                'eead-video-player.default': EEA.videoPlayer,





                'eead-caption-hover-effect.default': EEA.captionHoverEffect,
                'eead-charts.default': EEA.chartsBlock,
                'eead-horizontal-scroll.default': EEA.horizontalScrollBlock,
                'eead-multi-scroll.default': EEA.multiScrollBlock,
                'eead-offcanvas-header.default': EEA.offcanvasHeader,
                'eead-portfolio.default': EEA.portfolioBlock,
                'eead-portfolio-grid.default': EEA.portfolioGrid,
                'eead-slider.default': EEA.sliderBlock,
                'eead-slinky-vertical-menu.default': EEA.slinkyVerticalMenuBlock,
                'eead-text-marquee.default': EEA.textMarquee,
                'eead-threesixty-image.default': EEA.threesixtyImage,
                'eead-threed-text.default': EEA.threedTextBlock,
                'eead-testimonial-slider.default': EEA.testimonialSlider,
                'eead-tilt-hover-image.default': EEA.tiltHoverImageBlock,
                'eead-team-member-carousel.default': EEA.teamMemberCarouselBlock,
                
                'eead-twitter-feed-carousel.default': EEA.twitterFeedCarousel,
            };

            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });

            elementor.hooks.addAction('frontend/element_ready/column', EEA.elementorColumn);

            if (elementorFrontend.isEditMode() == true) {
                elementor.hooks.addAction('panel/open_editor/widget/eead-sticky-video-block', function (panel, model, view) {
                    var interval;
                    model.attributes.settings.on('change:eead_sticky_width', function () {
                        clearTimeout(interval);
                        interval = setTimeout(function () {
                            var height = Math.ceil(model.getSetting('eead_sticky_width') / 1.78);
                            model.attributes.settings.attributes.eead_sticky_height = height;
                            panel.el.querySelector('[data-setting="eead_sticky_height"]').value = height;
                        }, 250);
                    });
                    model.attributes.settings.on('change:eead_sticky_height', function () {
                        clearTimeout(interval);
                        interval = setTimeout(function () {
                            var width = Math.ceil(model.getSetting('eead_sticky_height') * 1.78);
                            model.attributes.settings.attributes.eead_sticky_width = width;
                            panel.el.querySelector('[data-setting="eead_sticky_width"]').value = width;
                        }, 250);
                    });
                });
            }


        },

        accordionBlock: function ($scope) {
            var accordion = $scope.find('.eead-each-accordion');

            if (accordion.length > 0) {
                accordion.find('.eead-accordion-title').each(function () {
                    var eachTitle = $(this);
                    // On Accordion Click
                    eachTitle.on('click', function () {
                        if (!$(this).parent('.eead-each-accordion').hasClass('eead-open')) {
                            $(this).next('.eead-accordion-content').slideDown();
                            $(this).parent('.eead-each-accordion').addClass('eead-open');
                        } else {
                            $(this).next('.eead-accordion-content').slideUp();
                            $(this).parent('.eead-each-accordion').removeClass('eead-open');
                        }
                    });
                });
            }
        },

        advancedMap: function ($scope) {
            new_map($scope.find('.eead-gmap-markers'));

            function new_map($el) {
                var zoom = $el.data('zoom');
                var scrollwheel = $el.data('scrollwheel') ? true : false;
                var zoomControl = $el.data('zoomcontrol') ? true : false;
                var fullscreenControl = $el.data('fullscreencontrol') ? true : false;
                var streetViewControl = $el.data('streetviewcontrol') ? true : false;
                var mapTypeControl = $el.data('maptypecontrol') ? true : false;
                var gestureHandling = $el.data('gesturehandling') ? $el.data('gesturehandling') : null;
                var $markers = $el.find('.eead-gmap-marker');
                var styles = $el.data('style');
                var mapOption = {
                    zoom: zoom,
                    scrollwheel: scrollwheel,
                    zoomControl: zoomControl,
                    fullscreenControl: fullscreenControl,
                    streetViewControl: streetViewControl,
                    mapTypeControl: mapTypeControl,
                    center: new google.maps.LatLng(0, 0),
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    styles: styles
                };

                if (typeof gestureHandling !== 'undefined' && gestureHandling === 'none') {
                    mapOption['gestureHandling'] = 'none';
                }

                // Generate map
                var map = new google.maps.Map($el[0], mapOption);

                // add a markers reference
                map.markers = [];

                // add markers
                $markers.each(function () {
                    add_marker($(this), map);
                });

                // center map
                center_map(map, zoom);

                return map;
            }

            function add_marker($marker, map) {
                var animate = $marker.attr('data-animate');
                var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));
                var icon_img = $marker.attr('data-icon');

                if (icon_img != '') {
                    var icon = {
                        url: $marker.attr('data-icon'),
                        scaledSize: new google.maps.Size($marker.attr('data-icon-size'), $marker.attr('data-icon-size'))
                    };
                }

                // create marker
                var marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    icon: icon,
                    animation: google.maps.Animation.DROP,
                });

                if (animate == 'animate-yes' && $marker.data('info-window') != 'yes') {
                    marker.setAnimation(google.maps.Animation.BOUNCE);
                }

                if (animate == 'animate-yes') {
                    google.maps.event.addListener(marker, 'click', function () {
                        marker.setAnimation(null);
                    });
                }

                // add to array
                map.markers.push(marker);

                // if marker has html elements, add it to an infoWindow
                if ($marker.html()) {
                    // make info window
                    var infowindow = new google.maps.InfoWindow({
                        content: $marker.html()
                    });

                    // show info window when marker is clicked
                    if ($marker.data('info-window') == 'yes') {
                        infowindow.open(map, marker);
                    }
                    google.maps.event.addListener(marker, 'click', function () {
                        infowindow.open(map, marker);
                    });
                }

                if (animate == 'animate-yes') {
                    google.maps.event.addListener(infowindow, 'closeclick', function () {
                        marker.setAnimation(google.maps.Animation.BOUNCE);
                    });
                }
            }

            function center_map(map, zoom) {
                var bounds = new google.maps.LatLngBounds();

                // loop markers and create bounds
                $.each(map.markers, function (i, marker) {
                    var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                    bounds.extend(latlng);
                });

                // If only 1 marker exist
                if (map.markers.length == 1) {
                    map.setCenter(bounds.getCenter());
                    map.setZoom(zoom);
                } else {
                    map.fitBounds(bounds);
                }
            }
        },

        animatedHeading: function ($scope, $) {
            var $heading = $scope.find('.eead-ah-heading > *'),
                $animatedHeading = $scope.find('.eead-animated-heading'),
                $settings = $scope.find('.eead-animated-heading').data('settings');

            if (!$heading.length) {
                return;
            }

            if ($settings.layout === 'animated') {
                $($animatedHeading).Morphext($settings);
            } else if ($settings.layout === 'typed') {
                var animateSelector = $($animatedHeading).attr('id');
                new Typed('#' + animateSelector, $settings);
            }

            $($heading).animate({
                easing: 'slow',
                opacity: 1
            }, 500);
        },

        businessHours: function ($scope) {
            var $container = $scope.find('.eead-business-hour');
            if (!$container.length) {
                return;
            }

            var $settings = $container.data('settings');
            var timeNotation = $settings.timeNotation;
            var business_hour_style = $settings.business_hour_style;

            if (business_hour_style != 'dynamic')
                return;

            $(document).ready(function () {
                var offset_val;
                var timeFormat = '%H:%M:%S', timeZoneFormat;
                var dynamic_timezone = $settings.dynamic_timezone;

                if (business_hour_style == 'static') {
                    offset_val = $settings.dynamic_timezone_default;
                } else {
                    offset_val = dynamic_timezone;
                }

                if (timeNotation == '12h') {
                    timeFormat = '%I:%M:%S %p';
                }

                if (offset_val == '') {
                    return;
                }

                var options = {
                    format: timeFormat,
                    timeNotation: timeNotation, //'24h',
                    am_pm: true,
                    utc: true,
                    utc_offset: offset_val
                }
                $($container).find('.eead-bh-current-time').jclock(options);

            });
        },

        circularProgressBar: function ($scope) {
            var container = $scope.find('.eead-circular-progressbar');
            var percentage = container.attr('data-number');
            var radius = container.attr('data-radius');
            const circumference = 2 * Math.PI * radius;
            const dashOffset = circumference - (percentage / 100) * circumference;
            if ((container.length > 0)) {
                container.waypoint(function () {
                    setTimeout(function () {
                        container.find('circle:nth-child(2)').css({
                            'stroke-dashoffset': dashOffset
                        }, 1000);
                    }, 400);
                    this.destroy();
                }, {
                    offset: '90%',
                });
            }
        },

        countdown: function ($scope) {
            var $coundDown = $scope.find('.eead-countdown'),
                $expire_type = $coundDown.data('expire-type') !== '' ? $coundDown.data('expire-type') : '',
                $expiry_text = $coundDown.data('expiry-text') !== '' ? $coundDown.data('expiry-text') : '',
                $expiry_title = $coundDown.data('expiry-title') !== '' ? $coundDown.data('expiry-title') : '',
                $redirect_url = $coundDown.data('redirect-url') !== '' ? $coundDown.data('redirect-url') : '';

            $coundDown.find('.eead-countdown-items').countdown({
                end: function end() {
                    if ($expire_type == 'text') {
                        countDown.html('<div class="eead-countdown-finish-message"><h4 class="expiry-title">' + $expiry_title + '</h4>' + '<div class="eead-countdown-finish-text">' + $expiry_text + '</div></div>');
                    } else if ($expire_type === 'url') {
                        window.location.href = $redirect_url;
                    }
                }
            });
        },

        counterBlock: function ($scope) {
            var $ele = $scope.find('.eead-counter-box');
            var $odometer = $ele.find('.eead-odometer');
            var format = $odometer.data('comma') == 'yes' ? '(,ddd)' : 'd';
            $ele.waypoint(function () {
                var od = new Odometer({
                    el: $odometer[0],
                    format: format,
                    value: $odometer.data('start'),
                });
                setTimeout(function () {
                    od.render();
                    od.update($odometer.data('count'));
                }, 1000);
                this.destroy();
            }, {
                offset: '90%'
            });
        },

        filterableGallery: function ($scope) {
            var filterControls = $scope.find('.eead-fg-filter-dropdown').eq(0),
                filterTrigger = $scope.find('#eead-fg-filter-trigger'),
                form = $scope.find('.eead-fg-search-box'),
                input = $scope.find('#eead-fg-search-input'),
                searchRegex,
                buttonFilter,
                timer;

            if (form.length) {
                form.on('submit', function (e) {
                    e.preventDefault();
                });
            }

            filterTrigger.on('click', function () {
                filterControls.toggleClass('open-filters');
            });

            /*filterTrigger.on('blur', function () {
                filterControls.removeClass('open-filters');
            });*/

            if (elementorFrontend.isEditMode() == false) {
                var $gallery = $('.eead-filter-gallery-container', $scope),
                    $gallery_items = $scope.find('.eead-filter-gallery'),
                    $settings = $gallery.data('settings'),
                    fg_items = $gallery.data('gallery-items'),
                    $layout_mode = $settings.grid_style === 'masonry' ? 'masonry' : 'fitRows',
                    $gallery_enabled = $settings.gallery_enabled === 'yes' ? true : false,
                    $init_show_setting = $gallery.data('init-show'),
                    filterType = $settings.filter_type;
                fg_items.splice(0, $init_show_setting);

                // setup isotope
                var $isotope_gallery = $gallery.isotope({
                    itemSelector: '.eead-fg-item-list',
                    layoutMode: $layout_mode,
                    percentPosition: true,
                    stagger: 30,
                    transitionDuration: $settings.duration + 'ms',
                    filter: function filter() {
                        var $this = $(this);
                        var $result = searchRegex ? $this.text().match(searchRegex) : true;
                        if (buttonFilter === undefined) {
                            if (filterType == 'normal') {
                                buttonFilter = $scope.find('.eead-fg-filter ul li').first().data('filter');
                            } else {
                                buttonFilter = $scope.find('ul.eead-fg-filter-dropdown li').first().data('filter');
                            }
                        }
                        var buttonResult = buttonFilter ? $this.is(buttonFilter) : true;
                        return $result && buttonResult;
                    }
                });

                $isotope_gallery.addClass('eead-isotope-initialized');

                // Init Popup
                if ($gallery_enabled) {
                    lightGallery(document.getElementById($gallery_items.attr('id')), {
                        selector: '.eead-magnific-link',
                        thumbnail: false,
                    });
                } else {
                    lightGallery(document.getElementById($gallery_items.attr('id')), {
                        selector: '.eead-magnific-link',
                        thumbnail: false,
                        counter: false,
                        controls: false,
                        loop: false,
                        mousewheel: false
                    });
                }

                // filter
                $scope.on('click', '.eead-fg-filter-control', function () {
                    var $this = $(this);
                    buttonFilter = $(this).attr('data-filter');
                    var $spanText = $scope.find('#eead-fg-filter-trigger > span');
                    if ($spanText.length) {
                        $spanText.text($this.text());
                    }

                    var LoadMoreShow = $(this).attr('data-load-more-status'),
                        loadMore = $('.eead-fg-loadmore-btn', $scope);

                    //hide load more button if no item to show
                    if (LoadMoreShow == '1' || fg_items.length < 1) {
                        loadMore.hide();
                    } else {
                        loadMore.show();
                    }
                    $this.siblings().removeClass('eead-fg-active');
                    $this.addClass('eead-fg-active');
                    $isotope_gallery.isotope();
                });

                //quick search
                input.on('input', function () {
                    var $this = $(this);
                    clearTimeout(timer);
                    timer = setTimeout(function () {
                        searchRegex = new RegExp($this.val(), 'gi');
                        $isotope_gallery.isotope();
                    }, 600);
                });

                // layout gal, while images are loading
                $isotope_gallery.imagesLoaded().progress(function () {
                    $isotope_gallery.isotope('layout');
                });

                // layout gal, on click tabs
                $isotope_gallery.on('arrangeComplete', function () {
                    $isotope_gallery.isotope('layout');
                });

                // layout gal, after window loaded
                $(window).on('load', function () {
                    $isotope_gallery.isotope('layout');
                });

                // Load more button
                $scope.on('click', '.eead-fg-loadmore-btn', function (e) {
                    e.preventDefault();
                    var $this = $(this),
                        $images_per_page = $gallery.data('images-per-page'),
                        $nomore_text = $gallery.data('nomore-item-text'),
                        enable_filter = $('.eead-fg-filter', $scope).length,
                        $items = [];
                    var filter_name = $('.eead-fg-filter li.eead-fg-active', $scope).data('filter');

                    if (filterControls.length > 0) {
                        filter_name = $('.eead-fg-filter-dropdown li.eead-fg-active', $scope).data('filter');
                    }

                    let item_found = 0;
                    let index_list = []
                    for (const [index, item] of fg_items.entries()) {
                        if (filter_name !== '' && filter_name !== '*' && enable_filter) {
                            let element = $($(item)[0]);
                            if (element.is(filter_name)) {
                                ++item_found;
                                $items.push($(item)[0]);
                                index_list.push(index);
                            }

                            if ((fg_items.length - 1) === index) {
                                $('.eead-fg-filter li.eead-fg-active', $scope).attr('data-load-more-status', 1)
                                $this.hide()
                            }
                        } else {
                            ++item_found;
                            $items.push($(item)[0]);
                            index_list.push(index);
                        }

                        if (item_found === $images_per_page) {
                            break;
                        }
                    }

                    if (index_list.length > 0) {
                        fg_items = fg_items.filter(function (item, index) {
                            return !index_list.includes(index);
                        });
                    }

                    if (fg_items.length < 1) {
                        $this.html($nomore_text);
                        setTimeout(function () {
                            $this.fadeOut();
                        }, 600);
                    }

                    // append items
                    $gallery.append($items);
                    $isotope_gallery.isotope('insert', $items);
                    $isotope_gallery.imagesLoaded().progress(function () {
                        $isotope_gallery.isotope('layout');
                    });
                });

                // Safari: hide filter menu
                $(document).on('mouseup', function (e) {
                    if (!filterTrigger.is(e.target) && filterTrigger.has(e.target).length === 0) {
                        filterControls.removeClass('open-filters');
                    }
                });
            }
        },

        horizontalTabsBlock: function ($scope) {
            $scope.find('.eead-horizontal-tab').on('click', '.eead-ht-tab', function () {
                var $tab_id = $(this).data('tabid');
                if ($tab_id) {
                    $scope.find('.eead-ht-tab').removeClass('eead-ht-active-tab');
                    $(this).addClass('eead-ht-active-tab');

                    $scope.find('.eead-ht-content').removeClass('eead-ht-active-content');
                    $scope.find('.eead-ht-content-' + $tab_id).addClass('eead-ht-active-content');
                }
            });
        },

        verticalTabsBlock: function ($scope) {
            $scope.find('.eead-vertical-tab').on('click', '.eead-ht-tab', function () {
                var $tab_id = $(this).data('tabid');
                if ($tab_id) {
                    $scope.find('.eead-ht-tab').removeClass('eead-ht-active-tab');
                    $(this).addClass('eead-ht-active-tab');

                    $scope.find('.eead-ht-content').removeClass('eead-ht-active-content');
                    $scope.find('.eead-ht-content-' + $tab_id).addClass('eead-ht-active-content');
                }
            });
        },

        horizontalTimelineCarousel: function ($scope) {
            $scope.find('.eead-horizontal-timeline-scrollbar').mCustomScrollbar({
                theme: 'dark',
                scrollInertia: 500,
                axis: 'x',
                advanced: {autoExpandHorizontalScroll: true}
            });
        },

        hotspotBlock: function ($scope) {
            $scope.find('.eead-open-onclick .eead-hotspot-item > a').on('click', function (e) {
                e.preventDefault();
                $(this).parent('.eead-hotspot-item').toggleClass('eead-active');
            });
        },

        imageComparison: function ($scope) {
            var $image_compare = $scope.find('.eead-image-compare');
            var $settings = $image_compare.data('settings');
            var options = {
                // UI Theme Defaults
                addCircle: $settings.add_circle,
                controlShadow: $settings.add_circle_shadow,
                addCircleBlur: $settings.add_circle_blur,
                controlColor: $settings.bar_color,

                // Label Defaults
                showLabels: $settings.show_before_after_label,
                labelOptions: {
                    onHover: $settings.show_before_after_label_onhover,
                    before: $settings.before_label,
                    after: $settings.after_label
                },

                // Smoothing
                smoothing: $settings.smoothing,
                smoothingAmount: $settings.smoothing_amount,

                // Other options
                hoverStart: $settings.move_slider_on_hover,
                verticalMode: $settings.orientation,
                startingPoint: $settings.starting_point,
                fluidMode: false
            };

            new ImageCompare(document.querySelector('#' + $settings.id), options).mount();
        },

        imageAccordion: function ($scope) {
            var $accordionContainer = $scope.find('.eead-image-accordion-on-click');

            if ($accordionContainer.length > 0) {
                var $accordion = $scope.find('.eead-image-accordion-item');
                $accordion.on('click', function (e) {
                    e.preventDefault();
                    var $this = $(this);
                    if ($this.hasClass('eead-tab-active')) {
                        return;
                    }

                    $accordion.removeClass('eead-tab-active');
                    $this.addClass('eead-tab-active');
                });
            } else {
                $scope.find('.eead-image-accordion-on-hover').mouseenter(function () {
                    $(this).find('.eead-image-accordion-item.eead-tab-active').removeClass('eead-tab-active').addClass('eead-trigger');
                });

                $scope.find('.eead-image-accordion-on-hover').mouseleave(function () {
                    $(this).find('.eead-image-accordion-item.eead-trigger').addClass('eead-tab-active').removeClass('eead-trigger');
                });
            }
        },

        imageGallery: function ($scope, $) {
            if (elementorFrontend.isEditMode() == false) {
                var $gallery_container = $scope.find('.eead-image-gallery-container');
                var $gallery = $scope.find('.eead-ig-wrap');
                var $settings = $gallery_container.data('settings');

                if ($settings.layout == 'masonry' || $settings.layout == 'grid') {
                    var layout = $settings.layout == 'grid' ? 'fitRows' : 'masonry';
                    var filterValue = $gallery_container.find('.eead-ig-filter-list .eead-ig-filter').first().data('filter');

                    var $isotope_gallery = $gallery.isotope({
                        itemSelector: '.eead-ig-item-box',
                        layoutMode: layout,
                        percentPosition: true,
                        stagger: 30,
                        transitionDuration: $settings.duration + 'ms',
                        filter: filterValue
                    });

                    $gallery_container.on('click', '.eead-ig-filter', function () {
                        var $this = $(this),
                            filterValue = $this.attr('data-filter');

                        $this.siblings().removeClass('eead-ig-active');
                        $this.addClass('eead-ig-active');
                        $isotope_gallery.isotope({filter: filterValue});
                    });

                    $gallery_container.addClass('eead-isotope-initialized');

                    // Init Popup
                    lightGallery(document.getElementById($gallery_container.attr('id')), {
                        selector: '.eead-ig-lightbox',
                        thumbnail: false,
                    });
                }
            }
        },

        pieChart: function ($scope) {
            var $container = $scope.find('.eead-pie-chart-container'),
                $canvas = $scope.find('.eead-pie-chart'),
                data = $container.data('chart') || {},
                options = $container.data('options') || {};
            console.log(options);
            new Chart($canvas, {
                type: 'pie',
                data: data,
                options: {
                    cutout: options.cutoutPercentage,
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: options.tooltips,
                        legend: options.legend
                    },
                    animation: options.animation
                }
            });

        },

        onePageNav: function ($scope) {
            var nav_el = $scope.find('.eead-one-page-nav');
            var $section_id = '#' + nav_el.data('section-id'),
                $top_offset = nav_el.data('top-offset'),
                $scroll_speed = nav_el.data('scroll-speed'),
                $scroll_wheel = nav_el.data('scroll-wheel'),
                $scroll_touch = nav_el.data('scroll-touch'),
                $scroll_keys = nav_el.data('scroll-keys'),
                $target_dot = $section_id + ' .eead-one-page-nav-item a',
                $active_item = $section_id + ' .eead-one-page-nav-item.active';

            $($target_dot).on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                if ($('#' + $(this).data('row-id')).length === 0) {
                    return;
                }
                if ($('html, body').is(':animated')) {
                    return;
                }

                $('html, body').animate({
                    scrollTop: $('#' + $(this).data('row-id')).offset().top - $top_offset
                }, $scroll_speed);

                $($section_id + ' .eead-one-page-nav-item').removeClass('active');
                $(this).parent().addClass('active');
                return false;
            });

            updateDot();

            $(window).on('scroll', function () {
                updateDot();
            });

            function updateDot() {
                $('.elementor-element').each(function () {
                    var $this = $(this);
                    if (($this.offset().top - $(window).height() / 2 < $(window).scrollTop()) && ($this.offset().top >= $(window).scrollTop() || $this.offset().top + $this.height() - $(window).height() / 2 > $(window).scrollTop())) {
                        $($section_id + ' .eead-one-page-nav-item a[data-row-id="' + $this.attr('id') + '"]').parent().addClass('active');
                    } else {
                        $($section_id + ' .eead-one-page-nav-item a[data-row-id="' + $this.attr('id') + '"]').parent().removeClass('active');
                    }
                });
            }

            // When Mouse Wheel Scrolled
            if ($scroll_wheel === 'on') {
                var lastAnimation = 0,
                    quietPeriod = 500,
                    animationTime = 800,
                    startX,
                    startY,
                    timestamp;

                $(document).on('mousewheel DOMMouseScroll', function (e) {
                    var timeNow = new Date().getTime();
                    if (timeNow - lastAnimation < quietPeriod + animationTime) {
                        return;
                    }

                    var delta = e.originalEvent.detail < 0 || e.originalEvent.wheelDelta > 0 ? 1 : -1;
                    if (!$('html,body').is(':animated')) {
                        if (delta < 0) {
                            if ($($active_item).next().length > 0) {
                                $($active_item).next().find('a').trigger('click');
                            }
                        } else {
                            if ($($active_item).prev().length > 0) {
                                $($active_item).prev().find('a').trigger('click');
                            }
                        }
                    }
                    lastAnimation = timeNow;
                });

                // When Screen Touch swiped
                if ($scroll_touch === 'on') {
                    $(document).on('pointerdown touchstart', function (e) {
                        var touches = e.originalEvent.touches;
                        if (touches && touches.length) {
                            startY = touches[0].screenY;
                            timestamp = e.originalEvent.timeStamp;
                        }
                    }).on('touchmove', function (e) {
                        if ($('html,body').is(':animated')) {
                            e.preventDefault();
                        }
                    }).on('pointerup touchend', function (e) {
                        var touches = e.originalEvent;
                        if (touches.pointerType === 'touch' || e.type === 'touchend') {
                            var Y = touches.screenY || touches.changedTouches[0].screenY;
                            var deltaY = startY - Y;
                            var time = touches.timeStamp - timestamp;
                            // screen swipe up.
                            if (deltaY < 0) {
                                if ($($active_item).prev().length > 0) {
                                    $($active_item).prev().find('a').trigger('click');
                                }
                            }
                            // screen swipe down.
                            if (deltaY > 0) {
                                if ($($active_item).next().length > 0) {
                                    $($active_item).next().find('a').trigger('click');
                                }
                            }
                            if (Math.abs(deltaY) < 2) {
                                return;
                            }
                        }
                    });
                }
            }

            // Key Press Scroll
            if ($scroll_keys === 'on') {
                $(document).keydown(function (e) {
                    var tag = e.target.tagName.toLowerCase();
                    if (tag === 'input' && tag === 'textarea') {
                        return;
                    }
                    switch (e.which) {
                        case 38:
                            $($active_item).prev().find('a').trigger('click');
                            break;
                        case 40:
                            $($active_item).next().find('a').trigger('click');
                            break;
                        case 33:
                            $($active_item).prev().find('a').trigger('click');
                            break;
                        case 36:
                            $($active_item).next().find('a').trigger('click');
                            break;
                        default:
                            return;
                    }
                });
            }
        },

        Lottie: function ($scope) {
            var $container = $scope.find('.eead-lottie'),
                id = $container.attr('id'),
                settings = JSON.parse($container.attr('data-settings')),
                action = settings.autoplay ? settings.action : settings.action_alt;

            let animation = lottie.loadAnimation({
                container: document.getElementById(id),
                renderer: settings.renderer,
                autoplay: settings.autoplay,
                path: settings.path,
                loop: true,
            });

            animation.setDirection(settings.reverse);
            animation.setSpeed(settings.speed);

            switch (action) {
                case 'play':
                    $container.on('mouseenter', function () {
                        animation.play();
                    });
                    $container.on('mouseleave', function () {
                        animation.pause();
                    });
                    break;
                case 'pause':
                    $container.on('mouseenter', function () {
                        animation.pause();
                    });
                    $container.on('mouseleave', function () {
                        animation.play();
                    });
                    break;
                case 'reverse':
                    var direction = settings.reverse == '1' ? '-1' : '1';
                    $container.on('mouseenter', function () {
                        animation.pause();
                        setTimeout(function () {
                            animation.setDirection(direction);
                            animation.play();
                        }, 200);
                    });
                    $container.on('mouseleave', function () {
                        animation.pause();
                        setTimeout(function () {
                            animation.setDirection(settings.reverse);
                            animation.play();
                        }, 200);
                    });
                    break;
            }

        },

        scrollImage: function ($scope) {
            var $container = $scope.find('.eead-scroll-image-container');

            lightGallery(document.getElementById($container.attr('id')), {
                selector: '.eead-scroll-image-modal',
                counter: false,
                iframeMaxWidth: '80%',
            });
        },

        logoCarousel: function ($scope) {
            var $ele = $scope.find('.eead-logo-carousel');
            if ($ele.length > 0) {
                var params = JSON.parse($ele.attr('data-params'));
                $ele.owlCarousel({
                    loop: JSON.parse(params.loop),
                    autoplay: JSON.parse(params.autoplay),
                    autoplayTimeout: params.pause,
                    autoplayHoverPause: JSON.parse(params.pause_on_hover),
                    nav: JSON.parse(params.arrows),
                    dots: JSON.parse(params.dots),
                    autoHeight: JSON.parse(params.auto_height),
                    center: JSON.parse(params.focus_center_logo),
                    navText: ['<i class="' + params.prev_icon + '">', '<i class="' + params.next_icon + '">'],
                    responsive: {
                        0: {
                            items: params.items_mobile,
                            margin: params.margin_mobile,
                            stagePadding: params.stagepadding_mobile
                        },
                        480: {
                            items: params.items_tablet,
                            margin: params.margin_tablet,
                            stagePadding: params.stagepadding_tablet
                        },
                        769: {
                            items: params.items,
                            margin: params.margin,
                            stagePadding: params.stagepadding
                        }
                    }
                });
            }
        },

        popupModal: function ($scope) {
            var $open = $scope.find('.eead-popup-modal-trigger-btn');
            $open.on('click', function () {
                var $id = $(this).data('id');
                MicroModal.show('eead-popup-modal-' + $id, {
                    awaitOpenAnimation: true,
                    awaitCloseAnimation: true,
                    openClass: 'eead-open-modal',
                    disableScroll: true,
                    onShow: (modal) => {
                    },
                    onClose: (modal) => {
                    }
                })
            });
        },

        popupVideo: function ($scope) {
            var $video = $scope.find('.eead-video-popup-button');
            var video_id = $video.attr('id');
            var video_type = $video.attr('data-video-type');
            var video_width = $video.attr('data-video-width');
            if (video_type == 'custom') {
                lightGallery(document.getElementById(video_id), {
                    selector: 'this',
                    counter: false
                });
            } else {
                var settings = JSON.parse($video.attr('data-settings'));
                lightGallery(document.getElementById(video_id), {
                    selector: 'this',
                    counter: false,
                    videoMaxWidth: video_width,
                    youtubePlayerParams: {
                        autoplay: settings.autoplay,
                        controls: settings.controls,
                        mute: settings.mute,
                        start: settings.start,
                        end: settings.end,
                        loop: settings.loop,
                        modestbranding: 0,
                        rel: 0
                    },
                    vimeoPlayerParams: {
                        autoplay: settings.autoplay,
                        loop: settings.loop,
                        title: settings.title,
                        byline: settings.byline,
                        portrait: settings.portrait,
                        muted: settings.mute
                    }
                });
            }
        },

        progressBar: function ($scope) {
            var $el = $scope.find('.eead-progressbar');
            if (($el.length > 0)) {
                $el.each(function (index) {
                    var $this = $(this);
                    var delay_time = parseInt(index * 100 + 300);
                    $this.waypoint(function () {
                        setTimeout(function () {
                            $this.find('.eead-progressbar-length').animate({
                                width: $this.attr('data-width') + '%'
                            }, 1000, function () {
                                $this.find('span').animate({
                                    opacity: 1
                                }, 500);
                            });
                        }, delay_time);
                        this.destroy();
                    }, {
                        offset: '90%',
                    });
                });
            }
        },

        toggleBlock: function ($scope, $) {
            var $container = $scope.find('.eead-toggle-container'),
                $toggle_switch = $container.find('.eead-toggle-switch-checkbox'),
                $label_primary = $container.find('.eead-toggle-label-primary'),
                $label_secondary = $container.find('.eead-toggle-label-secondary');

            $toggle_switch.on('click', function () {
                $container.toggleClass('eead-switch-on');
                if ($(this).prop('checked')) {
                    $toggle_switch.prop('checked', true);
                } else {
                    $toggle_switch.prop('checked', false);
                }
            });

            $label_primary.on('click', function () {
                $container.removeClass('eead-switch-on');
                $toggle_switch.prop('checked', false);
            });

            $label_secondary.on('click', function () {
                $container.addClass('eead-switch-on');
                $toggle_switch.prop('checked', true);
            });
        },

        switcherBlock: function ($scope) {
            $scope.find('.eead-switcher-slider').css({
                'width': $('.eead-switcher-active-tab').outerWidth() + 'px',
                'left': $('.eead-switcher-active-tab').position().left + 'px'
            });

            $('.eead-switcher-tab').on('click', function () {
                if ($(this).hasClass('eead-switcher-active-tab')) {
                    return;
                }

                $scope.find('.eead-switcher-slider').css({
                    'width': $(this).outerWidth() + 'px',
                    'left': $(this).position().left + 'px'
                });

                $scope.find('.eead-switcher-tab').removeClass('eead-switcher-active-tab');
                $scope.find('.eead-switcher-content').removeClass('eead-switcher-active-content');

                $(this).addClass('eead-switcher-active-tab');
                var clickedTabId = $(this).attr('data-switchid');
                $scope.find('.eead-switcher-content-' + clickedTabId).addClass('eead-switcher-active-content');
            });
        },

        stickyVideo: function ($scope) {
            var stickyVideo = $scope.find('.eead-sticky-video');
            var videoContainer = $scope.find('.eead-sticky-video-container');
            var overlayContainer = $scope.find('.eead-overlay');
            var sticky = stickyVideo.data('sticky');
            var overlay = stickyVideo.data('overlay') ? stickyVideo.data('overlay') : '';
            var autoplay = JSON.parse(stickyVideo.data('autoplay'));
            var videoIsActive = 'off';

            var player = new Plyr('#eead-player-' + $scope.data('id'), {
                autoplay: JSON.parse(stickyVideo.data('autoplay')),
                muted: JSON.parse(stickyVideo.data('mute')),
                loop: {active: JSON.parse(stickyVideo.data('loop'))}
            });

            player.on('pause', function (event) {
                videoIsActive = 'off';
            });

            player.on('play', function (event) {
                videoIsActive = 'on';
            });

            $('.eead-sticky-player-close').on('click', function () {
                stickyVideo.removeClass('out').addClass('in');
                player.pause();
                videoIsActive = 'off';
            });

            if (overlay === 'yes' && autoplay) {
                player.play();
                overlayContainer.hide();
                videoIsActive = 'on';
            } else if (overlay === 'yes') {
                overlayContainer.on('click', function () {
                    player.play();
                    overlayContainer.hide();
                    videoIsActive = 'on';
                });
            }

            if (sticky == 'yes') {
                setTimeout(function () {
                    videoContainer.css('height', stickyVideo.height() + 'px');
                    var stickyPoint = videoContainer.offset().top + videoContainer.height();
                    stickyVideo.attr('data-sticky-point', stickyPoint);
                }, 1000);

                $(window).resize(function () {
                    videoContainer.css('height', stickyVideo.height() + 'px');
                    var stickyPoint = videoContainer.offset().top + videoContainer.height();
                    stickyVideo.attr('data-sticky-point', stickyPoint);
                });

                $(window).scroll(function () {
                    var scrollTop = $(window).scrollTop();
                    var stickyPoint = stickyVideo.attr('data-sticky-point');

                    var scrollBottom = $(document).height() - scrollTop;

                    if (scrollBottom > jQuery(window).height() + 400) {
                        if (scrollTop > stickyPoint) {
                            if (videoIsActive == 'on') {
                                stickyVideo.removeClass('in').addClass('out');
                            }
                        } else {
                            stickyVideo.removeClass('out').addClass('in');
                        }
                    }
                });
            }
        },

        videoPlayer: function ($scope) {
            var video = $scope.find('.eead-video-player'),
                videoPlayer = $scope.find('.eead-html-video-player'),
                overlay = $scope.find('.eead-video-overlay'),
                iframe = $scope.find('.eead-video-iframe'),
                hasOverlay = overlay.length > 0,
                settings = video.data('settings') || {},
                autoplay = settings.autoplay || false;

            if (overlay[0]) {
                overlay.on('click.eead-video-player', function (event) {
                    if (videoPlayer[0]) {
                        videoPlayer[0].play();
                        overlay.remove();
                        hasOverlay = false;
                        return;
                    }

                    if (iframe[0]) {
                        playIframeVideo();
                    }
                });
            }

            if (autoplay && iframe[0] && overlay[0]) {
                playIframeVideo();
            }

            if (videoPlayer[0]) {
                videoPlayer.on('play.eead-video-player', function (event) {
                    if (hasOverlay) {
                        overlay.remove();
                        hasOverlay = false;
                    }
                });
            }

            function playIframeVideo() {
                var lazyLoad = iframe.data('lazy-load');
                if (lazyLoad) {
                    iframe.attr('src', lazyLoad);
                }
                if (!autoplay) {
                    iframe[0].src = iframe[0].src.replace('&autoplay=0', '&autoplay=1');
                }
                overlay.remove();
                hasOverlay = false;
            }
        },






























        offcanvasHeader: function ($scope) {
            var t = $scope.find('.ekit-sidebar-group');
            $scope.find('.ekit_offcanvas-sidebar, .ekit_close-side-widget, .ekit-overlay').on('click', function (e) {
                e.preventDefault();
                t.toggleClass('ekit_isActive');
            });
        },

        threesixtyImage: function ($scope) {
            var circlr_el = $scope.find('.eead-threesixty-rotation-inner');
            var cls = circlr_el.data('selector');
            var autoplay = circlr_el.data('autoplay');
            var magnify_glass = $scope.find('.eead-threesixty-rotation-magnify');
            var image = $scope.find('.eead-threesixty-rotation-img');
            var zoom = magnify_glass.data('zoom');
            var play_btn = $scope.find('.eead-threesixty-rotation-play');
            var crl = circlr(cls, {play: true});

            if (autoplay === 'on') {
                var autoplay_btn = $scope.find('.eead-threesixty-rotation-autoplay');
                setTimeout(function () {
                    crl.play();
                    image.remove();
                    autoplay_btn.remove();
                }, 1000);
            } else {
                play_btn.on('click', function (el) {
                    el.preventDefault();
                    var $this = $(this);
                    var $play_btn_icon = $this.find('i');
                    if ($play_btn_icon.hasClass('fa fa-play')) {
                        $play_btn_icon.removeClass('fa fa-play');
                        $play_btn_icon.addClass('fa fa-stop');
                        crl.play();
                    } else {
                        $play_btn_icon.removeClass('fa fa-stop');
                        $play_btn_icon.addClass('fa fa-play');
                        crl.stop();
                    }
                    image.remove();
                });
            }

            magnify_glass.on('click', function (el) {
                var img_block = $scope.find('img');
                img_block.each(function () {
                    var style = $(this).attr('style');
                    if (style.indexOf('block') !== -1) {
                        SimpleMagnify(jQuery(this)[0], zoom);
                        magnify_glass.css('display', 'none');
                        image.remove();
                    }
                });
            });

            $(document).on('click', function (e) {
                var targetEl = $(e.target);
                var magnifier = $scope.find('.eead-img-magnifier-glass');
                var iconElem = magnify_glass.find('i');
                if (magnifier.length && targetEl[0] !== iconElem[0]) {
                    magnifier.remove();
                    magnify_glass.removeAttr('style');
                }
                if (targetEl[0] === circlr_el[0]) {
                    image.remove();
                }
            });

            circlr_el.on('mouseup mousedown', function (e) {
                image.remove();
            });
        },

        twitterFeedCarousel: function ($scope, $) {
            var $ele = $scope.find('.eead-twitter-feed-carousel-slides');
            if ($ele.length > 0) {
                var params = JSON.parse($ele.attr('data-params'));
                $ele.owlCarousel({
                    loop: JSON.parse(params.loop),
                    autoplay: JSON.parse(params.autoplay),
                    autoplaySpeed: params.speed,
                    autoplayTimeout: params.pause,
                    autoplayHoverPause: JSON.parse(params.pause_on_hover),
                    nav: JSON.parse(params.arrows),
                    dots: JSON.parse(params.dots),
                    autoHeight: JSON.parse(params.auto_height),
                    center: JSON.parse(params.center_image_bigger),
                    responsive: {
                        0: {
                            items: params.items_mobile,
                            margin: params.margin_mobile,
                            stagePadding: params.stagepadding_mobile
                        },
                        480: {
                            items: params.items_tablet,
                            margin: params.margin_tablet,
                            stagePadding: params.stagepadding_tablet
                        },
                        769: {
                            items: params.items,
                            margin: params.margin,
                            stagePadding: params.stagepadding
                        }
                    }
                });
            }
        },

        sliderBlock: function ($scope) {
            var $ele = $scope.find('.eead-slider');
            if ($ele.find('.eead-slide').length > 0) {
                var params = JSON.parse($ele.attr('data-params'));
                var sliderObj = {
                    items: 1,
                    mouseDrag: false,
                    smartSpeed: 600,
                    loop: JSON.parse(params.loop),
                    autoplay: JSON.parse(params.autoplay),
                    autoplaySpeed: params.speed,
                    autoplayTimeout: params.pause,
                    autoplayHoverPause: JSON.parse(params.pause_on_hover),
                    nav: JSON.parse(params.arrows),
                    dots: JSON.parse(params.dots),
                    autoHeight: JSON.parse(params.auto_height),
                    responsiveClass: true
                };

                if ($('.eead-slider').attr('data-transition') == 'fade') {
                    sliderObj.animateOut = 'fadeOut';
                }
                $('.eead-slider').owlCarousel(sliderObj);
            }
        },

        testimonialSlider: function ($scope) {
            var $ele = $scope.find('.eead-testimonial-block');
            if ($ele.find('.eead-testimonial-all-slides').length > 0) {
                var params = JSON.parse($ele.find('.eead-testimonial-all-slides').attr('data-params'));
                $ele.find('.eead-testimonial-all-slides').owlCarousel({
                    loop: JSON.parse(params.loop),
                    autoplay: JSON.parse(params.autoplay),
                    autoplaySpeed: params.speed,
                    autoplayTimeout: params.pause,
                    autoplayHoverPause: JSON.parse(params.pause_on_hover),
                    nav: JSON.parse(params.arrows),
                    dots: JSON.parse(params.dots),
                    autoHeight: JSON.parse(params.auto_height),
                    responsive: {
                        0: {
                            items: params.items_mobile,
                            margin: params.margin_mobile
                        },
                        480: {
                            items: params.items_tablet,
                            margin: params.margin_tablet
                        },
                        769: {
                            items: params.items,
                            margin: params.margin
                        }
                    }
                });
            }
        },

        teamMemberCarouselBlock: function ($scope, $) {
            var $carousel = $scope.find('.eead-swiper-slider').eq(0),
                $slider_options = JSON.parse($carousel.attr('data-slider-settings'));

            var mySwiper = new Swiper($carousel, $slider_options);
            if ($scope.find('.eead-swiper-slider').length > 0) {
                setTimeout(function () {
                    mySwiper.update();
                }, 100);
            }
        },


        portfolioBlock: function ($scope) {
            var $element = $scope.find('.eead-portfolio-lists');
            if ($element.length > 0) {
                if ($element.hasClass('owl-carousel')) {
                    var params = JSON.parse($element.attr('data-params'));
                    $element.owlCarousel({
                        loop: JSON.parse(params.loop),
                        autoplay: JSON.parse(params.autoplay),
                        autoplayTimeout: params.pause,
                        nav: JSON.parse(params.nav),
                        dots: JSON.parse(params.dots),
                        lazyLoad: true,
                        responsive: {
                            0: {
                                items: params.items_mobile,
                                margin: params.margin_mobile,
                                stagePadding: params.stagepadding_mobile
                            },
                            580: {
                                items: params.items_tablet,
                                margin: params.margin_tablet,
                                stagePadding: params.stagepadding_tablet
                            },
                            860: {
                                items: params.items,
                                margin: params.margin,
                                stagePadding: params.stagepadding
                            }
                        }
                    });
                }

                $('.eead-portfolio-lists').lightGallery({
                    selector: '.eead-zoom-portfolio',
                    thumbnail: false
                });
                $('.eead-zoom-portfolio').click(function () {
                    $(this).closest('.eead-portfolio-card').find('.eead-portfolio-image img').trigger('click');
                })
                $('.eead-portfolio-lists').data('lightGallery').destroy(true);
            }
        },


        elementorColumn: function ($scope) {
            var columnId = $scope.data('id');
            var editMode = Boolean(elementor.isEditMode());
            var stickyInstanceOptions = {
                topSpacing: 50,
                bottomSpacing: 50,
                innerWrapperSelector: '.elementor-widget-wrap'
            };
            if (!editMode) {
                if ($scope.hasClass('eea-elementor-sticky-column')) {
                    var adminbarHeight = 0;
                    if ($('body').hasClass('admin-bar')) {
                        adminbarHeight = 32;
                    }
                    var $stickywrap = $scope.find('> .elementor-column-wrap');
                    $scope.find('> .elementor-column-wrap,> .elementor-widget-wrap').addClass('ht-clearfix');
                    if ($stickywrap.length > 0) {
                        stickyInstanceOptions.innerWrapperSelector = '.elementor-column-wrap';
                    } else {
                        stickyInstanceOptions.innerWrapperSelector = '.elementor-widget-wrap';
                    }
                    $scope.css({display: 'block'});
                    stickyInstanceOptions.topSpacing = parseInt($scope.attr('data-top-spacing')) + adminbarHeight;
                    stickyInstanceOptions.bottomSpacing = parseInt($scope.attr('data-bottom-spacing'));
                    stickyInstanceOptions.containerSelector = '.elementor-container';

                    var stickyInstance = new StickySidebar($scope[0], stickyInstanceOptions);
                    $scope.attr('data-sticky-column', 'true');

                    $(window).resize(function () {
                        var currentDeviceMode = elementorFrontend.getCurrentDeviceMode(),
                            availableDevices = ['desktop', 'tablet'],
                            isInit = $scope.attr('data-sticky-column');

                        if (-1 !== availableDevices.indexOf(currentDeviceMode)) {
                            if (isInit === 'false') {
                                $scope.attr('data-sticky-column', 'true');
                                stickyInstance = new StickySidebar($scope[0], stickyInstanceOptions);
                                stickyInstance.updateSticky();
                            }
                        } else {
                            $scope.attr('data-sticky-column', 'false');
                            stickyInstance.destroy();
                        }
                    }).resize();
                }
            } else {
                var settings = EEA.columnEditorSettings(columnId);
                if ('true' === settings['sticky']) {
                    $scope.addClass('eea-elementor-sticky-column');
                    var $stickywrap = $scope.find('> .elementor-column-wrap');
                    $scope.find('> .elementor-column-wrap,> .elementor-widget-wrap').addClass('ht-clearfix');
                    if ($stickywrap.length > 0) {
                        stickyInstanceOptions.innerWrapperSelector = '.elementor-column-wrap';
                    } else {
                        stickyInstanceOptions.innerWrapperSelector = '.elementor-widget-wrap';
                    }
                    $scope.css({display: 'block'});
                    stickyInstanceOptions.topSpacing = settings['topSpacing'];
                    stickyInstanceOptions.bottomSpacing = settings['bottomSpacing'];
                    var stickyInstance = new StickySidebar($scope[0], stickyInstanceOptions);
                    $scope.attr('data-sticky-column', 'true');
                    stickyInstance.updateSticky();

                    $(window).resize(function () {
                        var currentDeviceMode = elementorFrontend.getCurrentDeviceMode(),
                            availableDevices = ['desktop', 'tablet'],
                            isInit = $scope.attr('data-sticky-column');

                        if (-1 !== availableDevices.indexOf(currentDeviceMode)) {
                            if (isInit === 'false') {
                                $scope.attr('data-sticky-column', 'true');
                                stickyInstance = new StickySidebar($scope[0], stickyInstanceOptions);
                                stickyInstance.updateSticky();
                            }
                        } else {
                            $scope.attr('data-sticky-column', 'false');
                            stickyInstance.destroy();
                        }
                    }).resize();
                } else {
                    $scope.removeClass('eea-elementor-sticky-column');
                }
            }
        },

        columnEditorSettings: function (columnId) {
            var editorElements = null,
                columnData = {};

            if (!window.elementor.hasOwnProperty('elements')) {
                return false;
            }

            editorElements = window.elementor.elements;
            if (!editorElements.models) {
                return false;
            }

            $.each(editorElements.models, function (index, obj) {
                $.each(obj.attributes.elements.models, function (index, obj) {
                    if (columnId == obj.id) {
                        columnData = obj.attributes.settings.attributes;
                    }
                });
            });

            return {
                'sticky': columnData['hash_elements_sidebar_sticky'] || false,
                'topSpacing': columnData['hash_elements_sidebar_sticky_top_spacing'] || 50,
                'bottomSpacing': columnData['hash_elements_sidebar_sticky_bottom_spacing'] || 50,
            }
        },

        resizeSticky: function ($target) {
            var currentDeviceMode = elementorFrontend.getCurrentDeviceMode();
            if (-1 !== availableDevices.indexOf(currentDeviceMode)) {
                $target.data('stickyColumnInit', true);
                stickyInstance = new StickySidebar($target[0], stickyInstanceOptions);
                stickyInstance.updateSticky();
            } else {
                $target.data('stickyColumnInit', false);
                stickyInstance.destroy();
            }
        },

        multiScrollBlock: function (e, n) {
            var t = e.find('.eead-multiscroll-wrap'),
                a = t.data('settings'),
                i = a.id;
            function o() {
                n('#eead-scroll-nav-menu-' + i).removeClass('eead-scroll-responsive'),
                    n('#eead-multiscroll-' + i).multiscroll({
                        verticalCentered: !0,
                        menu: '#eead-scroll-nav-menu-' + i,
                        sectionsColor: [],
                        keyboardScrolling: a.keyboard,
                        navigation: a.dots,
                        navigationPosition: a.dotsPos,
                        navigationVPosition: a.dotsVPos,
                        navigationTooltips: a.dotsText,
                        navigationColor: '#000',
                        loopBottom: a.btmLoop,
                        loopTop: a.topLoop,
                        css3: !0,
                        paddingTop: 0,
                        paddingBottom: 0,
                        normalScrollElements: null,
                        touchSensitivity: 5,
                        leftSelector: '.eead-multiscroll-left-' + i,
                        rightSelector: '.eead-multiscroll-right-' + i,
                        sectionSelector: '.eead-multiscroll-temp-' + i,
                        anchors: a.anchors,
                        fit: a.fit,
                        cellHeight: a.cellHeight,
                        id: i,
                        leftWidth: a.leftWidth,
                        rightWidth: a.rightWidth,
                    });
            }
            var r = n(t).find('.eead-multiscroll-left-temp'),
                s = n(t).find('.eead-multiscroll-right-temp'),
                l = a.hideTabs,
                d = a.hideMobs,
                c = n('body').data('elementor-device-mode');
            function m() {
                n(t).parents('.elementor-top-section').removeClass('elementor-section-height-full'),
                    n.each(s, function (e) {
                        var t, i;
                        (t = r[e]),
                            (i = s[e]),
                            'mobile' === c
                                ? (n(t).data('hide-mobs') && n(t).addClass('eead-multiscroll-hide'), n(i).data('hide-mobs') && n(i).addClass('eead-multiscroll-hide'))
                                : (n(t).data('hide-tabs') && n(t).addClass('eead-multiscroll-hide'), n(i).data('hide-tabs') && n(i).addClass('eead-multiscroll-hide')),
                            a.rtl ? n(r[e]).insertAfter(s[e]) : n(s[e]).insertAfter(r[e]);
                    }),
                    n(t).find('.eead-multiscroll-inner').removeClass('eead-scroll-fit').css('min-height', a.cellHeight + 'px');
            }
            switch (!0) {
                case l && d:
                    ('desktop' === c ? o : m)();
                    break;
                case l && !d:
                    ('mobile' === c || 'desktop' === c ? o : m)();
                    break;
                case !l && d:
                    ('tablet' === c || 'desktop' === c ? o : m)();
                    break;
                case !l && !d:
                    o();
            }
        },

        horizontalScrollBlock: function ($scope, $) {
            var $hScrollElem = $scope.find('.eead-hscroll-wrap'),
                hScrollSettings = $hScrollElem.data('settings'),
                instance = null,
                disableOn = hScrollSettings.disableOn;
            var templates = hScrollSettings.templates;

            if (!templates.length) return;

            templates.forEach(function (template) {
                if ('id' === template.template_type && '' !== template.section_id) {
                    if (!$('#' + template.section_id)
                        .length) {
                        $hScrollElem.html(
                            '<div class="eead-error-notice"><span>Section with ID <b>' +
                            template.section_id +
                            '</b> does not exist on this page. Please make sure that section ID is properly set from section settings -> Advanced tab -> CSS ID.<span></div>'
                        );
                        return;
                    }
                }
            });

            if (disableOn.includes(elementorFrontend.getCurrentDeviceMode())) {
                $hScrollElem.find('.eead-hscroll-arrow, .eead-hscroll-progress, .eead-hscroll-nav, .eead-hscroll-pagination, .eead-hscroll-fixed-content').remove();
                $hScrollElem.find('.eead-hscroll-temp').each(function (index, slide) {
                    $(slide).removeClass('eead-hscroll-temp');
                });
                $hScrollElem.find('.eead-hscroll-sections-wrap').removeClass('eead-hscroll-sections-wrap');
                return;
            }

            instance = new eeadHorizontalScroll($hScrollElem, hScrollSettings);
            instance.init();
        },

        chartsBlock: function ($scope, $) {
            var $chartElem = $scope.find('.eead-chart-container'),
                settings = $chartElem.data('settings'),
                currentDevice = elementorFrontend.getCurrentDeviceMode(),
                dataSource = $chartElem.data('source'),
                type = settings.type,
                eventsArray = [
                    'mousemove',
                    'mouseout',
                    'click',
                    'touchstart',
                    'touchmove'
                ],
                printVal = settings.printVal,
                event =
                    ('pie' === type || 'doughnut' === type) && printVal ? false : eventsArray,
                premiumChartData = $chartElem.data('chart'),
                data = {
                    labels: settings.xlabels,
                    datasets: []
                },
                chartInstance = null;
            if ('desktop' !== currentDevice) {
                if (settings.legRes)
                    settings.legDis = false;
                settings.legPos = settings['legPos_' + currentDevice];
            }

            function renderChart() {
                var ctx = document
                    .getElementById(settings.chartId)
                    .getContext('2d');

                var globalOptions = {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            top: 'polarArea' === type ? 6 : 0
                        }
                    },
                    events: event,
                    animation: {
                        duration: settings.duration,
                        easing: settings.easing,
                        onComplete: function () {
                            if (!event) {
                                this.defaultFontSize = 16;
                                ctx.font =
                                    '15px "Helvetica Neue", "Helvetica", "Arial", sans-serif';
                                ctx.textAlign = 'center';
                                ctx.textBaseline = 'bottom';

                                this.data.datasets.forEach(function (dataset) {
                                    for (var i = 0; i < dataset.data.length; i++) {
                                        var model =
                                            dataset._meta[Object.keys(dataset._meta)[0]].data[i]
                                                ._model,
                                            total =
                                                dataset._meta[Object.keys(dataset._meta)[0]].total,
                                            mid_radius =
                                                model.innerRadius +
                                                (model.outerRadius - model.innerRadius) / 2,
                                            start_angle = model.startAngle,
                                            end_angle = model.endAngle,
                                            mid_angle = start_angle + (end_angle - start_angle) / 2;
                                        var x = mid_radius * Math.cos(mid_angle);
                                        var y = mid_radius * Math.sin(mid_angle);
                                        ctx.fillStyle = settings.yTicksCol;
                                        var percent =
                                            String(Math.round((dataset.data[i] / total) * 100)) + '%';
                                        ctx.fillText(percent, model.x + x, model.y + y + 15);
                                    }
                                });
                            }
                        }
                    },
                    tooltips: {
                        enabled: settings.enTooltips,
                        mode: settings.modTooltips,
                        callbacks: {
                            label: function (tooltipItem, data) {
                                var prefixString = '';
                                if ('pie' == type || 'doughnut' == type || 'polarArea' == type) {
                                    prefixString = data.labels[tooltipItem.index] + ': ';
                                }
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var total = dataset.data.reduce(function (previousValue, currentValue) {
                                    return parseFloat(previousValue) + parseFloat(currentValue);
                                });
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = ((currentValue / total) * 100).toPrecision(3);
                                return (
                                    prefixString +
                                    (settings.percentage ?
                                        percentage + '%' :
                                        currentValue)
                                );
                            }
                        }
                    },
                    legend: {
                        display: settings.legDis,
                        position: settings.legPos,
                        reverse: settings.legRev,
                        labels: {
                            usePointStyle: settings.legCircle,
                            boxWidth: parseInt(settings.itemWid),
                            fontColor: settings.legCol,
                            fontSize: parseInt(settings.legSize)
                        }
                    }
                };

                var multiScaleOptions = {
                    scales: {
                        xAxes: [{
                            barPercentage: settings.xwidth,
                            display: ('pie' === type || 'doughnut' === type) ? false : true,
                            gridLines: {
                                display: settings.xGrid,
                                color: settings.xGridCol,
                                lineWidth: settings.xGridWidth,
                                drawBorder: true
                            },
                            scaleLabel: {
                                display: settings.xlabeldis,
                                labelString: settings.xlabel,
                                fontColor: settings.xlabelcol,
                                fontSize: settings.xlabelsize
                            },
                            ticks: {
                                fontSize: settings.xTicksSize,
                                fontColor: settings.xTicksCol,
                                stepSize: settings.stepSize,
                                maxRotation: settings.xTicksRot,
                                minRotation: settings.xTicksRot,
                                beginAtZero: settings.xTicksBeg,
                                callback: function (tick) {
                                    var locale = settings.locale || false;
                                    return tick.toLocaleString(locale);
                                }
                            }
                        }],
                        yAxes: [{
                            display: ('pie' === type || 'doughnut' === type) ? false : true,
                            type: settings.yAxis,
                            gridLines: {
                                display: settings.yGrid,
                                color: settings.yGridCol,
                                lineWidth: settings.yGridWidth,
                            },
                            scaleLabel: {
                                display: settings.ylabeldis,
                                labelString: settings.ylabel,
                                fontColor: settings.ylabelcol,
                                fontSize: settings.ylabelsize
                            },
                            ticks: {
                                suggestedMin: settings.suggestedMin,
                                suggestedMax: settings.suggestedMax,
                                fontSize: settings.yTicksSize,
                                fontColor: settings.yTicksCol,
                                beginAtZero: settings.yTicksBeg,
                                stepSize: settings.stepSize,
                                callback: function (tick) {
                                    var locale = settings.locale || false;
                                    return tick.toLocaleString(locale);
                                }
                            }
                        }]
                    }
                };

                var singleScaleOptions = {
                    scale: {
                        ticks: {
                            beginAtZero: settings.yTicksBeg,
                            stepSize: settings.stepSize,
                            suggestedMax: settings.suggestedMax,
                            callback: function (tick) {
                                var locale = settings.locale || false;
                                return tick.toLocaleString(locale);
                            }
                        }
                    }
                };

                chartInstance = new Chart(ctx, {
                    type: type,
                    data: data,
                    options: Object.assign(globalOptions, ('radar' !== type && 'polarArea' !== type) ? multiScaleOptions : singleScaleOptions)
                });

                if ('custom' === dataSource) {
                    premiumChartData.forEach(function (element) {
                        if ('pie' !== type && 'doughnut' !== type && 'polarArea' !== type) {
                            if ('object' === typeof element.backgroundColor) {

                                //We need to make sure add gradient colors or not.
                                if ('empty' !== element.backgroundColor[element.backgroundColor.length - 1]) {
                                    var gradient = ctx.createLinearGradient(0, 0, 0, 600),
                                        secondColor = element.backgroundColor[1] ?
                                            element.backgroundColor[1] :
                                            element.backgroundColor[0];
                                    gradient.addColorStop(0, element.backgroundColor[0]);
                                    gradient.addColorStop(1, secondColor);
                                    element.backgroundColor = gradient;
                                    element.hoverBackgroundColor = gradient;
                                }
                            }
                        }
                        data.datasets.push(element);
                        chartInstance.update();
                    });

                    $('#' + settings.chartId).on('click', function (evt) {
                        var activePoint = chartInstance.getElementAtEvent(evt);
                        if (activePoint[0]) {
                            var URL =
                                chartInstance.data.datasets[activePoint[0]._datasetIndex].links[
                                activePoint[0]._index
                                ];
                            if (URL != null && URL != '') {
                                window.open(URL, settings.target);
                            }
                        }
                    });
                }
            }
            function handleChartData(res) {
                var rowsData = res.split(/\r?\n|\r/),
                    labels = (rowsData.shift()).split(premiumChartData.separator);

                data.labels = labels;
                rowsData.forEach(function (row, index) {
                    if (row.length !== 0) {
                        var colData = {};

                        colData.data = row.split(premiumChartData.separator);
                        //add properties only if repeater element exists
                        if (premiumChartData.props[index]) {
                            colData.borderColor = premiumChartData.props[index].borderColor;
                            colData.borderWidth = premiumChartData.props[index].borderWidth;
                            colData.backgroundColor = premiumChartData.props[index].backgroundColor;
                            colData.hoverBackgroundColor = premiumChartData.props[index].hoverBackgroundColor;
                            colData.label = premiumChartData.props[index].title;
                        }

                        data.datasets.push(colData);
                        chartInstance.update();

                    }
                });
            }
            var $checkModal = $chartElem.closest('.eead-modal-box-modal');
            if ($checkModal.length || 'load' === settings.event) {
                getChartData();
            } else {
                new Waypoint({
                    element: $('#' + settings.chartId),
                    offset: Waypoint.viewportHeight() - 250,
                    triggerOnce: true,
                    handler: function () {
                        getChartData();
                        this.destroy();
                    }
                });
            }
            function getChartData() {
                if ('custom' === dataSource) {
                    renderChart();
                } else {
                    $chartElem.append('<div class="totalplus-loading-feed"><div class="totalplus-loader"></div></div>');
                    if (premiumChartData.url) {
                        $.ajax({
                            url: premiumChartData.url,
                            type: 'GET',
                            success: function (res) {
                                console.log(res);
                                $chartElem.find('.eead-loading-feed').remove();
                                renderChart();
                                handleChartData(res);
                            },
                            error: function (err) {
                                console.log(err);
                            }
                        });
                    }
                }
            }
        },

        tiltHoverImageBlock: function ($scope) {
            var tiltImageBlock = $scope.find('a.eead-tilter'), tiltSettings = [
                {},
                {
                    movement: {
                        imgWrapper: {
                            translation: {x: 10, y: 10, z: 30},
                            rotation: {x: 0, y: -10, z: 0},
                            reverseAnimation: {duration: 200, easing: 'easeOutQuad'}
                        },
                        lines: {
                            translation: {x: 10, y: 10, z: [0, 70]},
                            rotation: {x: 0, y: 0, z: -2},
                            reverseAnimation: {duration: 2000, easing: 'easeOutExpo'}
                        },
                        caption: {
                            rotation: {x: 0, y: 0, z: 2},
                            reverseAnimation: {duration: 200, easing: 'easeOutQuad'}
                        },
                        overlay: {
                            translation: {x: 10, y: -10, z: 0},
                            rotation: {x: 0, y: 0, z: 2},
                            reverseAnimation: {duration: 2000, easing: 'easeOutExpo'}
                        },
                        shine: {
                            translation: {x: 100, y: 100, z: 0},
                            reverseAnimation: {duration: 200, easing: 'easeOutQuad'}
                        }
                    }
                },
                {
                    movement: {
                        imgWrapper: {
                            rotation: {x: -5, y: 10, z: 0},
                            reverseAnimation: {duration: 900, easing: 'easeOutCubic'}
                        },
                        caption: {
                            translation: {x: 30, y: 30, z: [0, 40]},
                            rotation: {x: [0, 15], y: 0, z: 0},
                            reverseAnimation: {duration: 1200, easing: 'easeOutExpo'}
                        },
                        overlay: {
                            translation: {x: 10, y: 10, z: [0, 20]},
                            reverseAnimation: {duration: 1000, easing: 'easeOutExpo'}
                        },
                        shine: {
                            translation: {x: 100, y: 100, z: 0},
                            reverseAnimation: {duration: 900, easing: 'easeOutCubic'}
                        }
                    }
                },
                {
                    movement: {
                        imgWrapper: {
                            rotation: {x: -5, y: 10, z: 0},
                            reverseAnimation: {duration: 50, easing: 'easeOutQuad'}
                        },
                        caption: {
                            translation: {x: 20, y: 20, z: 0},
                            reverseAnimation: {duration: 200, easing: 'easeOutQuad'}
                        },
                        overlay: {
                            translation: {x: 5, y: -5, z: 0},
                            rotation: {x: 0, y: 0, z: 6},
                            reverseAnimation: {duration: 1000, easing: 'easeOutQuad'}
                        },
                        shine: {
                            translation: {x: 50, y: 50, z: 0},
                            reverseAnimation: {duration: 50, easing: 'easeOutQuad'}
                        }
                    }
                },
                {
                    movement: {
                        imgWrapper: {
                            translation: {x: 0, y: -8, z: 0},
                            rotation: {x: 3, y: 3, z: 0},
                            reverseAnimation: {duration: 1200, easing: 'easeOutExpo'}
                        },
                        lines: {
                            translation: {x: 15, y: 15, z: [0, 15]},
                            reverseAnimation: {duration: 1200, easing: 'easeOutExpo'}
                        },
                        overlay: {
                            translation: {x: 0, y: 8, z: 0},
                            reverseAnimation: {duration: 600, easing: 'easeOutExpo'}
                        },
                        caption: {
                            translation: {x: 10, y: -15, z: 0},
                            reverseAnimation: {duration: 900, easing: 'easeOutExpo'}
                        },
                        shine: {
                            translation: {x: 50, y: 50, z: 0},
                            reverseAnimation: {duration: 1200, easing: 'easeOutExpo'}
                        }
                    }
                },
                {
                    movement: {
                        lines: {
                            translation: {x: -5, y: 5, z: 0},
                            reverseAnimation: {duration: 1000, easing: 'easeOutExpo'}
                        },
                        caption: {
                            translation: {x: 15, y: 15, z: 0},
                            rotation: {x: 0, y: 0, z: 3},
                            reverseAnimation: {duration: 1500, easing: 'easeOutElastic', elasticity: 700}
                        },
                        overlay: {
                            translation: {x: 15, y: -15, z: 0},
                            reverseAnimation: {duration: 500, easing: 'easeOutExpo'}
                        },
                        shine: {
                            translation: {x: 50, y: 50, z: 0},
                            reverseAnimation: {duration: 500, easing: 'easeOutExpo'}
                        }
                    }
                },
                {
                    movement: {
                        imgWrapper: {
                            translation: {x: 5, y: 5, z: 0},
                            reverseAnimation: {duration: 800, easing: 'easeOutQuart'}
                        },
                        caption: {
                            translation: {x: 10, y: 10, z: [0, 50]},
                            reverseAnimation: {duration: 1000, easing: 'easeOutQuart'}
                        },
                        shine: {
                            translation: {x: 50, y: 50, z: 0},
                            reverseAnimation: {duration: 800, easing: 'easeOutQuart'}
                        }
                    }
                },
                {
                    movement: {
                        lines: {
                            translation: {x: 40, y: 40, z: 0},
                            reverseAnimation: {duration: 1500, easing: 'easeOutElastic'}
                        },
                        caption: {
                            translation: {x: 20, y: 20, z: 0},
                            rotation: {x: 0, y: 0, z: -5},
                            reverseAnimation: {duration: 1000, easing: 'easeOutExpo'}
                        },
                        overlay: {
                            translation: {x: -30, y: -30, z: 0},
                            rotation: {x: 0, y: 0, z: 3},
                            reverseAnimation: {duration: 750, easing: 'easeOutExpo'}
                        },
                        shine: {
                            translation: {x: 100, y: 100, z: 0},
                            reverseAnimation: {duration: 750, easing: 'easeOutExpo'}
                        }
                    }
                }
            ];
            new TiltFx(tiltImageBlock[0], tiltSettings[tiltImageBlock.data('hoverstyle')]);
        },

        slinkyVerticalMenuBlock: function ($scope) {
            var $vrMenu = $scope.find('.eead-slinky-vertical-menu');
            var $settings = $vrMenu.attr('id');
            if (!$vrMenu.length) {
                return;
            }
            const slinky = $('#' + $settings).slinky();
        },

        portfolioGrid: function ($scope) {
            $scope.find('form.eead-fpg-toolbar').each(function () {
                var i = $(this).attr('id');
                document.getElementById(i).reset();
            });
            var n = $scope.find('input[name="filter"]:checked').val();
            n && 'all' != n && i.find('.eead-fpg-container li').each(function () {
                var i = $(this);
                i.filter('[data-filter~=' + n + ']').length ? i.show() : i.hide();
            }),
                $scope.find('.eead-fpg-container').fadeIn(200);
            $scope.find('li.eead-fpg-mobile-icon').on('click', function (e) {
                i.find('.eead-fpg-search-wrapper').find('li:not(.eead-fpg-mobile-icon)').toggle();
            }),
                $(window).on('resize', function () {
                    $(window).width() > 767 ? $scope.find('.eead-fpg-search-wrapper').find('li:not(.eead-fpg-mobile-icon)').show() : $scope.find('.eead-fpg-search-wrapper').find('li:not(.eead-fpg-mobile-icon)').hide();
                }),
                $scope.find('input[name="view"]').change(function () {
                    $scope.find('.eead-fpg-view-options label').removeClass('active'),
                        $scope.find('input[name="view"]:checked').parent().find('label').addClass('active'),
                        'show-grid' == $(this).val() ? ($scope.find('.eead-fpg-container').removeClass('eead-fpg-list-view'), $scope.find('.eead-fpg-container').addClass('eead-fpg-grid-view'))
                            : 'show-list' == $(this).val() && ($scope.find('.eead-fpg-container').removeClass('eead-fpg-grid-view'), $scope.find('.eead-fpg-container').addClass('eead-fpg-list-view'));
                }),
                $scope.find('input[name="filter"]').change(function () {
                    var n = $(this).val();
                    $scope.find('.eead-fpg-search-wrapper li label').removeClass('active'),
                        $scope.find('input[name="filter"]:checked').parent().find('label').addClass('active'),
                        'all' === n ? ($scope.find('.eead-fpg-container').removeClass('eead-fpg-zoom-in'),
                            $scope.find('.eead-fpg-container').addClass('eead-fpg-zoom-out'),
                            $scope.find('.eead-fpg-container').fadeOut(200, function () {
                                $scope.find('.eead-fpg-container li').show(),
                                    $(this).fadeIn(200, function () {
                                        $(this).removeClass('eead-fpg-zoom-out'), $(this).addClass('eead-fpg-zoom-in'), $(this).css('display', 'grid');
                                    });
                            }))
                            : ($scope.find('.eead-fpg-container').removeClass('eead-fpg-zoom-in'),
                                $scope.find('.eead-fpg-container').addClass('eead-fpg-zoom-out'),
                                $scope.find('.eead-fpg-container').fadeOut(200, function () {
                                    $scope.find('.eead-fpg-container li').each(function () {
                                        var e = $(this);
                                        e.filter('[data-filter~=' + n + ']').length ? e.show() : e.hide();
                                    }),
                                        $(this).fadeIn(200, function () {
                                            $(this).removeClass('eead-fpg-zoom-out'), $(this).addClass('eead-fpg-zoom-in'), $(this).css('display', 'grid');
                                        });
                                }));
                });
        },

        captionHoverEffect: function ($scope) {
            if (Modernizr.touch) {
                function classReg(className) {
                    return new RegExp('(^|\\s+)' + className + '(\\s+|$)');
                }

                // classList support for class management
                // altho to be fair, the api sucks because it won't accept multiple classes at once
                var hasClass, addClass, removeClass;

                if ('classList' in document.documentElement) {
                    hasClass = function (elem, c) {
                        return elem.classList.contains(c);
                    };
                    addClass = function (elem, c) {
                        elem.classList.add(c);
                    };
                    removeClass = function (elem, c) {
                        elem.classList.remove(c);
                    };
                }
                else {
                    hasClass = function (elem, c) {
                        return classReg(c).test(elem.className);
                    };
                    addClass = function (elem, c) {
                        if (!hasClass(elem, c)) {
                            elem.className = elem.className + ' ' + c;
                        }
                    };
                    removeClass = function (elem, c) {
                        elem.className = elem.className.replace(classReg(c), ' ');
                    };
                }

                function toggleClass(elem, c) {
                    var fn = hasClass(elem, c) ? removeClass : addClass;
                    fn(elem, c);
                }

                var classie = {
                    // full names
                    hasClass: hasClass,
                    addClass: addClass,
                    removeClass: removeClass,
                    toggleClass: toggleClass,
                    // short names
                    has: hasClass,
                    add: addClass,
                    remove: removeClass,
                    toggle: toggleClass
                };

                // transport
                if (typeof define === 'function' && define.amd) {
                    // AMD
                    define(classie);
                } else {
                    // browser global
                    window.classie = classie;
                }

                el = $scope.find('figcaption > a')[0];
                el.addEventListener('touchstart', function (e) {
                    e.stopPropagation();
                }, false);
                el.addEventListener('touchstart', function (e) {
                    classie.toggle(this, 'cs-hover');
                }, false);
            }
        },

        threedTextBlock: function ($scope) {
            var ztext = $scope.find('.eead-z-text'),
                options = {
                    depth: '30px',
                    layers: 8,
                },
                element_id = '.elementor-element-' + $scope.data('id') + ' .eead-z-text';

            if (ztext.data('zDepth')) {
                options.depth = ztext.data('zDepth') || '30px';
            }

            if (ztext.data('zLayers')) {
                options.layers = ztext.data('zLayers') || 3;
            }

            if (ztext.data('zPerspective')) {
                options.perspective = ztext.data('zPerspective') || '500px';
            }

            if (ztext.data('zFade')) {
                options.fade = ztext.data('zFade');
            }

            if (ztext.data('zDirection')) {
                options.direction = ztext.data('zDirection') || 'forwards';
            }

            if (ztext.data('zEvent')) {
                options.event = ztext.data('zEvent') || 'pointer';
            }

            if (ztext.data('zEventrotation') && ztext.data('zEvent') != 'none') {
                options.eventRotation = ztext.data('zEventrotation') || '35deg';
            }

            if (ztext.data('zEventdirection') && ztext.data('zEvent') != 'none') {
                options.eventDirection = ztext.data('zEventdirection') || 'default';
            }

            var ztxt = new Ztextify(element_id, options);
        },

        textMarquee: function ($scope) {
            $scope.find('.eead-text-marquee').marquee();
        }
    };

    $(window).on('elementor/frontend/init', EEA.init);

    window.eeadHorizontalScroll = function ($elem, settings) {
        var self = this,
            id = settings.id,
            count = settings.templates.length,
            editMode = elementorFrontend.isEditMode(),
            currentDevice = elementorFrontend.getCurrentDeviceMode(),
            progressOffset = 300,
            currentActiveArr = [],
            currentActive = 0,
            prevActive = -1,
            loop = settings.loop,
            snapScroll = 'snap' === settings.snap,
            controller = false,
            isScrolling = false,
            scene = null,
            offset = null,
            horizontalSlide = null,
            rtlMode = settings.rtl,
            scrollEvent = null,
            dimensions = null;

        $elem.find('.eead-hscroll-temp').each(function (index, template) {
            var hideOn = $(template).data('hide');
            if (-1 < hideOn.indexOf(currentDevice)) {
                hideSection(template, index);
            }
        });

        function hideSection(template, index) {
            if (0 !== count) {
                count--;
                $(template).remove();
                $elem.find('.eead-hscroll-total-slides').html(count > 9 ? count : ('0' + count));
                $elem.find('.eead-hscroll-nav-item[data-slide="section_' + id + index + '"]').remove();
            }

            if (0 === count) {
                $elem.find('.eead-hscroll-arrow, .eead-hscroll-nav, .eead-hscroll-pagination').remove();
            }

            if (settings.opacity) {
                $elem.find('.eead-hscroll-temp:first').removeClass('eead-hscroll-hide');
            }

        }

        var $slides = $elem.find('.eead-hscroll-temp');

        if (settings.opacity)
            var targetIndex = 0;

        if (rtlMode)
            targetIndex = count - 1;


        if ('desktop' !== currentDevice) {
            if (snapScroll && settings.disableSnap) {
                snapScroll = false;
                settings.enternace = false;
            }
            if ('tablet' === currentDevice) {
                progressOffset = 100;
            } else if ('mobile' === currentDevice) {
                progressOffset = 50;
            }
        } else if (snapScroll) {
            progressOffset = 30;
        }

        var $nav = $('.eead-hscroll-nav-item', $elem),
            $arrows = $('.eead-hscroll-wrap-icon', $elem);

        self.init = function () {

            if (!count) return;

            self.setLayout();
            self.setSectionsData();
            self.handleAnimations();
            self.setScene();

            if (!loop) self.checkActive();

            scene.on('progress', self.onProgress);
            $nav.on('click.eeadHorizontalScroll', self.onNavDotClick);
            $arrows.on('click.eeadHorizontalScroll', self.onNavArrowClick);
            self.checkRemoteAnchors();
            self.checkLocalAnchors();

            $(document).on('elementor/popup/show', function () {
                self.checkLocalAnchors();
            });

            $(window)
                .on('resize', self.refresh);

            if (snapScroll)
                document.addEventListener ? document.addEventListener('wheel', self.onScroll, {passive: false}) : document.attachEvent('onmousewheel', self.onScroll);

            if (settings.keyboard)
                document.addEventListener ? document.addEventListener('keydown', self.onKeyboardPress) : document.attachEvent('keydown', self.onKeyboardPress);

            if (snapScroll) {
                $(window).on('load', function () {
                    var windowOuterHeight = $(window).outerHeight();

                    if (offset - windowOuterHeight < 150)
                        return;

                    if (0 === currentActive) {
                        elementorFrontend.waypoint(
                            $elem,
                            function (direction) {
                                if ('down' === direction) {
                                    self.scrollToSlide(0);
                                }
                            }, {
                            offset: 150,
                            triggerOnce: false
                        }
                        );
                    }
                });
            }
        };

        self.checkLocalAnchors = function () {
            $('a').on('click', function (event) {
                var href = $(this).attr('href');
                if (href) {
                    href = href.replace('#/', '');
                    self.checkAnchors(href);
                }
            });
        }

        self.checkRemoteAnchors = function () {
            var url = new URL(window.location.href);
            if (!url) return;

            var slideID = url.searchParams.get('slide');
            if (slideID) self.checkAnchors(slideID);
        };

        self.checkAnchors = function (href) {
            var $slide = $elem.find('.eead-hscroll-temp[data-section="' + href + '"]');
            if (!$slide.length) return;

            var slideIndex = $slide.index();
            self.scrollToSlide(slideIndex, 'anchors');
        };

        self.onKeyboardPress = function (e) {
            if ('BEFORE' === scene.state()) {
                return;
            } else {
                var downKeyCodes = [40, 34],
                    upKeyCodes = [38, 33];

                if ('AFTER' === scene.state()) {
                    if (-1 !== $.inArray(e.keyCode, upKeyCodes)) {
                        var lastScrollOffset = self.getScrollOffset(
                            $slides.eq(count - 1)
                        );
                        if (
                            e.pageY - lastScrollOffset <= 300 &&
                            e.pageY - lastScrollOffset > 100
                        ) {
                            self.preventDefault(event);
                            self.scrollToSlide(count - 1);
                        } else if (e.pageY - lastScrollOffset < 100) {
                            self.preventDefault(event);
                            self.scrollToSlide(count - 2);
                        }
                        return;
                    }
                } else {
                    if (-1 !== $.inArray(e.keyCode, downKeyCodes)) {
                        if (isScrolling) {
                            self.preventDefault(event);
                            return;
                        }
                        self.goToNext();
                    }
                    if (-1 !== $.inArray(e.keyCode, upKeyCodes)) {
                        if (isScrolling) {
                            self.preventDefault(event);
                            return;
                        }
                        self.goToPrev('keyboard');
                    }
                }
            }
        };

        self.getResponsiveControlValue = function (ID) {
            var value = settings[ID];
            if ('desktop' !== currentDevice) {
                value = settings[ID + '_' + currentDevice];
            }
            return value;
        };

        self.setScene = function () {
            controller = new ScrollMagic.Controller();
            horizontalSlide = new TimelineMax();
            self.setHorizontalSlider();
            var scrollSpeed = self.getResponsiveControlValue('speed');

            if ('desktop' === currentDevice) {
                scrollSpeed = scrollSpeed * 100 + '%';
            } else {
                scrollSpeed = scrollSpeed * $elem.outerHeight();
            }

            scene = new ScrollMagic.Scene({
                triggerElement: '#eead-hscroll-spacer-' + id,
                triggerHook: 'onLeave',
                duration: scrollSpeed
            }).setPin('#eead-hscroll-wrap-' + id, {pushFollowers: true}).setTween(horizontalSlide).addTo(controller);
        };

        self.getDimensions = function () {
            var firstWidth = $slides.eq(0).innerWidth(),
                distance = firstWidth * (count - 1),
                progressWidth = firstWidth * count;

            var slidesInViewPort = self.getResponsiveControlValue('slides'),
                distanceBeyond = self.getResponsiveControlValue('distance');

            distance = distance - (1 - 1 / slidesInViewPort) * $elem.outerWidth();
            distance = distanceBeyond + distance;

            if (rtlMode)
                $('#eead-hscroll-scroller-wrap-' + id).css('transform', 'translateX(' + -distance + 'px)');

            var ease = Power2.easeOut;
            ease = Power0.easeNone;

            return {
                distance: distance,
                progressBar: progressWidth,
                ease: ease
            };

        };

        self.setHorizontalSlider = function (progress) {
            // horizontalSlide = new TimelineMax();
            dimensions = self.getDimensions();

            horizontalSlide
                .to('#eead-hscroll-scroller-wrap-' + id, 1, {x: rtlMode ? '0px' : -dimensions.distance, ease: dimensions.ease}, 0)
                .to('#eead-hscroll-progress-line-' + id, 1, {width: dimensions.progressBar + 'px', ease: dimensions.ease}, 0);

            if ('undefined' !== typeof progress) {
                scene.progress(0);
                scene.update(true);
            }
        }

        self.setLayout = function () {
            $elem.closest('section.elementor-section-height-full').removeClass('elementor-section-height-full');
        };

        self.setSectionsData = function () {
            var slidesInViewPort = self.getResponsiveControlValue('slides');
            var slideWidth = 100 / slidesInViewPort;
            $elem.find('.eead-hscroll-slider').css('width', count * slideWidth + '%');

            $elem.find('.eead-hscroll-temp').css('width', 100 / count + '%');

            var scrollSpeed = self.getResponsiveControlValue('speed');

            var width = parseFloat($elem.find('.eead-hscroll-sections-wrap').width() / count),
                winHeight = $(window).height() * scrollSpeed;

            $slides.each(function (index, template) {
                if ($(template)
                    .data('section')) {
                    var id = $(template)
                        .data('section');
                    self.getSectionContent(id);
                }
                var position = index * width;
                $(template).attr('data-position', position);
            });

            offset = $elem.offset().top;
            $slides.each(function (index, template) {
                var scrollOffset = (index * winHeight) / (count - 1);
                $(template).attr('data-scroll-offset', offset + scrollOffset);
            });
        };

        self.onScroll = function (event) {
            if (isScrolling && null !== event) self.preventDefault(event);
            var delta = self.getDirection(event),
                state = scene.state(),
                direction = 0 > delta ? 'down' : 'up';

            if ('up' === direction && 'AFTER' === scene.state()) {
                var lastScrollOffset = self.getScrollOffset(
                    $slides.eq(count - 1)
                );

                if (window.pageYOffset - lastScrollOffset <= 300 && window.pageYOffset - lastScrollOffset > 100)
                    self.scrollToSlide(count - 1);
            }

            if ('DURING' === state) {
                if ('down' === direction) {
                    if (!isScrolling && count - 1 !== currentActive) {
                        self.goToNext();
                    }
                } else if ('up' === direction) {
                    if (!isScrolling && 0 !== currentActive) self.goToPrev();
                }

                if ((0 !== currentActive && 'up' === direction) || ('down' === direction && count - 1 !== currentActive)) {
                    self.preventDefault(event);
                }
            }
        };

        self.getDirection = function (e) {
            e = window.event || e;
            var t = Math.max(-1, Math.min(1, e.wheelDelta || -e.deltaY || -e.detail));
            return t;
        };

        self.setSnapScroll = function (event) {
            var direction = event.scrollDirection;
            if ((0 !== currentActive && 'REVERSE' === direction) || 'FORWARD' === direction) {
                if (null !== scrollEvent) self.preventDefault(scrollEvent);
            }

            var $nextArrow = $('.eead-hscroll-next', $elem),
                $prevArrow = $('.eead-hscroll-prev', $elem);

            if ('FORWARD' === direction) {
                if (!isScrolling && count - 1 !== currentActive) {
                    $nextArrow.trigger('click.eeadHorizontalScroll');
                }
            } else {
                if (!isScrolling && 0 !== currentActive)
                    $prevArrow.trigger('click.eeadHorizontalScroll');
            }
        };

        self.refresh = function () {
            // dimensions = self.getDimensions();
            // horizontalSlide.to('#eead-hscroll-scroller-wrap-' + id, 1, { x: '-980', ease: Power0.easeNone }, 0);
            setTimeout(function () {
                var sceneProgress = scene.progress();
                self.setHorizontalSlider(sceneProgress);
            }, 200);
            // self.setScene();
        };

        self.onProgress = function () {
            var progressFillWidth = $elem.find('.eead-hscroll-progress-line').outerWidth(),
                elemWidth = $elem.outerWidth();

            $slides.each(function (index) {
                var scrollOffset = $slides.eq(index - 1).data('scroll-offset'),
                    scrollPosition = $(this).data('position');

                if (settings.opacity && targetIndex !== index) {
                    if (window.pageYOffset >= scrollOffset + elemWidth / 8) {
                        $(this).removeClass('eead-hscroll-hide');
                    } else {
                        $(this).addClass('eead-hscroll-hide');
                    }

                }

                if (progressFillWidth >= scrollPosition - progressOffset) {
                    if (settings.enternace && !isScrolling)
                        self.triggerAnimations();

                    if (-1 === currentActiveArr.indexOf(index)) {
                        currentActiveArr.push(index);
                        currentActive = index;
                        self.onSlideChange();
                    }

                } else {
                    if (-1 !== currentActiveArr.indexOf(index)) {
                        currentActiveArr.pop();
                        currentActive = currentActiveArr[currentActiveArr.length - 1];
                        self.onSlideChange();
                    }

                }
            });
        };

        self.onSlideChange = function () {
            prevActive = currentActive;
            self.addBackgroundLayer();
            if (settings.pagination && !snapScroll) {
                var text = currentActive + 1 > 9 ? '' : '0';
                $elem.find('.eead-hscroll-current-slide').text(text + (currentActive + 1));
            }

            $nav.removeClass('active');
            $elem.find('.eead-hscroll-nav-item').eq(currentActive).addClass('active');
            self.checkActive();

            if (settings.enternace && !isScrolling)
                self.restartAnimations(currentActive);
        };

        self.addBackgroundLayer = function () {
            if ($elem.find('.eead-hscroll-bg-layer[data-layer="' + currentActive + '"]').length) {
                $elem.find('.eead-hscroll-layer-active').removeClass('eead-hscroll-layer-active');
                $elem.find('.eead-hscroll-bg-layer[data-layer="' + currentActive + '"]').addClass('eead-hscroll-layer-active');
            }

        };

        self.getSectionContent = function (sectionID) {
            if (!$('#' + sectionID)
                .length) return;

            var htmlContent = $('#' + sectionID);
            if (!editMode) {
                $('#eead-hscroll-scroller-wrap-' + id)
                    .find('div[data-section="' + sectionID + '"]')
                    .append(htmlContent);
            } else {
                $slides.find('.elementor-element-overlay')
                    .remove();
                $('#eead-hscroll-scroller-wrap-' + id)
                    .find('div[data-section="' + sectionID + '"]')
                    .append(htmlContent.clone(true));
            }
        };

        self.checkActive = function () {
            if (!$arrows.length) return;

            if (loop) {
                if (-1 === currentActive) {
                    currentActive = count - 1;
                } else if (count === currentActive) {
                    currentActive = 0;
                }
            } else {
                if (0 === currentActive) {
                    $elem
                        .find('.eead-hscroll-arrow-left')
                        .addClass('eead-hscroll-arrow-hidden');
                } else {
                    $elem
                        .find('.eead-hscroll-arrow-left')
                        .removeClass('eead-hscroll-arrow-hidden');
                }

                if (count - 1 === currentActive) {
                    $elem
                        .find('.eead-hscroll-arrow-right')
                        .addClass('eead-hscroll-arrow-hidden');
                } else {
                    $elem
                        .find('.eead-hscroll-arrow-right')
                        .removeClass('eead-hscroll-arrow-hidden');
                }
            }

        };

        self.onNavDotClick = function () {
            if (isScrolling) return;
            var $item = $(this),
                index = $item.index();
            if (index === prevActive && 'DURING' === scene.state()) return;
            currentActive = index;
            self.scrollToSlide(index);
        };

        self.onNavArrowClick = function (e) {
            if (isScrolling) return;
            if ($(e.target).hasClass('eead-hscroll-prev') || $(e.target).find('.eead-hscroll-prev').length) {
                self.goToPrev();
            } else if ($(e.target).hasClass('eead-hscroll-next') || $(e.target).find('.eead-hscroll-next').length) {
                self.goToNext();
            }
        };

        self.goToNext = function () {
            if (isScrolling) return;
            currentActive++;
            if (loop) {
                if (-1 === currentActive) {
                    currentActive = count - 1;
                } else if (count === currentActive) {
                    currentActive = 0;
                }
            }
            self.scrollToSlide(currentActive);
        };

        self.goToPrev = function (trigger) {
            if (isScrolling || ('keyboard' === trigger && currentActive === 0)) return;

            currentActive--;
            if (loop) {
                if (-1 === currentActive) {
                    currentActive = count - 1;
                } else if (count === currentActive) {
                    currentActive = 0;
                }
            }

            self.scrollToSlide(currentActive);
        };

        self.scrollToSlide = function (slideIndex, scrollSrc) {
            var targetOffset = self.getScrollOffset($slides.eq(slideIndex));

            if (!scrollSrc) {
                if (isScrolling) return;
            }

            if (0 > currentActive || count - 1 < currentActive) return;

            isScrolling = true;
            prevActive = slideIndex;

            var spacerHeight = $('#eead-hscroll-spacer-' + id).outerHeight();

            TweenMax.to(window, 1.5, {
                scrollTo: {
                    y: targetOffset - spacerHeight
                },
                ease: Power3.easeOut,
                onComplete: self.afterSlideChange
            });

            if (settings.pagination && snapScroll)
                $elem.find('.eead-hscroll-current-slide').removeClass('zoomIn animated');

            if (settings.pagination && snapScroll) {
                setTimeout(function () {
                    if (currentActive + 1 != $elem.find('.eead-hscroll-current-slide').text()) {
                        //Lead zero
                        var text = currentActive + 1 > 9 ? '' : '0';
                        $elem.find('.eead-hscroll-current-slide').text(text + (currentActive + 1)).addClass('zoomIn animated');
                    }
                }, 1000);
            }

            if (settings.enternace) {
                setTimeout(function () {
                    self.setAnimations();
                }, 1000);
            }

            if (snapScroll) {
                setTimeout(function () {
                    isScrolling = false;
                }, 1500);
            }
        };

        self.afterSlideChange = function () {
            isScrolling = false;
        };

        self.handleAnimations = function () {
            if (settings.enternace) {
                self.hideAnimations();
                elementorFrontend.waypoint($elem, function () {
                    // self.setAnimations();
                });
            } else {
                self.unsetAnimations();
            }
        };

        self.hideAnimations = function () {
            $slides.find('.elementor-invisible').addClass('eead-hscroll-elem-hidden');
        };

        self.unsetAnimations = function () {
            $slides.find('.elementor-invisible').each(function (index, elem) {
                $(elem).removeClass('elementor-invisible');
            });
        };

        self.setAnimations = function () {
            self.restartAnimations();
            self.triggerAnimations();
        };

        self.restartAnimations = function (slideIndex) {
            var $unactiveSlides = $slides.filter(function (index) {
                return index !== slideIndex;
            });

            $unactiveSlides.find('.animated').each(function (index, elem) {
                var settings = $(elem).data('settings');
                if (undefined === settings) return;

                var animation = settings._animation || settings.animation;
                $(elem).removeClass('animated ' + animation).addClass('elementor-invisible');
            });
        };

        self.triggerAnimations = function () {
            $slides.eq(currentActive).find('.elementor-invisible').each(function (index, elem) {
                var settings = $(elem)
                    .data('settings');

                if (undefined === settings) return;

                if (!settings._animation && !settings.animation) return;

                var delay = settings._animation_delay ?
                    settings._animation_delay :
                    0,
                    animation = settings._animation || settings.animation;

                setTimeout(function () {
                    $(elem)
                        .removeClass('elementor-invisible eead-hscroll-elem-hidden')
                        .addClass(animation + ' animated');
                }, delay);
            });
        };

        self.getScrollOffset = function (item) {
            if (!$(item).length) return;
            return $(item).data('scroll-offset');
        };

        self.preventDefault = function (event) {
            if (event.preventDefault) {
                event.preventDefault();
            } else {
                event.returnValue = false;
            }
        };
    };

}(jQuery, window.elementorFrontend));