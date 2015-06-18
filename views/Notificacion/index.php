<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\Ubicacion;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotificacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Notificacions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notificacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Notificacion'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'subject',
			'create_time',
            [
				'attribute' => 'ubicacion_id',
				'value' => function($model) {
                    $location = Ubicacion::findOne($model->ubicacion_id);
					return $location->name;
                },
				'filter' => ArrayHelper::map(Ubicacion::find()->all(), 'id', 'name'),
			],
			[
				'attribute' => 'user_id',
				'value' => function($model) {
                    $user = User::findOne($model->user_id);
					return $user->username;
                },
				'filter' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
