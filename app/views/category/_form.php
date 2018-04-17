<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\RootCategory;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'custom'
    ]) ?>

    <?= $form->field($model, 'root_category_id')->dropDownList(RootCategory::getRootCategoryLabels(), ['prompt' => 'Выберите корневую категорию']) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort_weight')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'meta_title')->textInput() ?>

    <?= $form->field($model, 'meta_keywords')->textInput() ?>

    <?= $form->field($model, 'meta_description')->textarea(['rows' => 3]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
