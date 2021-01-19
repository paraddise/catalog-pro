<?php


namespace app\models;
use yii\base\Model;
use yii\base\Security;
use yii\helpers\StringHelper;
use yii\web\UploadedFile;

/**
 * Class CreateCatalogForm
 * It's used during catalog update and create actions
 * @package app\models\
 * @property UploadedFile $imageFile
 * @property Catalog $_catalog
 * @property string $title title of the catalog
 * @property string $description description of the catalog
 * @property string $published represents date in string format, after validation convert to $created_at
 * @property int $created_at timestamp, can be less then zero
 *
 */
class CreateCatalogForm extends Model
{

    public $title;
    public $description;
    public $imageFile;
    public $created_at;
    public $published;
    public $authors = [];

    protected $_catalog = null;

    public function rules()
    {
        return [
            [['title', 'description'], 'string', 'max' => 255],
            [['title', 'authors', 'published'], 'required'],
            ['imageFile', 'image',
                'extensions' => 'png, jpg, jpeg',
                'minHeight' => '150',
                'minWidth' => '150',
                'maxSize' => 2*1024*1024
            ],
            ['authors', 'each', 'rule' => ['integer']],
            ['authors', 'each', 'rule' => [
                'exist',
                'skipOnError' => false,
                'targetClass' => Author::class,
                'targetAttribute' => ['authors' => 'id']
                ]
            ],
            ['published', 'date', 'timestampAttribute' => 'created_at', 'format' => 'MMMM d, y']
        ];
    }

    /**
     * Setting catalog to write to
     * @param Catalog $catalog
     */
    public function setCatalog(Catalog $catalog)
    {
        $this->_catalog = $catalog;
    }

    /**
     * @return Catalog|null
     */
    public function getCatalog()
    {
        return $this->_catalog;
    }


    /**
     * {@inheritdoc}
     * @return bool
     */
    public function save()
    {
        if ( !$this->validate() )
            return false;
        // If catalog is not set, create new
        if ($this->_catalog === null) {
            $this->_catalog = new Catalog();
        }

        $this->_catalog->title = $this->title;
        $this->_catalog->description = $this->description;
        $this->_catalog->created_at = $this->created_at;

        $transaction = \Yii::$app->db->beginTransaction();
        $authorsIds = $this->_catalog->getAuthorsId();
        // Upload the catalog image
        if ( !$this->upload() )
            return false;
        // If catalog saved link/unlink it to/from its authors
        if ( $this->_catalog->save() && $this->_catalog->refresh()) {

            // Adding new authors
            if ( !empty($authorsToAdd = array_diff($this->authors, $authorsIds)) ) {
                foreach ($authorsToAdd as $authorId) {
                    if (!$this->_catalog->addAuthor($authorId)) {
                        $this->addError('authors', "Cannot add author with id: {$authorId}");
                        $transaction->rollBack();
                        return false;
                    }
                }
            }

            // Deleting authors
            if ( !empty($authorsToAdd = array_diff($authorsIds, $this->authors)) ) {
                foreach ($authorsToAdd as $authorId) {
                    if (!$this->_catalog->deleteAuthor($authorId)) {
                        $this->addError('authors', "Cannot delete author with id: {$authorId}");
                        $transaction->rollBack();
                        return false;
                    }
                }
            }

            $transaction->commit();
            return true;
        } else {
            $transaction->rollBack();
            return false;
        }
    }

    /**
     * Upload image
     *
     * @return bool
     * @throws \yii\base\Exception
     */
    public function upload()
    {
        if ($this->imageFile === null) {
            if ($this->_catalog->image == null && !$this->_catalog->isDefaultImage())
                $this->_catalog->setDefaultImage();
            return true;
        }

        $filename = \Yii::$app->params['catalog.imagePath'] .
            '/' . \Yii::$app->security->generateRandomString(128)
            . '.' . $this->imageFile->extension;
        if ($this->imageFile->saveAs(\Yii::getAlias('@webroot') . $filename, true)) {
            if (!$this->_catalog->isDefaultImage()) {
                $oldFile = \Yii::getAlias('@webroot') . $this->_catalog->image;
                unlink($oldFile);
            }
            $this->_catalog->image = $filename;
            return true;
        }

        $this->addError('imageFile', 'Cannot save image, please try another image');
        return false;
    }

    public static function fromCatalog(Catalog $catalog)
    {
        $model = new static();
        $model->setCatalog($catalog);
        $model->title = $catalog->title;
        $model->description = $catalog->description;
        $model->authors = $catalog->getAuthorsId();
        $model->published = $catalog->created_at;
        return $model;
    }

}