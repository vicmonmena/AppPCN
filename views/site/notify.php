<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NotifyForm */
/* @var $form ActiveForm */
?>
<div class="notify">

	<div class="jumbotron">
        <h1>Notify!</h1>

        <p class="lead">Input email to notify to someone</p>

    </div>
	<div class="body-content">
		<?php $form = ActiveForm::begin(); ?>

			<?= $form->field($model, 'email') ?>
		
			<div class="form-group">
				<?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</div><!-- notify -->
