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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Novo Usuário', ['create'], ['class' => 'btn btn-success']) ?>
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
                'template' => '{usuarioEditar} {usuarioExcluir}',
                'buttons'  => [
                                'usuarioEditar' => function ($url, $model) {
                                    $url = Url::to(['usuarios/update', 'id' => $model->id]);
                                    return Html::a('<span class="fa fa-pencil"></span>', $url, ['title' => 'Editar']);
                                },
                                'usuarioExcluir' => function ($url, $model) {
                                    $url = Url::to(['usuarios/delete', 'id' => $model->id]);
                                    return Html::a('<span class="fa fa-trash"></span>', $url, [
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
