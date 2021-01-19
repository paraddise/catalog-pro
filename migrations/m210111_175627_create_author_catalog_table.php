<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author_catalog}}`.
 */
class m210111_175627_create_author_catalog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%author_catalog}}', [
            'author_id' => $this->integer()->notNull(),
            'catalog_id' => $this->integer()->notNull()
        ]);
        $this->addPrimaryKey('author_catalog_pk', '{{%author_catalog}}', ['author_id', 'catalog_id']);
        $this->addForeignKey('author_id_fk', '{{%author_catalog}}', 'author_id', '{{%author}}', 'id', 'CASCADE');
        $this->addForeignKey('catalog_id_fk', '{{%author_catalog}}', 'catalog_id', '{{%catalog}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('author_id_fk', '{{%author_catalog}}');
        $this->dropForeignKey('catalog_id_fk', '{{%author_catalog}}');
        $this->dropTable('{{%author_catalog}}');
    }
}
