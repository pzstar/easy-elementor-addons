(function ($, elementor) {
    "use strict";
    var EEA = {

        init: function () {

            var widgets = {
                'eead-image-comparison-block.default': EEA.imageComparison,
                'eead-switcher-block.default': EEA.switcherBlock,
                'eead-accordion-block.default': EEA.accordionBlock,
                'eead-animated-heading-block.default': EEA.animatedHeading,
                'eead-business-hour-block.default': EEA.businessHours,
                'eead-scroll-image-block.default': EEA.scrollImage,
                'eead-horizontal-timeline.default': EEA.horizontalTimelineCarousel,
                'eead-image-gallery-block.default': EEA.imageGallery,
                'eead-video-player-block.default': EEA.videoPlayer,
                'eead-circular-progressbar.default': EEA.circularProgressBar,
                'eead-progressbar-block.default': EEA.progressBar,
                'eead-vertical-tab-block.default': EEA.verticalTabsBlock,
                'eead-horizontal-tab-block.default': EEA.horizontalTabsBlock,
                'eead-counter-block.default': EEA.counterBlock,
                'eead-portfolio-block.default': EEA.portfolioBlock,
                'eead-advanced-icon-box-block.default': EEA.advancedIconBox,
                'eead-one-page-nav.default': EEA.onePageNav,
                'eead-toggle-block.default': EEA.toggleBlock,
                'eead-team-member-carousel-block.default': EEA.teamMemberCarouselBlock,
                'eead-pie-chart-block.default': EEA.pieChart,
                'eead-logo-carousel-block.default': EEA.logoCarousel,
                'eead-testimonial-slider-block.default': EEA.testimonialSlider,
                'eead-slider-block.default': EEA.sliderBlock,
                'eead-popup-modal-block.default': EEA.popupModal,
                'eead-countdown.default': EEA.countdown,
                'eead-image-accordion.default': EEA.imageAccordion,
                'eead-twitter-feed-carousel.default': EEA.twitterFeedCarousel,
                'eead-sticky-video-block.default': EEA.stickyVideo,
                'eead-advanced-map.default': EEA.advancedMap,
                'eead-threesixty-image.default': EEA.threesixtyImage,
                'eead-offcanvas-header.default': EEA.offcanvasHeader,
                'eead-popup-video-block.default': EEA.popupVideo,
                'eead-filterable-gallery.default': EEA.filterableGallery,
                'eead-hotspot-block.default': EEA.hotspotBlock,
            };

            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });

            elementor.hooks.addAction('frontend/element_ready/column', EEA.elementorColumn);

            if (elementorFrontend.isEditMode() == true) {

                elementor.hooks.addAction("panel/open_editor/widget/eead-sticky-video-block", function (panel, model, view) {
                    var interval;
                    model.attributes.settings.on("change:eead_sticky_width", function () {
                        clearTimeout(interval);
                        interval = setTimeout(function () {
                            var height = Math.ceil(model.getSetting("eead_sticky_width") / 1.78);
                            model.attributes.settings.attributes.eead_sticky_height = height;
                            panel.el.querySelector('[data-setting="eead_sticky_height"]').value = height;
                        }, 250);
                    });
                    model.attributes.settings.on("change:eead_sticky_height", function () {
                        clearTimeout(interval);
                        interval = setTimeout(function () {
                            var width = Math.ceil(model.getSetting("eead_sticky_height") * 1.78);
                            model.attributes.settings.attributes.eead_sticky_width = width;
                            panel.el.querySelector('[data-setting="eead_sticky_width"]').value = width;
                        }, 250);
                    });
                });
            }

        },

        hotspotBlock: function ($scope) {
            if ($scope.find('.eead-hotspot-section').hasClass('eead-open-onclick')) {
                $scope.find('.eead-hotspot-section .eead-hotspot-item a').on('click', function () {
                    $(this).toggleClass('active');
                });

                $(document).on('mouseup', function (e) {
                    var container = $(".eead-hotspot-item");
                    if (!container.is(e.target) && container.has(e.target).length === 0) {
                        container.find('a.active').removeClass('active');
                    }
                });
            } else {
                $scope.find('.eead-hotspot-section:not(.eead-open-onclick) .eead-hotspot-item a').hover(
                        function () {
                            $(this).addClass('active');
                        },
                        function () {
                            $(this).removeClass('active');
                        }
                );
            }
        },

        filterableGallery: function ($scope) {
            var filterControls = $scope.find(".fg-layout-3-filter-controls").eq(0),
                    filterTrigger = $scope.find("#fg-filter-trigger"),
                    form = $scope.find(".fg-layout-3-search-box"),
                    input = $scope.find("#fg-search-box-input"),
                    searchRegex,
                    buttonFilter,
                    timer;

            if (form.length) {
                form.on("submit", function (e) {
                    e.preventDefault();
                });
            }

            filterTrigger.on("click", function () {
                filterControls.toggleClass("open-filters");
            });

            filterTrigger.on("blur", function () {
                filterControls.removeClass("open-filters");
            });

            if (elementorFrontend.isEditMode() == false) {

                var $gallery = $(".eead-filter-gallery-container", $scope),
                        $settings = $gallery.data("settings"),
                        fg_items = $gallery.data("gallery-items"),
                        $layout_mode = $settings.grid_style === "masonry" ? "masonry" : "fitRows",
                        $gallery_enabled = $settings.gallery_enabled === "yes",
                        $init_show_setting = $gallery.data("init-show");
                fg_items.splice(0, $init_show_setting);

                var gwrap = $(".eead-filter-gallery-wrapper");
                var layoutMode = gwrap.data("layout-mode");
                var mfpCaption = gwrap.data("mfp_caption");

                // setup isotope
                var $isotope_gallery = $gallery.isotope({
                    itemSelector: ".eead-filterable-gallery-item-wrap",
                    layoutMode: $layout_mode,
                    percentPosition: true,
                    stagger: 30,
                    transitionDuration: $settings.duration + "ms",
                    filter: function filter() {
                        var $this = $(this);
                        var $result = searchRegex ? $this.text().match(searchRegex) : true;

                        if (buttonFilter === undefined) {
                            if (layoutMode !== "layout_3") {
                                buttonFilter = $scope.find(".eead-filter-gallery-control ul li").first().data("filter");
                            } else {
                                buttonFilter = $scope.find(".fg-layout-3-filter-controls li").first().data("filter");
                            }
                        }
                        var buttonResult = buttonFilter ? $this.is(buttonFilter) : true;
                        return $result && buttonResult;
                    }
                });

                // Init Magnific Popup
                $($scope).magnificPopup({
                    delegate: ".eead-magnific-link",
                    type: "image",
                    gallery: {
                        enabled: $gallery_enabled
                    },
                    image: {
                        titleSrc: function titleSrc(item) {
                            if (mfpCaption === "yes") {
                                return item.el.parents('.gallery-item-caption-over').find('.fg-item-title').html() || item.el.parents('.gallery-item-caption-wrap').find('.fg-item-title').html() || item.el.parents('.eead-filterable-gallery-item-wrap').find('.fg-item-title').html();
                            }
                        }
                    }
                });

                // filter
                $scope.on("click", ".control", function () {
                    var $this = $(this);
                    buttonFilter = $(this).attr("data-filter");
                    var $tspan = $scope.find("#fg-filter-trigger > span");

                    if ($tspan.length) {
                        $tspan.text($this.text());
                    }
                    var LoadMoreShow = $(this).data("load-more-status"),
                            loadMore = $(".eead-gallery-load-more", $scope);

                    //hide load more button if no item to show
                    if (LoadMoreShow || fg_items.length < 1) {
                        loadMore.hide();
                    } else {
                        loadMore.show();
                    }
                    $this.siblings().removeClass("active");
                    $this.addClass("active");
                    $isotope_gallery.isotope();
                });

                //quick search
                input.on("input", function () {
                    var $this = $(this);
                    clearTimeout(timer);
                    timer = setTimeout(function () {
                        searchRegex = new RegExp($this.val(), "gi");
                        $isotope_gallery.isotope();
                    }, 600);
                });

                // layout gal, while images are loading
                $isotope_gallery.imagesLoaded().progress(function () {
                    $isotope_gallery.isotope("layout");
                });

                // layout gal, on click tabs
                $isotope_gallery.on("arrangeComplete", function () {
                    $isotope_gallery.isotope("layout");
                });

                // layout gal, after window loaded
                $(window).on("load", function () {
                    $isotope_gallery.isotope("layout");
                });

                // Load more button
                $scope.on("click", ".eead-gallery-load-more", function (e) {
                    e.preventDefault();
                    var $this = $(this),
                            $init_show = $(".eead-filter-gallery-container", $scope).children(".eead-filterable-gallery-item-wrap").length,
                            $total_items = $gallery.data("total-gallery-items"),
                            $images_per_page = $gallery.data("images-per-page"),
                            $nomore_text = $gallery.data("nomore-item-text"),
                            filter_enable = $(".eead-filter-gallery-control", $scope).length,
                            $items = [];
                    var filter_name = $(".eead-filter-gallery-control li.active", $scope).data('filter');

                    if (filterControls.length > 0) {
                        filter_name = $(".fg-layout-3-filter-controls li.active", $scope).data('filter');
                    }

                    var item_found = 0;
                    var index_list = [];
                    var _iterator = _createForOfIteratorHelper(fg_items.entries()),
                            _step;

                    try {
                        for (_iterator.s(); !(_step = _iterator.n()).done; ) {
                            var _step$value = _slicedToArray(_step.value, 2),
                                    index = _step$value[0],
                                    item = _step$value[1];
                            if (filter_name !== '' && filter_name !== '*' && filter_enable) {
                                var element = $($(item)[0]);
                                if (element.is(filter_name)) {
                                    ++item_found;
                                    $items.push($(item)[0]);
                                    index_list.push(index);
                                }
                                if (fg_items.length - 1 === index) {
                                    $(".eead-filter-gallery-control li.active", $scope).data('load-more-status', 1);
                                    $this.hide();
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
                    } catch (err) {
                        _iterator.e(err);
                    } finally {
                        _iterator.f();
                    }

                    if (index_list.length > 0) {
                        fg_items = fg_items.filter(function (item, index) {
                            return !index_list.includes(index);
                        });
                    }

                    if (fg_items.length < 1) {
                        $this.html('<div class="no-more-items-text">' + $nomore_text + "</div>");
                        setTimeout(function () {
                            $this.fadeOut("slow");
                        }, 600);
                    }

                    // append items
                    $gallery.append($items);
                    $isotope_gallery.isotope("appended", $items);
                    $isotope_gallery.imagesLoaded().progress(function () {
                        $isotope_gallery.isotope("layout");
                    });
                });

                // Safari: hide filter menu
                $(document).on('mouseup', function (e) {

                    if (!filterTrigger.is(e.target) && filterTrigger.has(e.target).length === 0) {
                        filterControls.removeClass("open-filters");
                    }
                });
            }

            function _slicedToArray(arr, i) {
                return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest();
            }

            function _nonIterableRest() {
                throw new TypeError("Invalid attempt to destructure non-iterable instance.In order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
            }
            function _iterableToArrayLimit(arr, i) {
                if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr)))
                    return;

                var _arr = [];
                var _n = true;
                var _d = false;
                var _e = undefined;
                try {
                    for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) {
                        _arr.push(_s.value);
                        if (i && _arr.length === i)
                            break;
                    }
                } catch (err) {
                    _d = true;
                    _e = err;
                } finally {
                    try {
                        if (!_n && _i["return"] != null)
                            _i["return"]();
                    } finally {
                        if (_d)
                            throw _e;
                    }
                }
                return _arr;
            }

            function _arrayWithHoles(arr) {
                if (Array.isArray(arr))
                    return arr;
            }
            function _createForOfIteratorHelper(o, allowArrayLike) {
                var it;
                if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) {
                    if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") {
                        if (it)
                            o = it;
                        var i = 0;
                        var F = function F() {};
                        return {
                            s: F,
                            n: function n() {
                                if (i >= o.length)
                                    return {
                                        done: true
                                    };
                                return {
                                    done: false,
                                    value: o[i++]
                                };
                            },
                            e: function e(_e2) {
                                throw _e2;
                            }, f: F
                        };
                    }
                    throw new TypeError("Invalid attempt to iterate non-iterable instance.In order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
                }
                var normalCompletion = true,
                        didErr = false,
                        err;
                return {
                    s: function s() {
                        it = o[Symbol.iterator]();
                    },
                    n: function n() {
                        var step = it.next();
                        normalCompletion = step.done;
                        return step;
                    },
                    e: function e(_e3) {
                        didErr = true;
                        err = _e3;
                    },
                    f: function f() {
                        try {
                            if (!normalCompletion && it["return"] != null)
                                it["return"]();
                        } finally {
                            if (didErr)
                                throw err;
                        }
                    }
                };
            }

            function _unsupportedIterableToArray(o, minLen) {
                if (!o)
                    return;
                if (typeof o === "string")
                    return _arrayLikeToArray(o, minLen);
                var n = Object.prototype.toString.call(o).slice(8, -1);
                if (n === "Object" && o.constructor)
                    n = o.constructor.name;
                if (n === "Map" || n === "Set")
                    return Array.from(o);
                if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))
                    return _arrayLikeToArray(o, minLen);
            }

            function _arrayLikeToArray(arr, len) {
                if (len == null || len > arr.length)
                    len = arr.length;

                for (var i = 0, arr2 = new Array(len); i < len; i++) {
                    arr2[i] = arr[i];
                }
                return arr2;
            }
        },

        popupVideo: function ($scope) {
            $(document).ready(function () {
                if ($(".eead-video-popup").length > 0 &&
                        $(".eead-video-popup").magnificPopup({type: "iframe", mainClass: "mfp-fade", removalDelay: 160, preloader: !0, fixedContentPos: !1}) &&
                        $("#wp-admin-bar-elementor_edit_page-default").length > 0)
                {
                    let t = $("#wp-admin-bar-elementor_edit_page-default").children("li");
                    $(t).map(function (t, n) {
                        var i = $(n).find(".elementor-edit-link-title");
                        -1 !== i.text().indexOf("dynamic-content-") && i.parent().parent().remove();
                    });
                }
            });
        },

        offcanvasHeader: function ($scope) {
            var t = $scope.find(".ekit-sidebar-group");
            $scope.find(".ekit_offcanvas-sidebar, .ekit_close-side-widget, .ekit-overlay").on("click", function (e) {
                e.preventDefault();
                t.toggleClass("ekit_isActive");
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
                    if (style.indexOf("block") !== -1) {
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

        advancedMap: function ($scope) {
            var map = new_map($scope.find('.eead-markers'));

            function new_map($el) {
                var zoom = $el.data('zoom');
                var scrollwheel = $el.data('scrollwheel') ? true : false;
                var zoomControl = $el.data('zoomcontrol') ? true : false;
                var fullscreenControl = $el.data('fullscreencontrol') ? true : false;
                var streetViewControl = $el.data('streetviewcontrol') ? true : false;
                var mapTypeControl = $el.data('maptypecontrol') ? true : false;
                var gestureHandling = $el.data('gesturehandling') ? $el.data('gesturehandling') : null;
                var $markers = $el.find('.marker');
                var styles = $el.data('style');
                var prevent_scroll = $el.data('scroll');

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
                var animate = $marker.data('animate');
                var info_window_onload = $marker.data('show-info-window-onload');
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
                    animation: google.maps.Animation.DROP
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
                if ($marker.html())
                {
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
                if (map.markers.length == 1)
                {
                    map.setCenter(bounds.getCenter());
                    map.setZoom(zoom);
                } else {
                    map.fitBounds(bounds);
                }
            }
        },

        stickyVideo: function ($scope) {


            $(".eead-sticky-player-close", $scope).hide();
            var element = $scope.find(".eead-sticky-video-player2");

            var eeadDomHeight = 0;
            var videoIsActive = "off";
            var sticky = element.data("sticky") ? element.data("sticky") : '';
            var autoplay = element.data("autoplay") ? element.data("autoplay") : '';
            var overlay = element.data("overlay") ? element.data("overlay") : '';
            var eeadPosition = element.data("position") ? element.data("position") : '';
            var eeadHeight = element.data("sheight") ? element.data("sheight") : 0;
            var eeadWidth = element.data("swidth") ? element.data("swidth") : 0;
            var scrollHeight = element.data("scroll_height") ? element.data("scroll_height") : 0;
            PositionStickyPlayer(eeadPosition, eeadHeight, eeadWidth);
            var playerAbc = new Plyr("#eead-player-" + $scope.data("id"));

            if (overlay === "no") {
                if (sticky === "yes") {
                    eeadDomHeight = GetDomElementHeight(element);
                    element.attr("id", "videobox");
                    videoIsActive = "on"; // When play event is cliked

                    // Do the sticky video
                    PlayerPlay(playerAbc, element);
                }
            }


            if (overlay === "yes" && autoplay === "yes") {
                var overlayElm = element.prev();
                videoIsActive = "off";
                $(".eead-sticky-video-wrapper > i").hide();
                overlayElm.css("display", "none");
                playerAbc.play();

                if (sticky === "yes") {
                    eeadDomHeight = GetDomElementHeight(element);
                    element.attr("id", "videobox");
                    videoIsActive = "on"; // When play event is cliked

                    // Do the sticky video
                    PlayerPlay(playerAbc, element);
                }
            } else if (overlay === "yes") {
                var overlayElm = element.prev();
                videoIsActive = "off";
                $(overlayElm).on("click", function () {
                    $(".eead-sticky-video-wrapper > i").hide();
                    $(this).css("display", "none");
                    playerAbc.play();

                    if (sticky === "yes") {
                        eeadDomHeight = GetDomElementHeight(element);
                        element.attr("id", "videobox");
                        videoIsActive = "on"; // When play event is cliked

                        // Do the sticky video
                        PlayerPlay(playerAbc, element);
                    }
                });
            }

            playerAbc.on("pause", function (event) {
                videoIsActive = "off";
            });
            playerAbc.on("play", function (event) {
                element.closest(".eead-sticky-video-player2").find(".plyr__poster").hide();
                videoIsActive = "on";
            });
            $(".eead-sticky-player-close").on("click", function () {
                element.removeClass("out").addClass("in");
                $(".eead-sticky-video-player2").removeAttr("style");
                videoIsActive = "off";
            });
            element.parent().css("height", element.height() + "px");
            $(window).resize(function () {
                element.parent().css("height", element.height() + "px");
            });


            jQuery(window).scroll(function () {
                var scrollTop = jQuery(window).scrollTop();
                var scrollBottom = jQuery(document).height() - scrollTop;

                if (scrollBottom > jQuery(window).height() + 400) {
                    if (scrollTop >= eeadDomHeight) {
                        if (videoIsActive == "on") {
                            jQuery("#videobox").find(".eead-sticky-player-close").css("display", "block");
                            jQuery("#videobox").removeClass("in").addClass("out");
                            PositionStickyPlayer(eeadPosition, eeadHeight, eeadWidth);
                        }
                    } else {
                        jQuery(".eead-sticky-player-close").hide();
                        jQuery("#videobox").removeClass("out").addClass("in");
                        jQuery(".eead-sticky-video-player2").removeAttr("style");
                    }
                }
            });

            function GetDomElementHeight(elemt) {
                var contentHeight = jQuery(elemt).parent().height();
                var expHeight = scrollHeight * contentHeight / 100;
                var height = jQuery(elemt).parent().offset().top + expHeight;
                return height;
            }

            function PositionStickyPlayer(p, h, w) {
                if (p == "top-left") {
                    jQuery(".eead-sticky-video-player2.out").css({"top": "40px", "left": "40px"});
                }

                if (p == "top-right") {
                    jQuery(".eead-sticky-video-player2.out").css({"top": "40px", "right": "40px"});
                }

                if (p == "bottom-right") {
                    jQuery(".eead-sticky-video-player2.out").css({"bottom": "40px", "right": "40px"});
                }

                if (p == "bottom-left") {
                    jQuery(".eead-sticky-video-player2.out").css({"bottom": "40px", "left": "40px"});
                }

                jQuery(".eead-sticky-video-player2.out").css({"width": w + "px", "height": h + "px"});
            }

            function PlayerPlay(a, b) {
                a.on("play", function (event) {
                    eeadDomHeight = GetDomElementHeight(b);
                    jQuery(".eead-sticky-video-player2").removeAttr("id");
                    jQuery(".eead-sticky-video-player2").removeClass("out");
                    b.attr("id", "videobox");
                    videoIsActive = "on";
                    eeadPosition = b.data("position");
                    eeadHeight = b.data("sheight");
                    eeadWidth = b.data("swidth");
                });
            }
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

        imageAccordion: function ($scope) {

            var imageAccordion = $scope.find(".eead-img-accordion").eq(0),
                    id = imageAccordion.data("img-accordion-id") !== undefined ? imageAccordion.data("img-accordion-id") : "",
                    type = imageAccordion.data("img-accordion-type") !== undefined ? imageAccordion.data("img-accordion-type") : "",
                    click_count = 0,
                    image_accordion_hover_element_id = "#eead-img-accordion-" + id + " .eead-image-accordion-hover";

            if (type === "on_click")
            {
                $(image_accordion_hover_element_id).on("click", function (e) {

                    var $this = $(this);

                    if (!$(this).hasClass("overlay-active"))
                    {
                        e.preventDefault();
                    }

                    $(image_accordion_hover_element_id, $scope).removeClass("overlay-active");

                    if (click_count == 0)
                    {
                        if ($(image_accordion_hover_element_id).hasClass('overlay-active'))
                        {
                            $(image_accordion_hover_element_id).removeClass("overlay-active");
                        }
                        click_count++;
                    }

                    $(image_accordion_hover_element_id).css("flex", "1");

                    $this.find(".overlay").parent(".eead-image-accordion-hover").addClass("overlay-active");
                    $(image_accordion_hover_element_id).find(".overlay-inner").removeClass("overlay-inner-show");
                    $this.find(".overlay-inner").addClass("overlay-inner-show");
                    $this.css("flex", "3");
                });
            } else {
                $(image_accordion_hover_element_id).on('hover', function () {
                    if ($(image_accordion_hover_element_id).hasClass('overlay-active'))
                    {
                        $(image_accordion_hover_element_id + ".overlay-active").css("flex", "1");
                        $(image_accordion_hover_element_id).removeClass("overlay-active");
                        $(image_accordion_hover_element_id + " .overlay .overlay-inner").removeClass('overlay-inner-show');
                    }
                });
            }
        },

        countdown: function ($scope) {
            var $coundDown = $scope.find(".eead-countdown-wrapper").eq(0),
                    $countdown_id = $coundDown.data("countdown-id") !== "" ? $coundDown.data("countdown-id") : "",
                    $expire_type = $coundDown.data("expire-type") !== "" ? $coundDown.data("expire-type") : "",
                    $expiry_text = $coundDown.data("expiry-text") !== "" ? $coundDown.data("expiry-text") : "",
                    $expiry_title = $coundDown.data("expiry-title") !== "" ? $coundDown.data("expiry-title") : "",
                    $redirect_url = $coundDown.data("redirect-url") !== "" ? $coundDown.data("redirect-url") : "";

            var countDown = $("#eead-countdown-" + $countdown_id);
            countDown.countdown({
                end: function end() {
                    if ($expire_type == "text") {
                        countDown.html('<div class="eead-countdown-finish-message"><h4 class="expiry-title">' + $expiry_title + "</h4>" + '<div class="eead-countdown-finish-text">' + $expiry_text + "</div></div>");
                    } else if ($expire_type === "url") {
                        window.location.href = $redirect_url;
                    }
                }
            });

        },

        popupModal: function ($scope) {
            var $open = $scope.find('.eead-popup-modal-trigger');

            $open.on('click', function () {
                var $id = $(this).data('id');

                MicroModal.show('eead-popup-modal-' + $id, {
                    awaitCloseAnimation: true,
                    openClass: 'open',
                    disableScroll: true,
                })
            });

            $scope.find(".eead-popup-modal-container.modal__container").mCustomScrollbar({
                scrollInertia: 500,
                axis: "y",
                autoDraggerLength: true,
            });
        },

        sliderBlock: function ($scope) {

            var $ele = $scope.find('.eead-slider');

            if ($ele.find('.eead-slide').length > 0)
            {
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

        logoCarousel: function ($scope) {
            var $ele = $scope.find('.eead-logo-carousel');
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

        pieChart: function ($scope) {

            var $container = $scope.find('.eead-pie-chart-container'),
                    $canvas = $scope.find('.eead-pie-chart')[0],
                    data = $container.data('chart') || {},
                    options = $container.data('options') || {};

            var chartInstance = new Chart($canvas, {
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

        toggleBlock: function ($scope, $) {
            var $el = $scope.find('.eead-toggle-container').eq(0),
                    $toggle_switch_container = $el.find('.eead-toggle-switch-container'),
                    $toggle_switch = $el.find('.eead-toggle-switch'),
                    $label_primary = $el.find('.eead-primary-toggle-label'),
                    $label_secondary = $el.find('.eead-secondary-toggle-label'),
                    $section_primary = $el.find('.eead-toggle-section-primary'),
                    $section_secondary = $el.find('.eead-toggle-section-secondary');

            $toggle_switch.on('click', function () {
                $section_primary.toggle(0, 'swing', function () {
                    $toggle_switch_container.toggleClass('eead-toggle-switch-on');
                });

                $section_secondary.toggle();

                if ($label_primary.hasClass('eead-toggle-active')) {
                    $label_primary.removeClass('eead-toggle-active');
                    $label_secondary.addClass('eead-toggle-active');
                } else {
                    $label_primary.addClass('eead-toggle-active');
                    $label_secondary.removeClass('eead-toggle-active');
                }
            });

            $label_primary.on('click', function () {
                $toggle_switch.prop('checked', false);
                $toggle_switch_container.removeClass('eead-toggle-switch-on');
                $(this).addClass('eead-toggle-active');
                $label_secondary.removeClass('eead-toggle-active');
                $section_primary.show();
                $section_secondary.hide();
            });

            $label_secondary.on('click', function () {
                $toggle_switch.prop('checked', true);
                $toggle_switch_container.addClass('eead-toggle-switch-on');
                $(this).addClass('eead-toggle-active');
                $label_primary.removeClass('eead-toggle-active');
                $section_secondary.show();
                $section_primary.hide();
            });
        },

        onePageNav: function ($scope) {

            var nav_el = $scope.find('.eead-one-page-nav').eq(0);

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
                $('.elementor-section').each(function () {
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

        advancedIconBox: function ($scope) {
            var $divider = $scope.find('.eead-advanced-icon-box'),
                    divider = $($divider).find('.eead-title-separator-wrapper > img');

            if ($divider.length) {
                elementorFrontend.waypoint(divider, function () {
                    UIkit.svg(this, {
                        strokeAnimation: true
                    });
                }, {
                    offset: 'bottom-in-view'
                });
            }
            return;
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

        counterBlock: function ($scope) {
            var $ele = $scope.find('.eead-counter-container');
            $ele.waypoint(function () {
                $ele.each(function () {
                    var $odometer = $(this).find('.odometer');
                    setTimeout(function () {
                        $odometer.html($odometer.data('count'));
                    }, 1000);
                });
                this.destroy();
            }, {
                offset: '90%'
            });
        },

        horizontalTabsBlock: function ($scope) {
            $scope.find('.eead-each-content').eq(0).fadeIn();
            $scope.find('.eead-horizontal-tab-section').on('click', '.eead-tab', function () {
                var $tab_id = $(this).data('tabid');
                if ($tab_id) {
                    $scope.find('.eead-tab').removeClass('active');
                    $(this).addClass('active');

                    $scope.find('.eead-each-content').removeClass('eead-active');
                    $scope.find('.eead-tab-content').find('.eead-content-' + $tab_id).addClass('eead-active');
                    $scope.find('.eead-each-content').hide();
                    $scope.find('.eead-tab-content').find('.eead-content-' + $tab_id).fadeIn();
                }
            });
        },

        verticalTabsBlock: function ($scope) {
            $scope.find('.eead-vertical-tab-section').on('click', '.eead-tab', function () {
                var $tab_id = $(this).data('tabid');
                if ($tab_id) {
                    $scope.find('.eead-tab').removeClass('active');
                    $(this).addClass('active');

                    $scope.find('.eead-each-content').hide();
                    $scope.find('.eead-tab-content').find('.eead-content-' + $tab_id).fadeIn();
                }
            });
        },

        circularProgressBar: function ($scope) {
            var container = $scope.find('.eead-circular-progressbar');
            var number = container.attr("data-number");
            var math = 440 - (440 * number) / 100;
            if ((container.length > 0)) {
                container.waypoint(function () {
                    setTimeout(function () {
                        container.find('.eead-circular-progressbar-box .percent svg circle:nth-child(2)').css({
                            'stroke-dashoffset': math
                        }, 1000);
                    }, 400);
                    this.destroy();
                }, {
                    offset: '90%',
                });
            }
        },

        progressBar: function ($scope) {
            var $el = $scope.find('.eead-progress-bar');
            if (($el.length > 0)) {
                $el.each(function (index) {
                    var $this = $(this);
                    var delay_time = parseInt(index * 100 + 300);
                    $this.waypoint(function () {
                        setTimeout(function () {
                            $this.find('.eead-progress-bar-length').animate({
                                width: $this.attr("data-width") + '%'
                            }, 1000, function () {
                                $this.find("span").animate({
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

        videoPlayer: function ($scope) {
            var video = $scope.find('.eead-video-block'),
                    videoPlayer = $scope.find('.eead-video-player'),
                    overlay = $scope.find('.eead-video-overlay'),
                    iframe = $scope.find('.eead-video-iframe'),
                    hasOverlay = overlay.length > 0,
                    settings = video.data('settings') || {},
                    autoplay = settings.autoplay || false;

            if (overlay[0]) {
                overlay.on('click.eead-video-block', function (event) {
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
                videoPlayer.on('play.eead-video-block', function (event) {
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

        imageGallery: function ($scope, $) {
            var $gallery_container = $scope.find('.eead-image-gallery-container').eq(0);
            var $widget_id = $scope.data('id');
            var $gallery = $scope.find('.eead-image-gallery-wrapper').eq(0);
            var $settings = $gallery_container.data('settings');

            if ($settings.layout == 'masonry' || $settings.layout == 'grid') {
                var layout = $settings.layout == 'grid' ? 'fitRows' : 'masonry';

                var $isotope_args = {
                    itemSelector: '.eead-gallery-item',
                    layoutMode: layout,
                    percentPosition: true,
                },
                        $isotope_gallery = {};

                $scope.imagesLoaded(function () {
                    $isotope_gallery = $gallery.isotope($isotope_args);
                    $gallery.find('.eead-gallery-image').on('load', function () {
                        if ($(this).hasClass('lazyloaded')) {
                            return;
                        }
                        setTimeout(function () {
                            $gallery.isotope('layout');
                        }, 1000);
                    });
                });


                $scope.on('click', '.eead-gallery-filter', function () {
                    var $this = $(this),
                            filterValue = $this.attr('data-filter'),
                            filter_index = $this.attr('data-gallery-index'),
                            $gallery_items = $gallery.find(filterValue);

                    $this.siblings().removeClass('eead-active');
                    $this.addClass('eead-active');

                    $isotope_gallery.isotope({filter: filterValue});
                });

                $scope.find('.eead-gallery-lightbox').on('click', function () {
                    $gallery.lightGallery({
                        selector: '.eead-gallery-lightbox',
                        thumbnail: false
                    });
                    $gallery.data('lightGallery').destroy(true);
                });
            }
        },

        horizontalTimelineCarousel: function ($scope) {
            var $element = $scope.find('.eead-htimeline-lists');

            $scope.find(".eead-horizontal-timeline-scrollbar").mCustomScrollbar({
                theme: "dark",
                scrollInertia: 500,
                axis: "x",
                advanced: {autoExpandHorizontalScroll: true}
            });
        },

        scrollImage: function ($scope) {
            var gallery = $scope.find('.eead-scroll-image-lightbox-item');
            gallery.on('click', function () {
                gallery.lightGallery({
                    selector: 'this',
                    thumbnail: false
                });
            });

            $scope.find('.eead-scroll-image-iframe-modal').lightGallery({
                selector: 'this'
            });
        },

        businessHours: function ($scope) {
            var $container = $scope.find('.eead-business-hour-section');
            var $businessHours = $container.find('.eead-current-time');

            if (!$container.length) {
                return;
            }

            var $settings = $container.data('settings');
            var dynamic_timezone = $settings.dynamic_timezone;
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
                $($container).find('.eead-current-time').jclock(options);

            });
        },

        animatedHeading: function ($scope, $) {
            var $heading = $scope.find('.eead-animated-heading-wrap > *'),
                    $animatedHeading = $scope.find('.eead-animated-heading'),
                    $settings = $scope.find('.eead-animated-heading').data('settings');

            if (!$heading.length) {
                return;
            }

            if ($settings.layout === 'animated') {
                $($animatedHeading).Morphext($settings);
            } else if ($settings.layout === 'typed') {
                var animateSelector = $($animatedHeading).attr('id');
                var typed = new Typed('#' + animateSelector, $settings);
            }

            $($heading).animate({
                easing: 'slow',
                opacity: 1
            }, 500);
        },

        accordionBlock: function ($scope) {

            var accordion = $scope.find('.eead-each-accordion');
            var windowsize = window.innerWidth;

            if (accordion.length > 0) {
                $scope.find('.eead-accordion-title-section').each(function () {
                    var eachTitle = $(this);
                    var eachHeight = JSON.parse(eachTitle.attr('data-height'));

                    // Check If active on windows load
                    if (eachTitle.hasClass('active')) {
                        if (windowsize > 768) {
                            eachTitle.next().css({'height': eachHeight.content_height + 'px'});
                        } else if (windowsize > 480) {
                            eachTitle.next().css({'height': eachHeight.content_height_tablet + 'px'});
                        } else {
                            eachTitle.next().css({'height': eachHeight.content_height_mobile + 'px'});
                        }

                    }

                    // On Accordion Click
                    eachTitle.on('click', function () {
                        var content = $(this).parent().find('.eead-accordion-content');
                        var height = JSON.parse($(this).attr('data-height'));
                        if (!$(this).hasClass('active')) {
                            $(this).addClass('active');
                            // content.css({ 'height': height+'px' });
                            if (windowsize > 768) {
                                content.css({'height': height.content_height + 'px'});
                            } else if (windowsize > 480) {
                                content.css({'height': height.content_height_tablet + 'px'});
                            } else {
                                content.css({'height': height.content_height_mobile + 'px'});
                            }
                        } else {
                            $(this).removeClass('active');
                            content.css({'height': '0px'});
                        }
                    });
                });
            }

        },

        switcherBlock: function ($scope) {
            $scope.find('.eead-switch-tab').on('click', function () {
                $scope.find('.eead-switch-tab').removeClass('active');
                $scope.find('.eead-switcher-inner-wrap').find('.eead-switch-content').removeClass('active');
                $scope.find('.eead-switcher-inner-wrap').find('.eead-switch-content').hide();
                if ($(this).hasClass('eead-switch-a')) {
                    $(this).addClass('active');
                    $(this).closest('.eead-switcher-inner-wrap').find('.eead-switch-a-content').addClass('active');
                    $(this).closest('.eead-switcher-inner-wrap').find('.eead-switch-a-content').fadeIn();
                } else if ($(this).hasClass('eead-switch-b')) {
                    $(this).addClass('active');
                    $(this).closest('.eead-switcher-inner-wrap').find('.eead-switch-b-content').addClass('active');
                    $(this).closest('.eead-switcher-inner-wrap').find('.eead-switch-b-content').fadeIn();
                }
            });
        },

        imageComparison: function ($scope) {

            var $image_compare_main = $scope.find('.eead-image-compare');
            var $image_compare = $scope.find('.image-compare');

            if (!$image_compare.length) {
                return;
            }

            var $settings = $image_compare.data('settings');

            var
                    default_offset_pct = $settings.default_offset_pct,
                    orientation = $settings.orientation,
                    before_label = $settings.before_label,
                    after_label = $settings.after_label,
                    no_overlay = $settings.no_overlay,
                    on_hover = $settings.on_hover,
                    add_circle_blur = $settings.add_circle_blur,
                    add_circle_shadow = $settings.add_circle_shadow,
                    add_circle = $settings.add_circle,
                    smoothing = $settings.smoothing,
                    smoothing_amount = $settings.smoothing_amount,
                    bar_color = $settings.bar_color,
                    move_slider_on_hover = $settings.move_slider_on_hover;

            var viewers = document.querySelectorAll('#' + $settings.id);

            var options = {

                // UI Theme Defaults
                controlColor: bar_color,
                controlShadow: add_circle_shadow,
                addCircle: add_circle,
                addCircleBlur: add_circle_blur,

                // Label Defaults
                showLabels: no_overlay,
                labelOptions: {
                    before: before_label,
                    after: after_label,
                    onHover: on_hover
                },

                // Smoothing
                smoothing: smoothing,
                smoothingAmount: smoothing_amount,

                // Other options
                hoverStart: move_slider_on_hover,
                verticalMode: orientation,
                startingPoint: default_offset_pct,
                fluidMode: false
            };

            viewers.forEach(function (element) {
                var view = new ImageCompare(element, options).mount();
            });
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
        }
    };
    $(window).on('elementor/frontend/init', EEA.init);
}(jQuery, window.elementorFrontend));