<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo Cliente', ['adicionar'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'idCliente',
//            'nomeCliente',
//            'cpfCliente',
//            'rgCliente',
//
//            ['class' => 'yii\grid\ActionColumn'],
                        ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nome',
            'criacao:datetime',

            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{clientesVer} {clientesEditar} {clientesExcluir}',
                'buttons'  => [
                                'clientesVer' => function ($url, $model) {
                                    $url = Url::to(['clientesVer/ver', 'idCliente' => $model->idCliente]);
                                    return Html::a('<span class="fa fa-eye"></span>', $url, ['title' => 'Visualizar']);
                                },
                                'clientesEditar' => function ($url, $model) {
                                    $url = Url::to(['clientesEditar/editar', 'idCliente' => $model->idCliente]);
                                    return Html::a('<span class="fa fa-pencil-alt"></span>', $url, ['title' => 'Editar']);
                                },
                                'clientesExcluir' => function ($url, $model) {
                                    $url = Url::to(['clientesExcluir/excluir', 'idCliente' => $model->idCliente]);
                                    return Html::a('<span class="fa fa-trash-alt text-danger"></span>', $url, [
                                        'title'        => 'Excluir',
                                        'data-confirm' => 'Tem certeza que deseja excluir este cliente?',
                                        'data-method'  => 'post',
                                    ]);
                                },
                ],
            ],
        ],
    ]); ?>
</div>
