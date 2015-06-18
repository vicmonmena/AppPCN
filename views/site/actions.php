<?php

use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Warning!</h1>

        <p class="lead">Seleccione el personal al que desea notificar y cómo proceder</p>

    </div>

    <div class="body-content">
		
		<p class="lead">Datos de la incidencia</p>
		<?= DetailView::widget([
			'model' => $model,
			'attributes' => [
				'subject',
				'location'
			],
		]) ?>
	
		<?php $form = ActiveForm::begin([
			'id' => 'inputcode-form', 
			'method' => 'post',
			'action' => ['send']
		]);?>
			
			<p class="lead">¿Cómo proceder?</p>
			<p><?= $form->field($model, 'description')->textInput(['maxlength' => true])->label(false) ?></p>
			
			<p class="lead">¿A quién desea notificar el procedimiento?</p>
			<p>
			<?php
				$personal = ArrayHelper::map($personalDisponible, 'id', 'username');
				echo $form->field($model, 'personalCritico')->checkboxList($personal, ['unselect'=>NULL])->label(false);
			?>
			</p>
			<div class="form-group">
				<?= Html::submitButton(Yii::t('app','Enviar'), ['class' => 'btn btn-primary', 'name' => 'inputcode-button']) ?>
			</div>
			
		<?php ActiveForm::end(); ?>
		
		<?php
		foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
			echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
		} 
		?>
    </div>
</div>
