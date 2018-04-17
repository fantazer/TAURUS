<?php

namespace app\helpers;

use app\models\Product;

class ProductHelper
{
    /**
     * @var integer
     */
    const NAME_SHORT_LENGTH = 70;

    /**
     * @var string
     */
    const IMG_PRODUCT_NO_PHOTO = 'product_no_photo.png';

    /**
     * @param Product $product
     *
     * @return string
     */
    public static function getProductUrl(Product $product)
    {
        if (!is_null($product->url) && $product->url != '') {
            return CategoryHelper::getCategoryUrl($product->category) . '/' . $product->url;
        } else {
            return CategoryHelper::getCategoryUrl($product->category) . '/' . $product->id;
        }
    }

    /**
     * @param Product $product
     *
     * @return string|false
     */
    public static function formatCharacteristics(Product $product)
    {
        $characteristic = $product->characteristics;

        if (is_array($characteristic) &&
            isset($characteristic['name']) &&
            isset($characteristic['value']) &&
            count($characteristic['name']) == count($characteristic['value'])
        ) {
            $names = $characteristic['name'];
            $values = $characteristic['value'];

            $data = [];

            for ($iter = 0; $iter < count($names); $iter++) {
                $data[] = [
                    'name' => $names[$iter],
                    'value' => $values[$iter],
                ];
            }

            return json_encode($data);
        } else {
            $product->addError('characteristic', 'Некорректный формат характеристик');
        }
    }

    /**
     * @param Product $product
     *
     * @return array
     */
    public static function getFormattedCharacteristics(Product $product)
    {
        $characteristics = json_decode($product->characteristics);

        $data = [];

        foreach ($characteristics as $characteristic) {
            $data[$characteristic->name] = $characteristic->value;
        }

        return $data;
    }

    /**
     * @param array $characteristics
     *
     * @return string
     */
    public static function formatCharacteristicToString(array $characteristics)
    {
        $result = [];

        foreach ($characteristics as $characteristicName => $characteristicValue) {
            $result[] = $characteristicName . ' - ' . $characteristicValue;
        }

        return implode(', ', $result);
    }

    /**
     * @param Product $product
     * @return bool
     */
    public static function isCharacteristicsEmpty(Product $product)
    {
        if (empty($product->characteristics)) {
            return true;
        } else {
            $characteristic = self::getFormattedCharacteristics($product);
            $key = key($characteristic);
            $value = current($characteristic);

            if ($key == '' || $value == '') {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * @param Product $product
     * @return string
     */
    public static function getProductImagePath(Product $product)
    {
        if (empty($product->image)) {
            return \Yii::getAlias('@web/img/') . self::IMG_PRODUCT_NO_PHOTO;
        } else {
            return \Yii::getAlias('@web/img/product/for_category/') . $product->image;
        }
    }

    /**
     * @param Product $product
     * @return string
     */
    public static function getProductImageAbsolutePath(Product $product)
    {
        if (empty($product->image)) {
            return null;
        } else {
            return \Yii::getAlias('@webroot/img/product/for_category') . '/' . $product->image;
        }
    }

    /**
     * @param Product $product
     * @return string
     */
    public static function getShortName(Product $product)
    {
        $name = strip_tags($product->name);
        $name = trim($name);

        if (strlen($name) <= self::NAME_SHORT_LENGTH) {
            return $name;
        } else {
            return mb_substr($name, 0, self::NAME_SHORT_LENGTH, 'UTF-8') . '...';
        }

    }
}