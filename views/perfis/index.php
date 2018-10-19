<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PerfisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Perfis';
?>
<div class="perfis-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo Perfil', ['adicionar'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nome',
            'criacao:datetime',

            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{perfilVer} {perfilEditar} {perfilExcluir}',
                'buttons'  => [
                                'perfilVer' => function ($url, $model) {
                                    $url = Url::to(['perfis/ver', 'id' => $model->id]);
                                    return Html::a('<span class="fa fa-eye"></span>', $url, ['title' => 'Visualizar']);
                                },
                                'perfilEditar' => function ($url, $model) {
                                    $url = Url::to(['perfis/editar', 'id' => $model->id]);
                                    return Html::a('<span class="fa fa-pencil-alt"></span>', $url, ['title' => 'Editar']);
                                },
                                'perfilExcluir' => function ($url, $model) {
                                    $url = Url::to(['perfis/excluir', 'id' => $model->id]);
                                    return Html::a('<span class="fa fa-trash-alt text-danger"></span>', $url, [
                                        'title'        => 'Excluir',
                                        'data-confirm' => 'Tem certeza que deseja excluir este perfil?',
                                        'data-method'  => 'post',
                                    ]);
                                },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
