<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;
use app\models\Rol;
use app\models\Proceso;
use app\models\Empresa;
use app\controllers\IUtils;

/**
 * ProfileForm represents the model behind the Profile.
 *
 */
class ProfileForm extends User {

	/**
     * @inheritdoc
     */
    public function rules() {
		return [
            [['id', 'proceso_id'], 'integer'],
            [['email', 'name', 'surname', 'phone', 'mobile'], 'safe'],
			[['name', 'surname', 'mobile', 'email'], 'required'],
			[['name', 'surname', 'phone', 'mobile', 'email'], 'string', 'max' => 32],
        ];
    }
}