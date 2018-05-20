<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php if ($model->editando) : ?>
        <div class="alert alert-info" role="alert">Deixe a senha <strong>em branco</strong> caso deseje manter a <strong>senha atual</strong>.</div>
    <?php endif; ?>

    <?= $form->field($model, 'senha')->passwordInput(['maxlength' => true]) ?>

    <div class="alert alert-info" role="alert">Apenas <strong>administradores</strong> possuem acesso ao cadastro de <strong>usuários</strong>.</div>

    <?= $form->field($model, 'administrador')->checkbox(['class'=>'js-switch']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>