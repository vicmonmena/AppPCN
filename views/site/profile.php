<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Proceso;
use app\controllers\IUtils;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Mis Datos');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-profile">

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
	<?php
		foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
			echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
		} 
	?>
</div>
