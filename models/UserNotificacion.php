<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "user_notificacion".
 *
 * @property integer $id
 * @property integer $to_user_id
 * @property integer $notificacion_id
 * @property integer $dispatched
 * @property string $code
 */
class UserNotificacion extends ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user_notificacion';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['dispatched', 'default', 'value' => 0],
			[['to_user_id', 'notificacion_id', 'dispatched', 'code'], 'required'],
            [['to_user_id', 'notificacion_id', 'dispatched'], 'integer'],
            [['code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'to_user_id' => Yii::t('app', 'To User ID'),
            'notificacion_id' => Yii::t('app', 'Notificacion ID'),
            'dispatched' => Yii::t('app', 'Dispatched'),
            'code' => Yii::t('app', 'Code'),
        ];
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
    public static function findByCode($code) {
        return static::findOne(['code' => $code]);
    }

	/**
     * @inheritdoc
     */
    public static function findByCodeAndUser($code, $user) {
        return static::findOne(['code' => $code, 'to_user_id' => $user]);
    }
}
