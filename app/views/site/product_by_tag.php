<?php

/* @var $this yii\web\View */
/* @var $tag \app\models\Tag */

use yii\helpers\Html;
use app\helpers\ProductHelper;

$this->title = 'Продукты с тегом: ' . $tag->name . ' | taurus22';
$products = $tag->products;
?>

<div class="container">
    <div class="default-page">
        <h1><?= $tag->name ?></h1>
        <div class="tag-description">
            <?= $tag->description ?>
        </div>
        <?php if (empty($products)) : ?>
            <p>Продукты с указанным тегом - не найдены.</p>
        <?php else : ?>
            <div class="search-result">
                <?php foreach ($products as $product) :?>
                    <div class="search-item">
                        <div class="image">
                            <?= Html::a(Html::img(ProductHelper::getProductImagePath($product)), ProductHelper::getProductUrl($product)) ?>
                        </div>
                        <div class="text">
                            <p class="name">
                                <?= Html::a(ProductHelper::getShortName($product), ProductHelper::getProductUrl($product)) ?>
                            </p>
                        </div>
                    </div>
                    <p></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </div>
</div>


