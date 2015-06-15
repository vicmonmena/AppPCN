<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * NotifyForm is the model behind the Notify form.
 */
class NotifyForm extends Model {
	
	public $email;
	
	/**
     * @return array the validation rules.
     */
    public function rules(){
        return [
            [['email'], 'required'],
        ];
    }
	
	public function sendNotification() {
		return \Yii::$app->mailer->compose()
			->setFrom('appweb@email.com')
			->setTo($this->email)
			->setSubject('Email de prueba ' . \Yii::$app->name)
			->setTextBody('Esto es un email de prueba')
			->setHtmlBody('<b>Esto es un email de prueba</b>')
			->send();
	}
}