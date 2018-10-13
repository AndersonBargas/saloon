<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "permissoes".
 *
 * @property string $id
 * @property string $idPerfil
 * @property string $rota
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPerfil'], 'integer'],
            [['rota'], 'string', 'max' => 150],
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
            'rota' => 'Rota',
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
