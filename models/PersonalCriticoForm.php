<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use app\models\User;


/**
 * PersonalCriticoForm represents the model behind the TabularForm.
 */
class PersonalCriticoForm extends User {
    /**
     * @inheritdoc
     */
    public function rules() {
		Yii::trace('rules', __METHOD__);
        return [
            [['id'], 'integer'],
            [['name', 'surname', 'email', 'mobile'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
	
	public function getFormAttribs() {
		Yii::trace('obteniendo atributos', __METHOD__);
		return [
			// primary key column
			'id'=>[ // primary key attribute
				'type'=>TabularForm::INPUT_HIDDEN, 
				'columnOptions'=>['hidden'=>true]
			], 
			'name'=>['type'=>TabularForm::INPUT_TEXT],
			'surname'=>['type'=>TabularForm::INPUT_TEXT],
			'email'=>['type'=>TabularForm::INPUT_TEXT],
			'mobile'=>['type'=>TabularForm::INPUT_TEXT],
		];
	}
}
