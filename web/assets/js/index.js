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


//    Нажатие на кнопку Купить
    $('body').on('click', 'button.js-order', function (e) {
        var honeyMoney = $('#hm').val();
        var $btn = $(e.currentTarget);

        if (honeyMoney !== 'undefined') {

            if ($btn.attr('disbled') === 'disabled') {
                return false;
            }

            var giftPrice = $btn.data('price');

            if (honeyMoney >= giftPrice) {
                var url = $btn.data('url');

                $btn.attr('disabled', true).text('Подождите...');

                window.location.href = url;
            } else {
                var giftImgSrc = $btn.closest('.card').children('.card__img').find('img').attr('src');
                var modal = $('#notEnoughPoints');
                $('#offer-modal-img').attr('src', giftImgSrc);
                modal.modal('show');
            }
        } else {
            //Показываем текст в модальном окне вместо alert()
            e.stopImmediatePropagation();
            $btn.attr('data-toggle', 'modal')
                    .attr('data-modal-content', '<p class="fs-20 mb-0">Вам нужно войти или зарегистрироваться для покупки товаров!</p>')
                    .attr('data-container-selector', '#commonModalContainer')
                    .attr('data-target', '#onlyWithGiftModal');
            $btn.trigger('click');
        }
    });

//    Вспомогательная анимация слайдера товаров
    (function () {
        var slider = $('.owl_nohb');
        
        if (slider.length != 0) {
            $(window).on('scroll', function () {
                if ($(slider).isInViewport() && localStorage.getItem('promoSlideMove') != 'done') {

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

//    Активация ленивой загрузки для блока
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
});