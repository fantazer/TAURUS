<?php

/* @var $this yii\web\View */
/* @var $products \app\models\Product[] */
/* @var $search string */

use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\ProductHelper;

$this->title = 'Резульаты поиска по запросу: ' . $search . ' | taurus22';
?>

<div class="container">
    <div class="default-page">
        <h1>Результаты поиска</h1>
        <div class="filters filter-search">
            <div class="search full-size">
                <form action="<?= Url::to(['site/search']) ?>" method="get">
                    <input type="text" class="catalog-search" name="search" placeholder="Поиск по каталогу" value="<?= $search ?>">
                </form>
            </div>
        </div>
        <?php if (empty($products)) : ?>
            <p>По вашему запросу не найдено совпадений.</p>
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
    <?= $this->render('designer_copyright') ?>
</div>


