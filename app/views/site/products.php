<?php

/* @var $this yii\web\View */
/* @var $products \app\models\Product[] */

use app\helpers\ProductHelper;

?>

<div class="products">
    <?php if (empty($products)) : ?>
        <p>В данной категории нет продуктов</p>
    <?php else : ?>
        <?php foreach($products as $product) : ?>
            <div class="product-item">
                <a href="<?= ProductHelper::getProductUrl($product) ?>">
                    <div class="image">
                        <?php if (!is_null($product->image) && !empty($product->image)) : ?>
                            <?= \yii\helpers\Html::img(ProductHelper::getProductImagePath($product))?>
                        <?php else : ?>
                            <img src="<?= Yii::$app->request->baseUrl ?>/img/catalog_category_bg_dummy.png" />
                        <?php endif ?>
                    </div>
                    <p class="name">
                        <?= ProductHelper::getShortName($product) ?>
                    </p>
                </a>
            </div>
        <?php endforeach ?>
    <?php endif ?>
</div>