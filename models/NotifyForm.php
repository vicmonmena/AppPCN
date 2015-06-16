<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * NotifyForm is the model behind the Notify form.
 */
class NotifyForm extends Model {
	
	public $subject;
	public $location;
	
	/**
     * @return array the validation rules.
     */
    public function rules(){
        return [
            [['subject', 'location'], 'required'],
        ];
    }
	
	public function sendNotification() {
		return \Yii::$app->mailer->compose()
			->setFrom(Yii::$app->params['adminEmail'])
			->setTo(Yii::$app->params['toEmail'])
			->setSubject('Email de prueba ' . \Yii::$app->name)
			->setTextBody('Motivo: ' . $this->subject . ' Ubicacion: ' . $this->location)
			->setHtmlBody('Motivo: <b>' . $this->subject . '</b> Ubicacion: <b>' . $this->location . '</b>')
			->send();
	}
}