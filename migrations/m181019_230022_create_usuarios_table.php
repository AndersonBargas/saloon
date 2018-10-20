<?php

use yii\base\Security;
use yii\db\Expression;
use yii\db\Migration;
use \yii\db\Query;

/**
 * Handles the creation of table `usuarios`.
 */
class m181019_230022_create_usuarios_table extends Migration
{
    public function init()
    {
        $this->db = 'dbBase';
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('usuarios', [
            'id'       => $this->primaryKey(),
            'nome'     => $this->string(120)->notNull(),
            'email'    => $this->string(120)->unique(),
            'senha'    => $this->string(120)->notNull(),
            'idPerfil' => $this->integer()->notNull(),
            'criacao'  => $this->dateTime()->notNull(),
        ]);

        $this->addForeignKey(
            'usuarios_perfis_fk',
            'usuarios',
            'idPerfil',
            'perfis',
            'id',
            'CASCADE'
        );

        $idPerfilAdministrador = (new Query())->from('perfis')->scalar($this->getDb());
        $security = new Security;
        $this->insert('usuarios', [
            'nome'     => 'Admin da Silva',
            'email'    => 'admin@admin.com',
            'senha'    => $security->generatePasswordHash('admin'),
            'idPerfil' => $idPerfilAdministrador,
            'criacao'  => new Expression('NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('usuarios', [
            'email' => 'admin@admin.com',
        ]);
        $this->dropTable('usuarios');
    }
}