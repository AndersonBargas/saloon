<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Reservas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reservas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usuario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sala')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'observacao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'inicio')->textInput() ?>

    <?= $form->field($model, 'termino')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
