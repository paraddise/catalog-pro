<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Author]].
 *
 * @see Author
 */
class AuthorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Author[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Author|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * Search for the author by keyword(it can be 1 symbol)
     *
     * @param $keyword
     * @return AuthorQuery
     */
    public function byKeyword($keyword)
    {
        return parent::andWhere("MATCH(first_name,last_name,patronymic) AGAINST (:keyword IN BOOLEAN MODE)", ['keyword' => $keyword]);
    }
}
