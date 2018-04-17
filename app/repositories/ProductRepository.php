<?php

namespace app\repositories;

use app\models\Product;

class ProductRepository
{
    /**
     * @return \app\models\Product[]
     */
    public static function findAll()
    {
        return Product::find()->all();
    }

    /**
     * @param $id
     *
     * @return null|\app\models\Product
     */
    public static function findById($id)
    {
        return Product::findOne($id);
    }

    /**
     * @param $url
     *
     * @return null|\app\models\Product
     */
    public static function findByUrl($url)
    {
        return Product::find()
            ->where('url = :url', [
                ':url' => $url,
            ])
            ->one();
    }

    /**
     * @param $search
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function findNameOrDescriptionLike($search)
    {
        $search = '%' . $search . '%';

        return Product::find()
            ->where('name LIKE :name OR description LIKE :description', [
                ':name' => $search,
                ':description' => $search,
            ])
            ->all();
    }
}