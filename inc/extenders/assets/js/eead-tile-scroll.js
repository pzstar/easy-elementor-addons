; (function ($, elementor) {
$(window).on('elementor/frontend/init', function () {
    let ModuleHandler = elementorModules.frontend.handlers.Base,
        TileScroll;

    TileScroll = ModuleHandler.extend({
        bindEvents: function () {
            this.run();
        },
        getDefaultSettings: function () {
            return {
                allowHTML: true,
            };
        },

        settings: function (key) {
            return this.getElementSettings('eead_tile_scroll_' + key);
        },

        run: function () {
            var tileScroll_ID = 'eead-tile-scroll-container-' + this.$element.data('id'),
                widgetID = this.$element.data('id'),
                widgetContainer = $('.elementor-element-' + widgetID);

            if (this.settings('show') == 'yes') {
                if ($('#' + tileScroll_ID).length === 0) {
                    let display = this.settings('display');
                    var $content = `
                        <div id="${tileScroll_ID}" class="tiles tiles--rotated">
                            <div class="eead_tiles__wrap">`;
                            this.settings('elements').forEach(element => {
                                let images = element.eead_tile_scroll_images;
                                $content += `<div class="tiles__line" data-scroll="" data-scroll-speed="-1" data-scroll-target="${tileScroll_ID}" data-scroll-direction="horizontal">`;
                                images.forEach(image => {
                                    $content += `<div class="eead_tiles__line-img" style="background-image:url(${image.url})"></div>`;
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
        if (!$scope.hasClass("eead-tile-scroll-yes")) {
            return;
        }
        elementorFrontend.elementsHandler.addHandler(TileScroll, {
            $element: $scope
        });
    });
});
}) (jQuery, window.elementorFrontend);
