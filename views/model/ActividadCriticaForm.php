<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadCritica */
/* @var $form ActiveForm */
?>
<div class="model-ActividadCriticaForm">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'nombre') ?>
        <?= $form->field($model, 'redireccion_telefono') ?>
        <?= $form->field($model, 'aplicaciones') ?>
        <?= $form->field($model, 'proveedores') ?>
        <?= $form->field($model, 'otros_activos') ?>
        <?= $form->field($model, 'comentarios') ?>
        <?= $form->field($model, 'create_time') ?>
        <?= $form->field($model, 'update_time') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- model-ActividadCriticaForm -->
