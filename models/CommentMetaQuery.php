<?php

namespace areutYii2Wp\models;

/**
 * This is the ActiveQuery class for [[CommentMeta]].
 *
 * @see CommentMeta
 */
class CommentMetaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CommentMeta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CommentMeta|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
