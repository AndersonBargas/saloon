<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%cliente}}".
 *
 * @property int $idCliente Chave primaria da tabela
 * @property string $nomeCliente Nome do cliente
 * @property int $cpfCliente CPF do cliente
 * @property int $rgCliente RG do cliente
 *
 * @property Consorciocliente[] $consorcioclientes
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cliente}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idCliente', 'nomeCliente', 'cpfCliente', 'rgCliente'], 'required'],
            [['idCliente', 'cpfCliente', 'rgCliente'], 'integer'],
            [['nomeCliente'], 'string', 'max' => 45],
            [['idCliente'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCliente' => 'Id Cliente',
            'nomeCliente' => 'Nome Cliente',
            'cpfCliente' => 'Cpf Cliente',
            'rgCliente' => 'Rg Cliente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsorcioclientes()
    {
        return $this->hasMany(Consorciocliente::className(), ['cliente_idCliente' => 'idCliente']);
    }
}
