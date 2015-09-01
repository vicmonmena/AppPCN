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
		<?= Yii::t('app', 'Introduce los datos de los recursos') . ':'?>
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'step3-form']); ?>
                <?= $form->field($model, 'apps') ?>
                <?= $form->field($model, 'proveedores') ?>
                <?= $form->field($model, 'otros') ?>
				<?= $form->field($model, 'comentarios')->textArea(['rows' => 6]) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>