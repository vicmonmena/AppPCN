<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'auth_key') ?>

    <?= $form->field($model, 'password_hash') ?>

    <?= $form->field($model, 'password_reset_token') ?>

    <?php // echo $form->field($model, 'email') ?>
	
	<?php // echo $form->field($model, 'name') ?>
	
	<?php // echo $form->field($model, 'surname') ?>
	
	<?php // echo $form->field($model, 'phone') ?>
	
	<?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?= $form->field($model, 'create_time')->widget(
		DatePicker::className(), [
			// inline too, not bad
			 'inline' => true, 
			 // modify template for custom rendering
			'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
			'clientOptions' => [
				'autoclose' => true,
				'format' => 'dd-M-yyyy'
			]
	]);?>

    <?= $form->field($model, 'update_time')->widget(
		DatePicker::className(), [
			// inline too, not bad
			 'inline' => true, 
			 // modify template for custom rendering
			'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
			'clientOptions' => [
				'autoclose' => true,
				'format' => 'dd-M-yyyy'
			]
	]);?>

    <?php // echo $form->field($model, 'rol_id') ?>
	
	<?php // echo $form->field($model, 'proceso_id') ?>
	
	<?php // echo $form->field($model, 'empresa_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
