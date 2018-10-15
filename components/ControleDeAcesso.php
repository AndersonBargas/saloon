<?php

namespace app\components;

use Yii;
use yii\base\BaseObject;

class ControleDeAcesso extends BaseObject
{

    public static function verificar()
    {
        if ($identidade = Yii::$app->user->identity) {
            return $identidade->getPerfil()->one()
            ->getPermissoes()
            ->where([
                'controlador' => ucfirst(Yii::$app->controller->id),
                'acao'        => ucfirst(Yii::$app->controller->action->id),
                ])
            ->exists();
        }

        return false;
    }

    public static function acessoNaoPermitido($rule, $action)
    {
        Yii::$app->getSession()->setFlash('aviso','Aceso não permitido.');
        Yii::$app->user->loginRequired();
    }

}