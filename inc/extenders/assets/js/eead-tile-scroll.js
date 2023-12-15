(function ($) {
    'use strict';
    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction('frontend/element_ready/section', function ($scope) {
            var $section = $($scope);
            var $sectionID = $section.data('id');

            if (!$section.hasClass('eead-tile-scroll-yes')) {
                return;
            }

            var tileSectionSelector = '.eead-tile-section-' + $sectionID;
            var tileSectionSelectorDetach = $section.siblings(tileSectionSelector).detach();
            $section.prepend(tileSectionSelectorDetach);
        });
    });
}(jQuery));