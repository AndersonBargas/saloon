<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Perfis */

$this->title = Html::encode($model->nome . ' (#' . $model->id .  ')');
?>
<div class="perfis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'controladores' => $controladores,
    ]) ?>

</div>
