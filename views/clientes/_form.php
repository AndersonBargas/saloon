<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clientes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomeCliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cpfCliente')->textInput() ?>

    <?= $form->field($model, 'rgCliente')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Salvar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::submitButton('Cancelar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
