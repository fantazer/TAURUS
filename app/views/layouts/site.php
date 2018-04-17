<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\SiteAsset;
use yii\widgets\Menu;
use app\models\RootCategory;
use yii\helpers\Url;

SiteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="description" content="Основные направления деятельности ООО «Таурус» - реализация специализированных напольных покрытий для промышленных предприятий различного профиля, спортивных сооружений, медицинских и образовательных учреждений, предприятий торговли, с/х комплексов, иных объектов.">
    <meta name="keywords" content="Таурус, специализированные напольные покрытия, напольные покрытия, напольные покрытия для промышленных предприятий, промышленный пол, резиновая плитка, резиновый пол, пол для бассейна, пол для спортазала, пол" />
    <meta name="yandex-verification" content="2e95158eaba19f9c" />
    <meta name="google-site-verification" content="p8pHWtXOIET3joV4Zs1aKbu2IjY4Ge14_cmFRapWyvI" />
    <link rel="icon" type="image/png" href="/favicon.png" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&subset=cyrillic" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="<?php if($this->context->route == 'site/index') echo 'index' ?>">
<?php $this->beginBody() ?>

<nav id="sidebar-menu">
    <div id="logo">
        <a href="<?= Yii::$app->request->baseUrl ?>/"></a>
    </div>
    <div class="menu-icon show-menu-adaptive"></div>
    <div class="wrap-block">
        <div class="contact-information">
            <a href="tel:83852991030" class="phone">8 (3852) 991 – 030</a>
            <br>
            <a class="email" href="mailto:info@modulsib.ru">info@modulsib.ru</a>
        </div>

        <ul class="menu">
            <li
                class="show-hidden-menu"
                data-category-number="<?= RootCategory::CATEGORY_FLOOR_COVERINGS ?>">
                <?= RootCategory::getRootCategoryLabel(RootCategory::CATEGORY_FLOOR_COVERINGS) ?>
            </li>
            <li
                class="show-hidden-menu"
                data-category-number="<?= RootCategory::CATEGORY_ACCESSIBLE_ENVIRONMENT ?>">
                <?= RootCategory::getRootCategoryLabel(RootCategory::CATEGORY_ACCESSIBLE_ENVIRONMENT) ?>
            </li>
            <li
                class="show-hidden-menu"
                data-category-number="<?= RootCategory::CATEGORY_MUDGUARDS ?>">
                <?= RootCategory::getRootCategoryLabel(RootCategory::CATEGORY_MUDGUARDS) ?>
            </li>
            <li
                class="show-hidden-menu"
                data-category-number="<?= RootCategory::CATEGORY_LED_LIGHTING ?>">
                <?= RootCategory::getRootCategoryLabel(RootCategory::CATEGORY_LED_LIGHTING) ?>
            </li>
            <li
                class="show-hidden-menu"
                data-category-number="<?= RootCategory::CATEGORY_EKOTEHNIKA ?>">
                <?= RootCategory::getRootCategoryLabel(RootCategory::CATEGORY_EKOTEHNIKA) ?>
            </li>
        </ul>

        <div class="sub-menu">
            <?= Menu::widget([
                'items' => [
                    ['label' => 'О компании', 'url' => ['site/about']],
                    ['label' => 'Контакты', 'url' => ['site/contacts']],
                    ['label' => 'Админинстративный интерфейс', 'url' => ['site/admin'], 'visible' => !Yii::$app->user->isGuest],
                ],
            ]); ?>
        </div>
    </div>
</nav>

<div class="hidden-menu" style="display: none;">
    <div class="close-hidden-menu"></div>
    <div class="content">
        <div class="container">
            <?= $this->render('//site/_hidden_menu_categories', ['rootCategoryId' => RootCategory::CATEGORY_FLOOR_COVERINGS]) ?>
            <?= $this->render('//site/_hidden_menu_categories', ['rootCategoryId' => RootCategory::CATEGORY_MUDGUARDS]) ?>
            <?= $this->render('//site/_hidden_menu_categories', ['rootCategoryId' => RootCategory::CATEGORY_LED_LIGHTING]) ?>
            <?= $this->render('//site/_hidden_menu_categories', ['rootCategoryId' => RootCategory::CATEGORY_EKOTEHNIKA]) ?>
            <?= $this->render('//site/_hidden_menu_categories', ['rootCategoryId' => RootCategory::CATEGORY_ACCESSIBLE_ENVIRONMENT]) ?>
        </div>
    </div>
</div>

<div id="page">
    <div class="page-container">
		<div class="overlay"></div>
        <?= $content ?>
    </div>
</div>

<div id="callback-form" class="mfp-hide white-popup">
    <p class="form-header">Напишите нам</p>
	<p class="error-message"></p>
	<p class="success-message"></p>
    <div class="form-row">
        <input type="text" name="name" id="callback-name" placeholder="Ваше имя" />
    </div>
    <div class="form-row">
        <input type="text" name="contactstring" id="callback-phone" placeholder="Почта или телефон" />
    </div>
    <div class="form-row">
        <textarea placeholder="Текст" id="callback-message" name="message"></textarea>
    </div>
    <div class="form-row">
        <?= Html::input('button', null, 'Отправить', ['class' => 'btn pull-right', 'id' => 'submit-callback-form']) ?>
		<?= Html::hiddenInput('callback-url', Url::to(['site/send-email']), ['id' => 'callback-url']) ?>
    </div>
    <div class="form-footer">
        <p>Или свяжитесь по телефону:</p>
        <p class="phone">8 (3852) 991 – 030</p>
    </div>
</div>

<?php $this->endBody() ?>

<!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter42080054 = new Ya.Metrika({ id:42080054, clickmap:true, trackLinks:true, accurateTrackBounce:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/42080054" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-90252830-1', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>
<?php $this->endPage() ?>