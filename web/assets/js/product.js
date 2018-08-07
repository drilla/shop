(function ($) {
    $(document).ready(function () {

        /**
         * Слайдер товара
         */
        $(".owl-carousel.product__main-slider").owlCarousel({
            items: 1,
            loop:true,
            dots: false,
            nav: false,
            mouseDrag: true,
            responsive: {
                0: {
                    nav: true,
                    center: true
                }
            }
        });
    });
})(jQuery);