<?php

/* @var $this yii\web\View */
/* @var $contactForm \app\forms\ContactForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Контакты | taurus22';
?>

<div class="container">
    <div class="contacts">
        <h1>Контакты</h1>
        <div class="row">
            <div class="info" itemscope itemtype="http://schema.org/Organization">
                <p class="phone"><span itemprop="name">Производственное объединение «МОДУЛЬ»</span></p>
                <p class="phone"><span itemprop="telephone">8 (3852) 991 – 030</span></p>
                <!--<p class="phone"><span itemprop="telephone">8 (3852) 532-844</span></p>
				<p class="phone"><span itemprop="telephone">8  903 958 57 94</span></p>-->
                <p class="email"><a href="mailto:info@modulsib.ru"><span itemprop="email">info@modulsib.ru</span></a></p>

                <div  class="address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                    <span itemprop="postalCode"> 656011,</span>
                    <span itemprop="addressLocality">Барнаул</span>,
                    <span itemprop="streetAddress">Ул. Бехтерева 30 А, офис 1</span>
                </div>
            </div>
            <div class="form-contacts">
				<?php if (\Yii::$app->session->getFlash('emailSend')) : ?>
					<p class="form-header">Спасибо за обращение, ваше сообщение отправлено.</p>
				<?php else : ?>
					<p class="form-header">Напишите нам</p>
					<?php $form = ActiveForm::begin([
						'id' => 'contact-form',
						'options' => ['class' => 'form'],
						'enableClientValidation' => false,
						'fieldConfig' => [
							'template' => "<div class=\"input\">{input}</div>\n<div class=\"error\">{error}</div>",
						],
					]); ?>
					<?= $form->field($contactForm, 'name')->textInput(['autofocus' => true, 'placeholder' => $contactForm->getAttributeLabel('name'), 'autocomplete' => 'off']) ?>
					<?= $form->field($contactForm, 'contactString')->textInput(['placeholder' => $contactForm->getAttributeLabel('contactString'), 'autocomplete' => 'off']) ?>
					<?= $form->field($contactForm, 'message')->textarea(['placeholder' => $contactForm->getAttributeLabel('message'), 'autocomplete' => 'off']) ?>
					<div>
						<?= Html::submitButton('Отправить', ['class' => 'btn pull-right']) ?>
					</div>
					<?php ActiveForm::end(); ?>
				<?php endif ?>
            </div>
        </div>
    </div>
    <div class="map">
        <a class="dg-widget-link" href="http://2gis.ru/barnaul/firm/70000001020009127/center/83.748151,53.367197/zoom/16?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=bigMap">Посмотреть на карте Барнаула</a>
        <div class="dg-widget-link">
            <a href="http://2gis.ru/barnaul/center/83.748151,53.367197/zoom/16/routeTab/rsType/bus/to/83.748151,53.367197╎СНП Эко-развитие, ООО, группа компаний?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=route">Найти проезд до СНП Эко-развитие, ООО, группа компаний</a>
        </div>
        <script charset="utf-8" src="http://widgets.2gis.com/js/DGWidgetLoader.js"></script>
        <script charset="utf-8">
            new DGWidgetLoader({"width":'100%',"height":450,"borderColor":"none","pos":{"lat":53.367197,"lon":83.748151,"zoom":16},"opt":{"city":"barnaul"},"org":[{"id":"70000001020009127"}]});
        </script>
        <noscript style="color:#c00;font-size:16px;font-weight:bold;">Виджет карты использует JavaScript. Включите его в настройках вашего браузера.</noscript>
    </div>
    <?= $this->render('designer_copyright') ?>
</div>


