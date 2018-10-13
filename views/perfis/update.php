<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Perfis */

$this->title = 'Update Perfis: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Perfis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="perfis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
