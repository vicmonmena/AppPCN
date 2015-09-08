<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadCriticaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Actividad Criticas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-critica-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button(Yii::t('app', 'Create Actividad Critica'), ['value' => Url::to('index.php?r=actividad-critica/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>
	
	<?php
		Modal::begin([
			'header' => '<h4>Actividad crítica</h4>',
			'id' => 'modal',
			'size' => 'modal-lg',
		]);
		
		echo "<div id='modalContent'></div>";
		
		Modal::end();
	?>
	<?php Pjax::begin(['id' => 'actividadCriticaGrid']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'redireccion_telefono',
            'aplicaciones:ntext',
            'proveedores:ntext',
            // 'otros_activos:ntext',
            // 'comentarios:ntext',
            // 'create_time',
            // 'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
	<?php Pjax::end();?>

</div>
