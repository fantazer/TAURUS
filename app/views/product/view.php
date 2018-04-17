<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\repositories\CategoryRepository;
use app\helpers\ProductHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Управление продуктами', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить данный продукт?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'video',
            [
                'label' => $model->getAttributeLabel('image'),
                'value' => Html::img(ProductHelper::getProductImagePath($model)),
                'format' => 'html',
            ],
            [
                'label' => $model->getAttributeLabel('characteristics'),
                'value' => ProductHelper::formatCharacteristicToString(ProductHelper::getFormattedCharacteristics($model)),
            ],
            [
                'label' => $model->getAttributeLabel('category_id'),
                'value' => CategoryRepository::findById($model->category_id)->name,
            ],
            'url',
            'price',
            'meta_title:ntext',
            'meta_keywords:ntext',
            'meta_description:ntext',
        ],
    ]) ?>
    <div class="tags">
        <h3>Теги</h3>
        <?= Html::a('Добавить тег', ['tag/create-tag-for-product', 'product_id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php foreach ($model->tags as $tag) : ?>
            <div class="item">
                <span class="btn btn-info"><?= $tag->name ?></span>
                <?= Html::a('Удалить', ['tag/remove-tag-from-product', 'tag_id' => $tag->id, 'product_id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить данный тег?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="product-slides">
        <h3>Слайды</h3>
        <?= Html::a('Добавить слайд', ['product-slide/create', 'product_id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php foreach ($model->productSlides as $productSlide) : ?>
            <div class="item">
                <?= Html::a('Удалить слайд', ['product-slide/delete', 'id' => $productSlide->id, 'return' => true], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить данный слайд?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::img(\app\helpers\ProductSlideHelper::getProductSlidePath($productSlide)) ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
