<?php

namespace app\repositories;

use app\models\Category;
use yii\helpers\ArrayHelper;

/**
 * Class CategoryRepository
 */
class CategoryRepository
{
    /**
     * @param $rootCategoryId
     * @param $order
     *
     * @return \app\models\Category[]
     */
    public static function findByRootCategoryId($rootCategoryId, $order = 'DESC')
    {
        return Category::find()
            ->where('root_category_id = :root_category_id', [
                ':root_category_id' => $rootCategoryId,
            ])
            ->orderBy('sort_weight ' . $order)
            ->all();
    }

    /**
     * @param $categoryId
     *
     * @return null|static
     */
    public static function findById($categoryId)
    {
        return Category::findOne($categoryId);
    }

    /**
     * @param $url
     *
     * @return null|\app\models\Category
     */
    public static function findByUrl($url)
    {
        return Category::find()
            ->where('url = :url', [
                ':url' => $url,
            ])
            ->one();
    }

    /**
     * @return null|\app\models\Category
     */
    public static function findAll()
    {
        return Category::find()->all();
    }

    /**
     * @param \app\models\Category[] $categories
     *
     * @return array
     */
    public static function formatForDropDown($categories)
    {
        if (is_array($categories) && !empty($categories)) {
            return ArrayHelper::map($categories, 'id', 'name');
        } else {
            return [];
        }
    }
}