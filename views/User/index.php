<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\Rol;
use app\controllers\IUtils;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            [
				'attribute' => 'status',
				'value' => function($model) {
					return $model->status == IUtils::STATUS_ACTIVE ?
                    'Activo' : 'Inactivo';
                },
				'filter' => ArrayHelper::map(
					[
						['id' => IUtils::STATUS_DELETED, 'estado' => 'Inactivo'],
						['id' => IUtils::STATUS_ACTIVE, 'estado' => 'Activo']
					], 'id', 'estado'),
			],
            // 'created_at',
            // 'updated_at',
            // 'rol_id',
			[
				'attribute' => 'rol_id',
				'value' => function($model) {
                    $role = Rol::findOne($model->rol_id);
					return $role->name;
                },
				'filter' => ArrayHelper::map(Rol::find()->all(), 'id', 'name'),
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
