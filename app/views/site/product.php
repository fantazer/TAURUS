<?php

/* @var $this yii\web\View */
/* @var $product \app\models\Product */

use yii\helpers\Html;
use app\helpers\CategoryHelper;
use app\helpers\ProductHelper;

$this->title = $product->name . ' | taurus22';

if (!empty($product->video)) {
    $script = '
    function getId(url) {
        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        var match = url.match(regExp);

        if (match && match[2].length == 11) {
            return match[2];
        } else {
            return "error";
        }
    }

    var myId = getId("' . $product->video . '");

    var myCode = \'<iframe width="100%" height="500px" src="//www.youtube.com/embed/\'
        + myId + \'" frameborder="0" allowfullscreen></iframe>\';

    $(document).ready(function() {
        $(".js-product-video").html(myCode);
    });
';

    $this->registerJs($script, yii\web\View::POS_END);
}


?>

<script>


</script>

<div class="container">
    <div class="breadcrumbs">
        <ul>
            <li>
                <?= Html::a($product->category->name, CategoryHelper::getCategoryUrl($product->category)) ?>
            </li>
        </ul>
    </div>

    <div class="product" itemscope itemtype="http://schema.org/Product">
        <div class="card">
            <div class="card-block">
                <h1 itemprop="name"><?= $product->name ?></h1>
                <?php if (count($product->productSlides) > 0) : ?>
                    <img style="display: none" src="http://<?= \Yii::$app->request->serverName . \app\helpers\ProductSlideHelper::getProductSlidePath($product->productSlides[0]) ?>" itemprop="image">
                    <div class="product-slider-wrapper">
                        <div class="product-slider">
                            <?php foreach ($product->productSlides as $productSlide) : ?>
                                <div class="slide">
                                    <?= Html::img(\app\helpers\ProductSlideHelper::getProductSlidePath($productSlide)) ?>
                                </div>
                            <?php endforeach ?>
                        </div>
                        <div class="slick-arrow slick-next"></div>
                        <div class="slick-arrow slick-prev"></div>
                    </div>
                <?php endif ?>
                <div class="description" itemprop="description">
                    <?= $product->description ?>
                </div>
                <div class="js-product-video video"></div>
            </div>
            <div class="card-block">
                <div class="characteristics">
                    <h2>Характеристики</h2>
                    <?php if (!is_null($product->characteristics)) : ?>
                        <div class="characteristics-table">
                            <?php foreach (ProductHelper::getFormattedCharacteristics($product) as $charName => $charValue) : ?>
                                <div class="row">
                                    <div class="label"><?= $charName ?></div>
                                    <div class="value"><?= $charValue ?></div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <div class="price-info" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
            <p class="price" itemprop="price">

                <?php if (is_null($product->price) || strlen($product->price) == 0) : ?>
                    Цену уточняйте у менеджера
                <?php else : ?>
                    <?= $product->price ?>
                <?php endif ?>
                <span style="display: none;" itemprop="priceCurrency">RUB</span>
            </p>
            <p class="feedback">
                <?= Html::tag('a', 'Заказать', ['class' => 'btn', 'data-action' => 'show-popup', 'href' => '#callback-form']) ?>
            </p>
            <p>Доставка ТК во все регионы Российской Федерации и Республику Казахстан</p>
            <hr />
            <p>Дополнительные услуги (проектные работы, монтаж, обслуживание) оговариваются индивидуально.</p>
        </div>
    </div>
    <?= $this->render('designer_copyright') ?>
</div>


