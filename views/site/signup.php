<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\SignupForm */

$this->title = Yii::t('app','Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?=Yii::t('app','Ayuda Sign up')?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username')->label(Yii::t('app','Username')) ?>
                <?= $form->field($model, 'email')->label(Yii::t('app','Email')) ?>
                <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('app','Password')) ?>
				<?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(Yii::t('app','Name')) ?>				
				<?= $form->field($model, 'surname')->textInput(['maxlength' => true])->label(Yii::t('app','Surname')) ?>
				<?= $form->field($model, 'phone')->textInput(['maxlength' => true])->label(Yii::t('app','Phone')) ?>
				<?= $form->field($model, 'mobile')->textInput(['maxlength' => true])->label(Yii::t('app','Mobile')) ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app','Sign up'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
