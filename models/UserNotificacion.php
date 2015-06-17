<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "user_notificacion".
 *
 * @property integer $id
 * @property integer $from_user_id
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
            [['from_user_id', 'to_user_id', 'notificacion_id', 'dispatched', 'code'], 'required'],
            [['from_user_id', 'to_user_id', 'notificacion_id', 'dispatched'], 'integer'],
            [['code'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'from_user_id' => Yii::t('app', 'From User ID'),
            'to_user_id' => Yii::t('app', 'To User ID'),
            'notificacion_id' => Yii::t('app', 'Notificacion ID'),
            'dispatched' => Yii::t('app', 'Dispatched'),
            'code' => Yii::t('app', 'Code'),
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
}
