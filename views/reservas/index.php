<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\web\View;

use app\widgets\Reservas;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReservasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reservas';
?>
<div class="reservas-index">

    <?php if (Yii::$app->session->hasFlash('sucesso')): ?>
        <div class="alert alert-success" role="alert">
            <strong>Excelente!</strong> <?= Yii::$app->session->getFlash('sucesso') ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class='col-sm-6'>
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class='col-sm-6 text-center'>
            <h3>Significado das cores:</h3>
            <label class="btn btn-success">Livre</label>
            <label class="btn btn-warning">Minha reserva</label>
            <label class="btn btn-danger">Reserva de outra pessoa</label>
        </div>
    </div>
    <?php Pjax::begin(); ?>

    <h1 class="text-center"><a id="data_por_extenso" href="#" onclick="calendarioToggle(event)"></a></h1>

    <div class="row">
        <div class='col-sm-offset-3 col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker2'>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <?= Reservas::widget([
        'data' => $data,
    ]) ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Nova Sala', ['salas/adicionar'], ['class' => 'btn btn-primary btn-lg btn-block']) ?>
    </p>

</div>
<?php
    View::registerCss(
        ".input-group-addon {
            visibility: hidden;
            padding: 0;
        }"
    );
    View::registerJs(
    "calendario = $('#datetimepicker2').datetimepicker({
        date    : '{$data}',
        format  : 'dddd, DD [de] MMMM [de] YYYY',
        inline  : true,
        locale  : 'pt-br',
        tooltips: {
            today        : 'Hoje',
            clear        : 'Limpar',
            close        : 'Fechar',
            selectMonth  : 'Selecione o Mês',
            prevMonth    : 'Mês Anterior',
            nextMonth    : 'Próximo Mês',
            selectYear   : 'Selecione o Ano',
            prevYear     : 'Ano Anterior',
            nextYear     : 'Próximo Ano',
            selectDecade : 'Selecione a Década',
            prevDecade   : 'Década Anterior',
            nextDecade   : 'Próxima Década',
            prevCentury  : 'Previous Century',
            nextCentury  : 'Próximo Século'
        }
    });

    var setarData = function(data) {
        calendario.hide();
        var formatado = moment(data).format('dddd, DD [de] MMMM [de] YYYY');
        $('#data_por_extenso').text(formatado);
    };

    calendario.on('dp.change', function(e){
        setarData(e.date);
        var formatado = moment(e.date).format('YYYY-MM-DD');
        $('body').LoadingOverlay('show');
        window.location.replace('/reservas/' + formatado);
    });

    setarData('{$data}');",
    View::POS_READY
    );
?>