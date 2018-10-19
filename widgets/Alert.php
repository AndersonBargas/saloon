<?php
namespace app\widgets;

use Yii;

/**
 * Alert widget renders a message from session flash. All flash messages are displayed
 * in the sequence they were assigned using setFlash. You can set message as following:
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @author Alexander Makarov <sam@rmcreative.ru>
 */
class Alert extends \yii\bootstrap\Widget
{

    public $tiposDeAlerta = [
        'erro'       => [
            'classe' => 'alert-danger',
            'prefixo'=> 'Oops!',
        ],
        'perigo'      => [
            'classe'  =>'alert-danger',
            'prefixo' => 'Cuidado!',
        ],
        'sucesso'     => [
            'classe'  =>'alert-success',
            'prefixo' => 'Excelente!',
        ],
        'informacao'  => [
            'classe'  =>'alert-info',
            'prefixo' => 'Informação!',
        ],
        'aviso'       => [
            'classe'  =>'alert-warning',
            'prefixo' => 'Atenção!',
        ],
    ];

    public $botoesDeFechar = [];

    public function run()
    {
        $sessao = Yii::$app->session;
        $mensagens = $sessao->getAllFlashes();

        foreach ($mensagens as $tipo => $mensagem) {
            if (array_key_exists($tipo, $this->tiposDeAlerta) === false) {
                print_r(array_keys($this->tiposDeAlerta));
                continue;
            }

            foreach ((array)$mensagem as $index => $texto) {
                echo \yii\bootstrap\Alert::widget([
                    'body' => "{$this->tiposDeAlerta[$tipo]['prefixo']} {$texto}",
                    'closeButton' => $this->botoesDeFechar,
                    'options' => array_merge(
                        $this->options, [
                        'id' => "{$this->getId()}-{$tipo}-{$index}",
                        'class' => $this->tiposDeAlerta[$tipo]['classe'],
                    ]),
                ]);
            }

            $sessao->removeFlash($tipo);
        }
    }
}
