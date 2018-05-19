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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Nova Reserva', ['adicionar'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= Reservas::widget(

    ) ?>

</div>
