<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $patronymic
 *
 * @property AuthorCatalog[] $authorCatalogs
 * @property Catalog[] $catalogs
 * @property string $fullName
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%author}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'patronymic'], 'string', 'max' => 255],
            ['last_name', 'string', 'min' => 3, 'max' => 255],
            [['first_name', 'last_name'], 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'patronymic' => 'Patronymic',
        ];
    }

    /**
     * Gets query for [[AuthorCatalogs]].
     *
     * @return \yii\db\ActiveQuery|AuthorCatalogQuery
     */
    public function getAuthorCatalogs()
    {
        return $this->hasMany(AuthorCatalog::class, ['author_id' => 'id']);
    }

    /**
     * Gets query for [[Catalogs]].
     *
     * @return \yii\db\ActiveQuery|CatalogQuery
     */
    public function getCatalogs()
    {
        return $this->hasMany(Catalog::class, ['id' => 'catalog_id'])->viaTable('author_catalog', ['author_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return AuthorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthorQuery(get_called_class());
    }

    /**
     * Returns first_name + last_name + patronymic(if set)
     * @return string
     */
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name . ($this->patronymic != '' ? $this->patronymic : '');
    }
}
