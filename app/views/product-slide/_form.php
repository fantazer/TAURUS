<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\repositories\ProductRepository;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSlide */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-slide-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'file')->fileInput(['required' => 'required']) ?>

    <?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map(ProductRepository::findAll(), 'id', 'name')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
