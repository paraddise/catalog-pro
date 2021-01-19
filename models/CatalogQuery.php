<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Catalog]].
 *
 * @see Catalog
 */
class CatalogQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Catalog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Catalog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * Searching catalog by word
     *
     * @param $keyword
     * @return CatalogQuery
     */
    public function byKeyword($keyword)
    {
        return $this
            ->andWhere("MATCH(title,description) AGAINST (:keyword WITH QUERY EXPANSION)", ['keyword' => $keyword]);
    }


}
