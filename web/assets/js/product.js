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

            var activateHashTab = function (customHash) {
                var hash;
                var hashPieces;
                var activeTab;

                hash = customHash || location.hash;
                if (!hash) return;

                hashPieces = hash.split('?');
                activeTab = $('[href="' + hashPieces[0] + '"]');
                activeTab && activeTab.tab('show');

                // $('html, body').stop().animate({scrollTop: ($(hashPieces[0]).offset().top + 140)}, 500);
            };

            activateHashTab();

            // // пишем хэш в строку
            $('.nav a').on('shown.bs.tab', function (e) {
                window.location.hash = e.target.hash;
            });

            // when a link within a tab is clicked, go to the tab requested
            // $('.tab-pane a').click(function (event) {
            //     if (event.target.hash) {
            //         activateHashTab(event.target.hash);
            //     }
            // });

        }());
    });
})(jQuery);