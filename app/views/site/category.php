<?php

/* @var $this yii\web\View */
/* @var $category \app\models\Category */

use yii\helpers\Url;

$this->title = $category->name;
?>

<div class="catalog">
    <div class="container">
        <h1><?= $category->name ?></h1>

        <!--<div class="filters">
            <div class="search full-size">
                <form action="<?/*= Url::to(['site/search']) */?>" method="get">
                    <input type="text" class="catalog-search" name="search" placeholder="Поиск по каталогу">
                </form>
            </div>
        </div>-->
        <?= $this->render('products', ['products' => $category->products]) ?>
        <?= $this->render('designer_copyright') ?>
         <div class="category-description">
            <?= $category->description ?>
        </div>
    </div>
</div>


