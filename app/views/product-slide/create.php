<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSlide */
/* @var $product app\models\Product */

$this->title = 'Добавить слайд продукта';
if (!is_null($product)) {
    $this->params['breadcrumbs'][] = ['label' => 'Управление продуктами', 'url' => ['product/index']];
    $this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['product/view', 'id' => $product->id]];
} else {
    $this->params['breadcrumbs'][] = ['label' => 'Управление слайдами продуктов', 'url' => ['index']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-slide-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
