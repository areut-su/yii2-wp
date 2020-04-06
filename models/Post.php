<?php

namespace areutYii2Wp\models;

use Yii;

/**
 * This is the model class for table "{{%posts}}".
 *
 * @property int $ID
 * @property int $post_author
 * @property string $post_date
 * @property string $post_date_gmt
 * @property string $post_content
 * @property string $post_title
 * @property string $post_excerpt
 * @property string $post_status
 * @property string $comment_status
 * @property string $ping_status
 * @property string $post_password
 * @property string $post_name
 * @property string $to_ping
 * @property string $pinged
 * @property string $post_modified
 * @property string $post_modified_gmt
 * @property string $post_content_filtered
 * @property int $post_parent
 * @property string $guid
 * @property int $menu_order
 * @property string $post_type
 * @property string $post_mime_type
 * @property int $comment_count
 *
 * @property Comment[] $comments
 * @property PostMeta[] $postmeta
 * @property User $postAuthor
 * @property TermRelationship[] $termRelationships
 * @property TermTaxonomy[] $termTaxonomies
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%posts}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_author', 'post_parent', 'menu_order', 'comment_count'], 'integer'],
            [['post_date', 'post_date_gmt', 'post_modified', 'post_modified_gmt'], 'safe'],
            [['post_content', 'post_title', 'post_excerpt', 'to_ping', 'pinged', 'post_content_filtered'], 'required'],
            [['post_content', 'post_title', 'post_excerpt', 'to_ping', 'pinged', 'post_content_filtered'], 'string'],
            [['post_status', 'comment_status', 'ping_status', 'post_type'], 'string', 'max' => 20],
            [['post_password', 'guid'], 'string', 'max' => 255],
            [['post_name'], 'string', 'max' => 200],
            [['post_mime_type'], 'string', 'max' => 100],
            [['post_author'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['post_author' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'ID'),
            'post_author' => Yii::t('app', 'Post Author'),
            'post_date' => Yii::t('app', 'Post Date'),
            'post_date_gmt' => Yii::t('app', 'Post Date Gmt'),
            'post_content' => Yii::t('app', 'Post Content'),
            'post_title' => Yii::t('app', 'Post Title'),
            'post_excerpt' => Yii::t('app', 'Post Excerpt'),
            'post_status' => Yii::t('app', 'Post Status'),
            'comment_status' => Yii::t('app', 'Comment Status'),
            'ping_status' => Yii::t('app', 'Ping Status'),
            'post_password' => Yii::t('app', 'Post Password'),
            'post_name' => Yii::t('app', 'Post Name'),
            'to_ping' => Yii::t('app', 'To Ping'),
            'pinged' => Yii::t('app', 'Pinged'),
            'post_modified' => Yii::t('app', 'Post Modified'),
            'post_modified_gmt' => Yii::t('app', 'Post Modified Gmt'),
            'post_content_filtered' => Yii::t('app', 'Post Content Filtered'),
            'post_parent' => Yii::t('app', 'Post Parent'),
            'guid' => Yii::t('app', 'Guid'),
            'menu_order' => Yii::t('app', 'Menu Order'),
            'post_type' => Yii::t('app', 'Post Type'),
            'post_mime_type' => Yii::t('app', 'Post Mime Type'),
            'comment_count' => Yii::t('app', 'Comment Count'),
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery|CommentQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['comment_post_ID' => 'ID']);
    }

    /**
     * Gets query for [[Postmeta]].
     *
     * @return \yii\db\ActiveQuery|PostMetaQuery
     */
    public function getPostmeta()
    {
        return $this->hasMany(PostMeta::className(), ['post_id' => 'ID']);
    }

    /**
     * Gets query for [[PostAuthor]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getPostAuthor()
    {
        return $this->hasOne(User::className(), ['ID' => 'post_author']);
    }

    /**
     * Gets query for [[TermRelationships]].
     *
     * @return \yii\db\ActiveQuery|TermRelationshipQuery
     */
    public function getTermRelationships()
    {
        return $this->hasMany(TermRelationship::className(), ['object_id' => 'ID']);
    }

    /**
     * Gets query for [[TermTaxonomies]].
     *
     * @return \yii\db\ActiveQuery|TermTaxonomyQuery
     */
    public function getTermTaxonomies()
    {
        return $this->hasMany(TermTaxonomy::className(), ['term_taxonomy_id' => 'term_taxonomy_id'])->viaTable('{{%term_relationships}}', ['object_id' => 'ID']);
    }

    /**
     * {@inheritdoc}
     * @return PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }
}
