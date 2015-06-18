<?php

use yii\widgets\ActiveForm;
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

		<p>
		<?php $form = ActiveForm::begin([
			'id' => 'inputcode-form', 
			'method' => 'post',
			'action' => ['code']
		]);?>
			<p class="lead">Datos de la incidencia</p>
			<p><?= $form->field($model, 'subject')->label('Motivo')?></p>
			<p><?= $form->field($model, 'ubicacion')->label('Ubicación')?></p>
			
			<p class="lead">¿Cómo proceder?</p>
			<p><?= $form->field($model, 'description')->textInput(['maxlength' => true])->label('Descripción') ?></p>
			
			<p class="lead">¿A quién desea notificar el procedimiento?</p>
			<p>
			<?php
				$personal = ArrayHelper::map($personalDisponible, 'id', 'name' . ' ' . 'surname');
				echo $form->field($model, 'personalCritico')->checkboxList($personal, ['unselect'=>NULL]);
			?>
			</p>
			<div class="form-group">
				<?= Html::submitButton(Yii::t('app','Enviar'), ['class' => 'btn btn-primary', 'name' => 'inputcode-button']) ?>
			</div>
		<?php ActiveForm::end(); ?>
		</p>
		<?php
		foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
			echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
		} 
		?>
    </div>
</div>
