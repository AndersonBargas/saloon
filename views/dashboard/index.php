<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dashboard';
?>
<div class="dashboard-index">

    <?php if (Yii::$app->session->hasFlash('sucesso')): ?>
        <div class="alert alert-success" role="alert">
            <strong>Excelente!</strong> <?= Yii::$app->session->getFlash('sucesso') ?>
        </div>
    <?php endif; ?>

    <h1><?= Html::encode($this->title) ?></h1>

</div>
