<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Административный интерфейс | taurus22';
?>

<h1>Административный интерфейс</h1>

<p><?= Html::a('Категории', ['category/index'], ['class' => 'btn btn-primary']) ?></p>
<p><?= Html::a('Продукты', ['product/index'], ['class' => 'btn btn-primary']) ?></p>
<p><?= Html::a('Теги', ['tag/index'], ['class' => 'btn btn-primary']) ?></p>