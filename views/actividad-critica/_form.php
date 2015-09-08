<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadCritica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividad-critica-form">

    <?php $form = ActiveForm::begin(['id' => model->formName()]); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'redireccion_telefono')->textInput() ?>

    <?= $form->field($model, 'aplicaciones')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'proveedores')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'otros_activos')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'comentarios')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$script = <<< JS

$('form#{$model->formName()}').on('beforeSubmit', function(e) {
	var \$form = $(this);
	$.post(
		\$form.attr("action"),	//action="/AppPCN/web/index.php?r=actividad-critica/create"
		\$form.serialize()		// srializar el formulario (toma todos los valores del form y los pone en un array)
	)
	
	.done(function(result) {
		// console.log(result);
		if(result == 1) {
			//$(document).find('#secondmodal').modal('hide');
			$(\$form).trigger("reset");
			$.pjax.reload({container:'#actividadCriticaGrid'});
		} else {
			$("#message").html(result);
		}
	}).fail(function(){
		console.log("server error");
	});
	return false;
});

JS;
$this->registerJs($script);
?>
