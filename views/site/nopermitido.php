<?php
use yii\helpers\Html;
 
/* @var $this yii\web\View */
$this->title = 'Forbidden 403';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
 
    <div class="alert alert-danger">
    <p>No tiene permiso para acceder a esta página.</p>
    </div>
</div>