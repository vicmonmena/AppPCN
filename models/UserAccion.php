<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_accion".
 *
 * @property integer $id
 * @property integer $to_user_id
 * @property integer $accion_id
 */
class UserAccion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_accion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['to_user_id', 'accion_id'], 'required'],
            [['to_user_id', 'accion_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'to_user_id' => Yii::t('app', 'To User ID'),
            'accion_id' => Yii::t('app', 'Accion ID'),
        ];
    }
	
	/**
     * @inheritdoc
     */
    public static function findByID($id) {
        return static::findOne(['id' => $id]);
    }
}
