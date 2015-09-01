<?php
use yii\helpers\Html;
use app\models\PersonalCriticoForm;
use app\models\IncidenciaForm;
use yii\web\View;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs(
	"test();",
	View::POS_END,
	'add-row');
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
	<?php
	$content1 = $this->render('forms\step1', ['model' => $model]);
	$modelPC = new PersonalCriticoForm();
	$content2 = $this->render('forms\step2', ['model' => $modelPC, 'data' => $model->personalCritico]);
	$content3 = $this->render('forms\step3', ['model' => $model]);
	$items = [
		[
			'label' => 'Paso 1',
			'content' => $content1,
			'active' => true
		],
		[
			'label' => 'Paso 2',
			'content' => $content2,
		],
		[
			'label' => 'Paso 3',
			'content' => $content3,
		],
	];
	?>
	<?= Tabs::widget(['items' => $items]);?>
</div>
