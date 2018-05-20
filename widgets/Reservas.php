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

    public $data;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $salas = Salas::find()
            ->indexBy('id')
            ->All();

        return $this->render('reservas', [
            'salas' => $salas,
            'data'  => $this->data,
        ]);
    }
}
