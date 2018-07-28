<?php
/**
 * Контент для модального окна с количеством бонусов по гео для оффера
 *
 * @var \common\models\ar\OfferHoneyFamily $offerFamily
 */
?>

<div class="container-fluid">
    <div class="row align-items-center pt-4 pb-5 px-5 px-md-7">
        <div class="col-lg-4 text-center">
            <img id="offer-modal-img" class="img-fluid my-3 my-lg-0" src="<?= $offerFamily->getImageUrl() ?>" alt=""/>
        </div>
        <div class="col-lg-8 text-center text-md-left">
            <p class="fs-20"><?= $offerFamily->name ?></p>
            <p class="fs-14 c-grey2 mb-4">Lorem ipsum dolor sit amet,
                consectetur adipisicing elit, sed do eiusmod tempor</p>
            <a href="#" target="_blank" class="btn btn_no-fw d-inline-block">Начать лить</a>
        </div>
    </div>
</div>

<div class="container-fluid bg-grey">
    <div class="row pt-5 pb-5 px-5 px-md-7">
        <div class="col-12 mb-2">
            <p class="fs-15"><b>Баллы по гео</b></p>
        </div>
        <div class="col-12 column-2 fs-13">

            <?php foreach ($offerFamily->offer->honeyBonusRates as $bonusRate) : ?>
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex c-grey">
                        <img class="mr-2" src="<?= \frontend\helpers\Country::flagUrl($bonusRate->country->iso) ?>">
                        <?= $bonusRate->country->name_ru ?>
                    </div>
                    <span class="text-uppercase"><b><?= $bonusRate->value ?> HM</b></span>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>