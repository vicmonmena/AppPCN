<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use app\models\User;

/**
 * This is the model class for table "empresa".
 *
 * @property integer $id
 * @property string $name
 * @property string $web
 * @property string $create_time
 * @property string $update_time
 */
class Empresa extends ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'empresa';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'web'], 'required'],
            [['create_time', 'update_time'], 'safe'],
            [['name', 'web'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'web' => Yii::t('app', 'Web'),
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
	
	public function getUsers() {
			return $this->hasMany(User::className(), ['empresa_id' => 'id']);
	}
}
