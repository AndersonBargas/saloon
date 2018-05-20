<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Salas */

$this->title = Html::encode($model->nome . ' (#' . $model->id .  ')');
?>
<div class="salas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
