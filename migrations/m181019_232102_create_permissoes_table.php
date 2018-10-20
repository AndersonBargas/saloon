<?php

use app\components\Metadata as MetaDataController;

use yii\db\Migration;
use \yii\db\Query;
use Codeception\Test\Metadata;

/**
 * Handles the creation of table `permissoes`.
 */
class m181019_232102_create_permissoes_table extends Migration
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
        $this->createTable('permissoes', [
            'id'          => $this->primaryKey(),
            'idPerfil'    => $this->integer()->notNull(),
            'controlador' => $this->string(15)->notNull(),
            'acao'        => $this->string(15)->notNull(),
        ]);

        $this->addForeignKey(
            'permissoes_perfis_fk',
            'permissoes',
            'idPerfil',
            'perfis',
            'id',
            'CASCADE'
        );

        $idPerfilAdministrador = (new Query())->from('perfis')->scalar($this->getDb());

        $metadata = new MetaDataController;
        $controladores = $metadata->getControllers();
        foreach (array_values($controladores) as $controlador) {
            $controladorSemSufixo = mb_substr($controlador, 0, -10);
            $acoes = $metadata->getActions($controlador);
            foreach ($acoes as $acao) {
                $this->insert('permissoes', [
                    'idPerfil'    => $idPerfilAdministrador,
                    'controlador' => $controladorSemSufixo,
                    'acao'        => $acao,
                ]);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $idPerfilAdministrador = (new Query())->from('perfis')->scalar($this->getDb());
        $this->delete('permissoes', [
            'idPerfil' => $idPerfilAdministrador,
        ]);
        $this->dropTable('permissoes');
    }
}
