<?php foreach ($salas as $id => $sala): ?>
    <?php $horariosDaSala =  $sala
        ->getReservas()
        ->where(['data' => '2017-06-22'])
        ->indexBy('hora')
        ->All();?>
    <div class="panel panel-default">
        <div class="panel-heading">Sala <?= $sala->nome ?><span class="label label-info pull-right">Reservas: <?= count($horariosDaSala) ?></span></div>
        <div class="panel-body">
            <div class="btn-group btn-group-justified" role="group" aria-label="..."-->
                <?php for ($hora = 8; $hora <= 18; $hora++) : ?>
                    <div class="btn-group" role="group">
                        <?php if (array_key_exists($hora, $horariosDaSala)): ?>
                            <?php   $reservante = $horariosDaSala[$hora]->getUsuario0()->One()->nome;
                                    $observacao = $horariosDaSala[$hora]->observacao;
                                    if (empty($observacao)) {
                                        $observacao .= 'Nenhuma observação.';
                                    }
                            ?>
                            <button type="button" class="btn btn-danger" data-toggle="popover" title="Reservante: <?= $reservante ?>" data-content="<?= $observacao ?>"><?= $hora ?>:00</button>
                        <?php else: ?>
                            <button type="button" class="btn btn-success"><?= $hora ?>:00</button>
                        <?php endif; ?>
                        
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php
    $this->registerCss('div.popover { width: 400px; }');
    $this->registerJs('$(\'[data-toggle="popover"]\').popover()', \yii\web\View::POS_READY);
?>