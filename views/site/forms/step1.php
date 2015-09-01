<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

?>
<div class="site-step1">
    <p>
        <?= Yii::t('app', 'Introduce los datos de la accion a seguir') . ':'?>
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'step-form']); ?>
                <?= $form->field($model, 'actividad') ?>
                <?= $form->field($model, 'rto') ?>
                <?= $form->field($model, 'impactos') ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
