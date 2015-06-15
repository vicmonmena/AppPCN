<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * NotifyForm is the model behind the Notify form.
 */
class NotifyForm extends Model {
	
	public $email;
	
	/**
     * @return array the validation rules.
     */
    public function rules(){
        return [
            [['email'], 'required'],
        ];
    }
}