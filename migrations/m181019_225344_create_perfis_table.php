<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `perfis`.
 */
class m181019_225344_create_perfis_table extends Migration
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
        $this->createTable('perfis', [
            'id'      => $this->primaryKey(),
            'nome'    => $this->string(50)->unique()->notNull(),
            'criacao' => $this->dateTime()->notNull(),
        ]);

        $this->insert('perfis', [
            'nome'    => 'Administrador',
            'criacao' => new Expression('NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('perfis', [
            'nome' => 'Administrador',
        ]);
        $this->dropTable('perfis');
    }
}
