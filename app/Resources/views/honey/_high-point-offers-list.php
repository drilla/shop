<?php

use frontend\helpers;
use common\models\ar;

/** @var ar\OfferHoneyFamily[] $families */
$families = ar\OfferHoneyFamily::find()->where(['show_in_enhanced_offers' => true])->all();
?>

<?php foreach ($families as $family) : ?>
    <div class="card cursor-pointer" 
        data-modal-href="<?= \yii\helpers\Url::toRoute(['honey/offer-family-bonuses', 'id' => $family->id]) ?>"
        data-toggle="modal"
        data-target="#modalPoints"
        data-container-selector="#modalPointsBody"
    >
        <div class="card__img">
            <img class="b-lazy" src="<?= helpers\Image::onePixelData() ?>"
                 data-src="<?= $family->getImageUrl() ?>" alt=""/>
        </div>
        <div class="card__header">
            <div>
                <?php foreach ($family->getCountryCategories() as $category) : ?>
                    <img class="flag b-lazy"
                         src="<?= helpers\Image::onePixelData() ?>"
                         data-src="<?= helpers\Country::categoryFlagUrl($category) ?>" alt=""/>
                <?php endforeach; ?>
            </div>
            <span class="card__link"><?= $family->offer->name ?></span>
        </div>
        <div class="card__body">
            <div class="lead">1 апрув = до <?= $family->getMaxHoneyRateValue() ?> HM</div>
        </div>
    </div>
<?php endforeach; ?>
