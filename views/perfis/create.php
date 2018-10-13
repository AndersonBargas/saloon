<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Perfis */

$this->title = 'Create Perfis';
$this->params['breadcrumbs'][] = ['label' => 'Perfis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perfis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
