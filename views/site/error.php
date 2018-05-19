<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::encode('O erro informado abaixo ocorreu enquanto o Servidor Web processava a sua requisição:') ?>
    </p>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
    
    <p>
        <?= Html::encode('Por favor, caso ache que este erro não deveria estar acontecendo, contate-me em: anderson <at> andersonbargas <dot> com. Obrigado.') ?>
    </p>

</div>
