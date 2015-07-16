<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ubicacion;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\NotificacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notificacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'subject') ?>

    <?= $form->field($model, 'ubicacion_id') ?>
	
	<?= $form->field($model, 'user_id') ?>

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

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
