<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "catalog".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $image
 * @property int $created_at
 *
 * @property AuthorCatalog[] $authorCatalogs
 * @property Author[] $authors
 */
class Catalog extends \yii\db\ActiveRecord
{

    const DEFAULT_IMAGE_NAME = 'default.png';


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%catalog}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['title', 'required'],
            [['title', 'description', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'image' => 'Image',
            'created_at' => 'Published',
        ];
    }

    /**
     * Gets query for [[AuthorCatalogs]].
     *
     * @return \yii\db\ActiveQuery|AuthorCatalogQuery
     */
    public function getAuthorCatalogs()
    {
        return $this->hasMany(AuthorCatalog::class, ['catalog_id' => 'id']);
    }

    /**
     * Gets query for [[Authors]].
     *
     * @return \yii\db\ActiveQuery|AuthorQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])->viaTable(AuthorCatalog::tableName(), ['catalog_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CatalogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CatalogQuery(get_called_class());
    }

    /**
     * Link author to this catalog
     *
     * @param $authorId
     * @return bool
     */
    public function addAuthor($authorId)
    {
        $author = Author::findOne($authorId);
        if ($author === null )
            return false;
        $this->link('authors', $author);
        return true;
    }

    /**
     * Unlink author from this catalog
     *
     * @param $authorId
     * @return bool
     */
    public function deleteAuthor($authorId)
    {
        $author = Author::findOne($authorId);
        if ($author === null )
            return false;
        $this->unlink('authors', $author, true);
        return true;
    }

    public function addAuthors(array $authorIds)
    {

        foreach ($authorIds as $authorId) {
            if ( !$this->addAuthor($authorId) ) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param int|Author $author
     * @return bool
     */
    public function hasAuthor($author)
    {
        if ( is_object($author) ) {
            return in_array($author, $this->authors );
        }
        return in_array( (int) $author, $this->getAuthorsId() );
    }

    /**
     * Getting ids of authors linked to this catalog
     *
     * @return array
     */
    public function getAuthorsId()
    {
        $query = new Query();
        $authors = $query
            ->from(AuthorCatalog::tableName())
            ->where(['catalog_id' => $this->id])
            ->select('author_id')->all();
        return ArrayHelper::getColumn($authors, 'author_id');
    }


    /**
     * Setting default image for the catalog
     *
     * @return string
     */
    public function setDefaultImage()
    {
        return $this->image = \Yii::$app->params['catalog.imagePath'] . '/' . static::DEFAULT_IMAGE_NAME;
    }

    /**
     * Lokking whether this is default image or not
     * @return bool
     */
    public function isDefaultImage()
    {
        return $this->image === \Yii::$app->params['catalog.imagePath'] . '/' . static::DEFAULT_IMAGE_NAME;
    }
}
