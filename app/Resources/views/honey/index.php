<?php

use common\models\ar;
use frontend\helpers;
use yii\helpers\Html;

/**
 * @var bool $isBonusAvailable
 * @var int $honeyBonus
 * @var bool $isGuest
 * @var \common\models\ar\User $user
 * @var \common\models\ar\UserProfile
 *
 * @var \yii\web\View $this
 */

/** @var ar\HoneyItem[] $almostCanTakeItems */
$almostCanTakeItems = ar\HoneyItem::findForAlmostPrice($honeyBonus)->all();
?>

<section class="sec sec_1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-xl-4">
                <h1 class="h1">Honey<br class="d-none d-md-inline d-lg-none"> Money<br
                            class="d-none d-md-inline d-lg-none"> Market<span>Витрина подарков за лиды</span></h1>
            </div>
            <div class="col-12 col-xl-8">
                <p class="fs-24 text-uppercase mb-5"><b>схема участия</b></p>

                <div class="row c-grey4 d-lg-flex justify-content-center animated fadeInRight">
                    <div class="col-12 col-md-4 col-lg-3 mb-3 mb-md-0">
                        <div class="fs-60 fw-900 c-grey3">01</div>
                        Наливай на любой<br>оффер и ГЕО партнерской сети <a href="//adbees.com" target="_blank">Adbees.com</a>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3 mb-3 mb-md-0">
                        <div class="fs-60 fw-900 c-grey3">02</div>
                        Зарабатывай баллы –<br>HoneyMoney (HM)<br>за апрувленные лиды
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="fs-60 fw-900 c-grey3">03</div>
                        Забирай свой<br>подарок
                    </div>
                </div>

                <?php if ($isGuest): ?>
                    <?= Html::a('Принять участие', \yii\helpers\Url::to( Yii::$app->params['affiliateHost']), ['target'=>"_blank", 'class' => 'btn d-inline-block mt-5']) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="sec sec_2 animated fadeInLeft" id="highPointOffers">
    <?= $this->render('high-point-offers') ?>
</section>

<section class="sec sec_3 aos aos_right" id="forWork">
    <?= $this->render('item-section', ['category' => ar\HoneyItem::CATEGORY_FOR_WORK]) ?>
</section>

<section class="sec sec_4 aos aos_left" id="gadgets">
    <?= $this->render('item-section', ['category' => ar\HoneyItem::CATEGORY_GADGET]) ?>
</section>

<section class="sec sec_5 aos aos_right" id="toys">
    <?= $this->render('item-section', ['category' => ar\HoneyItem::CATEGORY_TOY]) ?>
</section>

<section class="sec sec_6 aos aos_left" id="cars">
    <?= $this->render('item-section', ['category' => ar\HoneyItem::CATEGORY_AUTO]) ?>
</section>

<section class="sec sec_7 aos aos_right" id="other">
    <?= $this->render('item-section', ['category' => ar\HoneyItem::CATEGORY_OTHER]) ?>
</section>

<?php if ($almostCanTakeItems) : ?>
    <section class="sec sec_no-hb">
        <div class="container">
            <h2 class="h2 text-center text-lg-right text-xl-center mr-lg-6">на эти товары не хватает совсем чуть-чуть
                HM</h2>

            <div class="owl-carousel owl_nohb">
                <?php foreach ($almostCanTakeItems as $almostCanTakeItem) : ?>

                    <div class="card card_no-hb">
                        <div class="card__img">
                            <img class="b-lazy" src="<?= helpers\Image::onePixelData() ?>"
                                 data-src="<?= $almostCanTakeItem->getImageUrl() ?>" alt=""/>
                        </div>
                        <div class="card__header">
                            <?= $almostCanTakeItem->name ?>
                        </div>
                        <div class="card__body">
                            <div class="lead lead_big"><?= $almostCanTakeItem->price ?> HM</div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="sec sec_12 aos aos_left">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-4">
                <img class="chuvak b-lazy" src="<?= helpers\Image::onePixelData() ?>"
                     data-src="../md/honey/img/chuvak.png" alt=""/>
            </div>
            <div class="col-xl-6 col-lg-8">
                <p class="fs-30 lh-117 mb-6"><b>В витрине нет<br> того, что ты хочешь?</b></p>
                <p>Отправь нам ссылку на товар, и мы его добавим</p>

                <?php $ticketFrom = \yii\bootstrap\ActiveForm::begin([
                        'action' => ['add-honey-item'],
                        'method' => 'post',
                        'options' => ['class' => 'form form_wish'],
                ]) ?>

                <input type="hidden"  name='Ticket[iAgree]' value="1">
                <input type="hidden"  name='Ticket[theme]' value="Хочу новый товар">

                <div class="d-flex flex-column flex-md-row align-items-center mb-3">
                    <input type="text" class="form__text mr-0 mb-3 mb-md-0 mr-md-45" name='Ticket[message]' required=""
                           placeholder="Место для ссылки">
                    <button type="submit" class="btn">отправить</button>
                </div>
<!--                <div class="radio radio_cb">-->
<!--                    <label class="radio__label">-->
<!--                        <input type="checkbox" class="radio__input" name="notify"> Оповестить по email о добавлении-->
<!--                        товара-->
<!--                        <span class="radio__checkmark"></span>-->
<!--                    </label>-->
<!--                </div>-->

                <?php \yii\bootstrap\ActiveForm::end() ?>
            </div>
        </div>
    </div>
</section>

<section class="sec sec_points" id="points">
    <?= $this->render('approve-points') ?>
</section>

<section class="sec sec_9 aos aos_left" id="rules">
    <div class="container">
        <h2 class="h2">правила участия</h2>

        <div class="row">
            <div class="col-12 col-lg-6 mb-3 mb-lg-5 d-md-flex">
                <div class="fs-60 fw-900 c-grey3 lh-1 mr-md-5 w_7-5">01</div>
                <p class="pt-2">Период проведения акции с 06.06.2018 по 31.12.2019</p>
            </div>
            <div class="col-12 col-lg-6 mb-3 mb-lg-5 d-md-flex">
                <div class="fs-60 fw-900 c-grey3 lh-1 mr-md-5 w_7-5">02</div>
                <p class="pt-2">В акции участвуют все товарные офферы партнерской сети Adbees.com</p>
            </div>
            <div class="col-12 col-lg-6 mb-3 mb-lg-5 d-md-flex">
                <div class="fs-60 fw-900 c-grey3 lh-1 mr-md-5 w_7-5">03</div>
                <p class="pt-2">Баллы(HoneyMoney) начисляются за каждый апрувленный лид. Ставки отчислений остаются прежними</p>
            </div>
            <div class="col-12 col-lg-6 mb-3 mb-lg-5 d-md-flex">
                <div class="fs-60 fw-900 c-grey3 lh-1 mr-md-5 w_7-5">04</div>
                <p class="pt-2">За каждый заказанный товар с участника акции списывается стоимость в HoneyMoney</p>
            </div>
            <div class="col-12 col-lg-6 mb-3 mb-lg-5 d-md-flex">
                <div class="fs-60 fw-900 c-grey3 lh-1 mr-md-5 w_7-5">05</div>
                <p class="pt-2">Монеты могут обнуляться в двух случаях:<br>
                    • Если в течение каждого 31 дня с момента старта акции вебмастер наливает менее 29 подтвержденных
                    заявок<br>
                    • Если монеты не потрачены до 31 декабря 2019 года</p>
            </div>
            <div class="col-12 col-lg-6 mb-3 mb-lg-5 d-md-flex">
                <div class="fs-60 fw-900 c-grey3 lh-1 mr-md-5 w_7-5">06</div>
                <p class="pt-2">Все участники акции обязуются соблюдать правила работы
                    с партнёрской сетью. За нарушение любого из правил учётная
                    запись в Adbees.com будет заблокирована, а баланс HoneyMoney аннулирован</p>
            </div>
            <div class="col-12 col-lg-6 mb-3 mb-lg-5 d-md-flex">
                <div class="fs-60 fw-900 c-grey3 lh-1 mr-md-5 w_7-5">07</div>
                <p class="pt-2">
                    За 1 апрувленный лид начисляется от <?= ar\HoneyBonusRate::find()->where('value > 0')->min('value') ?> до <?= ar\HoneyBonusRate::find()->max('value') ?> Honey Money, в зависимости от оффера и Гео.
                    <a href="#points">Подробнее тут</a>
                </p>
            </div>
            <div class="col-12 col-lg-6 mb-3 mb-lg-5 d-md-flex">
                <div class="fs-60 fw-900 c-grey3 lh-1 mr-md-5 w_7-5">08</div>
                <p class="pt-2">Текущий баланс монет отображается в личном кабинете вебмастера рядом с балансом</p>
            </div>
            <!--<div class="w-100"></div>-->
            <div class="col-12">
                <p class="c-grey2 text-lg-center"><i>Условия акции могут меняться. Следите за новостями</i></p>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="notEnoughPoints" tabindex="-1" role="dialog" aria-labelledby="notEnoughPointsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-lg-7">
                            <p class="fs-45 mb-0"><b>Так, так, так</b></p>
                            <p class="fs-18 c-grey4">А Honey Money то не хвататет</p>
                            <p class="c-grey">Чтобы получить данный товар, накопите еще Honey Money,
                                а чтобы у Вас это быстрее получилось, воспользуйтесь
                                офферами с повышенными баллами</p>
                        </div>
                        <div class="d-none d-md-block col-lg-5 text-center">
                            <img id="offer-modal-img" class="img-fluid my-3 my-lg-0" src="../md/honey/img/gifts/MSI GT72S.jpg" alt=""/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="owl-carousel owl_modal">
                    <?= $this->render('_high-point-offers-list') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPoints" tabindex="-1" role="dialog" aria-labelledby="modalPointsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0" id="modalPointsBody">
                <!-- modal content dynamic load here-->
            </div>
        </div>
    </div>
</div>

<!--Общее модальное окно-->
<div class="modal fade" id="onlyWithGiftModal" tabindex="-1" role="dialog" aria-labelledby="onlyWithGiftModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="container-fluid">
                    <div class="row align-items-center pt-4 pb-5 px-5 px-md-7">
                        <div class="col-12 text-center" id="commonModalContainer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

