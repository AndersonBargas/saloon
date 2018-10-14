<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "permissoes".
 *
 * @property string $id
 * @property string $idPerfil
 * @property string $controlador
 * @property string $acao
 *
 * @property Perfis $perfil
 */
class Permissoes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'permissoes';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbBase');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPerfil', 'controlador', 'acao'], 'required'],
            [['idPerfil'], 'integer'],
            [['controlador', 'acao'], 'string', 'max' => 150],
            [['idPerfil'], 'exist', 'skipOnError' => true, 'targetClass' => Perfis::className(), 'targetAttribute' => ['idPerfil' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idPerfil' => 'Id Perfil',
            'controlador' => 'Controlador',
            'acao' => 'Acao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerfil()
    {
        return $this->hasOne(Perfis::className(), ['id' => 'idPerfil']);
    }
}
