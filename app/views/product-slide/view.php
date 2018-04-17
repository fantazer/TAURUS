<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\helpers\ProductSlideHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSlide */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Управление слайдами продуктов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-slide-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить данный слайд?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'file',
                'format' => 'html',
                'value' => Html::img(ProductSlideHelper::getProductSlidePath($model)),
            ],
            [
                'attribute' => 'product_id',
                'value' => $model->product->name,
            ],
        ],
    ]) ?>

</div>
