<?php

namespace AppBundle\Helper;

use AppBundle\Entity\Product as ProductEntity;

class Product
{

    public static function category(ProductEntity $product) : string {
        return self::categoryLabels()[$product->getCategory()] ?? '';
    }

    public static function categoryLabels() : array {
        return [
            ProductEntity::CAT_JOINT => 'Спина и суставы',
            ProductEntity::CAT_CREAM => 'Крема',
            ProductEntity::CAT_WRINKLES => 'Красота и молодость',
        ];
    }

}