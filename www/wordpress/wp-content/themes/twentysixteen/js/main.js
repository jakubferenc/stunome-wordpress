(function ($) {

        'use strict';

        var $win = $(window)
            , $body = $("body")
            , $aside = $(".social-news")
            , $container = $(".content-main .container")
            , $main_footer = $(".main-footer")
            , scrollPos;



        $(".main-menu-title").on("click", function (e) {

            if ($win.width() < 992 && !$(e.target).is("a")) {

                // we have mobile menu

                $(this).toggleClass("active");
                $(this).parents(".col-main-menu").find(".menu-submenu").toggleClass("hidden-xs hidden-sm");

            }

        });

        function stickyHandler() {


            if ($("body").hasClass("main-menu-on") || $("body").hasClass("header-top-on")) {

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

        function check_sticky_elements() {
            /*
                    if ($(".sticky-el").length > 0 && $win.width() >= 992) {

                        var aside_bottom_pos = $aside.offset().top + $aside.height();

                        var content_bottom_pos = $container.offset().top + $container.height();

                        if (aside_bottom_pos >= content_bottom_pos) {

                            //$aside.unstick();

                        } else if (!$main_footer.is(':in-viewport')) {

                            $aside.sticky({
                                topSpacing: 0
                                , zIndex: $aside.css("zIndex")
                            });

                        }

                    }*/


        }

        $('.slider-slick').slick({

            prevArrow: '<a href="#" class="slick-prev"><i class="fa fa-angle-left"></i></a>'
            , nextArrow: '<a href="#" class="slick-next"><i class="fa fa-angle-right"></i></a>'

        });

        function headerTopHandler(body_class) {


            if (!$body.hasClass("header-top-on") && !$body.hasClass("main-menu-on")) {

                scrollPos = $(window).scrollTop();

                $("body").toggleClass(body_class);

                $win.scrollTop(0);

            } else if ($body.hasClass(body_class)) {


                $("body").toggleClass(body_class);
                $win.scrollTop(scrollPos);

            } else {

                $("body").toggleClass("header-top-on");
                $("body").toggleClass("main-menu-on");

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



        check_sticky_elements();


        var scrollTimeout; // global for any pending scrollTimeout

        /* $win.scroll(function () {

             //scrollTimeout = setTimeout(scrollHandler, 150);
         });*/

        function scrollHandler() {
            /*
        if (  $main_footer.is(':in-viewport') && $body.data("no-sticky") !== true ) {
            
            $(".sticky-el").unstick();
            $body.data("no-sticky", true);
            
            
        }
        
        if (  ! $main_footer.is(':in-viewport') && $body.data("no-sticky") === true ) {
            
            $(".sticky-el").each(function () {

                var $this = $(this);

                $this.sticky({
                    topSpacing: 0
                    , zIndex: $this.css("zIndex")
                });

            });
            $body.data("no-sticky", false);
            
            
        }  
        
        clearTimeout(scrollTimeout);*/

        };

        /* $win.scroll(function () {

             check_sticky_elements();

         });*/


       /* $win.resize(function () {


           /* if ($win >= 1200) {


                $(".sticky-el").not(".sticky-wrapper .sticky-el").each(function () {

                    var $this = $(this);

                    $this.sticky({
                        topSpacing: 0
                        , zIndex: $this.css("zIndex")
                    });

                });

            } else {

                (".sticky-wrapper .sticky-el").each(function () {

                    var $this = $(this);

                    $this.unstick();

                });

            }*/

})(jQuery);
    
    