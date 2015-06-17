<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;
use app\models\Rol;
use app\models\Proceso;
use app\models\Empresa;
use app\controllers\IUtils;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property integer $rol_id
 * @property integer $proceso_id
 * @property integer $empresa_id
 * @property string $name
 * @property string $surname
 * @property string $phone
 * @property string $mobile
 */
class User extends ActiveRecord implements IdentityInterface {
	
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'timestamp' => [
                'class'      => 'yii\behaviors\TimestampBehavior',
                'value'      => new Expression('NOW()'),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
					ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at'
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['status', 'default', 'value' => IUTils::STATUS_ACTIVE],
            ['status', 'in', 'range' => [IUTils::STATUS_ACTIVE, IUTils::STATUS_DELETED]],
			[['username', 'name', 'surname', 'mobile', 'auth_key', 'password_hash', 'email'], 'required'],
			[['status', 'rol_id', 'proceso_id', 'empresa_id'], 'integer'],
			[['created_at', 'updated_at'], 'safe'],
			[['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
			[['auth_key'], 'string', 'max' => 32],
			[['name', 'surname', 'phone', 'mobile'], 'string', 'max' => 32],
        ];
    }

	public function attributeLabels() {
		return [
           'id' => Yii::t('app', 'ID'),
           'username' => Yii::t('app', 'Username'),
           'auth_key' => Yii::t('app', 'Auth Key'),
           'password_hash' => Yii::t('app', 'Password Hash'),
           'password_reset_token' => Yii::t('app', 'Password Reset Token'),
           'email' => Yii::t('app', 'Email'),
           'status' => Yii::t('app', 'Status'),
           'created_at' => Yii::t('app', 'Created At'),
           'updated_at' => Yii::t('app', 'Updated At'),
           'rol_id' => Yii::t('app', 'Rol ID'),
		   'empresa_id' => Yii::t('app', 'Empresa'),
		   'proceso_id' => Yii::t('app', 'Proceso'),
		   'name' => Yii::t('app', 'Name'),
		   'surname' => Yii::t('app', 'Surname'),
		   'phone' => Yii::t('app', 'Phone'),
		   'mobile' => Yii::t('app', 'Mobile'),
       ];
	}
    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status' => IUTils::STATUS_ACTIVE]);
    }

	/**
     * @inheritdoc
     */
    public static function findByID($id) {
        return static::findOne(['id' => $id]);
    }
	
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username, 'status' => IUTils::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => IUTils::STATUS_ACTIVE,
        ]);
    }
	
	/**
	 * Devuelve los usuarios ACTIVOS con ROL = $role
	 */
	public static function findByRol($role) {
		return static::findAll(
			[
				'rol_id' => $role, 
				'status' => IUTils::STATUS_ACTIVE
			]);
	}

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }
	
	/**
	 * Obtiene el ROL del usuario.
	 */
	public function getRol() {
			return $this->hasOne(Rol::className(), ['id' => 'rol_id']);
	}
	
	/**
	 * Obtiene el PROCESO del usuario.
	 */
	public function getProceso() {
			return $this->hasOne(Proceso::className(), ['id' => 'proceso_id']);
	}
	
	/**
	 * Obtiene la EMPRESA del usuario.
	 */
	public function getEmpresa() {
			return $this->hasOne(Empresa::className(), ['id' => 'empresa_id']);
	}
}