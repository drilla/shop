/**
 * Глобальные функции
 */

//Находится ли элемент в границах экрана
$.fn.isInViewport = function () {
    var elementTop = $(this).offset().top;
    var elementBottom = elementTop + $(this).outerHeight();
    var viewportTop = $(window).scrollTop();
    var viewportBottom = viewportTop + $(window).height();
    return elementBottom > viewportTop && elementTop < viewportBottom;
};

function Animation() {
    var scrollBlocks = $('.aos');

    scrollBlocks.each(function (index, elem) {
        if ($(elem).isInViewport()) {
            if ($(elem).hasClass('aos_left')) {
                $(elem).addClass('animated fadeInLeft');
            } else {
                $(elem).addClass('animated fadeInRight');
            }
        }
    });
}

//    Ленивая загрузка изображений
var blazy = new Blazy({
    offset: 500,
    breakpoints: [{
            width: 767 // max-width
            , src: 'data-src-sm'
        }
        , {
            width: 991 // max-width
            , src: 'data-src-md'
        }, {
            width: 1199 // max-width
            , src: 'data-src-lg'
        }]
});

/**
 * Общий код для страниц
 */
(function ($) {
    $(document).ready(function() {
        'use strict';

        /**
         * загрузка содержимого в модальное окно по клику на кнопке.
         * либо по урл тибо текст.
         *
         * у кнопки указать
         * data-modal-href - адрес для загрузки содержимого  (имеет приоритет перед текстом)
         * data-modal-content - текст для контейнера
         * data-target     - селектор для модального окна (напр #modal_id)
         * data-container-selector - куда загрузить полученное содержимое (сам контейнер останется)
         */
        $('body').on('click', '[data-modal-href], [data-modal-content]', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            var $button = $(this);
            var url = $button.attr('data-modal-href');
            var text = $button.attr('data-modal-content');
            var $modal = $($button.attr('data-target'));
            var $targetContainer = null;
            var targetContainerDefaultSelector = '.modal-body';
            var targetContainerCustomSelector = $button.data('container-selector');

            //пытаемся определить контейнер для загрузки из дата-аттрибута
            if (targetContainerCustomSelector !== undefined) {
                var $candidateObject = $modal.parent().find(targetContainerCustomSelector);
                if ($candidateObject.length === 1) {
                    $targetContainer = $candidateObject;
                }
            }

            //контейнер по умолчанию
            if ($targetContainer === null) {
                $targetContainer = $modal.find(targetContainerDefaultSelector);
            }

            if (!$targetContainer) {
                return false;
            }

            if (url) {
                $targetContainer.load(url);
            } else {
                $targetContainer.html(text);
            }
            $modal.modal('show');
        });

        /**
         *  Прокрутка до якоря
         */
        (function () {

            if (window.location.hash) {
                var id = window.location.hash.substr(1);

                if (!id) return;

                var $target = $('#' + id);

                if ($target.length < 1 ) return;

                $('html, body').stop().animate({scrollTop: ($target.offset().top + 140)}, 500);
            }
        }());

        /**
         * управление меню
         */
        $('.icon_menu, .menu__close, .overlay').on('click', function () {
            $('.menu, .overlay').toggleClass('active');
        });

        /**
         * Прокрутка меню
         */
        $('.menu__list a').on('click', function (e) {
            e.preventDefault();

            var url = document.URL;
            var target = this.hash;
            var id = $(this).attr('href');

             // Если это страница заказа, то переходим на главную
            if (url.search('order') !== -1) {
                window.location = "/" + id;
                return false;
            }

            $('html, body').stop().animate({scrollTop: ($(id).offset().top - 141)}, 1000);
            window.location.hash = target;
            $('.menu, .overlay').removeClass('active');
        });

        /**
         * Для радиокнопок
         */
        $('.radio__label').on('click', function () {
            $('.radio__block').removeClass('active');
            $(this).closest('.radio__block').addClass('active');
        });

        /**
         * Подгрузка картинок при активации окон
         */
        $('.modal').on('shown.bs.modal', function (e) {
            blazy.revalidate();
        });
    });
})(jQuery);
