<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = Html::encode($model->nome . ' (#' . $model->id .  ')');
?>
<div class="usuarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['editar', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['excluir', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza que deseja excluir este usuário?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'email:email',
            [
                'label' => 'Perfil',
                'value' => $model->perfil->nome,            
                //'contentOptions' => ['class' => 'bg-red'],
                //'captionOptions' => ['tooltip' => 'Tooltip'],
            ],
            'criacao:datetime',
        ],
    ]) ?>

</div>
