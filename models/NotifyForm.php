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

	/**
	 * Crea una notificación nueva.
	 */
	public function createNotification($user) {
		$notificacion = new Notificacion();
		$notificacion->user_id = $user->id;
		$notificacion->subject = $this->subject;
		$notificacion->ubicacion_id = $this->location;
		return $notificacion->save();
	}
	
	/**
 	 * Notifica por email
 	 */	
	public function sendNotification() {
		return \Yii::$app->mailer->compose()
			->setFrom(Yii::$app->params['adminEmail'])
			->setTo(Yii::$app->params['toEmail'])
			->setSubject('Email de prueba de ' . \Yii::$app->name)
			->setTextBody('Motivo: ' . $this->subject . ' Ubicacion: ' . $this->location)
			->setHtmlBody('Motivo: <b>' . $this->subject . '</b> Ubicacion: <b>' . $this->location . '</b>')
			->send();
	}
}