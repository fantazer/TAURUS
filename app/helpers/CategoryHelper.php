<?php

namespace app\helpers;

use app\models\RootCategory;
use app\models\Category;

class CategoryHelper
{
    public static function getCategoryUrl(Category $category)
    {
        if (!is_null($category->url) && $category->url != '') {
            return '/' . RootCategory::getRootCategoryUrl($category->root_category_id) . '/' . $category->url;
        } else {
            return '/' . RootCategory::getRootCategoryUrl($category->root_category_id) . '/' . $category->id;
        }
    }
}