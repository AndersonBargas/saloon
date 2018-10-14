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

    <?= yii2mod\tree\Tree::widget([
            'items' => $controladores,
            'clientOptions' => [
                'autoCollapse' => true,
                'clickFolderMode' => 2,
                'selectMode' => 3,
                'checkbox' => true,
                'select' => new \yii\web\JsExpression('
                        function(node, data) {
                            $("#tree").fancytree("getTree").generateFormElements("controladores[]", false, {"stopOnParents": false});
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
