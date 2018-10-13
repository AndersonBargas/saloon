<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Perfis */

$this->title = 'Novo Perfil';
?>
<div class="perfis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
