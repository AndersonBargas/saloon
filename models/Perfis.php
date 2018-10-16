<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

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
    use \mootensai\relation\RelationTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perfis';
    }

    public static function getDb()
    {
        return Yii::$app->dbBase;
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

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['criacao'],
                ],
                'value' => new Expression('NOW()'),
            ],
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
    /*public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['idPerfil' => 'id']);
    }*/

}
