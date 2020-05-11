<?php

namespace areutYii2Wp\models;

use Yii;

/**
 * This is the model class for table "{{%postmeta}}".
 *
 * @property int $meta_id
 * @property int $post_id
 * @property string|null $meta_key
 * @property string|null $meta_value
 *
 * @property Post $post
 */
class PostMeta extends BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%postmeta}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id'], 'integer'],
            [['meta_value'], 'string'],
            [['meta_key'], 'string', 'max' => 255],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'meta_id' => Yii::t('app', 'Meta ID'),
            'post_id' => Yii::t('app', 'Post ID'),
            'meta_key' => Yii::t('app', 'Meta Key'),
            'meta_value' => Yii::t('app', 'Meta Value'),
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery|PostQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['ID' => 'post_id']);
    }

    /**
     * {@inheritdoc}
     * @return PostMetaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostMetaQuery(get_called_class());
    }
}
