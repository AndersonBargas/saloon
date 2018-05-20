<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reservas */

$this->title = Html::encode('Reserva (#' . $model->id .  ')');
?>
<div class="reservas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
