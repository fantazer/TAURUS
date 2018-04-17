<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\RootCategory;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Управление категориями', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить указанную категорию?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description',
            [
                'label' => $model->getAttributeLabel('root_category_id'),
                'value' => RootCategory::getRootCategoryLabel($model->root_category_id),
            ],
            [
                'label' => 'url',
                'value' => $model->url ?
                    RootCategory::getRootCategoryUrl($model->root_category_id) . '/' . $model->url :
                    RootCategory::getRootCategoryUrl($model->root_category_id) . '/' . $model->id,
            ],
            'meta_title:ntext',
            'meta_keywords:ntext',
            'meta_description:ntext',
        ],
    ]) ?>

</div>
