(function ($) {
    'use strict';
    $(window).on('elementor/frontend/init', function () {

        var eeadGlobalCursorHandler = function ($scope, $) {

            if (!$scope.hasClass('eead-gCursor-yes')) {
                return;
            }

            var $eleType = $scope.data('element_type'),
                $eleId = $scope.data("id"),
                $eleInfo = {},
                settings = {},
                isInnerSection = ('section' === $eleType) ? $scope.hasClass('elementor-inner-section') : $scope.closest('.elementor-section').hasClass('elementor-inner-section'),
                parentClass = (isInnerSection) ? 'inner' : 'top';

            if (isInnerSection) {
                $eleInfo.innerSec = ('section' === $eleType) ? $scope : $scope.closest('.elementor-inner-section');
                $eleInfo.innerSecId = $eleInfo.innerSec.data('id');
                $eleInfo.parentCol = $eleInfo.innerSec.closest('.elementor-top-column');
                $eleInfo.parentColId = $eleInfo.parentCol.data('id');
                $eleInfo.parentSec = $eleInfo.parentCol.closest('.elementor-top-section');
                $eleInfo.parentSecId = $eleInfo.parentSec.data('id');
            }

            if ('section' !== $eleType) {
                $eleInfo.section = $scope.closest('.elementor-' + parentClass + '-section');

                if ('widget' === $eleType) {
                    $eleInfo.col = $scope.closest('.elementor-' + parentClass + '-column');
                }
            }

            $eleInfo.colId = ($eleInfo.col) ? $eleInfo.col.data('id') : '';
            $eleInfo.sectionId = ($eleInfo.section) ? $eleInfo.section.data('id') : '';

            generateSettings($eleType, $eleId);

            if (!settings) {
                return false;
            }

            generateGlobalCursor();

            function generateGlobalCursor() {

                var uniqueClass = 'eead-global-cursor-' + $eleId,
                    cursorHtml = '<div class="eead-global-cursor ' + uniqueClass + settings.pulse + settings.buzz + '">' + getCursorHtml(settings) + '</div>';

                $scope.find("." + uniqueClass).remove();
                $scope.prepend(cursorHtml);

                if ('icon' === settings.cursorType && 'svg' === settings.elementSettings.library) {
                    handleSvgIcon(settings.elementSettings.value.url, $eleId);
                }

                if ('lottie' === settings.cursorType) {
                    var $item = $scope.find('.eead-lottie-animation'),
                        instance = new eeadLottieAnimations($item);
                    instance.init();
                }

                var types = ['icon', 'image', 'lottie'],
                    props = {
                        extraTop: 0,
                        extraLeft: 0,
                        elem: uniqueClass,
                        delay: settings.delay,
                        width: $scope.find('.eead-global-cursor').outerWidth(),
                        height: $scope.find('.eead-global-cursor').outerHeight()
                    };

                if (!types.includes(settings.cursorType)) {
                    props.extraLeft = (settings.elementSettings.xpos / 100) * props.width;
                    props.extraTop = (settings.elementSettings.ypos / 100) * props.height;
                    props.width = 0;
                } else {
                    //We need to make sure the arrow is centered.
                    props.extraLeft = 0.5 * props.width;
                    props.extraTop = 0.5 * props.height;
                }

                $scope.off('mousemove');

                $scope.mousemove(function (e) {

                    $scope.css('cursor', 'default');

                    if ('section' !== $eleType) {
                        $eleInfo.section.find('.eead-global-cursor-' + $eleInfo.sectionId).addClass('eead-cursor-not-active');

                        if ('widget' === $eleType) {
                            $eleInfo.col.find('.eead-global-cursor-' + $eleInfo.colId).addClass('eead-cursor-not-active');
                        }
                    }

                    if (isInnerSection) {
                        $eleInfo.parentCol.find('.eead-global-cursor-' + $eleInfo.parentColId).addClass('eead-cursor-not-active');
                        $eleInfo.parentSec.find('.eead-global-cursor-' + $eleInfo.parentSecId).addClass('eead-cursor-not-active');
                    }

                    if (['iamge', 'fimage'].includes(settings.cursorType)) {
                        $("." + uniqueClass).css('display', 'flex');
                    } else {
                        $("." + uniqueClass).show();
                    }

                    followMouse(e, props);

                }).mouseout(function () {

                    if ('section' !== $eleType) {

                        $eleInfo.section.find('.eead-global-cursor-' + $eleInfo.sectionId).removeClass('eead-cursor-not-active');

                        if ('widget' === $eleType) {
                            $eleInfo.col.find('.eead-global-cursor-' + $eleInfo.colId).removeClass('eead-cursor-not-active');
                        }
                    }

                    if (isInnerSection) {
                        $eleInfo.parentCol.find('.eead-global-cursor-' + $eleInfo.parentColId).removeClass('eead-cursor-not-active');
                        $eleInfo.parentSec.find('.eead-global-cursor-' + $eleInfo.parentSecId).removeClass('eead-cursor-not-active');
                    }
                }).mouseleave(function () {
                    $("." + uniqueClass).hide();
                });

            }

            function getCursorHtml(settings) {
                var cursorHtml = '';

                if ('icon' === settings.cursorType) {
                    if ('svg' !== settings.elementSettings.library) {
                        cursorHtml += '<i class=" eead-cursor-icon-fa ' + settings.elementSettings.value + '"></li>';
                    }

                } else if ('image' === settings.cursorType || 'fimage' === settings.cursorType) {
                    cursorHtml += '<img class="eead-cursor-img" src="' + settings.elementSettings.url + '" alt="' + settings.elementSettings.alt + '">';

                } else if ('ftext' === settings.cursorType) {
                    cursorHtml += '<p class="eead-cursor-follow-text">' + escapeHtml(settings.elementSettings.text) + '</p>';

                } else {
                    cursorHtml += '<div class="eead-lottie-animation eead-cursor-lottie-icon" data-lottie-url="' + settings.elementSettings.url + '" data-lottie-loop="' + settings.elementSettings.loop + '" data-lottie-reverse="' + settings.elementSettings.reverse + '" ></div>';
                }

                return cursorHtml;
            }

            function escapeHtml(unsafe) {
                return unsafe.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(
                    /"/g, "&quot;").replace(/'/g, "&#039;");
            }

            function generateSettings(type, id) {

                var editMode = elementorFrontend.isEditMode(),
                    cursorSettings = {},
                    tempTarget = $scope.find('#eead-global-cursor-' + id),
                    tempTarget2 = $scope.find('#eead-global-cursor-temp-' + id),
                    tempExist = 0 !== tempTarget.length || 0 !== tempTarget2.length,
                    editMode = elementorFrontend.isEditMode() && tempExist;

                if (editMode) {
                    cursorSettings = tempTarget.data('gcursor');

                    if ('widget' === type && !cursorSettings) {
                        cursorSettings = tempTarget2.data('gcursor');
                    }
                } else {
                    cursorSettings = $scope.data('gcursor');

                }

                if (!cursorSettings) {
                    return false;
                }

                settings.cursorType = cursorSettings.cursorType;
                settings.delay = cursorSettings.delay;
                settings.pulse = cursorSettings.pulse;
                settings.buzz = cursorSettings.buzz;
                settings.elementType = type;
                settings.elementSettings = cursorSettings.elementSettings;

                if (0 !== Object.keys(settings).length) {
                    return settings;
                }
            }

            function handleSvgIcon(url, id) {

                var parser = new DOMParser();

                fetch(url)
                    .then(
                        function (response) {
                            if (200 !== response.status) {
                                console.log('Looks like there was a problem loading your svg. Status Code: ' +
                                    response.status);
                                return;
                            }

                            response.text().then(function (text) {
                                var parsed = parser.parseFromString(text, 'text/html'),
                                    svg = parsed.querySelector('svg');

                                $(svg).attr('class', 'eead-cursor-icon-svg');
                                $scope.find('.eead-global-cursor-' + id).html($(parsed).find('svg'));
                            });
                        }
                    );
            }

            function followMouse(e, props) {

                TweenMax.to('.' + props.elem, props.delay, {
                    css: {
                        left: e.clientX + props.extraLeft - props.width,
                        top: e.clientY + props.extraTop - props.width,
                    },
                    ease: Power0.easeOut,
                });
            }
        };

        elementorFrontend.hooks.addAction("frontend/element_ready/global", eeadGlobalCursorHandler);
    });

    window.eeadLottieAnimations = function ($elem) {
        var self = this,
            $lottie = null;

        if ($elem.hasClass("eead-lottie-animation")) {
            $lottie = $elem;
        } else {
            $lottie = $elem.find(".eead-lottie-animation");
        }

        self.init = function () {

            //Check if widget has been initialized before
            if ($lottie.data('initialized')) {
                return;
            }

            //Mark widget as initialized
            $lottie.data('initialized', true);

            // Search for elements with the .lottie and/or .bodymovin class
            var loop = $lottie.data("lottie-loop"),
                reverse = $lottie.data("lottie-reverse"),
                trigger = $lottie.data("lottie-hover"),
                speed = $lottie.data("lottie-speed"),
                scroll = $lottie.data("lottie-scroll"),
                viewPort = $lottie.data("lottie-viewport"),
                renderer = $lottie.data("lottie-render");

            var animItem = lottie.loadAnimation({
                container: $lottie[0],
                renderer: renderer || 'svg',
                loop: loop ? true : false,
                path: $lottie.data("lottie-url"),
                autoplay: true,
            });

            if (reverse) {
                animItem.setDirection(-1);
            }

            if (speed && 1 !== speed) {
                animItem.setSpeed(speed);
            }

            animItem.addEventListener('DOMLoaded', function () {
                if (scroll || viewPort) {
                    var animateInstance = null,
                        scrollSpeed = $lottie.data("scroll-speed"),
                        scrollStart = $lottie.data("scroll-start"),
                        scrollEnd = $lottie.data("scroll-end");
                    animItem.pause();
                    var animateSettings = {
                        elType: 'SECTION',
                        animate: {
                            speed: viewPort ? "viewport" : scrollSpeed,
                            range: {
                                start: scrollStart,
                                end: scrollEnd
                            }
                        },
                        effects: ['animate']
                    };
                    animateInstance = new eeadEffects($lottie[0], animateSettings, animItem);
                    animateInstance.init();
                }
                if (trigger) {
                    animItem.pause();
                    $elem.hover(function () {
                        animItem.play();
                    }, function () {
                        animItem.pause();
                    });
                }
            });
        };
    };

    window.eeadEffects = function (element, settings, lottieInstance) {
        var self = this,
            $el = $(element),
            scrolls = $el.data("scrolls"),
            elementSettings = settings,
            elType = elementSettings.elType;
        self.elementRules = {};
        self.init = function () {
            if (scrolls || 'SECTION' === elType) {
                if (!elementSettings.effects.length) {
                    return;
                }
                self.setDefaults();
                elementorFrontend.elements.$window.on('scroll load', self.initScroll);
            } else {
                elementorFrontend.elements.$window.off('scroll load', self.initScroll);
                return;
            }
        };

        self.setDefaults = function () {
            elementSettings.defaults = {};
            elementSettings.defaults.axis = 'y';
        };

        self.getPercents = function () {
            var dimensions = self.getDimensions();
            elementTopWindowPoint = dimensions.elementTop - pageYOffset,
                elementEntrancePoint = elementTopWindowPoint - innerHeight;
            passedRangePercents = 100 / dimensions.range * (elementEntrancePoint * -1);
            return passedRangePercents;
        };

        self.initScroll = function () {
            self.initScrollEffects();
        };

        self.initScrollEffects = function () {
            var percents = self.getPercents();
            var elemSettings = $el.closest(".elementor-element").data("settings");

            if (elemSettings && "fixed" === elemSettings._position) {
                percents = self.getLottieViewportHeightPercentage();
            }
            if (elementSettings.effects.includes('animate')) {
                self.animate(percents, elementSettings.animate);
            }
            if (elementSettings.effects.includes('translateY')) {
                self.transform('translateY', percents, elementSettings.vscroll);
            }
        };

        self.getLottieViewportHeightPercentage = function () {
            var offsetObj = elementSettings.animate.range;
            var limitPageHeight = window.innerHeight;
            var offsetStart = offsetObj.start || 0,
                offsetEnd = offsetObj.end || 0,
                initialPageHeight = limitPageHeight || document.documentElement.scrollHeight - document.documentElement.clientHeight,
                heightOffset = initialPageHeight * offsetStart / 100,
                pageRange = initialPageHeight + heightOffset + initialPageHeight * offsetEnd / 100,
                scrollPos = document.documentElement.scrollTop + document.body.scrollTop + heightOffset;
            return scrollPos / pageRange * 100;
        };

        self.getDimensions = function () {
            var elementOffset = $el.offset();
            var dimensions = {
                elementHeight: $el.outerHeight(),
                elementWidth: $el.outerWidth(),
                elementTop: elementOffset.top,
                elementLeft: elementOffset.left
            };
            dimensions.range = dimensions.elementHeight + innerHeight;
            return dimensions;
        };

        self.getStep = function (percents, options) {
            return -(percents - 50) * options.speed;
        };

        self.animate = function (percents, data) {
            var stopFrame = lottieInstance.totalFrames;
            if (data.range) {
                if (data.range.start > percents) {
                    percents = data.range.start;
                }
                if (data.range.end < percents) {
                    percents = data.range.end;
                }
            }
            var currframe = ((percents) / 100) * (stopFrame);

            //Check if element is visible
            if (data.speed === "viewport") {
                if (data.range.start !== percents && data.range.end !== percents) {
                    lottieInstance.play();
                } else {
                    lottieInstance.pause();
                }
            } else {
                lottieInstance.goToAndStop(currframe, true);
            }
        };

        self.transform = function (action, percents, data) {
            if ('down' === data.direction) {
                percents = 100 - percents;
            }

            if (data.range) {
                if (data.range.start > percents) {
                    percents = data.range.start;
                }

                if (data.range.end < percents) {
                    percents = data.range.end;
                }
            }
            elementSettings.defaults.unit = 'px';
            self.updateElement('transform', action, self.getStep(percents, data) + elementSettings.defaults.unit);
        };

        self.updateElement = function (propName, key, value) {
            if (!self.elementRules[propName]) {
                self.elementRules[propName] = {};
            }

            if (!self.elementRules[propName][key]) {
                self.elementRules[propName][key] = true;

                self.updateElementRule(propName);
            }

            var cssVarKey = '--' + key;
            element.style.setProperty(cssVarKey, value);
        };

        self.updateElementRule = function (rule) {
            var cssValue = '';
            $.each(self.elementRules[rule], function (variableKey) {
                cssValue += variableKey + '(var(--' + variableKey + '))';
            });

            $el.css(rule, cssValue);
        };
    };

})(jQuery);