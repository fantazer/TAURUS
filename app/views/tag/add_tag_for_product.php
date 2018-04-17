<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tag */
/* @var $product app\models\Product */

$this->title = 'Добавить тег к продукту ' . $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Управление продуктами', 'url' => ['product/index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['product/view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
