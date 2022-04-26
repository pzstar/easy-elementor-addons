; (function ($, elementor) {
$(window).on('elementor/frontend/init', function () {
    let ModuleHandler = elementorModules.frontend.handlers.Base,
        CustomCursor;

    CustomCursor = ModuleHandler.extend({
        bindEvents: function () {
            this.run();
        },
        getDefaultSettings: function () {
            return {

            };
        },
        onElementChange: debounce(function (prop) {
            if (prop.indexOf('eead_cursor_effects_') !== -1) {
                this.run();
            }
        }, 400),

        settings: function (key) {
            return this.getElementSettings('eead_cursor_effects_' + key);
        },

        run: function () {
            if (this.settings('show') !== 'yes') {
                return;
            }
            var options = this.getDefaultSettings(),
                widgetID = this.$element.data('id'),
                widgetContainer = '.elementor-element-' + widgetID,
                $element = this.$element,
                cursorStyle = this.settings('style');
            const checkClass = $(widgetContainer).find(".eead-cursor-effects");
            var source = this.settings('source');
            if ($(checkClass).length < 1) {
                // if (source === 'image') {
                //     var image = this.settings('image_src.url');
                //     $(widgetContainer).append('<div class="eead-cursor-effects"><div id="eead-cursor-ball-effects-' + widgetID + '" class="ep-cursor-ball"><img class="eead-cursor-image"src="' + image + '"></div></div>');
                // }
                // else if (source === 'icons') {
                //     var svg = this.settings('icons.value.url');
                //     var icons = this.settings('icons.value');
                //     if (svg !== undefined) {
                //         $(widgetContainer).append('<div class="eead-cursor-effects"><div id="eead-cursor-ball-effects-' + widgetID + '" class="ep-cursor-ball"><img class="eead-cursor-image" src="' + svg + '"></img></div></div>');
                //     } else {
                //         $(widgetContainer).append('<div class="eead-cursor-effects"><div id="eead-cursor-ball-effects-' + widgetID + '" class="ep-cursor-ball"><i class="' + icons + ' eead-cursor-icons"></i></div></div>');
                //     }
                // }
                // else if (source === 'text') {
                //     var text = this.settings('text_label');
                //     $(widgetContainer).append('<div class="eead-cursor-effects"><div id="eead-cursor-ball-effects-' + widgetID + '" class="ep-cursor-ball"><span class="eead-cursor-text">' + text + '</span></div></div>');
                // }
                // else {
                    $(widgetContainer).append('<div class="cursor cursor--small"></div><canvas class="cursor cursor--canvas" resize></canvas>');
                    // $(widgetContainer).append('<div class="eead-cursor-effects ' + cursorStyle + '"><div id="eead-cursor-ball-effects-' + widgetID + '" class="ep-cursor-ball"></div><div id="eead-cursor-circle-effects-' + widgetID + '"  class="ep-cursor-circle"></div></div>');
                // }
            }

            // set the starting position of the cursor outside of the screen
                let clientX = -100;
                let clientY = -100;
                const innerCursor = document.querySelector(".cursor--small");

                const initCursor = () => {
                // add listener to track the current mouse position
                document.addEventListener("mousemove", e => {
                clientX = e.clientX;
                clientY = e.clientY;
                });

                // transform the innerCursor to the current mouse position
                // use requestAnimationFrame() for smooth performance
                const render = () => {
                innerCursor.style.transform = `translate(${clientX}px, ${clientY}px)`;
                // if you are already using TweenMax in your project, you might as well
                // use TweenMax.set() instead
                // TweenMax.set(innerCursor, {
                //   x: clientX,
                //   y: clientY
                // });

                requestAnimationFrame(render);
                };
                requestAnimationFrame(render);
                };

                initCursor();



                let lastX = 0;
                let lastY = 0;
                let isStuck = false;
                let showCursor = false;
                let group, stuckX, stuckY, fillOuterCursor;

                const initCanvas = () => {
                const canvas = document.querySelector(".cursor--canvas");
                const shapeBounds = {
                width: 75,
                height: 75
                };
                paper.setup(canvas);
                const strokeColor = "rgba(255, 0, 0, 0.5)";
                const strokeWidth = 1;
                const segments = 8;
                const radius = 15;

                // we'll need these later for the noisy circle
                const noiseScale = 150; // speed
                const noiseRange = 4; // range of distortion
                let isNoisy = false; // state

                // the base shape for the noisy circle
                const polygon = new paper.Path.RegularPolygon(
                new paper.Point(0, 0),
                segments,
                radius
                );
                polygon.strokeColor = strokeColor;
                polygon.strokeWidth = strokeWidth;
                polygon.smooth();
                group = new paper.Group([polygon]);
                group.applyMatrix = false;

                const noiseObjects = polygon.segments.map(() => new SimplexNoise());
                let bigCoordinates = [];

                // function for linear interpolation of values
                const lerp = (a, b, n) => {
                return (1 - n) * a + n * b;
                };

                // function to map a value from one range to another range
                const map = (value, in_min, in_max, out_min, out_max) => {
                return (
                ((value - in_min) * (out_max - out_min)) / (in_max - in_min) + out_min
                );
                };

                // the draw loop of Paper.js 
                // (60fps with requestAnimationFrame under the hood)
                paper.view.onFrame = event => {
                // using linear interpolation, the circle will move 0.2 (20%)
                // of the distance between its current position and the mouse
                // coordinates per Frame
                lastX = lerp(lastX, clientX, 0.2);
                lastY = lerp(lastY, clientY, 0.2);
                group.position = new paper.Point(lastX, lastY);
                }



                    // the draw loop of Paper.js
                    // (60fps with requestAnimationFrame under the hood)
                    paper.view.onFrame = event => {
                    // using linear interpolation, the circle will move 0.2 (20%)
                    // of the distance between its current position and the mouse
                    // coordinates per Frame
                    if (!isStuck) {
                    // move circle around normally
                    lastX = lerp(lastX, clientX, 0.2);
                    lastY = lerp(lastY, clientY, 0.2);
                    group.position = new paper.Point(lastX, lastY);
                    } else if (isStuck) {
                    // fixed position on a nav item
                    lastX = lerp(lastX, stuckX, 0.2);
                    lastY = lerp(lastY, stuckY, 0.2);
                    group.position = new paper.Point(lastX, lastY);
                    }

                    if (isStuck && polygon.bounds.width < shapeBounds.width) { 
                    // scale up the shape 
                    polygon.scale(1.08);
                    } else if (!isStuck && polygon.bounds.width > 30) {
                    // remove noise
                    if (isNoisy) {
                    polygon.segments.forEach((segment, i) => {
                    segment.point.set(bigCoordinates[i][0], bigCoordinates[i][1]);
                    });
                    isNoisy = false;
                    bigCoordinates = [];
                    }
                    // scale down the shape
                    const scaleDown = 0.92;
                    polygon.scale(scaleDown);
                    }

                    // while stuck and big, apply simplex noise
                    if (isStuck && polygon.bounds.width >= shapeBounds.width) {
                    isNoisy = true;
                    // first get coordinates of large circle
                    if (bigCoordinates.length === 0) {
                    polygon.segments.forEach((segment, i) => {
                    bigCoordinates[i] = [segment.point.x, segment.point.y];
                    });
                    }

                    // loop over all points of the polygon
                    polygon.segments.forEach((segment, i) => {

                    // get new noise value
                    // we divide event.count by noiseScale to get a very smooth value
                    const noiseX = noiseObjects[i].noise2D(event.count / noiseScale, 0);
                    const noiseY = noiseObjects[i].noise2D(event.count / noiseScale, 1);

                    // map the noise value to our defined range
                    const distortionX = map(noiseX, -1, 1, -noiseRange, noiseRange);
                    const distortionY = map(noiseY, -1, 1, -noiseRange, noiseRange);

                    // apply distortion to coordinates
                    const newX = bigCoordinates[i][0] + distortionX;
                    const newY = bigCoordinates[i][1] + distortionY;

                    // set new (noisy) coodrindate of point
                    segment.point.set(newX, newY);
                    });

                    }
                    polygon.smooth();
                    };





                }

                initCanvas();



                const initHovers = () => {

                // find the center of the link element and set stuckX and stuckY
                // these are needed to set the position of the noisy circle
                const handleMouseEnter = e => {
                const navItem = e.currentTarget;
                const navItemBox = navItem.getBoundingClientRect();
                stuckX = Math.round(navItemBox.left + navItemBox.width / 2);
                stuckY = Math.round(navItemBox.top + navItemBox.height / 2);
                isStuck = true;
                };

                // reset isStuck on mouseLeave
                const handleMouseLeave = () => {
                isStuck = false;
                };

                // add event listeners to all items
                // const linkItems = document.querySelectorAll(".link");
                const linkItems = document.querySelectorAll("a");
                linkItems.forEach(item => {
                item.addEventListener("mouseenter", handleMouseEnter);
                item.addEventListener("mouseleave", handleMouseLeave);
                });
                };

                initHovers();










            // const cursorBallID = '#eead-cursor-ball-effects-' + this.$element.data('id');
            // const cursorBall = document.querySelector(cursorBallID);
            // options.models = widgetContainer + ' .elementor-widget-container';
            // options.speed = 1;
            // options.centerMouse = true;
            // new Cotton(cursorBall, options);

            // if (source === 'default') {
            //     const cursorCircleID = '#eead-cursor-circle-effects-' + this.$element.data('id');
            //     const cursorCircle = document.querySelector(cursorCircleID);
            //     options.models = widgetContainer + ' .elementor-widget-container';
            //     options.speed = this.settings('speed') ? this.settings('speed.size') : 0.725;
            //     options.centerMouse = true;
            //     new Cotton(cursorCircle, options);
            // }
        }
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/widget', function ($scope) {
        elementorFrontend.elementsHandler.addHandler(CustomCursor, {
            $element: $scope
        });
    });
});
})(jQuery, window.elementorFrontend);

var debounce = function(func, wait, immediate) {
    // 'private' variable for instance
    // The returned function will be able to reference this due to closure.
    // Each call to the returned function will share this common timer.
    var timeout;

    // Calling debounce returns a new anonymous function
    return function() {
        // reference the context and args for the setTimeout function
        var context = this,
            args = arguments;

        // Should the function be called now? If immediate is true
        //   and not already in a timeout then the answer is: Yes
        var callNow = immediate && !timeout;

        // This is the basic debounce behaviour where you can call this
        //   function several times, but it will only execute once
        //   [before or after imposing a delay].
        //   Each time the returned function is called, the timer starts over.
        clearTimeout(timeout);

        // Set the new timeout
        timeout = setTimeout(function() {

            // Inside the timeout function, clear the timeout variable
            // which will let the next execution run when in 'immediate' mode
            timeout = null;

            // Check if the function already ran with the immediate flag
            if (!immediate) {
                // Call the original function with apply
                // apply lets you define the 'this' object as well as the arguments
                //    (both captured before setTimeout)
                func.apply(context, args);
            }
        }, wait);

        // Immediate mode and no wait timer? Execute the function..
        if (callNow) func.apply(context, args);
    };
};