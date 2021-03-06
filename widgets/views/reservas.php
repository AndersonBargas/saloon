<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
?>
<?php foreach ($salas as $id => $sala): ?>
    <?php $horariosDaSala =  $sala
        ->getReservas()
        ->where(['data' => $data])
        ->indexBy('hora')
        ->All();?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= Html::encode($sala->nome) ?> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="<?= Url::toRoute(['salas/editar', 'id' => $id]); ?>"><span class="fa fa-pencil-alt text-primary"></span> Editar</a></li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <?= Html::a('<span class="fa fa-trash-alt text-danger"></span> Excluir',
                                    Url::toRoute(['salas/excluir', 'id' => $id]),
                                    [
                                        'title'        => 'Excluir',
                                        'data-confirm' => 'Tem certeza que deseja excluir esta sala?',
                                        'data-method'  => 'post',
                                    ]
                            )
                        ?>
                    </li>
                </ul>
            </div>
            <span class="label label-info pull-right">Reservas: <?= count($horariosDaSala) ?></span></div>
            <div class="panel-body">
                <div class="btn-group btn-group-justified" role="group" aria-label="Reservas">
                    <?php for ($hora = 8; $hora <= 18; $hora++) : ?>
                        <div class="btn-group" role="group">
                            <?php if (array_key_exists($hora, $horariosDaSala)): ?>
                                <?php   $idReserva = $horariosDaSala[$hora]->id;
                                        $reservante = $horariosDaSala[$hora]->getUsuario0()->One();
                                        $observacao = $horariosDaSala[$hora]->observacao;
                                        if (empty($observacao)) {
                                            $observacao .= 'Nenhuma observação.';
                                        }
                                ?>
                                <?php if (Yii::$app->user->identity->id == $reservante->id): ?>
                                    <?= Html::a("{$hora}h", ['/reservas/ver', 'id' => $idReserva], ['class'=>'btn btn-warning', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Clique para visualizar sua reserva']) ?>
                                <?php else: ?>
                                    <button type="button" class="btn btn-danger" data-toggle="popover" data-trigger="focus" title="Reservante: <?= Html::encode($reservante->nome) ?>" data-content="<?= nl2br(Html::encode($observacao)) ?>"><?= $hora ?>h</button>
                                <?php endif; ?>
                                
                            <?php else: ?>
                                <?= Html::a("{$hora}h", ['/reservas/adicionar'], ['class'=>'btn btn-success', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Clique para reservar este horário', 'data-method' => 'POST', 'data-params'=>['sala' => $id, 'data' => $data, 'hora' => $hora,]]) ?>
                            <?php endif; ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
    </div>
<?php endforeach; ?>
<?php
    $this->registerCss('div.popover { width: 400px; }');
    $this->registerJs('$(\'[data-toggle="tooltip"]\').tooltip()', View::POS_READY);
    $this->registerJs('$(\'[data-toggle="popover"]\').popover()', View::POS_READY);
?>