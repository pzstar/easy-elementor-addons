; (function ($, elementor) {
    'use strict';
    $(window).on('elementor/frontend/init', function () {
        let ModuleHandler = elementorModules.frontend.handlers.Base,
            AdvancedTileScroll;

        AdvancedTileScroll = ModuleHandler.extend({
            bindEvents: function () {
                this.run();
            },
            getDefaultSettings: function () {
                return {
                    allowHTML: true,
                };
            },

            settings: function (key) {
                return this.getElementSettings('eead_advanced_tile_scroll_' + key);
            },

            run: function () {
                var tileScroll_ID = 'eead-advanced-tile-scroll-container-' + this.$element.data('id'),
                    widgetID = this.$element.data('id'),
                    widgetContainer = $('.elementor-element-' + widgetID);


                if (this.settings('show') == 'yes') {
                    if ($('#' + tileScroll_ID).length === 0) {
                        let display = this.settings('display');
                        var $content = `
                        <div id="${tileScroll_ID}" class="eead-advanced-tile-scroll eead-advanced-tile-scroll--${display}">
                            <div class="eead-advanced-tile-scroll__wrap">`;

                            $.each(this.settings('elements'), function(index, element) {
                                let images = element.eead_advanced_tile_scroll_images;
                                let x_start = element.eead_advanced_tile_scroll_x_start.size;
                                let x_end = element.eead_advanced_tile_scroll_x_end.size;

                                if (display === 'horizontal') {
                                    var parallax = 'uk-parallax="target: .elementor-element-' + widgetID + '; viewport: 1.1; x:' + x_start + ',' + x_end + '"';
                                } else {
                                    var parallax = 'uk-parallax="y:' + x_start + ',' + x_end + '"';
                                }

                                $content += `<div class="eead-advanced-tile-scroll__line" ${parallax}>`;

                                $.each(images, function(index, image) {
                                    $content += `<div class=" eead-advanced-tile-scroll__line-img" style="background-image:url(${image.url})" loading="lazy"></div>`;
                                });

                                $content += `</div>`;
                            });

                        $content += `</div></div>`;

                        $(widgetContainer).prepend($content);
                    }
                }
            }
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/section', function ($scope) {

            if (!$scope.hasClass("eead-advanced-tile-scroll-yes")) {
                return;
            }

            elementorFrontend.elementsHandler.addHandler(AdvancedTileScroll, {
                $element: $scope
            });
        });
    });
}) (jQuery, window.elementorFrontend);
