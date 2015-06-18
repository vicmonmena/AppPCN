<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Accions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Accion'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'descripcion',
            'create_time',
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
