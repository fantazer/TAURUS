<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Tag */
/* @var $form yii\widgets\ActiveForm */

$script = <<< SCRIPT
    $(document).ready(function() {
        $("#tag-name").autocomplete({
            source: function(request, response){
                $.ajax({
                    type: 'POST',
                    url: $('#search-url').val(),
                    dataType: "json",
                    data: {
                        tag: $('#tag-name').val()
                    },
                    success: function(data) {
                        response($.map(data, function(item){
                            console.log
                            return {
                                label: item.name
                            }
                        }));
                    }
                });
            },
            minLength: 2
        });
    });
SCRIPT;

$this->registerJs($script, yii\web\View::POS_END);

?>

<?= Html::hiddenInput('search_url', Url::to(['tag/ajax-search-tag']), ['id' => 'search-url']) ?>

<div class="tag-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'custom'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
