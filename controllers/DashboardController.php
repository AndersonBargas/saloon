<?php

namespace app\controllers;

use app\components\ControleDeAcesso;
use yii\web\Controller;
use yii\filters\AccessControl;

class DashboardController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => ControleDeAcesso::verificar(),
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
