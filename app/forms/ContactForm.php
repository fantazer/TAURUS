<?php

namespace app\forms;

use yii\base\Model;
use yii\validators\EmailValidator;
use app\extensions\MailSender;

class ContactForm extends Model
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $contactString;

    /**
     * @var string
     */
    public $message;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['name', 'contactString', 'message'], 'required'],
            ['contactString', 'validateContactString'],
        ];
    }

    /**
     * Валидация строки, которая может содержать email или телефон
     *
     * @param $attribute
     * @param $params
     */
    public function validateContactString($attribute, $params)
    {
        $emailValidator = new EmailValidator();

        if (!$emailValidator->validate($this->$attribute)) {
            $value = str_replace('-', '', $this->$attribute);
            $value = str_replace('+', '', $value);
            $value = preg_replace('/[0-9]+/', '', $value);

            if (!empty($value)) {
                $this->addError($attribute, 'Некорректный email или телефон');
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Ваше имя',
            'contactString' => 'Почта или телефон',
            'message' => 'Текст',
        ];
    }
	
	/**
     * @return void
     */
    public function sendEmail()
    {
        $message = "Имя: $this->name, телефон или email: $this->contactString, сообщение:\n" . nl2br($this->message);
        MailSender::sendEmail($message);
    }
}
