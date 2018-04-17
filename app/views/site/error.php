<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\web\NotFoundHttpException;

$this->title = $name;
?>

<div class="error-page">
    <div class="message">
        <?php if(get_class($exception) == 'yii\web\NotFoundHttpException') : ?>
            <p>Страница не найдена</p>
            <?= Html::a('Перейти на главную', ['/']) ?>
        <?php else : ?>
            <p>Ошибка: <?= $exception->getCode() ?></p>
            <p><?= $message ?></p>
        <?php endif; ?>
    </div>

</div>