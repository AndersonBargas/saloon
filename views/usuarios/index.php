<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuários';
?>
<div class="usuarios-index">

    <?php if (Yii::$app->session->hasFlash('sucesso')): ?>
        <div class="alert alert-success" role="alert">
            <strong>Excelente!</strong> <?= Yii::$app->session->getFlash('sucesso') ?>
        </div>
    <?php endif; ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Novo Usuário', ['adicionar'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' =>['class' => 'table table-striped table-hover'],
        'columns' => [

            'id',
            'nome',
            'email:email',
            'administrador:boolean',
            'criacao:datetime',

            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{usuarioVer} {usuarioEditar} {usuarioExcluir}',
                'buttons'  => [
                                'usuarioVer' => function ($url, $model) {
                                    $url = Url::to(['usuarios/ver', 'id' => $model->id]);
                                    return Html::a('<span class="fa fa-eye"></span>', $url, ['title' => 'Visualizar']);
                                },
                                'usuarioEditar' => function ($url, $model) {
                                    $url = Url::to(['usuarios/editar', 'id' => $model->id]);
                                    return Html::a('<span class="fa fa-pencil-alt"></span>', $url, ['title' => 'Editar']);
                                },
                                'usuarioExcluir' => function ($url, $model) {
                                    $url = Url::to(['usuarios/excluir', 'id' => $model->id]);
                                    return Html::a('<span class="fa fa-trash-alt text-danger"></span>', $url, [
                                        'title'        => 'Excluir',
                                        'data-confirm' => 'Tem certeza que deseja excluir este usuário?',
                                        'data-method'  => 'post',
                                    ]);
                                },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
