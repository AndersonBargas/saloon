<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'senha')->passwordInput() ?>

        <?= $form->field($model, 'lembrar')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} Manter-me logado</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <?php if (Yii::$app->session->hasFlash('erro')): ?>
            <div class="alert alert-danger" role="alert">
                <strong>Oops!</strong> <?= Yii::$app->session->getFlash('erro') ?>
            </div>
        <?php endif; ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('<span class="btn-block-text">Entrar</span>', ['class' => 'btn  btn-primary btn-block', 'name' => 'login-button']) ?>
            </div>
        </div>

        <div class="clearfix"></div>

    <div class="separator">
        <p>No primeiro acesso, utilize: <strong>admin@admin.com</strong> / <strong>admin</strong></p>
    </div>

    <?php ActiveForm::end(); ?>

</div>
