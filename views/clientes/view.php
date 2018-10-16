<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */

//$this->title = $model->idCliente;
//$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
$this->title = Html::encode($model->nome . ' (#' . $model->idCliente .  ')');
?>
<div class="clientes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['editar', 'idCliente' => $model->idCliente], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['excluir', 'idCliente' => $model->idCliente], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza que deseja excluir este cliente?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'idCliente',
            'nomeCliente',
            'cpfCliente',
            'rgCliente',
        ],
    ]) ?>

</div>
