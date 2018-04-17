<?php

namespace app\helpers;

use app\models\ProductSlide;

class ProductSlideHelper
{
    public static function getProductSlidePath(ProductSlide $productSlide)
    {
        return \Yii::getAlias('@web/img/product/') . $productSlide->file;
    }

    public static function getProductSlideAbsolutePath(ProductSlide $productSlide)
    {
        return \Yii::getAlias('@webroot/img/product/') . $productSlide->file;
    }
}