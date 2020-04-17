<?php

namespace areutYii2Wp\yii\identity;

use areutYii2Wp\models\UserMeta;
use areutYii2Wp\models\UserMetaQuery;
use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
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
 * @property UserMeta[] $userMetas
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
//class User extends \yii\base\BaseObject implements IdentityInterface
{
    const USER_LEVEL_ADMINISTRATOR = 10;
    const USER_LEVEL_EDITOR        = 7;
    const USER_LEVEL_AUTHOR        = 2;
    const USER_LEVEL_CONTRIBUTOR   = 1;
    const USER_LEVEL_SUBSCRIBER    = 0;

    /**
     * @var int
     */
    public $default_user_level = self::USER_LEVEL_ADMINISTRATOR;
    /**
     * @var bool
     */
    public $strictt_user_level = false;

    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    public function insert($runValidation = true, $attributeNames = null)
    {
        return false;
    }

    public function update($runValidation = true, $attributeNames = null)
    {
        return false;
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['user_pass',],
                function($m, $a) {
                    return false;
                },
            ],
        ];
    }

    /**
     * @return array
     *
     */
    public function attributeLabels()
    {
        // todo change translate app
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
     * Gets query for [[Usermeta]].
     *
     * @return \yii\db\ActiveQuery|UserMetaQuery
     */
    public function getUserMeta()
    {
        return $this->hasMany(UserMeta::class, ['user_id' => 'ID'])->indexBy('meta_key');
    }

    /**
     * @param $user_login
     *
     * @return User|IdentityInterface|null
     */
    public static function findByUsername($user_login)
    {
        return static::findOne(['user_login' => $user_login]);
    }

    /**
     * @param int|string $id
     *
     * @return User|IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


    /**
     * @inheritDoc findIdentityByAccessToken is not implemented.
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

        throw new NotSupportedException('findIdentityByAccessToken не поддерживается');
    }

    /**
     * @return int|mixed|string
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @return string
     */
    public function getAuthKey()
    {
        return md5(substr($this->user_pass, 2, 8) . (string)$this->user_registered
                   . substr(Yii::$app->security->authKeyInfo, 2, 8));
    }

    /**
     * @param string $authKey
     *
     * @return bool
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }


    /**
     * @param string $meta_key
     *
     * @return string
     */
    public static function meta_key_prefix($meta_key)
    {
        return static::getDb()->tablePrefix . $meta_key;
    }

    /**
     * @param $meta_key
     *
     * @return |null
     */

    public function getUserMetaValue($meta_key)
    {
        $meta_key = static::getDb()->tablePrefix . $meta_key;

        return isset($this->userMeta[$meta_key]) ? $this->userMeta[$meta_key]->meta_value : null;
    }

    /**
     * only  WP admin
     * for other role use EVENT and set $default_user_level $strictt_user_level
     *
     * @param $password
     *
     * @return bool
     */
    public function validatePassword($password)
    {
        return (new PasswordHash(8, true))
                   ->CheckPassword($password, $this->user_pass)
               && $this->validateUserLevel($this->default_user_level, $this->strictt_user_level);

    }

    /**
     *
     * @param int  $user_level User::USER_LEVEL_???
     *
     * @param bool $strict     true '=' , false '>='
     *
     * @return bool
     */
    public function validateUserLevel($user_level, $strict = false)
    {
        return UserMeta::find()
            ->where([
                    'user_id' => $this->ID,
                    'meta_key' => self::meta_key_prefix('user_level'),
                ]
            )
            ->andWhere(
                [$strict ? '>=' : '=', 'meta_value', $user_level]
            )
            ->exists();
    }

    public function getUserName()
    {
        return $this->display_name;
    }

    public function getLogin()
    {
        return $this->user_login;
    }

    public function getEmail()
    {
        return $this->user_email;
    }


}
