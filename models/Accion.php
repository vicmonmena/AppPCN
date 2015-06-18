<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "accion".
 *
 * @property integer $id
 * @property string $descripcion
 * @property string $create_time
 * @property string $update_time
 * @property integer $user_id
 */
class Accion extends ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'descripcion', 'user_id'], 'required'],
            [['id', 'user_id'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['descripcion'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'descripcion' => Yii::t('app', 'Descripcion'),
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
	 * Obtiene el USER que genera la acción.
	 */
	public function getUser() {
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}
	
	/**
	 *
	 */
	public function getUserAcciones() {
		return $this->hasMany(UserAccion::className(), ['accion_id' => 'id']);
	}
	
	/**
	 * Método que se ejecuta una vez realizada una inserción o actualización.
	 * Almacena la relación usuario - acción
	 */
	public function afterSave($insert, $changedAttributes) {
		// TODO
	}
}
