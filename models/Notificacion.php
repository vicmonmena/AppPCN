<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use app\models\UserNotificacion;

/**
 * This is the model class for table "notificacion".
 *
 * @property integer $id
 * @property string $subject
 * @property integer $ubicacion_id
 * @property string $create_time
 * @property string $update_time
 */
class Notificacion extends ActiveRecord {
	
	/**
	 * Usuarios a los que va dirijida esta notificación.
	 */
	public $personalCritico;
	
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
            [['subject', 'ubicacion_id', 'create_time', 'update_time'], 'required'],
            [['ubicacion_id'], 'integer'],
            [['create_time', 'update_time', 'personalCritico'], 'safe'],
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
	 */
	public function afterSave($insert, $changedAttributes) {
		\Yii::$app->db->createCommand()->delete('user_notificacion', 'notificacion_id = '.(int) $this->id)->execute();
	 
		foreach ($this->operaciones as $id) {
			$ro = new RolOperacion();
			$ro->rol_id = $this->id;
			$ro->operacion_id = $id;
			$ro->save();
		}
	}
}
