jQuery(document).ready(function () {
    $('.ct-slick-homepage').on('init', function (event, slick) {
        $('.animated').addClass('activate fadeInRight');
    });

    $('.ct-slick-homepage').slick({
        autoplay: true,
        autoplaySpeed: 5000,
        pauseOnHover: false,
    });

    $('.ct-slick-homepage').on('afterChange', function (event, slick, currentSlide) {
        $('.animated').removeClass('off');
        $('.animated').addClass('activate fadeInRight');
    });

    $('.ct-slick-homepage').on('beforeChange', function (event, slick, currentSlide) {
        $('.animated').removeClass('activate fadeInRight');
        $('.animated').addClass('off');
    });
});