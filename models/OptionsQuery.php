<?php

namespace areutYii2Wp\models;

/**
 * This is the ActiveQuery class for [[Options]].
 *
 * @see Options
 */
class OptionsQuery extends \yii\db\ActiveQuery
{
    public function autoload()
    {
        return $this->andWhere(['autoload' => 'yes']);
    }

    /**
     * {@inheritdoc}
     * @return Options[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Options|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $key int|string|array
     *
     * @return OptionsQuery
     */

    public function whereKey($key)
    {
        if (is_array($key))
        {
            return $this->andWhere(['in', Options::FIELD_OPTION_NAME, $key]);
        }

        return $this->andWhere([Options::FIELD_OPTION_NAME => $key]);
    }

}
