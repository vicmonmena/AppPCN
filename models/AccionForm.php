<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * CodeForm is the model behind the Notify form.
 */
class AccionForm extends Model {
	
	// Información sobre la notificación
	public $subject;
	public $location;
	
	// Información sobre la acción a realizar
	public $description;	
	public $personalCritico;
	
	/**
     * @return array the validation rules.
     */
    public function rules(){
        return [
            [['description', 'personalCritico'], 'required'],
        ];
    }
	
	/**
	 * 1. Busca el código en BBDD.
	 * 2. Si NO existe lo indica => error
	 * 3. Si existe => busca el usuario en BBDD
	 * 4. Si NO existe => error 
	 * 5. Si existe => Login
	 * 6. Si Login OK => Devuelve notificación
	 * 7. Si NO => error
     */
    public function loginByCode($code) {
		// Comprobamos si existe la notificación y va dirijida al usuario logado
		$userNotif = UserNotificacion::findByCode($code);
		if ($userNotif != null) {
			// Comprobamos si existe el usuario
			$user = User::findByID($userNotif->to_user_id);
			if ($user != null && Yii::$app->user->login($this->getUser(), 0)) {
				// Usuario logado
				return $userNotif;
			}
		}
		return null;
    }
	
	/**
	 * Da de alta la acción en la BBDD.
	 */
	public function createAccion($user) {
		$accion = new Accion();
		$accion->user_id = $user->id;
		$accion->descripcion = $this->description;
		
		$accion->personalCritico = $this->personalCritico;
		if ($accion->save()) {
			return $accion;
		}
	}
}