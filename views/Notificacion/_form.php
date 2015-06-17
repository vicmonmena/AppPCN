<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Ubicacion;

/* @var $this yii\web\View */
/* @var $model app\models\Notificacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notificacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ubicacion_id') 
		->dropDownList(
			ArrayHelper::map(Ubicacion::find()->all(), 'id', 'name'))
	?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
