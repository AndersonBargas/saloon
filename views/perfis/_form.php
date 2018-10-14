<?php

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Perfis */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perfis-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?php
    $controladores = \Yii::$app->metadata->getControllers();

    $items = [];
    foreach (array_values($controladores) as $controlador) {

        $acoes = \Yii::$app->metadata->getActions($controlador);
        $filhos = [];
        foreach ($acoes as $acao) {
            $filhos[] = ['title' => $acao];
        }
        $items[] = ['title'    => mb_substr($controlador, 0, -10),
                    'children' => $filhos,
                    'folder' => true,
        ];
    }
    ?>

    <?= yii2mod\tree\Tree::widget([
            'items' => $items,
            'clientOptions' => [
                'autoCollapse' => true,
                'clickFolderMode' => 2,
                'selectMode' => 3,
                'checkbox' => true,
                'activate' => new \yii\web\JsExpression('
                        function(node, data) {
                              node  = data.node;
                              // Log node title
                              console.log(node.title);
                        }
                '),
            ],
        ]); ?>
    <br/>

    <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
