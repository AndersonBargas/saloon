<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "salas".
 *
 * @property string $id
 * @property string $nome
 * @property int $lotacao
 * @property bool $projetor
 * @property bool $som
 *
 * @property Reservas[] $reservas
 */
class Salas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'salas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'lotacao'], 'required'],
            [['lotacao'], 'integer'],
            [['projetor', 'som'], 'boolean'],
            [['nome'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'lotacao' => 'Lotação',
            'projetor' => 'Projetor',
            'som' => 'Som',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reservas::className(), ['sala' => 'id']);
    }
}
