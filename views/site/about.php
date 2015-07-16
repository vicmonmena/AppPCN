<?php
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use kartik\grid\GridView;
use kartik\form\ActiveForm;
use kartik\builder\TabularForm;
use app\models\PersonalCriticoForm;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the About page. You may modify the following file to customize its content:</p>

    <code><?= __FILE__ ?></code>
	<p>
	<?php
		
		$query = PersonalCriticoForm::find()->indexBy('id'); // where `id` is your primary key
 
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pagesize' => 10
			]
		]);
		
		$form = ActiveForm::begin();
		$attribs = $model->getFormAttribs();
		 
		echo TabularForm::widget([
			'dataProvider'=>$dataProvider,
			'form'=>$form,
			'attributes'=>$attribs,
			'gridSettings'=>[
				'floatHeader'=>true,
				'panel'=>[
					'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Personal Crítico</h3>',
					'type' => GridView::TYPE_PRIMARY,
					'after'=> Html::a('<i class="glyphicon glyphicon-plus"></i> Add New', '#', ['class'=>'btn btn-success']) . ' ' . 
							Html::a('<i class="glyphicon glyphicon-remove"></i> Delete', '#', ['class'=>'btn btn-danger']) . ' ' .
							Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> Save', ['class'=>'btn btn-primary'])
				]
			]   
		]);
		ActiveForm::end();
	?>
	</p>
	<p>
	<?php
	// Generate a bootstrap responsive striped table with row highlighted on hover
	echo GridView::widget([
		'dataProvider'=> $dataProvider,
		'columns' => [
			'name','surname','email','mobile',
		],
		'responsive'=>true,
		'hover'=>true,
		'toolbar' => [
			[
				'content'=>
					Html::button('<i class="glyphicon glyphicon-plus"></i>', [
						'type'=>'button', 
						'title'=>Yii::t('kvgrid', 'Add Book'), 
						'class'=>'btn btn-success'
					]) . ' '.
					Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], [
						'class' => 'btn btn-default', 
						'title' => Yii::t('kvgrid', 'Reset Grid')
					]),
			],
			'{export}',
			'{toggleData}'
		]
	]);?>
	</p>
</div>
