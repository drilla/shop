<?php

use \frontend\helpers\HoneyItem as HoneyItemHelper;
use \frontend\helpers\Image as ImageHelper;
use yii\helpers\Url;

/**
 * @var string $category
 * @var \yii\web\View $this
 */

/** @var \common\models\ar\HoneyItem[] $items */
$items = \common\models\ar\HoneyItem::findByCategory($category)->all();
$formatter = Yii::$app->formatter;
$formatter->thousandSeparator=' '
?>

<div class="container">
    <h2 class="h2"><?= HoneyItemHelper::sectionTitle($category) ?></h2>

    <div class="row no-gutters">

        <?php foreach ($items as $item) : ?>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="card card_big">
                    <div class="card__img">
                        <img class="b-lazy" src="<?= ImageHelper::onePixelData() ?>" data-src="<?= $item->getImageUrl() ?>" alt=""/>
                    </div>
                    <div class="card__header">
                        <?= $item->name ?>
                    </div>
                    <div class="card__body">
                        <div class="lead lead_big"><?=$formatter->asDecimal($item->price, 0) ?> HM</div>
                        <?php if ($item->price) :?>
                        <button class="btn btn_white order js-order"
                                data-url="<?= Url::toRoute(['honey/order', 'gift_id' => $item->id]) ?>"
                                data-price="<?= $item->price ?>"
                        >Купить</button>
                        <?php else : ?>
                            <button class="btn btn_white btn_inactive order not-selectable"
                                    data-modal-content="<p class='fs-20 mb-0'>Доступен при заказе других товаров</p>"
                                    data-container-selector="#commonModalContainer"
                                    data-togge="modal" data-target="#onlyWithGiftModal">
                                В подарок!
                            </button>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>