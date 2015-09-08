<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ActividadCritica */

$this->title = Yii::t('app', 'Create Actividad Critica');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Actividad Criticas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividad-critica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
