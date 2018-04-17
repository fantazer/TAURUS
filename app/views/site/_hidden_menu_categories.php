<?php
/** @var integer $rootCategoryId */

use app\repositories\CategoryRepository;
use app\repositories\TagRepository;
use app\models\RootCategory;
use app\helpers\CategoryHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$categories = CategoryRepository::findByRootCategoryId($rootCategoryId);

$tags = [];

if (RootCategory::isCategoryHaveTagFilter($rootCategoryId)) {
    $tags = TagRepository::findInRootCategory($rootCategoryId);
}

?>

<div class="part" data-category-part="<?= $rootCategoryId ?>">
    <h2><?= RootCategory::getRootCategoryLabel($rootCategoryId) ?></h2>
    <div class="filters">
        <?php if (!empty($tags)) : ?>
            <div class="tag-filter tag-filter-form">
                <?= Html::beginForm(['site/product-by-tag'], 'get') ?>
                    <?= Html::dropDownList('tag', null, ArrayHelper::map($tags, 'id', 'name'), [
                        'class' => 'select-box-lt tag-filter',
                        'prompt' => 'Фильтр по назначению',
                    ]) ?>
                    <?= Html::submitButton('Показать', ['class' => 'btn submit-tag-form']) ?>
                <?= Html::endForm() ?>
            </div>
        <?php else : ?>
            <div class="search<?php if (empty($tags)) echo ' full-size' ?>">
                <form action="<?= Url::to(['site/search']) ?>" method="get">
                    <input type="text" class="catalog-search" name="search" placeholder="Поиск по каталогу">
                </form>
            </div>
        <?php endif ?>
    </div>
    <div class="categires">
        <?php if (empty($categories)) : ?>
            <p>В данной категории нет подкатегорий.</p>
        <?php else : ?>
            <?php foreach ($categories as $category) : ?>
                <div class="category">
                    <?= Html::a($category->name, CategoryHelper::getCategoryUrl($category)) ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
