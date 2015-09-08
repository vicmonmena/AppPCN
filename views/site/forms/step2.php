<?php
use yii\helpers\Html;
use yii\captcha\Captcha;
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
use kartik\form\ActiveForm;
use kartik\builder\FormGrid;
use kartik\builder\TabularForm;


use app\models\PersonalCriticoForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

?>
<div class="site-step1">
    <p>
		<?= Yii::t('app', 'Introduce los datos del personal critico') . ':'?>
    </p>        
	<p>
	<?php
		$attribs = $model->getFormAttribs();
		$pcModel = new PersonalCriticoForm();
		$form = ActiveForm::begin([
			'id' => 'inputcode-form', 
			'method' => 'post',
			'action' => ['add']
		]);
		echo FormGrid::widget([
			'model' => $pcModel,
			'form' => $form,
			'autoGenerateColumns' => true,
			'rows' => [
				[
					'attributes' => $attribs
				],
			]
		]);
	?>
		<div class="form-group">
			<?= Html::submitButton(Yii::t('app','Add'), ['class' => 'btn btn-primary', 'name' => 'inputcode-button']) ?>
		</div>
	<?php ActiveForm::end();?>
	</p>
	<?php
		// $query = new Query;
		$dataProvider = new ArrayDataProvider([
			'allModels' => $data,
			'sort' => [
				'attributes' => ['name', 'surname', 'email', 'mobile'],
			],
			'pagination' => [
				'pageSize' => 10,
			],
		]);
		$form = ActiveForm::begin();
	?>
	<p>
	<?php \yii\widgets\Pjax::begin(); ?>
	<?= 
		GridView::widget([
			'dataProvider' => $dataProvider,
			'columns' => [
				['class' => 'yii\grid\SerialColumn'],
				'name', 'surname', 'email', 'mobile',
				['class' => 'yii\grid\ActionColumn'],
			],
		]);
	?>
	<?php \yii\widgets\Pjax::end(); ?>
	</p>
	<p>
	<?php
	/*
		echo TabularForm::widget([
			'dataProvider'=>$dataProvider,
			'form'=>$form,
			'attributes'=>$attribs,
			'gridSettings'=>[
				'floatHeader'=>true,
				'panel'=>[
					'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Personal Crítico</h3>',
					'type' => GridView::TYPE_PRIMARY,
					'after'=> 
						Html::a('<i class="glyphicon glyphicon-remove"></i> Delete', '#', ['class'=>'btn btn-danger']) . ' ' .
						Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> Save', ['class'=>'btn btn-primary'])
				]
			]   
		]);
		ActiveForm::end();
		*/
	?>
	</p>
</div>