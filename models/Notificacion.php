<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use app\models\UserNotificacion;
use app\models\User;
use app\controllers\IUtils;

/**
 * This is the model class for table "notificacion".
 *
 * @property integer $id
 * @property string $subject
 * @property integer $ubicacion_id
 * @property string $create_time
 * @property string $update_time
 * @property integer $user_id
 */
class Notificacion extends ActiveRecord {
	
	/**
	 * Usuarios a los que va dirijida esta notificación.
	 */
	public $directivos;
	
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'notificacion';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['subject', 'ubicacion_id', 'user_id'], 'required'],
            [['ubicacion_id', 'user_id'], 'integer'],
            [['create_time', 'update_time', 'directivos'], 'safe'],
            [['subject'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'subject' => Yii::t('app', 'Subject'),
            'ubicacion_id' => Yii::t('app', 'Ubicacion ID'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
			'user_id' => Yii::t('app', 'User ID'),
        ];
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
                    ActiveRecord::EVENT_BEFORE_INSERT => 'create_time',
					ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time'
                ],
            ],
        ];
    }
	
	/**
	 * Obtiene la UBICACION.
	 */
	public function getUbicacion() {
		return $this->hasOne(Ubicacion::className(), ['id' => 'ubicacion_id']);
	}
	
	/**
	 * Obtiene el USER que genera la notificación
	 */
	public function getUser() {
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}
	
	/**
	 *
	 */
	public function getUserNotificaciones() {
		return $this->hasMany(UserNotificacion::className(), ['notificacion_id' => 'id']);
	}
	
	/**
	 * Usuarios a los que va dirijida esta notificación.
	 */
	public function getDestinatarios() {
		return $this->hasMany(Usre::className(), ['id' => 'to_user_id'])
			->viaTable('user_notificacion', ['notificacion_id' => 'id']);
	}
	
	/**
	 * Array de Usuarios a los que va dirijida esta notificación.
	 */
	public function getDestinatariosList() {
		return $this->getDestinatarios()->asArray();
	}
	
	/**
	 * Método que se ejecuta una vez realizada una inserción o actualización.
	 * Almacena la relación usuario - notificación
	 */
	public function afterSave($insert, $changedAttributes) {
	 
		$this->directivos = User::findByRol(IUtils::ROLE_DIRECTIVO);
		Yii::trace('directivos encontrados: ' . count($this->directivos));	
		foreach ($this->directivos as $directivo) {
			
			$code = self::generateCode($directivo->username);
			Yii::trace('CODIGO: ' . $code . ' DIRECTIVO: ' . $directivo->username);
			
			$userNotif = new UserNotificacion();
			$userNotif->notificacion_id = $this->id;
			$userNotif->to_user_id = $directivo->id;
			$userNotif->code = $code;
			$userNotif->dispatched = 0;
			$userNotif->save();
		}
	}
	
	/**
	 * Genera un código único que representa la relación entre
	 * la notificación y el usuario al que va destinada.
	 */
	private static function generateCode($value) {
		return md5(uniqid($value,TRUE));
	}
}
