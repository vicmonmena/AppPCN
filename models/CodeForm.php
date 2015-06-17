<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * CodeForm is the model behind the Notify form.
 */
class CodeForm extends Model {
	
	public $code;
	
	/**
     * @return array the validation rules.
     */
    public function rules(){
        return [
            [['code'], 'required'],
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
		$notificacion;
		// TODO $found = Notificacion::findByCode($code);
		// if ($found) => login
		// 
		// Login de usuario 
		$user = User::findByUsername($this->username);
        if ($user != null) {
            if (Yii::$app->user->login($this->getUser(), 0)) {
				// TODO if ()
			}
        }
		return $notificacion;
    }
}