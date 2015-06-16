<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Ubicacion;

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
			<p>
			<?= $form->field($model, 'subject') ?>
			</p>
			<p>
			<?= $form->field($model, 'location')
				->dropDownList(ArrayHelper::map(Ubicacion::find()->all(), 'id', 'name'))
				->label(false)
			?>
			</p>
			<div class="form-group">
				<?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</div><!-- notify -->
