<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\db\Expression;


use Yii;

/**
 * This is the model class for table "actividad_critica".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $redireccion_telefono
 * @property string $aplicaciones
 * @property string $proveedores
 * @property string $otros_activos
 * @property string $comentarios
 * @property string $create_time
 * @property string $update_time
 */
class ActividadCritica extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actividad_critica';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'redireccion_telefono'], 'required'],
            [['redireccion_telefono'], 'integer'],
            [['aplicaciones', 'proveedores', 'otros_activos', 'comentarios'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['nombre'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'redireccion_telefono' => Yii::t('app', 'Redireccion Telefono'),
            'aplicaciones' => Yii::t('app', 'Aplicaciones'),
            'proveedores' => Yii::t('app', 'Proveedores'),
            'otros_activos' => Yii::t('app', 'Otros Activos'),
            'comentarios' => Yii::t('app', 'Comentarios'),
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
}
