/**
 * @todo убрать лишнее
 */
$(document).ready(function () {


    var spy = new ScrollSpy('#js-scrollspy', {
        nav: '.js-scrollspy-nav > li > a',
        className: 'active'
    });

    //    Слайдер
    $(".owl_high").owlCarousel({
        items: 3,
        margin: 1,
        mergeFit: true,
        autoWidth: true,
        mouseDrag: false,
        dots: false
    });


    /**
     * Вспомогательная анимация слайдера товаров
     */
    (function () {
        var slider = $('.owl_nohb');
        
        if (slider.length !== 0) {
            $(window).on('scroll', function () {
                if ($(slider).isInViewport() && localStorage.getItem('promoSlideMove') !== 'done') {

                    setTimeout(function () {
                        slider.trigger('next.owl.carousel', [500]);
                        localStorage.setItem('promoSlideMove', 'done');

                        setTimeout(function () {
                            slider.trigger('prev.owl.carousel', [500]);
                        }, 800);
                    }, 800);
                }
            });

        }

    }());

    /**
     * Активация ленивой загрузки для блока
     */
    (function () {
        var scrollArea = $('.scroll-x');
        var waiting = false;

        scrollArea.on('scroll', function () {
            
            if (waiting) {
                return;
            }
            waiting = true;

            blazy.revalidate();

            setTimeout(function () {
                waiting = false;
            }, 100);
        });

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
        var hash = this.hash;
        var idHash = $(this).attr('href');
        var $target = $(idHash);

        if ($target.length !== 1) return;

        $('html, body').stop().animate({scrollTop: ($target.offset().top - 120)}, 1000);
        window.location.hash = hash;
        $('.menu, .overlay').removeClass('active');
    });

    /**
     * Аякс сабмит форм звонка
     *
     * нужно положить форму в контейнер .js-call-form-container
     * у сабмита можно указать id модального окна для открытия после успешного лида
     * data-success-modal="#modalId"
     */
    $('body').on('submit', '.js-call-form-container form', function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();
        var $form = $(this);

        var $submit = $form.find('[type="submit"]');

        $.ajax({
            url : $form.attr('action'),
            method: 'post',
            data : serializeForm($form),
            success: function(data) {
                if (data.status === 1) {
                    if ($submit.data('success-modal')) {
                        $($submit.data('success-modal')).modal('show');
                    }
                } else {
                    //ничего не делаем в случае ошибки
                }
            },
        })
    });

    // включаем прокрутку до якоря
    goToAncor();
});