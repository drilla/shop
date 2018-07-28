<?php
/**
 * @var \yii\web\View  $this
 */

use \common\models\ar;

$mainOfferFamily =ar\OfferHoneyFamily::findMain();

//получаем и сортируем по цене
$families = ar\OfferHoneyFamily::findAll(['is_main' => false]);
ar\OfferHoneyFamily::sortByMaxValue($families);

//разбиваем на пары
$offerFamilyPairs = \common\helpers\ArrayHelper::toChunks($families, 2);

?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="h2">Баллы за апрувы</h2>
        </div>

        <div class="col-12">
            <div class="d-flex pb-4 pt-4 scroll-x" style="overflow-x: auto;">

                <?php if ($mainOfferFamily) : ?>
                    <div class="d-flex flex-column">
                        <?= $this->render('_offer-point-card',  ['offerFamily' => $mainOfferFamily, 'additionalClass' => 'card_points_big']) ?>
                    </div>
                <?php endif; ?>

                <?php foreach ($offerFamilyPairs as $pair) : ?>
                    <div class="d-flex flex-column">
                        <?php foreach ($pair as $offerFamily) :?>
                            <?= $this->render('_offer-point-card',  ['offerFamily' => $offerFamily, 'additionalClass2' => 'ml-3']) ?>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
