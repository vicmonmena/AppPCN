<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Proceso;
use app\controllers\IUtils;

$this->title = Yii::t('app', 'Mis Datos') .  ' ' . Yii::t('app', '{modelClass}: ', ['modelClass' => 'User',]) . ' ' . $model->username;
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>
	
		<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
		
		<?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
		
		<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
		
		<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
		
		<?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
		
		<?= $form->field($model, 'proceso_id') 
			->dropDownList(
				ArrayHelper::map(Proceso::find()->all(), 'id', 'name'))
		?>
		
		<div class="form-group">
			<?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
		</div>

    <?php ActiveForm::end(); ?>

</div>
