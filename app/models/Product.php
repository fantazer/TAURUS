<?php

namespace app\models;

use app\helpers\ProductHelper;
use app\behaviors\ActiveRecord\ImageUploadBehavior;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $characteristics
 * @property integer $category_id
 * @property string $image
 * @property string $url
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $price
 * @property integer $sort_weight
 *
 * @property Category $category
 * @property ProductSlide[] $productSlides
 * @property Tag[] $tags
 */
class Product extends \yii\db\ActiveRecord
{
	const SCENARIO_SEARCH = 'product_search_scenario';
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category_id'], 'required'],
            [['description', 'characteristics', 'meta_title', 'meta_keywords', 'meta_description', 'video'], 'string'],
            [['category_id', 'sort_weight'], 'integer'],
            [['image'], 'file', 'extensions' => 'jpg, png, jpeg, gif', 'on' => ['create', 'update']],
            [['name', 'url', 'image', 'price'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => ImageUploadBehavior::className(),
                'modelFileAttrName' => 'image',
                'fileDir' => \Yii::getAlias('@webroot/img/product/for_category/'),
                'imageWidth' => 231,
                'imageHeight' => 162,
            ],
        ];
    }

    public function attributeLabels() {
        return [
            'id'               => 'ID',
            'name'             => 'Название',
            'description'      => 'Описание',
            'image'            => 'Изображение (только для списка в категории)',
            'characteristics'  => 'Характеристики',
            'price'            => 'Цена',
            'category_id'      => 'Категория',
            'url'              => 'Url',
            'meta_title'       => 'Meta title',
            'meta_keywords'    => 'Meta keywords',
            'meta_description' => 'Meta description',
            'tags'             => 'Теги',
            'sort_weight'      => 'Вес сортировки',
            'video'            => 'Видео (YouTube)'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id'])->inverseOf('products');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductSlides()
    {
        return $this->hasMany(ProductSlide::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->viaTable('tag_product', ['product_id' => 'id']);
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {
		if ($this->scenario != self::SCENARIO_SEARCH) {
			$this->characteristics = ProductHelper::formatCharacteristics($this);
		}

        return parent::beforeValidate();
    }
}
