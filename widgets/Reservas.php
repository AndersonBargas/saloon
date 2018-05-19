<?php
namespace app\widgets;

use Yii;

use app\models\Salas;

use yii\data\ActiveDataProvider;

/**
 * Widget para gerar a visualização das reservas
 *
 * @author Anderson Bargas <anderson@andersonbargas.com>
 */
class Reservas extends \yii\bootstrap\Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - key: the name of the session flash variable
     * - value: the bootstrap alert type (i.e. danger, success, info, warning)
     */
    public $alertTypes = [
        'error'   => 'alert-danger',
        'danger'  => 'alert-danger',
        'success' => 'alert-success',
        'info'    => 'alert-info',
        'warning' => 'alert-warning'
    ];


    /**
     * {@inheritdoc}
     */
    public function run()
    {
        //$salas = ['Lannister', 'Stark'];
        $salas = Salas::find()
            ->indexBy('id')
            ->All();

        return $this->render('reservas', [
            'salas' => $salas,

            ]);
        /*$salas = ['lannister', 'stark'];
        foreach ($salas as $sala) {
            echo '<div class="panel panel-default">
                    <div class="panel-heading">Sala' . $sala . '</div>
                    <div class="panel-body">';
            
            for ($hora = 8; $hora <= 18; $hora++ ) {

            }


            echo '</div>
                </div>';
        }
        //$session = Yii::$app->session;
        for ($hora = 8; $hora <= 18; $hora++ ) {

        }*/

    }
}
