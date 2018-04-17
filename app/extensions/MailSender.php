<?php

namespace app\extensions;

class MailSender
{
    public static function sendEmail($message)
    {
        \Yii::$app->mailer->compose('callback', [
            'message' => $message
        ])
            ->setFrom('no-reply@taurus-sib.ru')
            ->setTo(array(
                /*'manager@taurus-sib.ru',*/
                'info@modulsib.ru',
                'taurus-sib@yandex.ru'
            ))
            ->setSubject('Сообщение с сайта taurus-sib.ru')
            ->send();
    }
}