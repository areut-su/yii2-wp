<?php

namespace areutYii2Wp\models;

use Yii;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property int        $ID
 * @property string     $user_login
 * @property string     $user_pass
 * @property string     $user_nicename
 * @property string     $user_email
 * @property string     $user_url
 * @property string     $user_registered
 * @property string     $user_activation_key
 * @property int        $user_status
 * @property string     $display_name
 *
 * @property Post[]     $posts
 * @property UserMeta[] $usermeta
 */
class User extends BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_registered'], 'safe'],
            [['user_status'], 'integer'],
            [['user_login'], 'string', 'max' => 60],
            [['user_pass', 'user_activation_key'], 'string', 'max' => 255],
            [['user_nicename'], 'string', 'max' => 50],
            [['user_email', 'user_url'], 'string', 'max' => 100],
            [['display_name'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'ID'),
            'user_login' => Yii::t('app', 'User Login'),
            'user_pass' => Yii::t('app', 'User Pass'),
            'user_nicename' => Yii::t('app', 'User Nicename'),
            'user_email' => Yii::t('app', 'User Email'),
            'user_url' => Yii::t('app', 'User Url'),
            'user_registered' => Yii::t('app', 'User Registered'),
            'user_activation_key' => Yii::t('app', 'User Activation Key'),
            'user_status' => Yii::t('app', 'User Status'),
            'display_name' => Yii::t('app', 'Display Name'),
        ];
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery|PostQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['post_author' => 'ID']);
    }

    /**
     * Gets query for [[Usermeta]].
     *
     * @return \yii\db\ActiveQuery|UserMetaQuery
     */
    public function getUsermeta()
    {
        return $this->hasMany(UserMeta::className(), ['user_id' => 'ID']);
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
