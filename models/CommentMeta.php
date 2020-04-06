<?php

namespace areutYii2Wp\models;

use Yii;

/**
 * This is the model class for table "{{%commentmeta}}".
 *
 * @property int $meta_id
 * @property int $comment_id
 * @property string|null $meta_key
 * @property string|null $meta_value
 *
 * @property Comment $comment
 */
class CommentMeta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%commentmeta}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment_id'], 'integer'],
            [['meta_value'], 'string'],
            [['meta_key'], 'string', 'max' => 255],
            [
                ['comment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::className(),
                'targetAttribute' => ['comment_id' => 'comment_ID'],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'meta_id' => Yii::t('app', 'Meta ID'),
            'comment_id' => Yii::t('app', 'Comment ID'),
            'meta_key' => Yii::t('app', 'Meta Key'),
            'meta_value' => Yii::t('app', 'Meta Value'),
        ];
    }

    /**
     * Gets query for [[Comment]].
     *
     * @return \yii\db\ActiveQuery|CommentQuery
     */
    public function getComment()
    {
        return $this->hasOne(Comment::className(), ['comment_ID' => 'comment_id']);
    }

    /**
     * {@inheritdoc}
     * @return CommentMetaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommentMetaQuery(get_called_class());
    }
}
