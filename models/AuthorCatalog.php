<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author_catalog".
 *
 * @property int $author_id
 * @property int $catalog_id
 *
 * @property Author $author
 * @property Catalog $catalog
 */
class AuthorCatalog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%author_catalog}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'catalog_id'], 'required'],
            [['author_id', 'catalog_id'], 'integer'],
            [['author_id', 'catalog_id'], 'unique', 'targetAttribute' => ['author_id', 'catalog_id']],
            [['author_id'], 'exist', 'skipOnError' => false, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
            [['catalog_id'], 'exist', 'skipOnError' => false, 'targetClass' => Catalog::class, 'targetAttribute' => ['catalog_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'author_id' => 'Author',
            'catalog_id' => 'Catalog',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Catalog]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalog()
    {
        return $this->hasOne(Catalog::class, ['id' => 'catalog_id']);
    }
}
