<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "usuarios".
 *
 * @property string $id
 * @property string $nome
 * @property string $email
 * @property string $senha
 * @property bool $administrador
 * @property string $criacao
 *
 * @property Historico[] $historicos
 * @property Reservas[] $reservas
 */
class Usuarios extends ActiveRecord implements \yii\web\IdentityInterface
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
            [['criacao'], 'safe'],
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
            'email' => 'E-mail',
            'senha' => 'Senha',
            'administrador' => 'Administrador',
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
            return true;
        }
        return false;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * Localiza uma identidade pelo ID informado
     *
     * @param string|int $id o ID a ser localizado
     * @return IdentityInterface|null o objeto da identidade que corresponde ao ID informado
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Localiza uma identidade pela chave informada
     *
     * @param string $chave a chave a ser localizada
     * @return IdentityInterface|null o objeto da identidade que corresponde a chave informada
     */
    public static function findIdentityByAccessToken($token, $type = NULL)
    {
        return false;
    }

    /**
     * @return string a chave de autenticação do usuário atual
     */
    public function getAuthKey()
    {
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
     * @return int|string o ID do usuário atual
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Retorna o primeiro nome do usuário logado
     * 
     * @return string
     */
    public function getPrimeiroNome()
    {
        return explode(' ', $this->nome)[0];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reservas::className(), ['usuario' => 'id']);
    }

    /**
     * @param string $chave
     * @return bool se a chave de autenticação do usuário atual for válida
     */
    public function validateAuthKey($chave)
    {
        return false;
    }

    /**
     * Valida a senha
     *
     * @param string $password senha a ser validada
     * @return bool se a senha está correta
     */
    public function validatePassword($senha)
    {
        return $this->senha === $senha;
    }
}
