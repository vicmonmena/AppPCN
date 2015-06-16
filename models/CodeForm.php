<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * CodeForm is the model behind the Notify form.
 */
class CodeForm extends Model {
	
	public $code;
	
	/**
     * @return array the validation rules.
     */
    public function rules(){
        return [
            [['code'], 'required'],
        ];
    }
	
	/**
	 * 1. Busca el código en BBDD.
	 * 2. Si no existe lo indica
	 * 3. Si existe => extrae los datos del directivo.
	 * 4. Se loga en el sistema: usr y pass del directivo del que extrae los datos.
	 * 5. Muestra la información referente a la incidencia.
     */
    public function checkCode($mycode) {
		
		$pos = strpos($mycode, 'error');
        return !($pos !== false);
    }
}