<?php

namespace areutYii2Wp\models;

/**
 * This is the ActiveQuery class for [[PostMeta]].
 *
 * @see PostMeta
 */
class PostMetaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PostMeta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PostMeta|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
