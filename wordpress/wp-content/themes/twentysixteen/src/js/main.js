(function ($) {

       'use strict';

        var $win = $(window)
            , $body = $("body")
            , $aside = $(".social-news")
            , $container = $(".content-main .container")
            , $main_footer = $(".main-footer")
            , scrollPos;


        $('.section-widget-tabs').each(function() {

            var $this = $(this);

            var $links = $this.find('.section-filter li');
            var $contents = $this.find('.tab-content .tab-pane');

            $links.on('click', function() {

                console.log('from link');

                var $this_link_container = $(this);
                var $this_link = $this_link_container.find('a');
                var $link_ref = $($this_link.attr("href")).first();

                if ( ! $this_link.data('cached-content') ) {
                    $this_link.data('cached-content', $link_ref );
                }

                $links.removeClass('active');
                $this_link_container.addClass('active');

                $contents.removeClass('active');
                $this_link.data('cached-content').addClass('active');

                console.log($this_link.data('cached-content'));

                return false;

            });


        });



        $(".main-menu-title").on("click", function (e) {

            if ($win.width() < 992 && !$(e.target).is("a")) {

                // we have mobile menu

                $(this).toggleClass("active");
                $(this).parents(".col-main-menu").find(".menu-submenu").toggleClass("hidden-xs hidden-sm");

            }

        });

        function stickyHandler() {


            if ($body.hasClass("main-menu-on") || $body.hasClass("header-top-on")) {

                $(".main-header").unstick();

            } else {

                $(".main-header").each(function () {

                    var $this = $(this);

                    $this.sticky({
                        topSpacing: 0
                        , zIndex: $this.css("zIndex")
                    });

                });

            }
        }


        $('.slider-slick').slick({

            prevArrow: '<a href="#" class="slick-prev"><i class="fa fa-angle-left"></i></a>'
            , nextArrow: '<a href="#" class="slick-next"><i class="fa fa-angle-right"></i></a>'

        });

        function headerTopHandler(body_class) {


            if (!$body.hasClass("header-top-on") && !$body.hasClass("main-menu-on")) {

                scrollPos = $(window).scrollTop();

                $body.toggleClass(body_class);

                $win.scrollTop(0);

            } else if ($body.hasClass(body_class)) {


                $body.toggleClass(body_class);
                $win.scrollTop(scrollPos);

            } else {

                $body.toggleClass("header-top-on");
                $body.toggleClass("main-menu-on");

            }


        }

        $(".header-switch-top").on("click", function () {



            headerTopHandler("header-top-on");

            stickyHandler();

            return false;

        });


        $(".header-switch-menu").on("click", function () {



            headerTopHandler("main-menu-on");

            stickyHandler();

            return false;

        });

        if ($win.width() >= 1200) {


            $(".sticky-el").each(function () {

                var $this = $(this);

                $this.sticky({
                    topSpacing: 0
                    , zIndex: $this.css("zIndex")
                });

            });

        }

})(jQuery);

