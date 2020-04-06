<?php

namespace areutYii2Wp\models;

use Yii;

/**
 * This is the model class for table "{{%comments}}".
 *
 * @property int           $comment_ID
 * @property int           $comment_post_ID
 * @property string        $comment_author
 * @property string        $comment_author_email
 * @property string        $comment_author_url
 * @property string        $comment_author_IP
 * @property string        $comment_date
 * @property string        $comment_date_gmt
 * @property string        $comment_content
 * @property int           $comment_karma
 * @property string        $comment_approved
 * @property string        $comment_agent
 * @property string        $comment_type
 * @property int           $comment_parent
 * @property int           $user_id
 *
 * @property CommentMeta[] $commentmeta
 * @property Post          $commentPost
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%comments}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment_post_ID', 'comment_karma', 'comment_parent', 'user_id'], 'integer'],
            [['comment_author', 'comment_content'], 'required'],
            [['comment_author', 'comment_content'], 'string'],
            [['comment_date', 'comment_date_gmt'], 'safe'],
            [['comment_author_email', 'comment_author_IP'], 'string', 'max' => 100],
            [['comment_author_url'], 'string', 'max' => 200],
            [['comment_approved', 'comment_type'], 'string', 'max' => 20],
            [['comment_agent'], 'string', 'max' => 255],
            [
                ['comment_post_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(),
                'targetAttribute' => ['comment_post_ID' => 'ID'],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'comment_ID' => Yii::t('app', 'Comment ID'),
            'comment_post_ID' => Yii::t('app', 'Comment Post ID'),
            'comment_author' => Yii::t('app', 'Comment Author'),
            'comment_author_email' => Yii::t('app', 'Comment Author Email'),
            'comment_author_url' => Yii::t('app', 'Comment Author Url'),
            'comment_author_IP' => Yii::t('app', 'Comment Author Ip'),
            'comment_date' => Yii::t('app', 'Comment Date'),
            'comment_date_gmt' => Yii::t('app', 'Comment Date Gmt'),
            'comment_content' => Yii::t('app', 'Comment Content'),
            'comment_karma' => Yii::t('app', 'Comment Karma'),
            'comment_approved' => Yii::t('app', 'Comment Approved'),
            'comment_agent' => Yii::t('app', 'Comment Agent'),
            'comment_type' => Yii::t('app', 'Comment Type'),
            'comment_parent' => Yii::t('app', 'Comment Parent'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * Gets query for [[Commentmeta]].
     *
     * @return \yii\db\ActiveQuery|CommentMetaQuery
     */
    public function getCommentmeta()
    {
        return $this->hasMany(CommentMeta::className(), ['comment_id' => 'comment_ID']);
    }

    /**
     * Gets query for [[CommentPost]].
     *
     * @return \yii\db\ActiveQuery|PostQuery
     */
    public function getCommentPost()
    {
        return $this->hasOne(Post::className(), ['ID' => 'comment_post_ID']);
    }

    /**
     * {@inheritdoc}
     * @return CommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommentQuery(get_called_class());
    }
}
