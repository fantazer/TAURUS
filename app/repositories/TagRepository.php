<?php

namespace app\repositories;

use app\models\Tag;
use app\models\Category;

class TagRepository
{
    /**
     * @param integer $id
     *
     * @return null|\app\models\Tag
     */
    public static function findById($id)
    {
        return Tag::findOne($id);
    }

    /**
     * @param string $name
     *
     * @return null|\app\models\Tag
     */
    public static function findByName($name)
    {
        return Tag::find()
            ->where('name = :name', [
                ':name' => $name,
            ])
            ->one();
    }

    /**
     * @param $str
     * @return array
     */
    public static function findNamesByString($str)
    {
        return (new \yii\db\Query())
            ->select(['name'])
            ->from('{{tag}}')
            ->where(['like', 'name', $str])
            ->all();
    }

    /**
     * @param Category $category
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function findInCategory(Category $category)
    {
        return Tag::find()
            ->leftJoin('tag_product', 'tag_product.tag_id = tag.id')
            ->leftJoin('product', 'product.id = tag_product.product_id')
            ->where('product.category_id = :category_id', [
                ':category_id' => $category->id,
            ])
            ->all();
    }

    /**
     * @param $rootCategoryId
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function findInRootCategory($rootCategoryId)
    {
        return Tag::find()
            ->leftJoin('tag_product', 'tag_product.tag_id = tag.id')
            ->leftJoin('product', 'product.id = tag_product.product_id')
            ->leftJoin('category', 'category.root_category_id = :root_category_id', [
                ':root_category_id' => $rootCategoryId
            ])
            ->where('product.category_id = category.id')
            ->all();
    }

}