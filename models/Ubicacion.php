<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use app\models\Notificacion;

/**
 * This is the model class for table "ubicacion".
 *
 * @property integer $id
 * @property string $name
 * @property string $create_time
 * @property string $update_time
 */
class Ubicacion extends ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ubicacion';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['create_time', 'update_time'], 'safe'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
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
     * @inheritdoc
     */
    public static function findByID($id) {
        return static::findOne(['id' => $id]);
    }
	
	/**
	 * Obtiene le listado de notificaciones procucidas en esta ubicación.
	 */
	public function getNotificaciones() {
			return $this->hasMany(Notificacion::className(), ['ubicacion_id' => 'id']);
	}
}
