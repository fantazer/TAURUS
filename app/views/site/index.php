<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\RootCategory;

$this->title = 'Производственное объединение «МОДУЛЬ»';
?>

<div id="index">
    <div class="site-title">
        <h1>Производственное объединение «МОДУЛЬ»</h1>
    </div>
    <div class="index-slider">

        <div class="slide">
            <div class="block" style="background-image: url(img/main_slide_4.jpg)">
                <div class="index-controls">
                    <div class="category-name show-hidden-menu" data-category-number="<?= RootCategory::CATEGORY_ACCESSIBLE_ENVIRONMENT ?>">
                        <h2>Программа "Доступная среда"</h2>
                        <?= Html::a(
                            null,
                            null,
                            [
                                'class' => 'btn show-hidden-menu',
                                'data-category-number' => RootCategory::CATEGORY_ACCESSIBLE_ENVIRONMENT,
                            ]
                        ) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="slide">
            <div class="block" style="background-image: url(img/main_slide_3.jpg)">

                <div class="index-controls">
                    <div class="category-name show-hidden-menu" data-category-number="<?= RootCategory::CATEGORY_MUDGUARDS ?>">
                        <h2>Системы грязезащиты</h2>
                        <?= Html::a(
                            null,
                            null,
                            [
                                'class' => 'btn show-hidden-menu',
                                'data-category-number' => RootCategory::CATEGORY_MUDGUARDS,
                            ]
                        ) ?>
                    </div>
                </div>

            </div>

        </div>
        <div class="slide">
            <div class="block" style="background-image: url(img/main_slide_5.jpg)">
                <div class="index-controls">
                    <div class="category-name show-hidden-menu" data-category-number="<?= RootCategory::CATEGORY_LED_LIGHTING ?>">
                        <h2>Светодиодное освещение</h2>
                        <?= Html::a(
                            null,
                            null,
                            [
                                'class' => 'btn show-hidden-menu',
                                'data-category-number' => RootCategory::CATEGORY_LED_LIGHTING,
                            ]
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide">
            <div class="block" style="background-image: url(img/main_slide_2.jpg)">
                <div class="index-controls">
                    <div class="category-name show-hidden-menu" data-category-number="<?= RootCategory::CATEGORY_EKOTEHNIKA ?>">
                        <h2>Экологическая техника</h2>
                        <?= Html::a(
                            null,
                            null,
                            [
                                'class' => 'btn show-hidden-menu',
                                'data-category-number' => RootCategory::CATEGORY_EKOTEHNIKA,
                            ]
                        ) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="slide">
            <div class="block" style="background-image: url(img/main_slide_1.jpg)">

                <div class="index-controls">
                    <div class="category-name show-hidden-menu" data-category-number="<?= RootCategory::CATEGORY_FLOOR_COVERINGS ?>">
                       <h2>Специальные напольные покрытия</h2>
                        <?= Html::a(
                            null,
                            null,
                            [
                                'class' => 'btn show-hidden-menu',
                                'data-category-number' => RootCategory::CATEGORY_FLOOR_COVERINGS,
                            ]
                        ) ?>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


