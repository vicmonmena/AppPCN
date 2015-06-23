<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\LoginForm */

$this->title = Yii::t('app','Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?=Yii::t('app','Ayuda Login')?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username')->label(Yii::t('app','Username')) ?>
                <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('app','Password')) ?>
                <?= $form->field($model, 'rememberMe')->checkbox()->label(Yii::t('app','Recuerdame')) ?>
                <div style="color:#999;margin:1em 0">
                    <?= Html::a(Yii::t('app','Sign up'), ['site/signup']) ?> <?=Yii::t('app','Forgot password')?> <?= Html::a(Yii::t('app','reset it'), ['site/request-password-reset']) ?>.
                </div>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app','Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
