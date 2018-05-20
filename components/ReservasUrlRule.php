<?php

namespace app\components;

use yii\web\UrlRuleInterface;
use yii\base\BaseObject;

class ReservasUrlRule extends BaseObject implements UrlRuleInterface
{
    private function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public function createUrl($manager, $route, $params)
    {
        if ($route === 'reservas/index') {
            if (isset($params) && is_array($params) && array_key_exists('data', $params)) {
                return $params['data'];
            }
        }
        return false;
    }

    public function parseRequest($manager, $request)
    {
        $caminho = $request->getPathInfo();
        $data = str_replace('reservas/', '', $caminho);
        if ($this->validateDate($data, 'Y-m-d')) {
            $params['data'] = $data;
            return ['reservas/index', $params];
        }
        return false;
    }
}