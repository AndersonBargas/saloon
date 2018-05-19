<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "usuarios".
 *
 * @property string $id
 * @property string $nome
 * @property string $email
 * @property string $senha
 * @property bool $administrador
 * @property string $dataCriacao
 * @property string $dataExclusao
 *
 * @property Historico[] $historicos
 * @property Reservas[] $reservas
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'email', 'senha'], 'required'],
            [['administrador'], 'boolean'],
            [['dataCriacao', 'dataExclusao'], 'safe'],
            [['nome', 'email', 'senha'], 'string', 'max' => 120],
            [['email'], 'unique'],
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
            'email' => 'Email',
            'senha' => 'Senha',
            'administrador' => 'Administrador',
            'dataCriacao' => 'Data Criacao',
            'dataExclusao' => 'Data Exclusao',
        ];
    }

    /**
     * Função para fazermos o hook no evento de inserção
     * e criarmos a hash da senha.
     * 
     * @param boolean
     * @return boolean
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (isset($this->senha) && !empty($this->senha)){
                $this->senha = Yii::$app->getSecurity()->generatePasswordHash($this->senha);
            }
            if ($this->isNewRecord){
                $this->dataCriacao = new Expression('NOW()');
            }
            return true;
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoricos()
    {
        return $this->hasMany(Historico::className(), ['idUsuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reservas::className(), ['usuario' => 'id']);
    }
}
