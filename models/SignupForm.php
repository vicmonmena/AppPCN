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
	/**
	 * Proceso por defecto con el que se da de alta un usuario desde el formulario de alta.
	 */
	const DEFAULT_PROCESO = 1;
	/**
	 * Empresa por defecto con la que se da de alta un usuario desde el formulario de alta.
	 */
	const DEFAULT_EMPRESA = 1;
	
	public $username;
    public $email;
    public $password;
	public $name;
	public $surname;
	public $phone;
	public $mobile;

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
			
			['name', 'required'],
			['name', 'string', 'min' => 2, 'max' => 45],
			
			['surname', 'required'],
			['surname', 'string', 'min' => 2, 'max' => 45],
			
			['phone', 'string', 'min' => 9, 'max' => 11],
			
			['mobile', 'required'],
			['mobile', 'string', 'min' => 9, 'max' => 11],
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
			$user->name = $this->name;
			$user->surname = $this->surname;
			$user->phone = $this->phone;
			$user->mobile = $this->mobile;
            $user->setPassword($this->password);
            $user->generateAuthKey();
			$user->rol_id = self::DEFAULT_USER;
			$user->status = self::DEFAULT_STATUS;
			$user->proceso_id = self::DEFAULT_PROCESO;
			$user->empresa_id = self::DEFAULT_EMPRESA;
			if ($user->save()) {
				return $user;
			}
        }
        return null;
    }
}
