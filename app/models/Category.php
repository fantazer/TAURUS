<?php

namespace app\models;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $root_category_id
 * @property string $url
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property integer $sort_weight
 *
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @var string
     */
    const PATTERN_CATEGORY_URL = '/^[a-zA-Z0-9-_]+/';

    /**
     * @var string
     */
    const ERROR_INVALID_CATEGORY_URL = 'Строка может содержать только буквы английского алфавита, дефисы и нижние подчеркивания.';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'root_category_id'], 'required'],
            [['root_category_id', 'sort_weight'], 'integer'],
            [['meta_title', 'meta_keywords', 'meta_description', 'description'], 'string'],
            [['name', 'url'], 'string', 'max' => 255],
            [['url'], 'validateCategoryUrl'],
            [['url', 'root_category_id'], 'unique', 'skipOnEmpty' => true, 'targetAttribute' => ['url', 'root_category_id'], 'message' => 'Категория с таким URL уже создана для данной корневой категории'],
        ];
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function validateCategoryUrl($attribute, $params)
    {
        $urlString = preg_replace(self::PATTERN_CATEGORY_URL, '', $this->$attribute);

        if (strlen($urlString) != 0) {
            $this->addError('url', self::ERROR_INVALID_CATEGORY_URL);
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'root_category_id' => 'Корневая категория',
            'url' => 'Url',
            'meta_title' => 'meta title',
            'meta_keywords' => 'meta keywords',
            'meta_description' => 'meta description',
            'sort_weight' => 'Вес сортировки',
        ];
    }

    /**
     * @return \app\models\Product[]
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id'])->orderBy('sort_weight DESC');
    }
}
