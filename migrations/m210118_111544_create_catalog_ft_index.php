<?php

use yii\db\Migration;

/**
 * Class m210118_111544_create_catalog_ft_index
 */
class m210118_111544_create_catalog_ft_index extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE {{%catalog}} ADD FULLTEXT title_desc_ft_idx(title,description) WITH PARSER `ngram`");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('title_desc_ft_idx', '{{%catalog}}');
    }


}
