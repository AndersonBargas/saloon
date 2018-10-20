<?php

use yii\db\Migration;

/**
 * Handles the creation of table `historico`.
 */
class m181019_230859_create_historico_table extends Migration
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
        $this->createTable('historico', [
            'id'            => $this->primaryKey(),
            'idUsuario'     => $this->integer()->notNull(),
            'dataHistorico' => $this->dateTime()->notNull(),
            'ip'            => $this->string(15)->notNull(),
            'host'          => $this->string(90)->notNull(),
            'navegador'     => $this->string(130)->notNull(),
            'comentario'    => $this->string(80)->notNull(),
            'url'           => $this->string(220)->notNull(),
            'detalhes'      => $this->text(),
        ]);

        $this->addForeignKey(
            'historico_usuario_fk',
            'historico',
            'idUsuario',
            'usuarios',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('historico');
    }
}
