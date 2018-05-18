<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "historico".
 *
 * @property string $id
 * @property string $idUsuario
 * @property string $dataHistorico
 * @property string $ip
 * @property string $host
 * @property string $navegador
 * @property string $comentario
 * @property string $url
 * @property string $detalhes
 *
 * @property Usuarios $usuario
 */
class Historico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'historico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUsuario', 'dataHistorico', 'ip', 'host', 'navegador', 'comentario', 'url'], 'required'],
            [['idUsuario'], 'integer'],
            [['dataHistorico'], 'safe'],
            [['detalhes'], 'string'],
            [['ip'], 'string', 'max' => 15],
            [['host'], 'string', 'max' => 90],
            [['navegador'], 'string', 'max' => 130],
            [['comentario'], 'string', 'max' => 80],
            [['url'], 'string', 'max' => 220],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['idUsuario' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idUsuario' => 'Id Usuario',
            'dataHistorico' => 'Data Historico',
            'ip' => 'Ip',
            'host' => 'Host',
            'navegador' => 'Navegador',
            'comentario' => 'Comentario',
            'url' => 'Url',
            'detalhes' => 'Detalhes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'idUsuario']);
    }
}
