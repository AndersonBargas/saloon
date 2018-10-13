<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "perfis".
 *
 * @property string $id
 * @property string $nome
 * @property string $criacao
 *
 * @property Permissoes[] $permissoes
 * @property Usuarios[] $usuarios
 */
class Perfis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perfis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['criacao'], 'safe'],
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
            'criacao' => 'Data Criação',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissoes()
    {
        return $this->hasMany(Permissoes::className(), ['idPerfil' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['idPerfil' => 'id']);
    }
}
