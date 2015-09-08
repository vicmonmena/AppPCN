<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OperacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Operaciones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
			[
				'attribute' => 'create_time',
				'value' => 'create_time',
				'filter' => \yii\jui\DatePicker::widget([
					'model'=>$searchModel,
					'attribute'=>'create_time',
					'language' => 'es',
					'dateFormat' => 'dd-MM-yyyy',
				]),
				'format' => 'html',
			],
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{download} {view} {update} {delete}',
				'buttons' => [
					'download' => function ($url) {
						return Html::a(
							'<span class="glyphicon glyphicon-cloud-download"</span>',
							$url, 
							[
								'title' => 'Download',
								'data-pjax' => '0',
							]
						);
					},
				],
			],
        ],
    ]); ?>

</div>
