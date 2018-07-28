$(document).ready(function () {
    
    blazy.revalidate();

    /**
     * Отказываемся от бесплатных офферов
     */
    (function () {
        $('body').on('click', '.js-remove-free-gift', function (e) {
            $('.js-add-gift-input').val(0);
        });
    })();


//    Удаление блока в заказе
    $('.orders__block_close').on('click', function () {
        $(this).closest('.orders__block').hide();
    });

    //    Выбор количества товара
    $('.orders-counter__button').on('click', function () {

        var input = $(this).siblings('.orders-counter__window');
        var count = input.val();
        var price = parseInt($('.price_one').text().replace(/\D+/g, ""));
        
        $('#giftPrice').val(price);

        if ($(this).hasClass('orders-counter__button_plus')) {
            count++;
        } else {
            if (count != 1)
                count--;
        }

        input.val(count);

        //Пересчёт цен
        price *= count;
        $('.price_total').text(addSpace(price) + ' HM');
    });
});

function addSpace(number){
    number = number + '';
    number.split("").reverse().join("");
    return number.replace(/\B(?=(\d{3})+(?!\d))/g, " ");
}