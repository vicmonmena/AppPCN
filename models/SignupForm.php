<?php
namespace app\models;

use app\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model {

    /**
	 * Rol por defecto con el que se da de alta un usuario desde el formulario de altas.
	 */
	const DEFAULT_USER = 1;
	/**
	 * Estado por defecto con el que se da de alta un usuario desde el formulario de altas.
	 */
	const DEFAULT_STATUS = 0;
	
	public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
        if ($this->validate()) {
			Yii::trace('Creando usuario: ' . $this->username);
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
			$user->rol_id = self::DEFAULT_USER;
			$user->status = self::DEFAULT_STATUS;
            if ($user->save()) {
				Yii::trace('Nuevo usuario: ' . $this->username);
                return $user;
            }
        }

        return null;
    }
}
