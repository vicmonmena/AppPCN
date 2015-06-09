<?php

namespace app\models;

use Yii;
use app\models\User;
use app\models\Operacion;
use app\models\RolOperacion;

/**
 * This is the model class for table "rol".
 *
 * @property integer $id
 * @property string $nombre
 */
class Rol extends \yii\db\ActiveRecord
{
	/**
	 * Contendrá las operaciones seleccionadas para ser asignadas al rol.
	 * Es necesario agregar la regla ‘safe’, ya que los modelos 
	 * ignoran la asignación de valores para todos los atributos 
	 * que no tengan una regla de validación definida explicítamente.
	 */
	public $operaciones;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 32],
			['operaciones', 'safe']
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
        ];
    }
	
	public function getUsers() {
			return $this->hasMany(User::className(), ['rol_id' => 'id']);
	}
	
	/**
	 * Método que se ejecuta una vez realizada una inserción o actualización.
	 */
	public function afterSave($insert, $changedAttributes) {
		\Yii::$app->db->createCommand()->delete('rol_operacion', 'rol_id = '.(int) $this->id)->execute();
	 
		foreach ($this->operaciones as $id) {
			$ro = new RolOperacion();
			$ro->rol_id = $this->id;
			$ro->operacion_id = $id;
			$ro->save();
		}
	}
	
	public function getRolOperaciones() {
		return $this->hasMany(RolOperacion::className(), ['rol_id' => 'id']);
	}
	/**
	 * Este método señala la relación existente entre Rol y Operacion. 
	 * Sin embargo, esa relación no es directa, 
	 * sino que se realiza a través de la tabla pivot rol_operacion.
	 */
	public function getOperacionesPermitidas() {
		return $this->hasMany(Operacion::className(), ['id' => 'operacion_id'])
			->viaTable('rol_operacion', ['rol_id' => 'id']);
	}
	 
	public function getOperacionesPermitidasList() {
		return $this->getOperacionesPermitidas()->asArray();
	}
}
