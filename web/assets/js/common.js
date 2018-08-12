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

/**
 * приводим данные формы в правильный формат
 * {formName['name'] : value}
 *
 * @return object
 */
function serializeForm($form) {
    var formDataRaw = $form.serializeArray();
    var formData = {};
    $.each(formDataRaw,
        function(i, v) {formData[v.name] = v.value;}
    );

    return formData;
}

/**
 *  Прокрутка до якоря
 */
function goToAncor() {

    if (window.location.hash) {
        var id = window.location.hash.substr(1);

        if (!id) return;

        var $target = $('#' + id);

        if ($target.length < 1 ) return;

        $('html, body').stop().animate({scrollTop: ($target.offset().top + 140)}, 500);
    }
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

        /**
         * подгрузка картинок в слайдеры
         */
        (function () {
            var sliders = $('.owl-carousel');
            sliders.on('changed.owl.carousel', function (event) {
                blazy.revalidate();
            });
        }());

        /**
         * запуск ленивой загрузки
         */
        blazy.revalidate();
    });
})(jQuery);
