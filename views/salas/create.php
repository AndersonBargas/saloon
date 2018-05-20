<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Salas */

$this->title = 'Nova Sala';
?>
<div class="salas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
