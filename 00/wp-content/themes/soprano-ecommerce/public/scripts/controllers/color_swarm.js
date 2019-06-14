/*! ===================================
 *  Author: Roman Nazarkin, Egor Dankov
 *  -----------------------------------
 *  PuzzleThemes
 *  =================================== */


/***********************************************
 * ColorSwarm module API
 ***********************************************/
(function ($) {
    'use strict';

    $.fn.PZT_ColorSwarm = function () {
        var canvas = $(this)[0];
        var ctx;
        var numCircles = 100;

        var resize = window.resize = function () {
            canvas.height = $(canvas).parent().outerHeight();
            canvas.width = window.innerWidth;
        };

        $(function () {
            ctx = canvas.getContext('2d');
            resize();

            var circles = [],
                colors = randomColor({luminosity: 'light', count: numCircles});

            for (var i = 0; i < numCircles; i++) {
                var x = Math.random() * canvas.width;
                var y = Math.random() * canvas.height;
                var c = new Circle(x, y, colors[i]);
                c.draw();
                circles.push(c);
            }

            var requestAnimFrame = function () {
                return window.requestAnimationFrame ||
                    window.webkitRequestAnimationFrame ||
                    window.mozRequestAnimationFrame ||
                    window.oRequestAnimationFrame ||
                    window.msRequestAnimationFrame ||
                    function (a) {
                        window.setTimeout(a, 1E3 / 60);
                    };
            }();

            var loop = function () {
                requestAnimFrame(loop);
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                for (var i = 0; i < circles.length; i++) {
                    circles[i].frame();
                }
            };

            loop();
        });

        var Circle = function (x, y, c) {
            this.pos = [x, y];
            this.r = (1.5 * Math.random()) + 1;
            this.c = c;
            this.v = [
                (Math.random() - 0.5) * 0.3,
                (Math.random() - 0.5) * 0.3
            ];
        };

        Circle.prototype.getBound = function (i) {
            return i ? canvas.height : canvas.width;
        };

        var i;
        Circle.prototype.frame = function () {
            for (i = 0; i < 2; i++) {
                if (this.pos[i] > this.getBound(i) - 10) {
                    this.v[i] *= -1;
                }
                else if (this.pos[i] < 10) {
                    this.v[i] *= -1;
                }
                this.pos[i] += this.v[i] * 10;
            }

            this.draw();
        };

        Circle.prototype.draw = function () {
            ctx.fillStyle = this.c;
            ctx.beginPath();
            ctx.arc(this.pos[0], this.pos[1], this.r, 0, 2 * Math.PI, false);
            ctx.fill();
        };
    };
})(jQuery);


/***********************************************
 * Equip module
 ***********************************************/
(function ($) {
    'use strict';

    $('.sp-color-swarm').each(function () {
        var $canvas = $('<canvas class="sp-color-swarm-svg" />');
        $(this).prepend($canvas);
        $canvas.PZT_ColorSwarm();
    });
})(jQuery);