<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reservas".
 *
 * @property string $id
 * @property string $usuario
 * @property string $sala
 * @property string $observacao
 * @property string $data
 * @property int $hora
 *
 * @property Salas $sala0
 * @property Usuarios $usuario0
 */
class Reservas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reservas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario', 'sala', 'observacao', 'data', 'hora'], 'required'],
            [['usuario', 'sala', 'hora'], 'integer'],
            [['observacao'], 'string'],
            [['data'], 'safe'],
            [['sala', 'data', 'hora'], 'unique', 'targetAttribute' => ['sala', 'data', 'hora']],
            [['sala'], 'exist', 'skipOnError' => true, 'targetClass' => Salas::className(), 'targetAttribute' => ['sala' => 'id']],
            [['usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario' => 'Usuário',
            'sala' => 'Sala',
            'observacao' => 'Observação',
            'data' => 'Data',
            'hora' => 'Hora',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSala0()
    {
        return $this->hasOne(Salas::className(), ['id' => 'sala']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario0()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario']);
    }
}
