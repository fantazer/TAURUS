<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'О компании | taurus22';
?>

<div class="container">
    <div class="about">
        <h1>О компании</h1>
        <div class="company-description">
		 <!--<p>Основные направления деятельности группы компаний «ТАУРУС» - реализация специализированных напольных покрытий для промышленных предприятий различного профиля, спортивных сооружений, медицинских и образовательных учреждений, предприятий торговли, с/х комплексов, иных объектов.</p>
		 <p>Особое внимание уделено продукции, предназначенной для реализации программы «Доступная среда» для людей с ограниченными возможностями.</p>-->
		 <p>Основное направление деятельности ПО «МОДУЛЬ» - производство специализированных напольных покрытий для промышленных объектов, спортивных сооружений, медицинских и образовательных учреждений, а также производство тактильной продукции, предназначенной для реализации программы «Доступная среда» (для людей с ограниченными возможностями).</p>
		</div>
        <div class="services">
            <h3>Услуги</h3>
            <!--<p>- При необходимости осуществляются проектные работы, монтаж, обслуживание предлагаемой продукции.</p>
            <p>- Производится доставка во все регионы Российской Федерации, а также в Республику Казахстан посредством ТК</p>-->
            <p>- Проектные работы, монтаж, обслуживание предлагаемой продукции.</p>
            <p>- Производится доставка во все регионы Российской Федерации, а также в Республику Казахстан посредством ТК</p>
        </div>
        <div class="clients">
            <h3 class="text-center">Доверие клиентов</h3>
            <!--<p class="client-text">Клиенты, по достоинству оценившие качество продукции и услуг, предоставляемых группой компаний «ТАУРУС»: </p>-->
            <p class="client-text">Клиенты, по достоинству оценившие качество продукции и услуг, предоставляемых ПО «МОДУЛЬ»: </p>
            <div class="client-logo-row">
                <div class="client-logo">
                    <img alt="Газпром" src="<?= Yii::$app->request->baseUrl ?>/img/about/gazprom.png" />
                </div>
                <div class="client-logo">
                    <img alt="Сбербанк"  src="<?= Yii::$app->request->baseUrl ?>/img/about/sberbank.png" />
                </div>
                <div class="client-logo">
                    <img alt="ВТБ24"  src="<?= Yii::$app->request->baseUrl ?>/img/about/vtb24.png" />
                </div>
                <div class="client-logo">
                    <img alt="Холидей"  src="<?= Yii::$app->request->baseUrl ?>/img/about/holidey.png" />
                </div>
                <div class="client-logo">
                    <img alt="Мария-Ра"  src="<?= Yii::$app->request->baseUrl ?>/img/about/mariya_ra.png" />
                </div>
                <div class="client-logo">
                    <img alt="Республика"  src="<?= Yii::$app->request->baseUrl ?>/img/about/respublika.png" />
                </div>
                <div class="client-logo">
                    <img alt="Белокуриха"  src="<?= Yii::$app->request->baseUrl ?>/img/about/belokuriha.png" />
                </div>
                <div class="client-logo">
                    <img alt="Идеал"  src="<?= Yii::$app->request->baseUrl ?>/img/about/ideal.gif" />
                </div>
                <div class="client-logo">
                    <img alt="АлтГу"  src="<?= Yii::$app->request->baseUrl ?>/img/about/agu.png" />
                </div>
                <div class="client-logo">
                    <img alt="Диагност"  src="<?= Yii::$app->request->baseUrl ?>/img/about/diagnost.png" />
                </div>
            </div>
        </div>
    </div>
    <?= $this->render('designer_copyright') ?>
</div>


