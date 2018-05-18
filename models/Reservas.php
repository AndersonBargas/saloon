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
 * @property string $inicio
 * @property string $termino
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
            [['usuario', 'sala', 'observacao', 'inicio', 'termino'], 'required'],
            [['usuario', 'sala'], 'integer'],
            [['observacao'], 'string'],
            [['inicio', 'termino'], 'safe'],
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
            'usuario' => 'Usuario',
            'sala' => 'Sala',
            'observacao' => 'Observacao',
            'inicio' => 'Inicio',
            'termino' => 'Termino',
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
