<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use app\widgets\Reservas;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReservasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reservas';
?>
<div class="reservas-index">

    <?php if (Yii::$app->session->hasFlash('sucesso')): ?>
        <div class="alert alert-success" role="alert">
            <strong>Excelente!</strong> <?= Yii::$app->session->getFlash('sucesso') ?>
        </div>
    <?php endif; ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Nova Reserva', ['adicionar'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= Reservas::widget() ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Nova Sala', ['salas/adicionar'], ['class' => 'btn btn-primary btn-lg btn-block']) ?>
    </p>

</div>
