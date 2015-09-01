<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * IncidenciaForm is the model behind the incidencia form.
 */
class IncidenciaForm extends Model {
	public $personalCritico;
    public $actividad;
    public $rto;
    public $impactos;
    public $apps;
    public $proveedores;
	public $otros;
	public $comentarios;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'actividad' => Yii::t('app', 'Actividad critica'),
			'RTO' => Yii::t('app', 'RTO'),
			'impactos' => Yii::t('app', 'Impactos'),
			'apps' => Yii::t('app', 'Aplicaciones criticas'),
			'proveedores' => Yii::t('app', 'Proveedores criticos'),
			'otros' => Yii::t('app', 'Otros archivos criticos'),
			'comentarios' => Yii::t('app', 'Comentarios'),
        ];
    }
}
