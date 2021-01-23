/* ------------------------------- All Funtions Start ------------------------------- */

    /* ------------------------------- Document Rready Funtions Start ------------------------------- */

    jQuery(document).ready(function(jQuery) {
        jQuery('[data-toggle="tooltip"]').tooltip();
        /** Responsive Menu*/
        if (jQuery(".main-navigation>ul, ul.top-nav.nav-left").length != '') {
            jQuery('.main-navigation>ul').slicknav({
                prependTo: '.cs-main-nav'
            });
            jQuery('ul.top-nav.nav-left').slicknav({
                prependTo: '.top-bar > .container > .row > .col-lg-4',
                label: ' '
            });
        }
        /*If Condition Start*/
        if (jQuery("#mobile-menu").length != '') {
            /* Sidebar Menu*/
            jQuery("#mobile-menu").mobileMenu({
                MenuWidth: 250,
                SlideSpeed: 300,
                WindowsMaxWidth: 1200,
                PagePush: true,
                FromLeft: true,
                Overlay: true,
                CollapseMenu: true,
                ClassName: "mobile-menu"
            });
        }
        /*If Condition End*/
        /*Graduate Slider*/
        if (jQuery(".cs-graduate-slider").length != '') {
            jQuery(".cs-graduate-slider").slick({
                dots: false,
                infinite: true,
                swipeToSlide: true,
                speed: 300,
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplaySpeed: 1000,
                autoplay: true,
                arrows: false,
                responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1

                    }
                }, {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]
            });
        }
        /*Graduate End*/
        /*If Condition Start*/
        if (jQuery(".cs-course-slider").length != '') {
            jQuery(".cs-course-slider").slick({
                dots: false,
                infinite: true,
                swipeToSlide: true,
                speed: 900,
                slidesToShow: 4,
                slidesToScroll: 1,
                responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]
            });
        }
        /*Testimonial Main Slider Start*/
        if (jQuery(".main-testimonial").length != '') {
            jQuery(".main-testimonial").slick({
                dots: false,
                arrows: true,
                infinite: true,
                swipeToSlide: true,
                autoplay: true,
                autoplaySpeed: 2000,
                speed: 300,
                slidesToShow: 5,
                slidesToScroll: 1,
                responsive: [{
                    breakpoint: 1370,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 1170,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 990,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]

            });
        }
        /*Testimonial Slider Start*/
        if (jQuery(".cs-testimonial").length != '') {
            jQuery(".cs-testimonial").slick({
                dots: false,
                arrows: false,
                infinite: true,
                swipeToSlide: true,
                autoplay: true,
                autoplaySpeed: 2000,
                speed: 300,
                slidesToShow: 5,
                slidesToScroll: 1,
                responsive: [{
                    breakpoint: 1370,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 1170,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 990,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]
            });
        }
	   // Price Filter
			if(jQuery('#ex2').length != ''){
				jQuery("#ex2").slider({});
			}
        // Product Slides
        if (jQuery('.cs-product-slides').length != '') {
            jQuery('.cs-product-slides').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                fade: true,
                asNavFor: '.cs-product-slides-thumb'
            });
        }
        if (jQuery('.cs-product-slides-thumb').length != '') {
            jQuery('.cs-product-slides-thumb').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '.cs-product-slides',
                dots: false,
                centerMode: false,
                focusOnSelect: true,
                arrows: false,
				responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }]
            });
			
        }
        /*Testimonial Slider End*/
        /*Blog Small Slider Start*/
        if (jQuery(".cs-blogsmall-slider").length != '') {
            jQuery(".cs-blogsmall-slider").slick({
                dots: false,
                infinite: true,
                speed: 900,
                autoplay: true,
                swipeToSlide: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]
            });
        }
        /*Blog Small Slider End*/
        if (jQuery(".cs-blog-grid-slider").length != '') {
            jQuery(".cs-blog-grid-slider").slick({
                dots: false,
                infinite: true,
                swipeToSlide: true,
                speed: 900,
                autoplay: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]
            });
        }
        /*Place Holder Function*/
        jQuery('input,textarea').on('focus', function() {
            var $this = jQuery(this);
            $this.data('placeholder', $this.prop('placeholder'));
            $this.removeAttr('placeholder')
        }).on('blur', function() {
            var $this = jQuery(this);
            $this.prop('placeholder', $this.data('placeholder'));
        });
        /*If Condition End*/
        /* PROGRESS BARS Function */
        jQuery('.skillbar').each(function() {
            jQuery(this).waypoint(function(direction) {
                jQuery(this).find('.skillbar-bar').animate({
                    width: jQuery(this).attr('data-percent')
                }, 2000);

            }, {
                offset: "100%",
                triggerOnce: true,
            });
        });
        /* PROGRESS BARS Function End */
        /*If Condition counter Start*/
        if (jQuery(".counter").length != '') {
            jQuery('.counter').counterUp({
                delay: 10,
                time: 1000
            });
        }
        /*Map Pointer Event show hide*/
        if (jQuery('.cs-maps').length != '') {
            $(document).on('click', '.cs-maps', function() {
                $('.cs-maps iframe').css("pointer-events", "auto");
            });

            $(document).on('mouseleave', '.cs-maps', function() {
                $('.cs-maps iframe').css("pointer-events", "none");
            });
        }
        /*Map Detail Hide Show*/
        /* Under Construction Count Down */
        if (jQuery('#getting-started').length != '') {
            jQuery('#getting-started').countdown('2016/03/35', function(event) {
                jQuery(this).html(event.strftime('<div class="time-box"><h4 class="dd">%D</h4> <span class="label">days</span> </div><div class="time-box"><h4 class="hh">%H</h4><span class="label">hours</span></div><div class="time-box"><h4 class="mm">%M</h4> <span class="label">minutes</span></div><div class="time-box"><h4 class="ss">%S</h4> <span class="label">seconds</span></div> '));
            });
        }

        if (jQuery(".cs-post-slides").length != '') {
            $('.cs-post-slides').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1
            });
        }
        if (jQuery(".responsive-calendar").length != '') {
            jQuery(".responsive-calendar").responsiveCalendar({
                time: '2014-11',
                events: {
                    "2014-11-05": {
                        "number": 5,
                        "url": "http://w3widgets.com/responsive-slider"
                    },
                    "2014-11-14": {
                        "number": 1,
                        "url": "http://w3widgets.com"
                    },
                    "2014-11-19": {
                        "number": 1
                    },
                    "2014-11-29": {}
                }
            });
        }

        $(".cs-map-holder").show();
        $(document).on('click', '.map-opener', function() {
            $(this).toggleClass("active").next().slideToggle("slow");

            if ($.trim($(this).text()) === 'Open map') {
                $(this).text('Close map');
            } else {
                $(this).text('Open map');
            }

            return false;
        });
        $("a[href='" + window.location.hash + "']").parent(".map-opener").click();

    });
    /* ------------------------------- Document Rready Funtions End ------------------------------- */


    /* ------------------------------- Window Load Funtions Start ------------------------------- */

    jQuery(window).load(function($) {
        /*  Search Form */
        jQuery(document).on('click', '.search-area a', function(e) {
            e.preventDefault();
            jQuery(this).siblings('form').toggle();
        });

        if (jQuery('.chosen-select , .chosen-select-deselect , .chosen-select-no-results , .chosen-select-width').length != '') {
            var config = {
                '.chosen-select': {
                    width: "100%"
                },
                '.chosen-select-deselect': {
                    allow_single_deselect: true
                },
                '.chosen-select-no-single': {
                    disable_search_threshold: 10
                },
                '.chosen-select-no-results': {
                    no_results_text: 'Oops, nothing found!'
                },
                '.chosen-select-width': {
                    width: "95%"
                }
            }
            for (var selector in config) {
                jQuery(selector).chosen(config[selector]);
            }
        };

        if (jQuery("cs-select-checklist .cs-checkbox-list").length != '') {
            jQuery("cs-select-checklist .cs-checkbox-list").mCustomScrollbar({
                setHeight: 55,
                theme: "dark"
            });
        }
        /*Blog Grid Slider Start*/
        if (jQuery(".cs-bloggrid-slider-sm").length != '') {
            jQuery(".cs-bloggrid-slider-sm").slick({
                dots: false,
                arrows: true,
                infinite: true,
                autoplay: true,
                swipeToSlide: true,
                autoplaySpeed: 2000,
                speed: 300,
                slidesToShow: 1,
                slidesToScroll: 1,
                responsive: [{
                    breakpoint: 1170,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 990,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]

            });
        }
        /*Blog Grid Slider Start*/
        /* Team List Slider Start*/
        if (jQuery(".cs-teamlist-slider").length != '') {
            jQuery(".cs-teamlist-slider").slick({
                dots: false,
                infinite: true,
                swipeToSlide: true,
                speed: 900,
                autoplay: true,
                slidesToShow: 2,
                slidesToScroll: 1,
                responsive: [{
                    breakpoint: 1170,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 990,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]
            });
        }
        /* Team List Slider End*/
        /* History Slider Start*/
        if (jQuery(".cs-history-slider").length != '') {
            jQuery(".cs-history-slider").slick({
                dots: false,
                arrows: false,
                infinite: true,
                swipeToSlide: true,
                autoplay: true,
                autoplaySpeed: 2000,
                speed: 300,
                slidesToShow: 5,
                slidesToScroll: 1,
                responsive: [{
                    breakpoint: 1370,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 1170,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 990,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]
            });

        }
        /* History Slider End*/
        if (jQuery("#grid").length != '') {
            new AnimOnScroll(document.getElementById('grid'), {
                minDuration: 0.4,
                maxDuration: 0.7,
                viewportFactor: 0.2
            });
        }		
    });
    /* ------------------------------- Window Load Funtions End ------------------------------- */

/* ------------------------------- All Funtions End ------------------------------- */