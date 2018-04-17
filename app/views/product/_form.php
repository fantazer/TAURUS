<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\repositories\CategoryRepository;
use app\helpers\ProductHelper;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */

$script = <<< SCRIPT
    $(document).ready(function() {
        $('#add-characteristic').click(function() {
            var items = $('.characteristics').find('.item'),
                item = $('.characteristics').find('.item')[0];
            
            $('.characteristics').append(clearTemplate($(item).clone()));
        });
        
        var clearTemplate = function(template) {
            $(template).find('input[type = "text"]').val('');
            $(template).find('.remove-characteristic').removeClass('hidden').click(function () {
                $(template).remove();
            });
            
            return template;
        };
    });
SCRIPT;

$this->registerJs($script, yii\web\View::POS_END);

?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'custom'
    ]) ?>

    <?= $form->field($model, 'video')->textInput() ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'category_id')->dropDownList(CategoryRepository::formatForDropDown(CategoryRepository::findAll()), ['prompt' => 'Выберите категорию']) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <div class="characteristics">
            <?php if (!ProductHelper::isCharacteristicsEmpty($model)) : ?>
                <?php foreach (ProductHelper::getFormattedCharacteristics($model) as $charName => $charValue) : ?>
                    <div class="item">
                        <div class="form-group">
                            <?= Html::label('Название характеристики', null, ['class' => 'control-label']) ?>
                            <?= Html::input('text', 'Product[characteristics][name][]', $charName, ['class' => 'form-control']) ?>
                            <?= Html::label('Значение характеристики', null, ['class' => 'control-label']) ?>
                            <?= Html::input('text', 'Product[characteristics][value][]', $charValue, ['class' => 'form-control']) ?>
                            <?= Html::input('button', null, 'Удалить характеристику', ['class' => 'btn btn-warning remove-characteristic'])?>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php else : ?>
                <div class="item">
                    <div class="form-group">
                        <?= Html::label('Название характеристики', null, ['class' => 'control-label']) ?>
                        <?= Html::input('text', 'Product[characteristics][name][]', null, ['class' => 'form-control']) ?>
                        <?= Html::label('Значение характеристики', null, ['class' => 'control-label']) ?>
                        <?= Html::input('text', 'Product[characteristics][value][]', null, ['class' => 'form-control']) ?>
                        <?= Html::input('button', null, 'Удалить характеристику', ['class' => 'btn btn-warning remove-characteristic hidden'])?>
                    </div>
                </div>
            <?php endif ?>
        </div>
        <?= Html::input('button', null, 'Добавить характеристику', ['class' => 'btn btn-success', 'id' => 'add-characteristic'])?>
    </div>

    <?= $form->field($model, 'sort_weight')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'meta_title')->textInput() ?>

    <?= $form->field($model, 'meta_keywords')->textInput() ?>

    <?= $form->field($model, 'meta_description')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
