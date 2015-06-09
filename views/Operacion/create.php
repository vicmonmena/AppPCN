<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Operacion */

$this->title = Yii::t('app', 'Create Operacion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Operacions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
