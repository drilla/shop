/**
 * @author drilla
 */
(function ($) {
    $(document).ready(function () {

        /**
         * Слайдер товара
         */
        $(".owl-carousel.product__main-slider").owlCarousel({
            items: 1,
            loop:true,
            dots: true,
            nav: false,
            mouseDrag: true,
            responsive: {
                0: {
                    nav: true,
                    center: true
                }
            }
        });

        /**
         * активация нужной вкладки на товаре
         */
        (function () {

            var gotoHashTab = function (customHash) {
                var hash = customHash || location.hash;
                var hashPieces = hash.split('?'),
                    activeTab = $('[href="' + hashPieces[0] + '"]');
                activeTab && activeTab.tab('show');

                $('html, body').stop().animate({scrollTop: ($(hashPieces[0]).offset().top + 140)}, 500);
            };

            // onready go to the tab requested in the page hash
            gotoHashTab();

            // пишем хэш в строку
            $('.nav a').on('shown', function (e) {
                window.location.hash = e.target.hash;
            });

            // when a link within a tab is clicked, go to the tab requested
            $('.tab-pane a').click(function (event) {
                if (event.target.hash) {
                    gotoHashTab(event.target.hash);
                }
            });

        }());
    });
})(jQuery);