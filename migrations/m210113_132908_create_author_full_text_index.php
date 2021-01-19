<?php

use yii\db\Migration;

/**
 * Class m210113_132908_create_author_full_text_index
 */
class m210113_132908_create_author_full_text_index extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE {{%author}} ADD FULLTEXT fullname_fulltext_index(first_name,last_name,patronymic) WITH PARSER `ngram`");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('fullname_fulltext_index', '{{%author}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210113_132908_create_author_full_text_index cannot be reverted.\n";

        return false;
    }
    */
}
