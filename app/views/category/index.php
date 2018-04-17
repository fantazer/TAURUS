<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\RootCategory;


/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Category */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Управление категориями';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'root_category_id',
            [
                'attribute' => 'root_category_id',
                'value' => function ($model) {
                    return RootCategory::getRootCategoryLabel($model->root_category_id);
                },
                'filter' => RootCategory::getRootCategoryLabels(),
            ],
            'url',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
