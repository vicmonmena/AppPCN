<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Accion */

$this->title = Yii::t('app', 'Create Accion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
