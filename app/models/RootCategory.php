<?php

namespace app\models;


class RootCategory
{
    /**
     * @var integer
     */
    const CATEGORY_FLOOR_COVERINGS = 1;

    /**
     * @var integer
     */
    const CATEGORY_MUDGUARDS = 2;

    /**
     *  @var integer
     */
    const CATEGORY_LED_LIGHTING = 3;

    /**
     * @var integer
     */
    const CATEGORY_EKOTEHNIKA = 4;

    /**
     * @var integer
     */
    const CATEGORY_ACCESSIBLE_ENVIRONMENT = 5;

    /**
     * @var array
     */
    private static $categoryLabels = [
        self::CATEGORY_FLOOR_COVERINGS => 'Напольные покрытия',
        self::CATEGORY_MUDGUARDS => 'Грязезащита',
        self::CATEGORY_LED_LIGHTING => 'LED освещение',
        self::CATEGORY_EKOTEHNIKA => 'Экотехника',
        self::CATEGORY_ACCESSIBLE_ENVIRONMENT => 'Доступная среда',
    ];

    /**
     * @var array
     */
    private static $categoryUrls = [
        self::CATEGORY_FLOOR_COVERINGS => 'napolnyye-pokrytiya',
        self::CATEGORY_MUDGUARDS => 'gryazezashchita',
        self::CATEGORY_LED_LIGHTING => 'led-osveshcheniye',
        self::CATEGORY_EKOTEHNIKA => 'ekotekhnika',
        self::CATEGORY_ACCESSIBLE_ENVIRONMENT => 'dostupnaya-sreda',
    ];

    /**
     * @param $rootCategoryId
     *
     * @return string|null
     */
    public static function getRootCategoryLabel($rootCategoryId)
    {
        if (isset(self::$categoryLabels[$rootCategoryId])) {
            return self::$categoryLabels[$rootCategoryId];
        } else {
            return null;
        }
    }

    /**
     * @return array
     */
    public static function getRootCategoryLabels()
    {
        return self::$categoryLabels;
    }

    /**
     * @param $rootCategoryId
     * @return string|null
     */
    public static function getRootCategoryUrl($rootCategoryId)
    {
        if (isset(self::$categoryUrls[$rootCategoryId])) {
            return self::$categoryUrls[$rootCategoryId];
        } else {
            return null;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public static function isCategoryHaveTagFilter($id)
    {
        switch($id) {
            case self::CATEGORY_FLOOR_COVERINGS :
                return true;
            case self::CATEGORY_MUDGUARDS :
                return true;
            case self::CATEGORY_LED_LIGHTING :
                return false;
            case self::CATEGORY_EKOTEHNIKA :
                return false;
            case self::CATEGORY_ACCESSIBLE_ENVIRONMENT :
                return true;
            default: return false;
        }
    }
}