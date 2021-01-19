<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AuthorCatalog]].
 *
 * @see AuthorCatalog
 */
class AuthorCatalogQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AuthorCatalog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AuthorCatalog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
