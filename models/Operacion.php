<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "operacion".
 *
 * @property integer $id
 * @property string $name
 * @property string $create_time
 * @property string $update_time
 */
class Operacion extends ActiveRecord {
    
	/**
     * @inheritdoc
     */
    public static function tableName() {
        return 'operacion';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
			[['create_time', 'update_time'], 'safe'],
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
                    ActiveRecord::EVENT_BEFORE_INSERT => 'crate_time',
					ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time'
                ],
            ],
        ];
    }
}
